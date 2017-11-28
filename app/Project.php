<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Project extends Model
{
    protected $table = "project";

    use Searchable;

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
}
