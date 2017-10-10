<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    protected $table = "requirement";

    public $incrementing = false;

    protected $fillable = [
        'id','name', 'description', 'feature_id', 'status'
    ];
    public function features(){
        return $this->belongsTo('App\Feature', "id", 'feature_id');
    }
}
