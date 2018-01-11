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

}
