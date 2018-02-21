<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Kyslik\ColumnSortable\Sortable;

class Client extends Model
{
    protected $table = "client";

    use Sortable, Searchable;

    public $sortable = ['name', 'contactname'];

    protected $sortableAs = ['projects_count', 'cstatus_name'];

    protected $fillable = [
        'id','name', 'description', 'path', 'status'
    ];

    public function projects(){
        return $this->hasMany('App\Project', "company_id", "id")->orderBy('deadline', 'desc');
    }

    public function cstatus(){
        return $this->hasOne('App\Status', "id", "status");
    }
}
