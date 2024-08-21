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
        Schema::create('area_venues', function (Blueprint $table) {
            $table->integer('area_id')->index()->nullable()->comment('区域ID');
            $table->uuid('venue_id')->index()->nullable()->comment('场地ID');
            $table->primary(['area_id', 'venue_id']);
            $table->comment('区域场地关联表');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('area_venues');
    }
};
