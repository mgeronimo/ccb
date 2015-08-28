<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //
     public $timestamps = false;
    protected $table = 'groups';
    protected $fillable = ['id', 'group_name'];

    public function users()
    {
    	return $this->hasMany('App\User', 'group_number');
    }
   
}
