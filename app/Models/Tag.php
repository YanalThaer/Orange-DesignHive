<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    /** @use HasFactory<\Database\Factories\TagFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'admin_id',
    ];


    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_tags', 'tag_id', 'project_id')->withTimestamps();
    }
}
