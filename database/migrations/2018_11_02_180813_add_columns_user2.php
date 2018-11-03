<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsUser2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('users', function($table) {
            $table->text('description')->nullable();

            $table->integer('native_language')->unsigned()->nullable();
            $table->foreign('native_language')->references('id')->on('languages');

            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();

            $table->text('about_me')->nullable();
            $table->text('experience')->nullable();

            $table->boolean('is_premium')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table('users', function($table) {
            $table->dropColumn('description');

            $table->dropColumn('native_language');

            $table->dropColumn('instagram');
            $table->dropColumn('youtube');

            $table->dropColumn('about_me');
            $table->dropColumn('experience');

            $table->dropColumn('is_premium');
        });
    }
}
