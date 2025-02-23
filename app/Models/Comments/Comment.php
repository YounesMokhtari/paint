<?php

namespace App\Models\Comments;

use App\Models\ArtWorks\ArtWork;
use App\Models\BlogPosts\BlogPost;
use App\Models\Courses\Course;
use App\Models\User;
use Database\Factories\Comments\CommentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /** @use HasFactory<CommentFactory> */
    use HasFactory;

    protected $fillable = [
        CommentFields::USER_ID,
        CommentFields::BLOG_POST_ID,
        CommentFields::CONTENT
    ];

    public function user()
    {
        return $this->belongsTo(User::class, CommentFields::USER_ID);
    }

    public function artwork()
    {
        return $this->belongsTo(BlogPost::class, CommentFields::BLOG_POST_ID);
    }

    public function course()
    {
        return $this->belongsTo(Course::class, CommentFields::COURSE_ID);
    }
}
