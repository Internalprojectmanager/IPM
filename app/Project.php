<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Kyslik\ColumnSortable\Sortable;

class Project extends Model
{
    use Sortable, Searchable;

    public $sortable = ['name', 'description', 'status', 'deadline', 'users'];

    protected $table = "project";

    protected $fillable = [
        'id','name', 'description', 'company_id'
    ];

    public function releases(){
        return $this->hasMany('App\Release', "project_id", "id");
    }

    public function company(){
        return $this->belongsTo('App\Client');
    }

    public function pstatus(){
        return $this->hasOne('App\Status', "id", 'status');
    }

    public function assignee(){
        return $this->hasMany('App\Assignee', "uuid", "id");
    }
}
