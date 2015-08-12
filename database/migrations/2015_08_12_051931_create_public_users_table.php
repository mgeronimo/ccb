<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('public_users', function (Blueprint $table) {
            $table->increments('id');
            $table->String('email', 45);
            $table->String('password', 45);
            $table->String('first_name', 45);
            $table->String('last_name', 45);
            $table->String('contact_number', 45);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('public_users');
    }
}
