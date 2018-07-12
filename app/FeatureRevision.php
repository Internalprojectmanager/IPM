<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeatureRevision extends Model
{
    protected $table = "feature_revision";

    protected $fillable = [
        'id','name', 'description', 'author', 'release_id'
    ];

    public function feature()
    {
        return $this->hasMany('App\Feature', "feature_uuid", "feature_id");
    }
}
