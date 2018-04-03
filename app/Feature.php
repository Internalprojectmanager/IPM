<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use Sluggable;
    protected $table = "feature";

    public $incrementing = false;

    protected $fillable = [
        'id','feature_uuid','name', 'description', 'status', 'release_id', 'revision_log'
    ];

    public function requirements(){
        return $this->hasMany('App\Requirement', "feature_uuid", "feature_uuid");
    }

    public function releases(){
        return $this->belongsTo('App\Release', "release_id", 'release_uuid');
    }

    public function fstatus(){
        return $this->hasOne('App\Status', "id", "status");
    }

    public function fcategory(){
        return $this->hasOne('App\Status', "id", "category");
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
