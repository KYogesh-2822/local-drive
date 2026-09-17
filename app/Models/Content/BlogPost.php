<?php

namespace App\Models\Content;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'blog_category_id',
        'title',
        'slug',
        'excerpt',
        'body_html',
        'featured_image',
        'featured_image_alt',
        'author_name',
        'status',
        'published_at',
        'meta_title',
        'meta_description',
        'focus_keyword',
        'canonical_url',
        'og_image',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    public function isPubliclyAvailable(): bool
    {
        return $this->status === 'published'
            && $this->published_at !== null
            && $this->published_at->lte(now());
    }

    public function isScheduled(): bool
    {
        return $this->status === 'published'
            && $this->published_at !== null
            && $this->published_at->isFuture();
    }

    public function publicationDate(): ?CarbonInterface
    {
        return $this->published_at?->copy()->timezone(
            config('content.publishing_timezone', 'Asia/Amman')
        );
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }

    public function pages(): BelongsToMany
    {
        return $this->belongsToMany(ContentPage::class, 'content_page_blog_post')
            ->withPivot('sort_order');
    }

    public function faqs(): MorphMany
    {
        return $this->morphMany(ContentFaq::class, 'faqable')->orderBy('sort_order');
    }

    public function activeFaqs(): MorphMany
    {
        return $this->faqs()->where('is_active', true);
    }

    public function publicUrl(): string
    {
        return url('/blog/'.$this->slug);
    }
}
