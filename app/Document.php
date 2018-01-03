<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = "document";

    protected $fillable = [
        'id','title', 'description', 'author', 'project_id'
    ];

    public function features(){
        return $this->hasMany('App\Feature', "document_id", "id");
    }

    public function projects(){
        return $this->belongsTo('App\Project', "project_id", 'id');
    }

    public function release(){
        return $this->belongsTo('App\Release', "release_id", 'release_uuid');
    }

    public function dstatus(){
        return $this->hasOne('App\Status', "id", 'status');
    }

    public function categories(){
        return $this->hasOne('App\Status', "id", 'category');
    }
}
