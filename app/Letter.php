<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    protected $table = "letter";

    public $incrementing = false;

    protected $fillable = [
        'id','title', 'content', 'author', 'contact_person', 'project_id'
    ];

    public function features(){
        return $this->hasMany('App\Feature', "letter_id", "id");
    }

    public function projects(){
        return $this->belongsTo('App\Project', "id", 'project_id');
    }
}
