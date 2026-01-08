<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('home_hero_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('home_hero_id')->constrained()->cascadeOnDelete();
            $table->json('data');
            $table->string('modified_by')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_hero_histories');
    }
};
