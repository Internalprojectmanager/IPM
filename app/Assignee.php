<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignee extends Model
{
    public $timestamps = false;
    protected $table = "assignee";

    protected $fillable = [
        'userid','project_id', 'uuid'
    ];

    public function projects()
    {
        return $this->hasOne('App\Project', "id", "project_id")->orderBy('deadline', 'desc');
    }

    public function requirements()
    {
        return $this->hasOne('App\Requirement', "requirement_uuid", "uuid");
    }

    public function users()
    {
        return $this->hasOne('App\User', "id", "userid");
    }

    public function astatus()
    {
        return $this->hasOne('App\Status', "id", "status");
    }

    public function role()
    {
        return $this->belongsToMany('App\Role', 'role_assignee');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role', 'role_assignee')->get();
    }
}
