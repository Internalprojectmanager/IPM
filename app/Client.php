<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Kyslik\ColumnSortable\Sortable;
use Cviebrock\EloquentSluggable\Sluggable;


class Client extends Model
{
    protected $table = "client";

    use Sortable, Searchable, Sluggable;

    public $sortable = ['name', 'contactname'];

    protected $sortableAs = ['projects_count', 'cstatus_name'];

    protected $fillable = [
        'id','name', 'description', 'path', 'status'
    ];

    public function getRouteKeyName()
    {
        return 'path';
    }

    public function projects(){
        return $this->hasMany('App\Project', "company_id", "id")->orderBy('deadline', 'desc');
    }

    public function cstatus(){
        return $this->hasOne('App\Status', "id", "status");
    }

    public function scopePath($query, $path){
        return $query->where('path', $path);
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
