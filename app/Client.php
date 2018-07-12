<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Kyslik\ColumnSortable\Sortable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;

class Client extends Model
{
    protected $table = "client";

    use Sortable, Searchable, Sluggable;

    public $sortable = ['name', 'contactname'];

    protected $sortableAs = ['projects_count', 'cstatus_name'];

    protected $fillable = [
        'id','name', 'description', 'path', 'status', 'team_id'
    ];

    public function getRouteKeyName()
    {
        return 'path';
    }

    public function projects()
    {
        return $this->hasMany('App\Project', "company_id", "id")->orderBy('deadline', 'desc');
    }

    public function cstatus()
    {
        return $this->hasOne('App\Status', "id", "status");
    }

    public function scopePath($query, $path)
    {
        return $query->where('path', $path);
    }

    public function team()
    {
        return $this->hasOne('App\Team', 'id', 'teamid');
    }

    public function ScopeCurrentUserTeam($query)
    {
        if (Auth::user()->teams() !== null) {
            $ids = [];
            foreach (Auth::user()->teams() as $t) {
                $ids [] = $t->id;
            }
            return $query->wherein('team_id', $ids);
        }   return $query->where('team_id', null);
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
