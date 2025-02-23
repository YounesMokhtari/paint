<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use App\Models\Courses\Course;
use App\Models\CategoryIcons;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->slug = Str::slug($category->name);
        });
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    public function getIconSvgAttribute(): string
    {
        return CategoryIcons::get($this->icon);
    }
}
