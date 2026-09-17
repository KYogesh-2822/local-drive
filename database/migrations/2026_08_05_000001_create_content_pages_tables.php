<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('content_pages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('template', 40);
            $table->string('status', 20)->default('draft')->index();
            $table->string('hero_image')->nullable();
            $table->string('hero_image_alt')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('focus_keyword')->nullable();
            $table->string('canonical_url')->nullable();
            $table->string('og_image')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('content_page_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('content_page_id')->constrained()->cascadeOnDelete();
            $table->string('section_key', 80);
            $table->string('heading')->nullable();
            $table->string('subheading')->nullable();
            $table->longText('body_html')->nullable();
            $table->string('layout', 40)->nullable();
            $table->json('settings')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_enabled')->default(true);
            $table->timestamps();

            $table->unique(['content_page_id', 'section_key']);
            $table->index(['content_page_id', 'is_enabled', 'sort_order'], 'page_section_display_index');
        });

        Schema::create('content_section_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('content_page_section_id')->constrained()->cascadeOnDelete();
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->longText('body')->nullable();
            $table->string('image')->nullable();
            $table->string('image_alt')->nullable();
            $table->string('button_label')->nullable();
            $table->string('button_url')->nullable();
            $table->json('additional_data')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_enabled')->default(true);
            $table->timestamps();

            $table->index(['content_page_section_id', 'is_enabled', 'sort_order'], 'section_item_display_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('content_section_items');
        Schema::dropIfExists('content_page_sections');
        Schema::dropIfExists('content_pages');
    }
};
