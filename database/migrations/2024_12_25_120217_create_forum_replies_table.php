<?php

namespace Database\Migrations\Forum;

use App\Models\Forum\ForumReplyFields;
use App\Models\User;
use App\Models\Forum\ForumTopic;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('forum_replies', function (Blueprint $table) {
            $table->id();
            $table->text(ForumReplyFields::CONTENT);
            $table->foreignIdFor(User::class, ForumReplyFields::USER_ID)
                ->constrained()
                ->onDelete('cascade');
            $table->foreignIdFor(ForumTopic::class, ForumReplyFields::TOPIC_ID)
                ->constrained()
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('forum_replies');
    }
};
