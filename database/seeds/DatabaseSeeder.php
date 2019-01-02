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
        Schema::table('style_books', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade')->onUpdate('cascade');
                
            $table->foreign('style_book_repository_id')->references('id')
                ->on('style_book_repositories')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('style_book_repositories', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('style_book_categories', function (Blueprint $table) {
            $table->foreign('style_book_id')->references('id')
                ->on('style_books')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('category_id')->references('id')
                ->on('categories')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('role_id')->references('id')
                ->on('roles')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('likes', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('style_book_id')->references('id')
                ->on('style_books')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('dislikes', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('style_book_id')->references('id')
                ->on('style_books')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('follows', function (Blueprint $table) {
            $table->foreign('followed_id')->references('id')
                ->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('follower_id')->references('id')
                ->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('style_book_id')->references('id')
                ->on('style_books')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('guests', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }
}
