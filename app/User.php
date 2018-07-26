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

    public function fullName()
    {
        return $this->attributes['first_name']. ' ' .$this->attributes['last_name'];
    }


    public function team()
    {
        return $this->belongsToMany('App\Team')
            ->withPivot('active', 'current')
            ->wherePivot('active', true)
            ->orderBy('current', 'desc');
    }

    public function emails()
    {
        return $this->hasMany('App\UserMail');
    }

    public function teams()
    {
        return $this->team()->get();
    }

    public function jobtitles()
    {
        return $this->hasOne('App\Status', 'id', 'job_title');
    }

    public function assingees()
    {
        return $this->hasMany('App\Assignee', 'userid', 'id');
    }

    public function getTotal()
    {
        return $this->count();
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

    public function currentTeam()
    {
        return $this->team()->wherePivot('current', true)->first();
    }

    public function toDo()
    {
        $todo = 0;
        $assignees = $this->assingees()->get();

        foreach ($assignees as $s) {
            if ($s->requirements()->first() !== null) {
                if ($s->astatus() !== null) {
                    if ($s->astatus()->first()->name !== Status::name('completed')->name) {
                        $todo++;
                    }
                }
            }
        }
        return $todo;
    }

    public function getAvatar()
    {
        if ($this->avatar !== null) {
            $avatar =  $this->avatar;
        } else {
            $avatar = 'https://www.gravatar.com/avatar/'. md5($this->email).'?s=200&r=g&d=identicon';
        }
        return $avatar;
    }
}
