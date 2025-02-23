<?php

namespace App\Models\Forum;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ForumTopic extends Model
{
    use HasFactory;

    protected $fillable = [
        ForumTopicFields::USER_ID,
        ForumTopicFields::TITLE,
        ForumTopicFields::CONTENT,
        ForumTopicFields::CATEGORY
    ];

    protected $with = ['user'];

    protected $withCount = ['replies'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, ForumTopicFields::USER_ID);
    }

    public function replies(): HasMany
    {
        return $this->hasMany(ForumReply::class, ForumReplyFields::TOPIC_ID);
    }

    public function lastReply()
    {
        return $this->replies()->latest()->first();
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
