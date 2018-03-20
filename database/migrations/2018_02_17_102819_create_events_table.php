<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('title_font');
            $table->string('title_size');
            $table->string('title_color');
            $table->smallInteger('title_show')->unsigned();

            $table->text('description')->nullable();
            $table->text('description_font');
            $table->text('description_size');
            $table->text('description_color');
            $table->smallInteger('description_show')->unsigned();



            $table->string('background')->default('noimg.jpg');
            $table->smallInteger('status')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
