<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTravelersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travelers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('name');
            $table->string('gender');
            $table->integer('birthday');
            $table->string('password');
            $table->integer('phone');
            $table->integer('country_id')->unsigned();
            $table->string('city');
            $table->integer('language_id')->unsigned();
            $table->integer('language2_id')->unsigned();
            $table->integer('language3_id')->unsigned();
            $table->integer('language4_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('language_id')->references('id')->on('languages');
            $table->foreign('language2_id')->references('id')->on('languages');
            $table->foreign('language3_id')->references('id')->on('languages');
            $table->foreign('language4_id')->references('id')->on('languages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('travelers');
    }
}
