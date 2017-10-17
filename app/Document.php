<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = "document";

    public $incrementing = false;

    protected $fillable = [
        'id','title', 'description', 'author', 'project_id'
    ];

    public function features(){
        return $this->hasMany('App\Feature', "document_id", "id");
    }

    public function projects(){
        return $this->belongsTo('App\Project', "id", 'project_id');
    }
}
