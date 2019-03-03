<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Schema\Blueprint;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * スタイルブック系
         * |-------------------------------------|
         * |style_books / style_book_repositories|
         * |-------------------------------------|
         */

         // style_books
        Schema::table('style_books', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade')->onUpdate('cascade');
                
            $table->foreign('style_book_repository_id')->references('id')
                ->on('style_book_repositories')->onUpdate('cascade');
        });

        // style_book_repositories
        Schema::table('style_book_repositories', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        // hair_style_models
        Schema::table('hair_style_models', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade')->onUpdate('cascade');
            
            $table->foreign('face_type_id')->references('id')
                ->on('face_types')->onUpdate('cascade');
            
            $table->foreign('hair_type_id')->references('id')
                ->on('hair_types')->onUpdate('cascade');
            
            $table->foreign('hair_bold_type_id')->references('id')
                ->on('hair_bold_types')->onUpdate('cascade');

            $table->foreign('hair_amount_type_id')->references('id')
                ->on('hair_amount_types')->onUpdate('cascade');
        });

        // style_book_hair_style_models
        Schema::table('style_book_hair_style_models', function (Blueprint $table) {
            $table->foreign('style_book_id')->references('id')
                ->on('style_books')->onDelete('cascade')->onUpdate('cascade');
            
            $table->foreign('hair_style_model_id')->references('id')
                ->on('hair_style_models')->onDelete('cascade')->onUpdate('cascade');
        });

        // style_book_details
        Schema::table('style_book_details', function (Blueprint $table) {
            $table->foreign('style_book_id')->references('id')
                ->on('style_books')->onDelete('cascade')->onUpdate('cascade');
            
            $table->foreign('origin_hair_color_id')->references('id')
                ->on('origin_hair_colors')->onUpdate('cascade');

            $table->foreign('about_hair_color_id')->references('id')
                ->on('about_hair_colors')->onUpdate('cascade');

            $table->foreign('detail_hair_color_id')->references('id')
                ->on('detail_hair_colors')->onUpdate('cascade');

            $table->foreign('hair_length_type_id')->references('id')
                ->on('hair_length_types')->onUpdate('cascade');
        });

        /**
         * ユーザー系
         * |--------------------------------------------------------------|
         * |users / guests / stylist_profiles / hair_salons / recommenders|
         * |--------------------------------------------------------------|
         */
        
         //users
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('role_id')->references('id')
                ->on('roles')->onUpdate('cascade');
        });

        // guests
        Schema::table('guests', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        // stylist_profiles
        Schema::table('stylist_profiles', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('base_id')->references('id')
                ->on('bases')->onUpdate('cascade');
        });

        // ヘアサロン
        Schema::table('hair_salons', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        // 推薦者
        Schema::table('recommenders', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('recommender_id')->references('id')
                ->on('users')->onUpdate('cascade');
        });
    }
}
