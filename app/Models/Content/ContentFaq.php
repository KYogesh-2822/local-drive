<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ContentFaq extends Model
{
    protected $fillable = [
        'question',
        'answer',
        'sort_order',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function faqable(): MorphTo
    {
        return $this->morphTo();
    }
}
