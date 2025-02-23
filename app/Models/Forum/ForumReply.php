<?php

namespace App\Models\Forum;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ForumReply extends Model
{
    use HasFactory;

    protected $fillable = [
        ForumReplyFields::TOPIC_ID,
        ForumReplyFields::USER_ID,
        ForumReplyFields::CONTENT
    ];

    protected $with = ['user'];

    public function topic(): BelongsTo
    {
        return $this->belongsTo(ForumTopic::class, ForumReplyFields::TOPIC_ID);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, ForumReplyFields::USER_ID);
    }

    public function isOwnedBy(User $user): bool
    {
        return $this->user_id === $user->id;
    }

    public function getFormattedCreatedAtAttribute(): string
    {
        return $this->created_at->format('Y/m/d H:i');
    }
}
