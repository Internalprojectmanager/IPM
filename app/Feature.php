<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $table = "feature";

    public $incrementing = false;

    protected $fillable = [
        'id','name', 'description', 'status', 'release_id'
    ];

    public function requirements(){
        return $this->hasMany('App\Requirement', "feature_id", "id");
    }

    public function releases(){
        return $this->belongsTo('App\Release', "id", 'release_id');
    }
}
