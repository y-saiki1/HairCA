<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStylistProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stylist_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('recommender_id')->unsigned();
            $table->integer('age');
            $table->integer('sex');
            $table->text('introduction');
            $table->text('recommendation');
            $table->string('hair_salon_name');
            $table->integer('hair_salon_postal_code');
            $table->string('hair_salon_prefecture');
            $table->string('hair_salon_municipality');
            $table->string('hair_salon_street_number');
            $table->string('hair_salon_building_name')->nullable();
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
        Schema::dropIfExists('eloquent_stylist_profiles');
    }
}
