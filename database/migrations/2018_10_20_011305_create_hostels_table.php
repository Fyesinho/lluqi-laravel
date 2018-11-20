<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHostelsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hostels', function (Blueprint $table) {
            $table->increments('id');
            $table->text('avatar');
            $table->string('name_hostel');
            $table->string('name_host');
            $table->integer('city_id')->unsigned();
            $table->string('main_picture');
            $table->integer('verified');
            $table->integer('start_stay');
            $table->integer('end_stay');
            $table->integer('travelers_reciebed');
            $table->integer('calification');
            $table->string('web');
            $table->string('phone');
            $table->string('description');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('city_id')->references('id')->on('cities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('hostels');
    }
}
