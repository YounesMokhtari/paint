<?php

namespace App\Models\Enrollments;

use App\Models\Courses\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Enrollment extends Model
{
    protected $fillable = [
        'user_id',
        'course_id',
        'status',
        'payment_id',
        'price_paid',
    ];

    protected $casts = [
        'price_paid' => 'integer',
    ];

    public const STATUS_PENDING = 'pending';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_FAILED = 'failed';
    public const STATUS_REFUNDED = 'refunded';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function getStatusTextAttribute(): string
    {
        return match ($this->status) {
            self::STATUS_PENDING => 'در انتظار پرداخت',
            self::STATUS_COMPLETED => 'تکمیل شده',
            self::STATUS_FAILED => 'ناموفق',
            self::STATUS_REFUNDED => 'مسترد شده',
            default => 'نامشخص'
        };
    }
}
