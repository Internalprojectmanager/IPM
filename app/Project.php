<?php

namespace App;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Facades\Auth;

class Project extends Model
{
    use Sortable, Searchable, Sluggable;

    public $sortable = ['name', 'description', 'status', 'deadline', 'users', 'created_at',  'team_id'];

    protected $table = "project";

    protected $fillable = [
        'id','name', 'description', 'company_id'
    ];


    public function releases()
    {
        return $this->hasMany('App\Release', "project_id", "id");
    }

    public function company()
    {
        return $this->belongsTo('App\Client');
    }

    public function pstatus()
    {
        return $this->hasOne('App\Status', "id", 'status')
            ->orderByRaw("FIELD(name , 'Draft', 'In Progress', 'Testing', 'Paused', 'Final', 'Completed') ASC");
    }

    public function assignee()
    {
        return $this->hasMany('App\Assignee', "uuid", "id");
    }

    public function userAssingee()
    {
        return $this->belongsToMany('App\User', 'assignee', 'uuid', 'userid')
            ->orderBy('users.last_name', 'asc');
    }

    public function team()
    {
        return $this->hasOne('App\Team', "id", "team_id");
    }

    public static function updateDeadline($project)
    {
        $currentrelease = Release::where("project_id", "=", $project->id)
            ->wherenotin('status', [
                Status::name('Paused')->id,
                Status::name('Completed')->id,
                Status::name('Cancelled')->id
            ])
            ->orderby('deadline', 'asc')->first();
        if ($currentrelease) {
            $project->deadline = $currentrelease->deadline;
        } else {
            $project->deadline = null;
        }
        $project->save();
    }

    public static function updateStatus($project)
    {
        $currentrelease = Release::where("project_id", "=", $project->id)
            ->wherenotin('status', [
                Status::name('Paused')->id,
                Status::name('Completed')->id,
                Status::name('Cancelled')->id
            ])
            ->orderby('deadline', 'asc')->first();

        if ($currentrelease) {
            $project->status = $currentrelease->status;
        } elseif (Release::where("project_id", "=", $project->id)->count()
            == Release::where("project_id", "=", $project->id)
                ->where('status', Status::name('Completed')->id)
                ->count()) {
            $project->status = Status::name('Completed')->id;
        } else {
            $project->status = Status::name('Paused')->id;
        }
        $project->save();
    }

    public function scopePath($query, $path)
    {
        return $query->where('path', $path);
    }

    public function scopeCurrentProjectTeam($query, $id){
        $team = Auth::user()->team;
        if ($team !== null) {
            $ids = [];
            foreach ($team as $t) {
                if ($t->plans->first()->name !== "No Plan") {
                    $ids [] = $t->id;
                }
            }
            return $query->wherein('team_id', $ids);
        }   return $query->where('team_id', null);
    }

    public function scopeCurrentUserTeam($query)
    {
        $team = Auth::user()->team;
        if ($team !== null) {
            $ids = [];
            foreach ($team as $t) {
                if ($t->plans->first()->name !== "No Plan") {
                    $ids [] = $t->id;
                }
            }
            return $query->wherein('team_id', $ids);
        }   return $query->where('team_id', null);
    }

    public function sluggable()
    {
        return [
            'path' => [
                'source' => 'name'
            ]
        ];
    }
}
