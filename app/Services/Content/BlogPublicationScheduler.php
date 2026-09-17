<?php

namespace App\Services\Content;

use App\Models\Content\BlogPost;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;

class BlogPublicationScheduler
{
    public function resolve(string $date, string $status, ?BlogPost $existingPost = null): CarbonInterface
    {
        $timezone = config('content.publishing_timezone', 'Asia/Amman');
        $selectedDate = CarbonImmutable::createFromFormat('!Y-m-d', $date, $timezone);
        $today = CarbonImmutable::now($timezone)->startOfDay();

        if ($status === 'published' && $selectedDate->isSameDay($today)) {
            if ($this->isAlreadyPublishedOnDate($existingPost, $selectedDate)) {
                return $existingPost->published_at;
            }

            return CarbonImmutable::now('UTC');
        }

        return $selectedDate->startOfDay()->utc();
    }

    private function isAlreadyPublishedOnDate(?BlogPost $post, CarbonImmutable $selectedDate): bool
    {
        return $post?->status === 'published'
            && $post->published_at !== null
            && $post->isPubliclyAvailable()
            && $post->publicationDate()->isSameDay($selectedDate);
    }
}
