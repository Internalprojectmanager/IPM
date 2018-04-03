<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Kyslik\ColumnSortable\Sortable;

class Requirement extends Model
{
    use Searchable, Sortable;

    protected $table = "requirement";

    public $incrementing = false;

    protected $fillable = [
        'id','name', 'description', 'feature_uuid', 'status'
    ];

    public $sortable = ['name', 'description', 'status', 'deadline', 'created_at'];


    public function features(){
        return $this->belongsTo('App\Feature', "feature_uuid", 'feature_uuid');
    }

    public function releases(){
        return $this->belongsTo('App\Release', 'release_id', 'release_uuid');
    }

    public function assignees(){
        return $this->hasMany('App\Assignee', "uuid", "requirement_uuid");
    }

    public function rstatus(){
        return $this->hasOne('App\Status', "id", "status");
    }
}
