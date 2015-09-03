<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $fillable = ['username', 'email', 'password', 'first_name', 'last_name', 'contact_number', 'role', 'remember_token'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function group()
    {
        return $this -> belongsTo('App/Group');
    }

    public function supervisor()
    {
         $this->role = 1;
         $this->save();
    }
    
    public function agent()
    {
         $this->role = 2;
         $this->save();
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function($user){
            $user->token = str_random(10);
        });
    }

}
