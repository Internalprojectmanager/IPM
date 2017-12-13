<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Kyslik\ColumnSortable\Sortable;

class Client extends Model
{
    protected $table = "client";

    use Sortable, Searchable;

    public $sortable = ['name', 'contact', 'status', 'count', 'projects'];

    protected $fillable = [
        'id','name', 'description'
    ];

    public function projects(){
        return $this->hasMany('App\Project', "company_id", "id")->orderBy('deadline', 'desc');
    }

    public function cstatus(){
        return $this->hasOne('App\Status', "id", "status");
    }
}
