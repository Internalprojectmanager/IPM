<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use Sluggable;
    protected $table = "feature";

    public $incrementing = false;

    protected $fillable = [
        'id','feature_uuid','name', 'description', 'status', 'release_id', 'revision_log'
    ];

    public function requirements(){
        return $this->hasMany('App\Requirement', "feature_uuid", "feature_uuid");
    }

    public function releases(){
        return $this->belongsTo('App\Release', "release_id", 'release_uuid');
    }

    public function fstatus(){
        return $this->hasOne('App\Status', "id", "status");
    }

    public function fcategory(){
        return $this->hasOne('App\Status', "id", "category");
    }

    public function sluggable()
    {
        return [
            'path' => [
                'source' => 'name'
            ]
        ];
    }

    public static function updateStatus($feature)
    {
        $completed = Status::name('Completed')->id;
        $requirements = Requirement::where('feature_uuid', $feature->feature_uuid)->count();
        $completedreq = Requirement::where('feature_uuid', $feature->feature_uuid)->where('status', $completed)->count();
        $progressreq = Requirement::where('feature_uuid', $feature->feature_uuid)->where('status', Status::name('In Progress')->id)->count();
        if($requirements ==  $completedreq){
            $feature->status = $completed;
        } else if( $completedreq > 0 || $progressreq > 0 && $requirements < $completedreq) {
            $feature->status = Status::name('In Progress')->id;
        } else{
            $feature->status = Status::name('Draft')->id;
        }
        $feature->save();
    }
}
