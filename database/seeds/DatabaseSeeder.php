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
                ->on('style_book_repositories')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('hair_style_id')->references('id')
                ->on('hair_styles')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('hair_color_id')->references('id')
                ->on('hair_colors')->onDelete('cascade')->onUpdate('cascade');
        });

        // style_book_repositories
        Schema::table('style_book_repositories', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        // style_book_tags
        Schema::table('style_book_tags', function (Blueprint $table) {
            $table->foreign('style_book_id')->references('id')
                ->on('style_books')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('tag_id')->references('id')
                ->on('tags')->onDelete('cascade')->onUpdate('cascade');
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
