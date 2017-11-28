<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Client extends Model
{
    protected $table = "client";

    use Searchable;

    protected $fillable = [
        'id','name', 'description'
    ];

    public function projects(){
        return $this->hasMany('App\Project', "company_id", "id")->orderBy('deadline', 'desc');
    }

    public function cstatus(){
        return $this->hasOne('App\Status', "id", "status");
    }
}
