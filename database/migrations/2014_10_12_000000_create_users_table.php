<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');

            $table->date('birthday')->nullable();
            $table->string('phone')->nullable();

            $table->string('role')->default('');

            $table->integer('city_id')->unsigned()->nullable();
            $table->foreign('city_id')->references('id')->on('cities');

            $table->integer('gender_id')->unsigned()->nullable();
            $table->foreign('gender_id')->references('id')->on('genders');

            $table->integer('country_id')->unsigned()->nullable();
            $table->foreign('country_id')->references('id')->on('countries');

            $table->integer('language_id')->unsigned()->nullable();
            $table->integer('language2_id')->unsigned()->nullable();
            $table->integer('language3_id')->unsigned()->nullable();
            $table->integer('language4_id')->unsigned()->nullable();

            $table->foreign('language_id')->references('id')->on('languages');
            $table->foreign('language2_id')->references('id')->on('languages');
            $table->foreign('language3_id')->references('id')->on('languages');
            $table->foreign('language4_id')->references('id')->on('languages');

            $table->rememberToken();
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
