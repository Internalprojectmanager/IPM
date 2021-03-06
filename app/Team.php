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

    public function project()
    {
        return $this->hasMany('App\Project');
    }

    public function client()
    {
        return $this->hasMany('App\Client');
    }

    public function owner()
    {
        return $this->hasone('App\User', 'id', 'owner_id');
    }

    public function users()
    {
        return $this->belongsToMany('App\User')
            ->orderBy('team_user.active', 'desc')
            ->orderBy('last_name', 'asc')
            ->withPivot('current', 'active');
    }

    public function plan()
    {

        return $this->belongsToMany('App\Plan', 'team_plan')
            ->withPivot('start', 'end')
            ->wherePivot('end', '>=', \Carbon\Carbon::now('Europe/Amsterdam')->toDateTimeString())
            ->orderBy('end', 'ASC')
            ->first();
    }

    public function plans()
    {
        return $this->belongsToMany('App\Plan', 'team_plan')
            ->withPivot('start', 'end')
            ->wherePivot('end', '>=', \Carbon\Carbon::now('Europe/Amsterdam')->toDateTimeString())
            ->orderBy('end', 'ASC');
    }


    public function scopeCurrentUserTeam($query)
    {
        $currentteam = Auth::user()->currentTeam();
        if ($currentteam !== null) {
            return $query->where('id', $currentteam->id);
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
