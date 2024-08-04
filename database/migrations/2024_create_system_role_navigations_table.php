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
        Schema::create('system_role_navigations', function (Blueprint $table) {
            $table->integer('role_id')->unsigned();
            $table->integer('navigation_id')->unsigned();
            $table->primary(['role_id', 'navigation_id']);
            $table->comment('管理员角色菜单表');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_role_navigations');
    }
};
