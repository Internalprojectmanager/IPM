<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = "project";

    public $incrementing = false;

    protected $fillable = [
        'id','name', 'description', 'company_id'
    ];

    public function releases(){
        return $this->hasMany('App\Release', "project_id", "id");
    }

    public function company(){
        return $this->belongsTo('App\Client');
    }
}
