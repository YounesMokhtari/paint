<?php

namespace Database\Migrations\ArtWorks;

use App\Models\ArtWorks\ArtWorkFields;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('art_works', function (Blueprint $table) {
            $table->id();
            $table->string(ArtWorkFields::TITLE);
            $table->text(ArtWorkFields::DESCRIPTION);
            $table->string(ArtWorkFields::IMAGE);
            $table->string(ArtWorkFields::CATEGORY);
            $table->boolean(ArtWorkFields::IS_APPROVED)->default(false);
            $table->foreignIdFor(User::class, ArtWorkFields::USER_ID)
                ->constrained()
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('art_works');
    }
};
