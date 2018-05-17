<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $table = 'roles';

    public $timestamps = false;

    public function scopeName($query, $name)
    {
        return $query->where('name', $name)->firstorfail();
    }

    public function assignee(){
        return $this->belongsToMany('App\Assignee', 'role_assignee');
    }
}
