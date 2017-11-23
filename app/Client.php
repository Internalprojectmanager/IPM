<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = "client";

    public $incrementing = false;

    protected $fillable = [
        'id','name', 'description'
    ];

    public function projects(){
        return $this->hasMany('App\Project', "company_id", "id")->orderBy('deadline', 'desc');
    }
}
