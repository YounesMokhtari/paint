<?php

namespace Database\Migrations\Forum;

use App\Models\Forum\ForumTopicFields;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('forum_topics', function (Blueprint $table) {
            $table->id();
            $table->string(ForumTopicFields::TITLE);
            $table->string(ForumTopicFields::CATEGORY);
            $table->text(ForumTopicFields::CONTENT);
            $table->foreignIdFor(User::class, ForumTopicFields::USER_ID)
                ->constrained()
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('forum_topics');
    }
};
