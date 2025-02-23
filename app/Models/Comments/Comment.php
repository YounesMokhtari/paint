<?php

namespace App\Models\Comments;

use App\Models\ArtWorks\ArtWork;
use App\Models\BlogPosts\BlogPost;
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
        CommentFields::CONTENT,
        CommentFields::MORPH_ID,
        CommentFields::MORPH_TYPE,
    ];

    public function user()
    {
        return $this->belongsTo(User::class, CommentFields::USER_ID);
    }

    public function artwork()
    {
        return $this->belongsTo(ArtWork::class, foreignKey: CommentFields::MORPH_ID)->where(CommentFields::MORPH_TYPE, ArtWork::class);
    }

    public function blogPost()
    {
        return $this->belongsTo(BlogPost::class, foreignKey: CommentFields::MORPH_ID)->where(CommentFields::MORPH_TYPE, BlogPost::class);
    }
}
