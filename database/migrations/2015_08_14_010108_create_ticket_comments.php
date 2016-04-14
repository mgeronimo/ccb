<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketComments extends Migration
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
            $table->integer('is_comment');
            $table->text('comment');
            $table->integer('user_id');
            $table->integer('commenter_role');
            $table->string('attachment', 255);
            $table->string('class', 20);
            $table->timestamps('commented_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ticket_comments');
    }
}
