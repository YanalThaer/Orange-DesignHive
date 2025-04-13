<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'title',
        'description',
        'category_id',
        'user_id',
        'featured_post'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function images()
    {
        return $this->hasMany(ProjectImage::class, 'project_id');
    }

    public function userLike()
    {
        $user = Auth::user();
        if ($user) {
            return $this->hasOne(Like::class)->where('user_id', $user->id);
        } else {
            return $this->hasOne(Like::class); // or handle the case when user is not authenticated
        }
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'project_tags', 'project_id', 'tag_id')->withTimestamps();
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
