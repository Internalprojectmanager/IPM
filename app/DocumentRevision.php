<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentRevision extends Model
{
    protected $table = "document_revision";

    protected $fillable = [
        'id','title', 'description', 'author', 'project_id'
    ];

    public function document()
    {
        return $this->hasMany('App\Document', "document_id", "document_id");
    }
}
