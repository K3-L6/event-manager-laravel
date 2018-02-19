<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubeventlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subeventlogs', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('time');
            $table->integer('subevent_id')->unsigned();
            $table->foreign('subevent_id')->references('id')->on('subevents')->onDelete('cascade');
            $table->integer('guest_id')->unsigned();
            $table->foreign('guest_id')->references('id')->on('guests')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subeventlogs');
    }
}
