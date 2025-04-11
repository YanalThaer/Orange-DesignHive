<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'title',
        'description',
        'image',
        // 'format',
        'category_id',
        // 'likes_count',
        // 'comments_count',
        'user_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
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

    // public function uploads()
    // {
    //     return $this->hasMany(UserUploads::class);
    // }

    public function userLike()
    {
        $user = Auth::user();
        if ($user) {
            return $this->hasOne(Like::class)->where('user_id', $user->id); 
        } else {
            return $this->hasOne(Like::class); // or handle the case when user is not authenticated
        }
    }

    public function tags(){
        return $this->belongsToMany(Tag::class, 'project_tags', 'project_id', 'tag_id')->withTimestamps();
    }

    // public function userComment()
    // {
    //     return $this->hasOne(Comment::class)->where('user_id', 1); 
    // }
}
