<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('users', function($table) {
            $table->string('facebook')->nullable();
            $table->string('vimeo')->nullable();
            $table->dateTime('payment_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table('users', function($table) {
            $table->dropColumn('facebook');
            $table->dropColumn('vimeo');
            $table->dropColumn('payment_at');
        });
    }
}
