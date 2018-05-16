<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    public $table = 'plan';

    public function scopeName($query, $name)
    {
        return $query->where('name', $name)->firstorfail();
    }
}
