<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create the table for Patients in the Database
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('casetype');
            $table->string('uid')->nullable();
            $table->string('name');
            $table->integer('age');
            $table->string('sex');
            $table->integer('district_id')->unsigned();
            $table->foreign('district_id')->references('id')->on('districts');
            $table->string('village');
            $table->tinyInteger('status');
            $table->string('user');
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
        // Deletes the patients table from the database
        Schema::dropIfExists('patients');
    }
}
