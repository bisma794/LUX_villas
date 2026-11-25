<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('group')->default('general');
            $table->timestamps();
        });

        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique(); // slug, e.g. home_hero
            $table->string('name');
            $table->string('type'); // hero, listings, faq, ...
            $table->json('content')->nullable();
            $table->boolean('is_global')->default(true);
            $table->string('status')->default('published'); // published | draft
            $table->timestamps();
        });

        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('path')->unique(); // URL path without leading slash; '' = home
            $table->string('status')->default('published'); // published | draft
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->timestamps();
        });

        Schema::create('page_section', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->constrained()->cascadeOnDelete();
            $table->foreignId('section_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
            $table->unique(['page_id', 'section_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_section');
        Schema::dropIfExists('pages');
        Schema::dropIfExists('sections');
        Schema::dropIfExists('settings');
    }
};
