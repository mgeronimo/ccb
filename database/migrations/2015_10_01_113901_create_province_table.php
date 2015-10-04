<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvinceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('province', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('regcode')->unsigned();
            $table->integer('provcode')->unsigned();
            $table->string('provname');
            $table->foreign('regcode')
                  ->references('id')
                  ->on('region')
                  ->onDelete('cascade') 
                  ->onUpdate('cascade');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('province');
    }
}
