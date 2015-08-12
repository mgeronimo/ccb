<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->String('comment', 255);
            $table->integer('usr_id');
            $table->integer('is_ccb_agent');
            $table->String('attachment');
            $table->timestamps('commented_at');

            $table->unsignedInteger('ticket_id')->nullable();
            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ticket_comments', function (Blueprint $table) {
            $table->dropForeign('ticket_comments_ticket_id_foreign');
        });
        Schema::drop('ticket_comments');
    }
}
