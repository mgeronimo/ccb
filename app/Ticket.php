<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public $timestamps = false;
    protected $table = 'tickets';
    protected $fillable = ['id', 'created_by', 'message', 'complainee', 'subject', 'attachments', 'dept_id'];
}
