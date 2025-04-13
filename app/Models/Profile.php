<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Profile extends Model
{
    /** @use HasFactory<\Database\Factories\ProfileFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'profile_picture',
        'bio',
        'location',
        'facebook',
        'twitter',
        'linkedin',
        'instagram',
    ];

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
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
