<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_managers', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->uuid('organization_id')->index()->nullable()->comment('组织ID');
            $table->string('nickname',128)->nullable()->comment('昵称');
            $table->string('avatar',128)->nullable()->comment('头像');
            $table->string('remark',128)->nullable()->comment('备注');
            $table->string('mobile',18)->index()->nullable()->comment('联系电话');
            $table->string('remark',128)->nullable()->comment('备注');
            $table->integer('login_at')->unsigned()->nullable();
            $table->integer('created_at')->unsigned()->nullable();
            $table->integer('updated_at')->unsigned()->nullable();
            $table->integer('created_by')->index()->unsigned()->nullable()->comment('用户ID');
            $table->integer('updated_by')->index()->unsigned()->nullable()->comment('用户ID');
            $table->integer('deleted_at')->unsigned()->nullable();
            $table->comment('组织表');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organization_managers');
    }
};
