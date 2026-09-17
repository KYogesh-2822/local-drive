<?php

namespace App\Services\Content;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageUploadService
{
    public function store(UploadedFile $image, string $directory, ?string $oldPath = null): string
    {
        $filename = Str::uuid().'.'.strtolower($image->getClientOriginalExtension());
        $path = $image->storeAs(trim($directory, '/'), $filename, 'public');

        if ($oldPath && str_starts_with($oldPath, 'content/')) {
            Storage::disk('public')->delete($oldPath);
        }

        return $path;
    }
}
