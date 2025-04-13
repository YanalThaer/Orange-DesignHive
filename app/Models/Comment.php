<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'project_id',
        'content'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function projects()
    {
        return $this->belongsTo(Project::class);
    }

    protected static function booted()
    {
        static::addGlobalScope('excludeSoftDeletedUsers', function (Builder $builder) {
            $builder->whereHas('user', function ($query) {
                $query->whereNull('deleted_at');
            });
        });
    }
}
