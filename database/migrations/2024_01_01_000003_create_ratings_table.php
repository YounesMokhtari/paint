<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('rating');
            $table->text('comment')->nullable();
            $table->morphs('rateable');
            $table->timestamps();

            $table->unique(['user_id', 'rateable_id', 'rateable_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
