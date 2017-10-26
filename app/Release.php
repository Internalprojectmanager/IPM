<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Release extends Model
{
    protected $table = "release";

    public $incrementing = false;

    protected $fillable = [
        'id','name', 'description', 'versie', 'specificationtype', 'project_id'
    ];

    public function features(){
        return $this->hasMany('App\Feature', "release_id", "id");
    }

    public function projects(){
        return $this->belongsTo('App\Project', "project_id", 'id');
    }
}
