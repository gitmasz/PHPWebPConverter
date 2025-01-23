<?php

ini_set('display_errors', 1);
$new_upload_url = 'example.png'; // Source file (PNG with transparency)
$new_upload_data = file_get_contents($new_upload_url);
$new_upload_img = imagecreatefromstring($new_upload_data);
$webp_quality = 80;

if (imageistruecolor($new_upload_img)) {
    // Converting image to a mode that supports transparency
    $temp_image = imagecreatetruecolor(imagesx($new_upload_img), imagesy($new_upload_img));
    imagealphablending($temp_image, false);
    imagesavealpha($temp_image, true);
    
    // Copying image while preserving transparency
    $transparent = imagecolorallocatealpha($temp_image, 0, 0, 0, 127);
    imagefill($temp_image, 0, 0, $transparent);
    imagecopy($temp_image, $new_upload_img, 0, 0, 0, 0, imagesx($new_upload_img), imagesy($new_upload_img));
    
    // Overwriting image
    $new_upload_img = $temp_image;
}

// Displaying webp file in browser
header('Content-type: image/webp');
imagewebp($new_upload_img, null, $webp_quality);

// Saving the file on the server
$new_webp_file = imagewebp($new_upload_img, 'example.webp', $webp_quality); // Folder must have permissions 777
imagedestroy($new_upload_img);

echo $new_webp_file ? "The file was saved successfully." : "An error occurred while saving the file.";