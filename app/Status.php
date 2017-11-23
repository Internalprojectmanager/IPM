<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = "status";

    protected $fillable = [
        'id', 'name', 'type', 'color'
    ];

    public function project(){
        return $this->belongsTo('App\Project', "status", 'id');
    }

    public function client(){
        return $this->belongsTo('App\Client', "status", 'id');
    }
}
