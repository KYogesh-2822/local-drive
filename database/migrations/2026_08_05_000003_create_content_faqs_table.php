<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('content_faqs', function (Blueprint $table) {
            $table->id();
            $table->nullableMorphs('faqable');
            $table->text('question');
            $table->longText('answer');
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index(['faqable_type', 'faqable_id', 'is_active', 'sort_order'], 'content_faq_display_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('content_faqs');
    }
};
