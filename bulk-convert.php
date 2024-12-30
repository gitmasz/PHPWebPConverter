<?php

ini_set('display_errors', 1);

function bulkConvert($sourceDir = 'images', $targetDir = 'converted', $webpQuality = 20) {
    if (!is_dir($sourceDir)) {
        die("Source directory does not exist: $sourceDir");
    }
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $allowedExtensions = ['jpg', 'jpeg', 'png'];
    $files = scandir($sourceDir);

    foreach ($files as $file) {
        $filePath = "$sourceDir/$file";
        if (!is_file($filePath)) continue;

        $fileExtension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedExtensions)) continue;

        $image = imagecreatefromstring(file_get_contents($filePath));
        if (!$image) {
            echo "Failed to process: $filePath<br>";
            continue;
        }

        $outputPath = "$targetDir/" . pathinfo($file, PATHINFO_FILENAME) . '.webp';
        if (imagewebp($image, $outputPath, $webpQuality)) {
            echo "Converted: $filePath -> $outputPath<br>";
        } else {
            echo "Failed to convert: $filePath<br>";
        }

        imagedestroy($image);
    }

    echo "Bulk conversion completed.";
}

bulkConvert();
