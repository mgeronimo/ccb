<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OauthSession extends Model
{
    public $timestamps = false;
    protected $table = 'oauth_sessions';
}
