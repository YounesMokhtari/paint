<?php

namespace Database\Migrations\Videos;

use App\Models\Videos\VideoFields;
use App\Models\Courses\Course;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string(VideoFields::TITLE);
            $table->text(VideoFields::DESCRIPTION);
            $table->string(VideoFields::VIDEO);
            $table->integer(VideoFields::DURATION);
            $table->foreignIdFor(Course::class, VideoFields::COURSE_ID)
                ->constrained()
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
