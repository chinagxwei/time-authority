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
        Schema::create('order_redemptions', function (Blueprint $table) {
            $table->string('order_sn', 64)->index()->nullable()->comment('订单编号')->primary();
            $table->string('write_off_code',64)->nullable()->comment('核销码');
            $table->string('write_off_code_img',64)->nullable()->comment('核销码图片');
            $table->uuid('member_id')->index()->nullable()->comment('销售会员ID');
            $table->string('write_off_at',64)->nullable()->comment('核销时间');
            $table->integer('created_at')->unsigned()->nullable();
            $table->integer('updated_at')->unsigned()->nullable();
            $table->integer('created_by')->index()->unsigned()->nullable()->comment('用户ID');
            $table->integer('updated_by')->index()->unsigned()->nullable()->comment('用户ID');
            $table->integer('deleted_at')->unsigned()->nullable();
            $table->comment('订单核销表');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_redemptions');
    }
};
