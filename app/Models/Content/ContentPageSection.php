<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ContentPageSection extends Model
{
    protected $fillable = [
        'content_page_id',
        'section_key',
        'heading',
        'subheading',
        'body_html',
        'layout',
        'settings',
        'sort_order',
        'is_enabled',
    ];

    protected $casts = [
        'settings' => 'array',
        'is_enabled' => 'boolean',
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(ContentPage::class, 'content_page_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(ContentSectionItem::class)->orderBy('sort_order');
    }

    public function activeItems(): HasMany
    {
        return $this->items()->where('is_enabled', true);
    }
}
