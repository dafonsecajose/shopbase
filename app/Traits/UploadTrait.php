<?php

namespace App\Traits;

trait UploadTrait
{
    private function imageUpload($images, $imageColumn = null)
    {
        $uploadImages = [];
        if (is_array($images)) {
            foreach ($images as $image) {
                $uploadImages[] = [$imageColumn => $image->store('products', 'public')];
            }
        }
        return $uploadImages;
    }
}
