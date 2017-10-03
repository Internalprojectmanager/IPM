<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $table = "feature";

    public function requirements(){
        return $this->hasMany('App\Requirement', "feature_id", "id");
    }

    public function releases(){
        return $this->belongsTo('App\Release', "id", 'release_id');
    }
}
