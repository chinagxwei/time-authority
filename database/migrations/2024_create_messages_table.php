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
        Schema::create('messages', function (Blueprint $table) {
            $table->uuid('id')->unsigned();
            $table->string('title', 128)->comment('标题');
            $table->text('content')->comment('内容');
            $table->tinyInteger('weight')->unsigned()->default(1)->nullable()->comment('消息重要程度 1一般 2重要 3很重要');
            $table->smallInteger('user_type')
                ->unsigned()
                ->default(5)
                ->comment('用户类型 1一般用户 10企业理员 100平台管理员 999超级管理员');
            $table->integer('created_at')->unsigned()->nullable();
            $table->integer('updated_at')->unsigned()->nullable();
            $table->integer('created_by')->index()->unsigned()->nullable()->comment('用户ID');
            $table->integer('updated_by')->index()->unsigned()->nullable()->comment('用户ID');
            $table->integer('deleted_at')->unsigned()->nullable();
            $table->comment('系统消息表');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
};
