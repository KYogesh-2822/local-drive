<?php

declare(strict_types=1);

if ($argc !== 5) {
    fwrite(STDERR, "Usage: php scripts/optimize_image.php <source> <destination.webp> <max-width> <quality>\n");
    exit(1);
}

[$script, $sourcePath, $destinationPath, $maxWidth, $quality] = $argv;
$maxWidth = filter_var($maxWidth, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
$quality = filter_var($quality, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 100]]);

if (! is_file($sourcePath) || $maxWidth === false || $quality === false) {
    throw new InvalidArgumentException('Invalid image source or optimization settings.');
}

$imageInfo = getimagesize($sourcePath);
if ($imageInfo === false) {
    throw new RuntimeException("Unable to inspect source image: {$sourcePath}");
}

$source = match ($imageInfo['mime']) {
    'image/jpeg' => imagecreatefromjpeg($sourcePath),
    'image/png' => imagecreatefrompng($sourcePath),
    'image/webp' => imagecreatefromwebp($sourcePath),
    default => throw new RuntimeException("Unsupported image type: {$imageInfo['mime']}"),
};

if ($source === false) {
    throw new RuntimeException("Unable to decode source image: {$sourcePath}");
}

$sourceWidth = imagesx($source);
$sourceHeight = imagesy($source);
$destinationWidth = min($sourceWidth, $maxWidth);
$destinationHeight = (int) round($sourceHeight * ($destinationWidth / $sourceWidth));
$destination = imagecreatetruecolor($destinationWidth, $destinationHeight);

imagealphablending($destination, false);
imagesavealpha($destination, true);
imagecopyresampled(
    $destination,
    $source,
    0,
    0,
    0,
    0,
    $destinationWidth,
    $destinationHeight,
    $sourceWidth,
    $sourceHeight
);

$destinationDirectory = dirname($destinationPath);
if (! is_dir($destinationDirectory) && ! mkdir($destinationDirectory, 0775, true) && ! is_dir($destinationDirectory)) {
    throw new RuntimeException("Unable to create image directory: {$destinationDirectory}");
}

if (! imagewebp($destination, $destinationPath, $quality)) {
    throw new RuntimeException("Unable to write optimized image: {$destinationPath}");
}

imagedestroy($source);
imagedestroy($destination);

fwrite(
    STDOUT,
    sprintf(
        "Created %s (%dx%d, %d bytes)\n",
        $destinationPath,
        $destinationWidth,
        $destinationHeight,
        filesize($destinationPath)
    )
);
