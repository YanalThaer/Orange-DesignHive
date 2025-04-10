<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTags extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectTagsFactory> */
    use HasFactory;

    protected $fillable = [
        'project_id',
        'tag_id',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
