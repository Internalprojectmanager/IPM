<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    protected $table = "requirement";

    public $incrementing = false;

    protected $fillable = [
        'id','name', 'description', 'feature_uuid', 'status'
    ];
    public function features(){
        return $this->belongsTo('App\Feature', "feature_uuid", 'feature_uuid');
    }

    public function releases(){
        return $this->belongsTo('App\Release', 'release_id', 'release_uuid');
    }

    public function assignees(){
        return $this->hasMany('App\Assignee', "uuid", "requirement_uuid");
    }

    public function rstatus(){
        return $this->hasOne('App\Status', "id", "status");
    }
}
