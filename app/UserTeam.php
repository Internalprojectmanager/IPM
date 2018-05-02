<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTeam extends Model
{
    protected $table = 'team_user';

    public $timestamps = false;
}
