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
        Schema::create('press_section_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('press_section_id')->constrained()->cascadeOnDelete();
            $table->text('quote');
            $table->string('source');
            $table->string('media_logo')->nullable();
            $table->date('published_at')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('press_section_items');
    }
};
