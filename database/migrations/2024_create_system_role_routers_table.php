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
        Schema::create('system_role_routers', function (Blueprint $table) {
            $table->integer('role_id')->unsigned();
            $table->integer('router_id')->unsigned();
            $table->primary(['role_id', 'router_id']);
            $table->comment('角色路由单表');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_role_routers');
    }
};
