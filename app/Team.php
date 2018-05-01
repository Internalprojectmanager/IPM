<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table = 'teams';

    protected $fillable = ['name'];


    public function scopeName($query, $name)
    {
        return $query->where('name', $name)->first();
    }


    public function client(){
        return $this->belongsToMany('App\Project');
    }

    public function users(){
        return $this->belongsToMany('App\User');
    }
}
