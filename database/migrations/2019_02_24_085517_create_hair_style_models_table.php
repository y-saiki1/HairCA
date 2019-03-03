<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHairStyleModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hair_style_models', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('face_type_id')->unsigned();
            $table->integer('hair_type_id')->unsigned();
            $table->integer('hair_bold_type_id')->unsigned();
            $table->integer('hair_amount_type_id')->unsigned();

            $table->integer('age')->unsigned();
            $table->integer('sex')->unsigned();
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
        Schema::dropIfExists('hair_style_models');
    }
}
