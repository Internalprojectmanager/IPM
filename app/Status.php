<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Laravel\Scout\Searchable;

class Status extends Model
{
    protected $table = "status";

    use Searchable, Sortable;

    public $sortable = ['name'];

    protected $fillable = [
        'id', 'name', 'type', 'color'
    ];

    public function scopeName($query, $name)
    {
        return $query->where('name', $name)->first();
    }

    public function scopeType($query, $type)
    {
        return $query->where('type', $type);
    }


    public function project(){
        return $this->belongsTo('App\Project', "id", 'status');
    }

    public function client(){
        return $this->belongsTo('App\Client', "id", 'status');
    }

    public function requirements(){
        return $this->belongsTo('App\Requirement', "id", 'status');
    }

    public function release(){
        return $this->belongsTo('App\Release', "id", 'status');
    }

    public function feature(){
        return $this->belongsTo('App\Feature', "id", 'status');
    }
}
