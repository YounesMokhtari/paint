<?php

namespace App\Models;

use App\Models\Courses\Course;
use App\Models\ArtWorks\ArtWork;
use App\Models\Reviews\Review;
use App\Models\Enrollments\Enrollment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable;
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'bio',
        'role',
        'profile_photo',
        'username'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // دوره‌های ایجاد شده توسط مدرس
    public function createdCourses(): HasMany
    {
        return $this->hasMany(Course::class, 'creator_id');
    }

    // دوره‌هایی که دانشجو در آن‌ها ثبت‌نام کرده
    public function enrolledCourses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'enrollments')
            ->withPivot('status', 'payment_id', 'price_paid')
            ->withTimestamps();
    }
    public function ratings(): HasMany
    {
        return $this->hasMany(Review::class);
    }
    // آثار هنری کاربر
    public function artworks(): HasMany
    {
        return $this->hasMany(ArtWork::class);
    }

    // نظرات کاربر
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    // پورتفولیو کاربر
    public function portfolio(): HasOne
    {
        return $this->hasOne(Portfolio::class);
    }

    // دستاوردهای کاربر
    public function achievements(): HasMany
    {
        return $this->hasMany(UserAchievement::class);
    }

    // گواهینامه‌های کاربر
    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class);
    }

    // جلسات خصوصی به عنوان دانشجو
    public function privateSessions(): HasMany
    {
        return $this->hasMany(PrivateSession::class, 'student_id');
    }

    // جلسات خصوصی به عنوان مدرس
    public function teachingSessions(): HasMany
    {
        return $this->hasMany(PrivateSession::class, 'teacher_id');
    }

    // چالش‌های شرکت کرده
    public function challenges(): BelongsToMany
    {
        return $this->belongsToMany(ArtChallenge::class, 'art_challenge_participants')
            ->withPivot('submission_url', 'submission_date', 'votes_count')
            ->withTimestamps();
    }

    // تکالیف ارسال شده
    public function assignmentSubmissions(): HasMany
    {
        return $this->hasMany(AssignmentSubmission::class);
    }

    // محاسبه امتیاز کلی کاربر
    public function getTotalPointsAttribute(): int
    {
        return $this->achievements()->sum('points');
    }

    // بررسی نقش کاربر
    public function isTeacher(): bool
    {
        return $this->role === 'teacher';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
    public function isStudent(): bool
    {
        return $this->role === 'student';
    }
}
