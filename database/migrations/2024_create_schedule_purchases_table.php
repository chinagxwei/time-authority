<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules_purchases', function (Blueprint $table) {
            $table->increments('id')->unique()->primary();
            $table->uuid('schedule_sale_id')->index()->nullable()->comment('日程销售ID');
            $table->uuid('member_id')->index()->nullable()->comment('购买会员ID');
            $table->string('order_sn', 64)->index()->nullable()->comment('购买订单编号');
            $table->integer('created_at')->unsigned()->nullable();
            $table->integer('updated_at')->unsigned()->nullable();
            $table->integer('created_by')->index()->unsigned()->nullable()->comment('用户ID');
            $table->integer('updated_by')->index()->unsigned()->nullable()->comment('用户ID');
            $table->integer('deleted_at')->unsigned()->nullable();
            $table->comment('日程购买表');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules_purchases');
    }
};
