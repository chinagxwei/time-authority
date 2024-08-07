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
        Schema::create('location_venue_schedules', function (Blueprint $table) {
            $table->uuid('venue_id')->index()->nullable()->comment('场地ID');
            $table->uuid('schedule_id')->index()->nullable()->comment('日程安排ID');
            $table->bigInteger('price')->unsigned()->nullable()->comment('价格（单位：分）');
            $table->integer('unit_id')->unsigned()->comment('单位ID');
            $table->string('order_sn',64)->index()->nullable()->comment('订单编号');
            $table->integer('created_at')->unsigned()->nullable();
            $table->integer('updated_at')->unsigned()->nullable();
            $table->integer('created_by')->index()->unsigned()->nullable()->comment('用户ID');
            $table->integer('updated_by')->index()->unsigned()->nullable()->comment('用户ID');
            $table->integer('deleted_at')->unsigned()->nullable();
            $table->primary(['venue_id', 'schedule_id']);
            $table->comment('场地日程安排表');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('location_venue_schedules');
    }
};
