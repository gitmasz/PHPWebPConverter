<?php

ini_set('display_errors', 1);
$new_upload_url = 'example.jpg';
$new_upload_data = file_get_contents($new_upload_url);
$new_upload_img = imagecreatefromstring($new_upload_data);
$webp_quality = 20;

// Displaying webp file in browser
header('Content-type: image/webp');
imagewebp($new_upload_img, null, $webp_quality);

// Saving webp file on server
$new_webp_file = imagewebp($new_upload_img, 'example.webp', $webp_quality); // Folder permission must be 777
imagedestroy($new_upload_img);

echo $new_webp_file ? "The file was saved successfully." : "An error occurred while saving the file.";