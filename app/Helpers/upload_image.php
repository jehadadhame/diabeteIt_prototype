<?php
namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Intervention\Image\Interfaces\DriverInterface;

/**
 * Summary of App\Helpers\upload_image
 * @param \Illuminate\Http\UploadedFile $image
 * @param string $small_image_path
 * @param string $original_image_path
 * @return bool|string
 */
function upload_image(UploadedFile $image, $original_image_path, $small_image_path): string
{
    $image_name = uniqid() . "_" . $image->getClientOriginalName();
    $original_path = Storage::disk('public')->putFileAs($original_image_path, $image, $image_name);
    $imageManager = new ImageManager(new Driver());

    $image = $imageManager->read($image->getPathname());
    $image->scale(300);
    $small_path = $small_image_path . "\\" . $image_name;
    $small_path = Storage::disk('public')->put($small_path, (string) $image->toJpeg());
    // $smal_path = Storage::disk('public')->putFileAs($small_image_path, (string) $image->toJpeg(), $image_name);
    if ($original_path && $small_path) {
        return $image_name;
    } else {
        return false;
    }
}