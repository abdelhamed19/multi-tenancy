<?php
namespace App\Traits;
trait UploadImage
{
    public function uploadImage($image, $path)
    {
        $image_name = time() . '.' . $image->getClientOriginalExtension();
        $path = $image->storeAs($path, $image_name);
        return $path;
    }
}
