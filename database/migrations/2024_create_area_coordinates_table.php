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
        Schema::create('area_coordinates', function (Blueprint $table) {
            $table->integer('area_id')->index()->nullable()->comment('区域ID');
            $table->integer('coordinate_id')->index()->nullable()->comment('坐标ID');
            $table->primary(['area_id', 'coordinate_id']);
            $table->comment('区域坐标关联表');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('area_coordinates');
    }
};
