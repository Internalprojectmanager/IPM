<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Kyslik\ColumnSortable\Sortable;

class Release extends Model
{
    use Searchable, Sortable, Sluggable;
    protected $table = "release";

    public $sortable = ['name', 'description', 'status', 'deadline', 'created_at'];

    public $incrementing = false;

    protected $fillable = [
        'id','name', 'description', 'versie', 'specificationtype', 'project_id'
    ];

    public function features(){
        return $this->hasMany('App\Feature', "release_uuid", "release_uuid");
    }

    public function projects(){
        return $this->belongsTo('App\Project', "project_id", 'id');
    }

    public function rstatus(){
        return $this->hasOne('App\Status', 'id', 'status');
    }
    public function dstatus(){
        return $this->hasOne('App\Status', 'id', 'document_status');
    }

    public function user(){
        return $this->hasOne('App\User', 'id', 'author');
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
