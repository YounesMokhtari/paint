<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('subject');
            $table->enum('status', ['open', 'in_progress', 'closed'])->default('open');
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');
            $table->enum('department', ['technical', 'educational', 'financial']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
