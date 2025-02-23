<?php

namespace App\Models\Lessons;

use App\Models\Courses\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lesson extends Model
{
    protected $fillable = [
        'title',
        'description',
        'course_id',
        'video_url',
        'duration',
        'is_preview',
        'sort_order'
    ];

    protected $casts = [
        'duration' => 'float',
        'is_preview' => 'boolean',
        'sort_order' => 'integer'
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
