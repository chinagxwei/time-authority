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
        Schema::create('schedule_sales', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->uuid('schedule_id')->index()->nullable()->comment('日程安排ID');
            $table->bigInteger('price')->unsigned()->nullable()->comment('价格（单位：分）');
            $table->integer('unit_id')->unsigned()->comment('单位ID');
            $table->string('order_sn', 64)->index()->nullable()->comment('售出订单编号');
            $table->tinyInteger('status')->default(0)->comment('状态 -1 取消 0 等待 1 成交');
            $table->tinyInteger('openness')->unsigned()->nullable()->comment('开放度 0公开 3私域一对多 7专属一对一 15机构');
            $table->integer('created_at')->unsigned()->nullable();
            $table->integer('updated_at')->unsigned()->nullable();
            $table->integer('created_by')->index()->unsigned()->nullable()->comment('用户ID');
            $table->integer('updated_by')->index()->unsigned()->nullable()->comment('用户ID');
            $table->integer('deleted_at')->unsigned()->nullable();
            $table->comment('日程销售表');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules_sales');
    }
};
