<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OauthAccessToken extends Model
{
    public $timestamps = false;
    protected $table = 'oauth_access_tokens';
    //protected $fillable = ['id', 'created_by', 'message', 'complainee', 'subject', 'attachments', 'dept_id'];
}
