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
        Schema::create('member_tags', function (Blueprint $table) {
            $table->uuid('member_id')->unsigned();
            $table->uuid('tag_id')->unsigned();
            $table->primary(['member_id', 'tag_id']);
            $table->comment('会员标签表');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member_tags');
    }
};
