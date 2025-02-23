<?php

namespace App\Models\ArtWorks;

use App\Models\Comments\Comment;
use App\Models\User;
use Database\Factories\ArtWorks\ArtWorkFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtWork extends Model
{
    /** @use HasFactory<ArtWorkFactory> */
    use HasFactory;

    protected $fillable = [
        ArtWorkFields::USER_ID,
        ArtWorkFields::TITLE,
        ArtWorkFields::IMAGE,
        ArtWorkFields::DESCRIPTION,
        ArtWorkFields::CATEGORY
    ];

    public function user()
    {
        return $this->belongsTo(User::class, ArtWorkFields::USER_ID);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, ArtWorkFields::ID);
    }
}
