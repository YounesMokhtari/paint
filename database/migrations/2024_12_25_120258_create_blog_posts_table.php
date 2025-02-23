<?php

namespace Database\Migrations\BlogPosts;

use App\Models\BlogPosts\BlogPostFields;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->string(BlogPostFields::TITLE);
            $table->text(BlogPostFields::CONTENT);
            $table->string(BlogPostFields::CATEGORY);
            $table->foreignIdFor(User::class, BlogPostFields::AUTHOR_ID)
                ->constrained()
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};
