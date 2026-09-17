<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContentSectionItem extends Model
{
    protected $fillable = [
        'content_page_section_id',
        'title',
        'subtitle',
        'body',
        'image',
        'image_alt',
        'button_label',
        'button_url',
        'additional_data',
        'sort_order',
        'is_enabled',
    ];

    protected $casts = [
        'additional_data' => 'array',
        'is_enabled' => 'boolean',
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(ContentPageSection::class, 'content_page_section_id');
    }
}
