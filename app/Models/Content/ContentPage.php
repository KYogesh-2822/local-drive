<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class ContentPage extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'template',
        'status',
        'hero_image',
        'hero_image_alt',
        'meta_title',
        'meta_description',
        'focus_keyword',
        'canonical_url',
        'og_image',
        'published_at',
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
            ->where(function (Builder $query) {
                $query->whereNull('published_at')->orWhere('published_at', '<=', now());
            });
    }

    public function sections(): HasMany
    {
        return $this->hasMany(ContentPageSection::class)->orderBy('sort_order');
    }

    public function activeSections(): HasMany
    {
        return $this->sections()->where('is_enabled', true);
    }

    public function faqs(): MorphMany
    {
        return $this->morphMany(ContentFaq::class, 'faqable')->orderBy('sort_order');
    }

    public function activeFaqs(): MorphMany
    {
        return $this->faqs()->where('is_active', true);
    }

    public function blogPosts(): BelongsToMany
    {
        return $this->belongsToMany(BlogPost::class, 'content_page_blog_post')
            ->withPivot('sort_order')
            ->orderByPivot('sort_order');
    }

    public function publicUrl(): string
    {
        return $this->template === 'home'
            ? url('/')
            : url('/'.$this->slug);
    }

    public function heroImageUrl(): ?string
    {
        if (! $this->hero_image) {
            return null;
        }

        if (preg_match('#^(?:https?:)?//#i', $this->hero_image)) {
            return $this->hero_image;
        }

        $relativePath = ltrim($this->hero_image, '/');
        $publicPath = str_starts_with($relativePath, 'content/')
            ? 'storage/'.$relativePath
            : $relativePath;
        $optimizedPath = preg_replace('/\.(?:jpe?g|png)$/i', '.webp', $publicPath);

        if ($optimizedPath !== null
            && $optimizedPath !== $publicPath
            && is_file(public_path($optimizedPath))) {
            return asset($optimizedPath);
        }

        return asset($publicPath);
    }
}
