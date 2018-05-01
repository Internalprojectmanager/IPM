<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name', 'email', 'password', 'active', 'provider', 'provider_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function teams(){
        return $this->belongsToMany('App\Team')->wherePivot('current', true);
    }

    public function jobtitles(){
        return $this->hasOne('App\Status', 'id', 'job_title');
    }


    /**
     * Magically crypt the password whenever its set on the modal because otherwise remembering to do it can get ugly
     * at least you know it's now done
     *
     * @param String $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}