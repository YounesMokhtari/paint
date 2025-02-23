<?php

namespace Database\Migrations\Comments;

use App\Models\Comments\CommentFields;
use App\Models\User;
use App\Models\Courses\Course;
use App\Models\ArtWorks\ArtWork;
use App\Models\BlogPosts\BlogPost;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text(CommentFields::CONTENT);
            $table->foreignIdFor(User::class, CommentFields::USER_ID)
                ->constrained()
                ->onDelete('cascade');
            $table->morphs('commentable');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
