<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMail extends Model
{
    protected $table = 'user_email';

    public $timestamps = false;
    protected $fillable = [
        'user_id','email', 'provider', 'provider_id',
    ];

    public function user(){
        return $this->belongsTo('App\User', 'id', 'user_id');
    }
}
