<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStyleBookDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('style_book_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('style_book_id')->unsigned();
            $table->integer('origin_hair_color_id')->unsigned();
            $table->integer('about_hair_color_id')->unsigned();
            $table->integer('detail_hair_color_id')->unsigned();
            $table->integer('hair_length_type_id')->unsigned();
            
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
        Schema::dropIfExists('style_book_details');
    }
}
