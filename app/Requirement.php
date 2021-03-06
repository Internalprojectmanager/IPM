<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Kyslik\ColumnSortable\Sortable;

class Requirement extends Model
{
    use Searchable, Sortable;

    protected $table = "requirement";

    public $incrementing = false;

    protected $fillable = [
        'id','name', 'description', 'feature_uuid', 'status'
    ];

    public $sortable = ['name', 'description', 'status', 'deadline', 'created_at'];


    public function features()
    {
        return $this->belongsTo('App\Feature', "feature_uuid", 'feature_uuid');
    }

    public function releases()
    {
        return $this->belongsTo('App\Release', 'release_id', 'release_uuid');
    }

    public function assignees()
    {
        return $this->hasMany('App\Assignee', "uuid", "requirement_uuid");
    }

    public function userAssingee()
    {
        return $this->belongsToMany(
            'App\User',
            'assignee',
            'uuid',
            'userid',
            'requirement_uuid',
            'id'
        )
            ->orderBy('users.last_name', 'asc');
    }

    public function rstatus()
    {
        return $this->hasOne('App\Status', "id", "status");
    }

    public static function updateStatus($requirement)
    {
        $completedstatus = Status::name('Completed')->id;
        $assignees = Assignee::where('uuid', $requirement->requirement_uuid)->get()->count();
        $completed = Assignee::where('uuid', $requirement->requirement_uuid)->where('status', $completedstatus)->get()->count();
        $progress = Assignee::where('uuid', $requirement->requirement_uuid)->where('status', Status::name('In Progress')->id)->count();
        $testing = Assignee::where('uuid', $requirement->requirement_uuid)->where('status', Status::name('Testing')->id)->count();

        if ($assignees ==  $completed) {
            $requirement->status = $completedstatus;
        } elseif ($testing > 0 &&  $completed < $assignees) {
            $requirement->status = Status::name('Testing')->id;
        } elseif ($progress > 0 &&  $completed < $assignees || $completed > 0) {
            $requirement->status = Status::name('In Progress')->id;
        } else {
            $requirement->status = Status::name('Draft')->id;
        }

        $requirement->save();
    }
}
