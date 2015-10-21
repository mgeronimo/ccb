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
            $table->string('ticket_id');
            $table->String('message', 255);
            $table->integer('status');
            $table->string('complainee', 100)->nullable();
            $table->string('subject', 160);
            $table->string('attachments', 255);
            $table->datetime('incident_date_time', 25);
            $table->string('category', 5);
            $table->string('duration', 5);
            $table->string('sla_metric', 5);
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
        
        Schema::drop('tickets');
    }
}
