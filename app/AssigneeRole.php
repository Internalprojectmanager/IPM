<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssigneeRole extends Model
{
    public $timestamps = true;
    protected $table = "role_assignee";

    protected $fillable = [
        'id','name', 'description'
    ];

    public function role(){
        return $this->hasOne('App\Role', 'id','role_id');
    }
}
