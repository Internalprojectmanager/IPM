<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Team extends Model
{
    use Sluggable;
    protected $table = 'teams';

    protected $fillable = ['name', 'slug', 'owner_id'];

    public $sortable = ['name'];


    public $timestamps = false;


    public function scopeName($query, $name)
    {
        return $query->where('name', $name)->firstorfail();
    }

    public function scopeSlug($query, $slug)
    {
        return $query->where('slug', $slug)->firstorfail();
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

    public function plan(){

        return $this->belongsToMany('App\Plan', 'team_plan')
            ->withPivot('start', 'end')
            ->wherePivot('end', '>', \Carbon\Carbon::now('Europe/Amsterdam')->toDateTimeString())
            ->orwherePivot('end', '=', null )
            ->orderBy('end', 'desc')
            ->first();
    }

    public function ScopeCurrentUserTeam($query){
        if(Auth::user()->currentTeam() !== null){
            return $query->where('id', Auth::user()->currentTeam()->id);

        }   return $query->where('id', null);
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
