<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = "company";

    protected $fillable = [
        'id','name', 'description'
    ];

    public function projects(){
        return $this->hasMany('App\Project', "company_id", "id");
    }
}
