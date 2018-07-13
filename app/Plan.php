<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    public $table = 'plan';
    public $timestamps = false;

    public function scopeName($query, $name)
    {
        return $query->where('name', $name)->firstorfail();
    }

    public function team()
    {
        return $this->belongsToMany('App\Team', 'team_plan')
            ->withPivot('start', 'end')
            ->wherePivot('end', '>=', \Carbon\Carbon::now('Europe/Amsterdam')->toDateTimeString())
            ->orderBy('end', 'ASC')
            ->orderBy('plan_id', 'desc')
            ->get();
    }
}
