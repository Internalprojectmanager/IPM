<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testrapport extends Model
{
    protected $table = "testrapport";

    public $incrementing = false;

    protected $fillable = [
        'id','title', 'description', 'author', 'status', 'project_id'
    ];

    public function features(){
        return $this->hasMany('App\Feature', "testrapport_id", "id");
    }

    public function projects(){
        return $this->belongsTo('App\Project', "id", 'testrapport_id');
    }
}