<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('idcard')->nullable();
            $table->text('qrcode')->nullable();

            //data from google form
            $table->string('email')->unique();
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('lastname');
            $table->string('designation');
            $table->string('companyname');
            $table->string('officeaddress');
            $table->string('mobilenumber');
            $table->string('officetelnumber');

            //determine if pre registered 
            // 1 for pre registered
            // 2 for not pre registered (WALK IN)
            $table->smallInteger('type')->unsigned();

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
        Schema::dropIfExists('guests');
    }
}
