<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Kyslik\ColumnSortable\Sortable;;

class Project extends Model
{
    use Sortable, Searchable;

    public $sortable = ['name', 'description', 'status', 'deadline', 'users', 'created_at'];

    protected $table = "project";

    protected $fillable = [
        'id','name', 'description', 'company_id'
    ];


    public function releases(){
        return $this->hasMany('App\Release', "project_id", "id");
    }

    public function company(){
        return $this->belongsTo('App\Client');
    }

    public function pstatus(){
        return $this->hasOne('App\Status', "id", 'status')->orderByRaw("FIELD(name , 'Draft', 'In Progress', 'Testing', 'Paused', 'Final', 'Completed') ASC");
    }

    public function assignee(){
        return $this->hasMany('App\Assignee', "uuid", "id");
    }

    public static function updateDeadline($project){
        $currentrelease = Release::where([["project_id", "=", $project->id]])->where('deadline', '>=', Carbon::now())->orderby('deadline', 'asc')->first();
        $project->deadline = $currentrelease->deadline;
        $project->save();
    }

    public static function updateStatus($project){
        $currentrelease = Release::where([["project_id", "=", $project->id]])->where('deadline', '>=', Carbon::now())->orderby('deadline', 'asc')->first();
        $project->status = $currentrelease->status;
        $project->save();

    }

    public function scopePath($query, $path){
        return $query->where('path', $path);
    }
}
