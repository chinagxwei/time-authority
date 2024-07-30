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
        Schema::create('system_units', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('title',64)->nullable()->comment('标题');
            $table->string('description',128)->nullable()->comment('描述');
            $table->string('label',64)->nullable()->comment('中文标签');
            $table->string('symbol',32)->nullable()->comment('单位符号');
            $table->tinyInteger('finance')->unsigned()->default(0)->nullable()->comment('金融单位 0不是 1是');
            $table->integer('created_at')->unsigned()->nullable();
            $table->integer('updated_at')->unsigned()->nullable();
            $table->integer('created_by')->index()->unsigned()->nullable()->comment('用户ID');
            $table->integer('updated_by')->index()->unsigned()->nullable()->comment('用户ID');
            $table->integer('deleted_at')->unsigned()->nullable();
            $table->comment('单位表');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_units');
    }
};
