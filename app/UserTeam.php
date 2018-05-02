<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTeam extends Model
{
    protected $table = 'team_user';

    public $timestamps = false;

    protected $fillable = [
        'user_id','team_id', 'active'
    ];

    public function scopeTeamMember($query, $team, $user){
        return $query->where('team_id', $team)->where('user_id', $user)->firstorfail();
    }

    public function toggleBlock(){

        if($this->attributes['active'] == true){
            $this->attributes['active'] = false;
            $this->attributes['current'] = false;
        }else{
            $this->attributes['active'] = true;
        }

        return $this->attributes;
    }
}
