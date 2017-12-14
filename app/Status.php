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

    public function project(){
        return $this->belongsTo('App\Project', "status", 'id');
    }

    public function client(){
        return $this->belongsTo('App\Client', "status", 'id');
    }
}
