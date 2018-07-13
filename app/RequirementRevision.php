<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequirementRevision extends Model
{
    protected $table = "requirement_revision";


    public function document()
    {
        return $this->hasMany('App\Requiremnt', "requirement_uuid", "requirement_id");
    }
}
