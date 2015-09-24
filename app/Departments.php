<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
    //
    protected $table = 'departments';

    public $timestamps = false;
    protected $fillable = ['dept_name', 'is_national', 'description'];

    public function users()
    {
    	return $this->hasOne('App\User', 'dept_rep');
    }
}
