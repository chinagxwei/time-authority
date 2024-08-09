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
        Schema::create('member_coupons', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->uuid('member_id')->index()->nullable()->comment('会员ID');
            $table->integer('coupon_id')->index()->nullable()->comment('优惠券ID');
            $table->string('from_order_sn', 64)->index()->nullable()->comment('获取订单编号');
            $table->string('to_order_sn', 64)->index()->nullable()->comment('用于订单编号');
            $table->tinyInteger('status')->default(0)->comment('状态 -1 已取消 0未使用 1已使用 2已过期');
            $table->integer('started_at')->unsigned()->nullable()->comment('开始时间');
            $table->integer('ended_at')->unsigned()->nullable()->comment('结束时间');
            $table->integer('created_at')->unsigned()->nullable();
            $table->integer('updated_at')->unsigned()->nullable();
            $table->integer('created_by')->index()->unsigned()->nullable()->comment('用户ID');
            $table->integer('updated_by')->index()->unsigned()->nullable()->comment('用户ID');
            $table->integer('deleted_at')->unsigned()->nullable();
            $table->comment('会员优惠券表');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member_coupons');
    }
};
