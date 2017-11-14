<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReleaseRevision extends Model
{
    protected $table = "release_revision";

    protected $fillable = [
        'id','title', 'description', 'author', 'project_id'
    ];

    public function release(){
        return $this->hasMany('App\Release', "release_uuid", "release_id");
    }
}
