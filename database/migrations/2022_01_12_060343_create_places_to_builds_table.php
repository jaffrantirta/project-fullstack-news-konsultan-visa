<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacesToBuildsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places_to_builds', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('building_id')->unsigned();
            $table->bigInteger('place_id')->unsigned();
            $table->timestamps();
            $table->foreign('building_id')->references('id')->on('buildings')->onDelete('cascade');
            $table->foreign('place_id')->references('id')->on('places')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('places_to_builds');
    }
}
