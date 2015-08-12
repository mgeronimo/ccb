<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->String('message', 255);
            $table->integer('status');

            $table->unsignedInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('public_users')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedInteger('assignee')->nullable();
            $table->foreign('assignee')->references('id')->on('super_agent_deptrep')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedInteger('dept_id')->nullable();
            $table->foreign('dept_id')->references('id')->on('departments')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign('tickets_created_by_foreign');
            $table->dropForeign('tickets_assignee_foreign');
            $table->dropForeign('tickets_dept_id_foreign');
        });
        Schema::drop('tickets');
    }
}
