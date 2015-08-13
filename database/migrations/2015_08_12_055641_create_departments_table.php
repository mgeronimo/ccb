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
            $table->integer('is_national');

            $table->unsignedInteger('dept_rep')->nullable();
            $table->foreign('dept_rep')->references('id')->on('super_agent_deptrep')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('departments', function (Blueprint $table) {
            $table->dropForeign('departments_dept_rep_foreign');
        });
        Schema::drop('departments');
    }
}
