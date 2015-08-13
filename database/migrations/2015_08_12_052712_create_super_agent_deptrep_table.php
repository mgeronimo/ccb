<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuperAgentDeptrepTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('super_agent_deptrep', function (Blueprint $table) {
            $table->increments('id');
            $table->String('email', 45);
            $table->String('first_name', 45);
            $table->String('last_name', 45);
            $table->String('username', 45);
            $table->String('password', 45);
            $table->integer('role')->nullable();

            $table->unsignedInteger('group_number')->nullable();
            $table->foreign('group_number')->references('id')->on('groups')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('super_agent_deptrep', function (Blueprint $table) {
            $table->dropForeign('super_agent_deptrep_group_number_foreign');
        });
        Schema::drop('super_agent_deptrep');
    }
}
