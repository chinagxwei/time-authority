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
        Schema::create('schedules_topics', function (Blueprint $table) {
            $table->integer('schedule_id');
            $table->uuid('topic_id');
            $table->primary(['schedule_id', 'topic_id']);
            $table->comment('日程话题表');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules_topics');
    }
};
