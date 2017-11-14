<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LetterRevision extends Model
{
    protected $table = "letter_revision";

    public function letter(){
        return $this->hasMany('App\Letter', "letter_id", "letter_id");
    }
}
