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
        Schema::create('quests', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->string('title', 64)->nullable()->comment('标题');
            $table->tinyInteger('stock')->unsigned()->nullable()->comment('任务参与人数');
            $table->bigInteger('price')->unsigned()->nullable()->comment('价格（单位：分）');
            $table->integer('unit_id')->unsigned()->comment('单位ID');
            $table->string('remark', 128)->nullable()->comment('备注');
            $table->tinyInteger('status')->default(0)->comment('状态 0 取消 1发布');
            $table->string('order_sn', 64)->index()->nullable()->comment('任务奖励订单编号');
            $table->integer('started_at')->unsigned()->nullable()->comment('开始时间');
            $table->integer('ended_at')->unsigned()->nullable()->comment('结束时间');
            $table->text('location')->nullable()->comment('位置');
            $table->decimal('latitude',10,8)->nullable()->comment('经度');
            $table->decimal('longitude',11,8)->nullable()->comment('纬度');
            $table->integer('created_at')->unsigned()->nullable();
            $table->integer('updated_at')->unsigned()->nullable();
            $table->integer('created_by')->index()->unsigned()->nullable()->comment('用户ID');
            $table->integer('updated_by')->index()->unsigned()->nullable()->comment('用户ID');
            $table->integer('deleted_at')->unsigned()->nullable();
            $table->comment('任务表');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quests');
    }
};
