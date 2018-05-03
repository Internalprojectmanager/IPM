<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Team extends Model
{
    protected $table = 'teams';

    protected $fillable = ['name', 'owner_id'];

    public $sortable = ['name'];


    public $timestamps = false;


    public function scopeName($query, $name)
    {
        return $query->where('name', $name)->firstorfail();
    }

    public function client(){
        return $this->belongsToMany('App\Project');
    }

    public function users(){
        return $this->belongsToMany('App\User')
            ->orderBy('team_user.active', 'desc')
            ->orderBy('last_name', 'asc')
            ->withPivot('current', 'active');
    }

    public function ScopeCurrentUserTeam($query){
        if(Auth::user()->currentTeam() !== null){
            return $query->where('id', Auth::user()->currentTeam()->id);

        }   return $query->where('id', null);
    }

    public function sluggable()
    {
        return [
            'path' => [
                'source' => 'name'
            ]
        ];
    }
}
