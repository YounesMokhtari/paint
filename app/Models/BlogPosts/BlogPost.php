<?php

namespace App\Models\BlogPosts;

use App\Models\Comments\Comment;
use App\Models\Comments\CommentFields;
use App\Models\User;
use Database\Factories\BlogPosts\BlogPostFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    /** @use HasFactory<BlogPostFactory> */
    use HasFactory;

    protected $fillable = [
        BlogPostFields::AUTHOR_ID,
        BlogPostFields::TITLE,
        BlogPostFields::CONTENT,
        BlogPostFields::CATEGORY,
        BlogPostFields::TAGS,
    ];

    protected $casts = [
        BlogPostFields::TAGS => 'array',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, BlogPostFields::AUTHOR_ID);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, CommentFields::MORPH_ID)
            ->where(CommentFields::MORPH_TYPE, BlogPost::class);
    }

    public function getCommentsCountAttribute()
    {
        return $this->comments()->count();
    }

    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('Y/m/d H:i');
    }

    public function getReadTimeAttribute()
    {
        $wordsPerMinute = 200;
        $wordCount = str_word_count(strip_tags($this->content));
        return ceil($wordCount / $wordsPerMinute);
    }
}
