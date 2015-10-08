<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->increments('id');
            $table->String('dept_name', 45);
            $table->integer('is_member');
            $table->integer('regcode')->unsigned();
            $table->integer('provcode')->nullable()->unsigned();
            $table->string('agency_head')->nullable()->default(null);
            $table->integer('contact')->nullable()->default(null);
            $table->string('agency_email')->nullable()->default(null);
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('departments');
    }
}