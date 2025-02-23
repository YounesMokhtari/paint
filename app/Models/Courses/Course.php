<?php

namespace App\Models\Courses;

use App\Models\User;
use App\Models\Category;
use App\Models\Reviews\Review;
use App\Models\Assignment;
use App\Models\Certificate;
use App\Models\Lessons\Lesson;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'creator_id',
        'category_id',
        'level',
        'price',
        'duration',
        'is_featured',
        'poster',
    ];

    protected $casts = [
        'price' => 'integer',
        'duration' => 'integer',
        'is_featured' => 'boolean',
    ];

    // مدرس دوره
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    // دسته‌بندی دوره
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // درس‌های دوره
    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class)->orderBy('sort_order');
    }

    // دانشجویان دوره
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'enrollments')
            ->withPivot('status', 'payment_id', 'price_paid')
            ->withTimestamps();
    }

    // نظرات دوره
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }


    // محاسبه میانگین امتیازات
    public function getAverageRatingAttribute(): float
    {
        return $this->reviews()->avg('rating') ?? 0;
    }

    // تعداد نظرات
    public function getReviewsCountAttribute(): int
    {
        return $this->reviews()->count();
    }
}
