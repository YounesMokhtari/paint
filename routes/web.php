<?php

use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArtWorkController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ForumTopicController;
use App\Http\Controllers\ForumReplyController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\EnrollmentController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::redirect('/dashboard', '/')->name('dashboard');
// Protected routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/support/{ticket}/reply', [SupportController::class, 'reply'])->name('support.reply');
    // Resource Controllers
    Route::resources([
        'courses' => CourseController::class,
        'art-works' => ArtWorkController::class,
        'blog-posts' => BlogPostController::class,
        'comments' => CommentController::class,
        'forum-topics' => ForumTopicController::class,
        'forum-replies' => ForumReplyController::class,
        'tickets' => SupportController::class,
        'videos' => VideoController::class,
        'courses.lessons' => LessonController::class,
        'notifications' => NotificationController::class,
    ]);

    // Categories routes
    Route::get('/categories/{slug}', [CategoryController::class, 'show'])
        ->name('categories.show');
    // Search routes
    Route::get('/search', [SearchController::class, 'index'])->name('search');
});

Route::middleware(['auth'])->group(function () {


    Route::post('/courses/{course}/reviews', [ReviewController::class, 'store'])
        ->name('courses.reviews.store');

    Route::post('/courses/{course}/enroll', [EnrollmentController::class, 'store'])
        ->name('courses.enroll');

    Route::get('/courses/{course}/verify/{enrollment}', [EnrollmentController::class, 'verify'])
        ->name('courses.verify');
});


require __DIR__ . '/auth.php';
