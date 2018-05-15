<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $table = 'role';

    public function assignee(){
        return $this->belongsToMany('App\Assignee');
    }
}
