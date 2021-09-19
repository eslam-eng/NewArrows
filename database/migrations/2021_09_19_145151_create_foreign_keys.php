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
    }
}
