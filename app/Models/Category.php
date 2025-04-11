<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'image',
        'admin_id'
    ];

    public function projects()
    {
        return $this->hasMany(Project::class , 'category_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

}
