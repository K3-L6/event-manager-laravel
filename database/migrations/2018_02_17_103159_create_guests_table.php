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
            // 2 for not pre registered
            $table->smallInteger('type')->unsigned();

            //determine if registration is complete
            //0 no tag and badge
            //1 complete with tag and badge
            $table->smallInteger('status')->unsigned()->default(0);
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
