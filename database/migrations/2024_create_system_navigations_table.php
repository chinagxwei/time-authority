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
        Schema::create('system_navigations', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('parent_id')->index()->unsigned()->nullable()->comment('父导航ID');
            $table->string('navigation_name', 64)->comment('导航名称');
            $table->string('navigation_link', 64)->nullable()->comment('导航链接');
            $table->tinyInteger('menu_show')->unsigned()->default(1)->nullable()->comment('菜单显示');
            $table->integer('navigation_sort')->unsigned()->nullable()->comment('导航排序');
            $table->string('icon', 64)->nullable()->comment('导航图标');
            $table->integer('created_at')->unsigned()->nullable();
            $table->integer('updated_at')->unsigned()->nullable();
            $table->integer('created_by')->index()->unsigned()->nullable()->comment('用户ID');
            $table->integer('updated_by')->index()->unsigned()->nullable()->comment('用户ID');
            $table->integer('deleted_at')->unsigned()->nullable();
            $table->comment('平台导航表');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_navigations');
    }
};
