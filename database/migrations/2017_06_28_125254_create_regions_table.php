<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create the table for regional locality
        Schema::create('regions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('user')->nullable()->default('Kizito');
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
        // Deletes the transactions table from the database
        Schema::dropIfExists('regions');
    }
}
