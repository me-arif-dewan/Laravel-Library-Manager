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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('identifier_type')->nullable();
            $table->string('identifier_value')->nullable();
            $table->string('language_code', 8)->default('en');
            $table->string('publisher')->nullable();
            $table->date('published_date')->nullable();
            $table->unsignedInteger('page_count')->nullable();
            $table->string('cover_url')->nullable();
            $table->string('cover_thumbnail_url')->nullable();
            $table->string('source')->nullable();
            $table->string('pdf_path')->nullable();
            $table->unsignedBigInteger('pdf_size')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['id', 'uuid', 'identifier_value', 'language_code', 'published_date', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
