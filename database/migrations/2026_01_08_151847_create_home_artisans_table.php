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
        Schema::create('home_artisans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('job');
            $table->text('description')->nullable();
            $table->string('location')->nullable();
            $table->string('avatar')->nullable();
            $table->string('rating')->nullable();
            $table->string('experience')->nullable();
            $table->string('status')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_artisans');
    }
};
