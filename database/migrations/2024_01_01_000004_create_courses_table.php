<?php

namespace Database\Migrations\Courses;

use App\Models\Category;
use App\Models\Courses\Course;
use App\Models\Courses\CourseFields;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string(CourseFields::TITLE);
            $table->text(CourseFields::DESC);
            $table->string(CourseFields::SLUG);
            $table->string(column: CourseFields::LEVEL);
            $table->string(CourseFields::POSTER)->nullable();
            $table->boolean(CourseFields::IS_FEATURED)->default(false);
            $table->unsignedBigInteger(CourseFields::PRICE)->default(false);
            $table->foreignIdFor(User::class, CourseFields::CREATOR_ID)
                ->constrained()
                ->onDelete('cascade');
            $table->foreignIdFor(
                model: Category::class,
                column: CourseFields::CATEGORY_ID
            )
                ->constrained()
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
