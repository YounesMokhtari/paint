<?php

namespace App\Models\Videos;

use App\Models\Courses\Course;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        VideoFields::COURSE_ID,
        VideoFields::TITLE,
        VideoFields::DESCRIPTION,
        VideoFields::VIDEO,
        VideoFields::DURATION
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, VideoFields::COURSE_ID);
    }
}
