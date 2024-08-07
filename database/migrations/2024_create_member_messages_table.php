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
        Schema::create('member_messages', function (Blueprint $table) {
            $table->uuid('member_id');
            $table->uuid('message_id');
            $table->primary(['member_id', 'message_id']);
            $table->comment('会员消息表');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member_messages');
    }
};
