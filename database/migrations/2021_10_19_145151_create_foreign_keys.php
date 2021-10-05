<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function(Blueprint $table) {
            $table->foreign('restaurant_id')->references('id')->on('users')
                ->onDelete('cascade');
        });
        Schema::table('coupons', function(Blueprint $table) {
            $table->foreign('restaurant_id')->references('id')->on('users')
                ->onDelete('cascade');
        });

        Schema::table('products', function(Blueprint $table) {
            $table->foreign('restaurant_id')->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')
                ->onDelete('cascade');
        });

        Schema::table('social_media', function(Blueprint $table) {
            $table->foreign('restaurant_id')->references('id')->on('users')
                ->onDelete('cascade');
        });

        Schema::table('restaurant_basic_infos', function(Blueprint $table) {
            $table->foreign('restaurant_id')->references('id')->on('users')
                ->onDelete('cascade');
        });



        Schema::table('drinks', function(Blueprint $table) {
            $table->foreign('restaurant_id')->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('category_id')->references('id')->on('categories')
                ->onDelete('cascade');
        });


        Schema::table('branches', function(Blueprint $table) {
            $table->foreign('restaurant_id')->references('id')->on('users')
                ->onDelete('cascade');
        });

        Schema::table('announcements', function(Blueprint $table) {
            $table->foreign('restaurant_id')->references('id')->on('users')
                ->onDelete('cascade');
        });

        Schema::table('accounts', function(Blueprint $table) {
            $table->foreign('restaurant_id')->references('id')->on('users')
                ->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function(Blueprint $table) {
            $table->dropForeign('restaurant_id');
        });

        Schema::table('coupons', function(Blueprint $table) {
            $table->dropForeign('restaurant_id');
        });
        Schema::table('products', function(Blueprint $table) {
            $table->dropForeign('restaurant_id');
            $table->dropForeign('category_id');
        });
    }
}
