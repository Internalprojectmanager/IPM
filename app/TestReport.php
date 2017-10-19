<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestReport extends Model
{
    protected $table = "release";

    public $incrementing = false;

    protected $fillable = [
        'id', 'title', 'description', 'version', 'author', 'status', 'release_id'
    ];

    public function release(){
        return $this->belongsTo('App\Release', "release_id", 'id');
    }
}
