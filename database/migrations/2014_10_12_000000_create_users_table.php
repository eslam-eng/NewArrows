<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable()->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->enum('active',[0,1])->default(1);

//            $table->string('phone_1');
//            $table->string('phone_2')->nullable();
//            $table->string('phone_3')->nullable();
//            $table->string('desc')->nullable();
//            $table->string('facebook')->nullable();
//            $table->string('twitter')->nullable();
//            $table->string('instagram')->nullable();
//            $table->string('snapchat')->nullable();
//            $table->integer('delivery_cost')->nullable();
//            $table->integer('tax')->nullable();
//            $table->integer('additional_cost')->nullable();
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
        Schema::dropIfExists('users');
    }
}
