<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = "project";

    public function releases(){
        return $this->hasMany('App\Release', "project_id", "id");
    }

    public function companies(){
        return $this->belongsTo('App\Company', "id", 'company_id');
    }
}
