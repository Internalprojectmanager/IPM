<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    protected $table = "requirement";

    public function features(){
        return $this->belongsTo('App\Feature', "id", 'feature_id');
    }
}
