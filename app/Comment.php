<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'ticket_comments';
    protected $fillable = ['comment', 'user_id', 'commenter_role', 'attachment', 'ticket_id'];

    public function getDates()
	{
	    return [
	        'created_at',
	        'updated_at',
	    ];
	}
}