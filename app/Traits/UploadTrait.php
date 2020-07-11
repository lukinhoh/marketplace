<?php
namespace App\Traits;

use Illuminate\Http\Request;

trait UploadTrait
{
    private function imageUpload($images, $image_column = null)
    {
        $uploaded_images = [];

        if (is_array($images))
        {
            foreach($images as $image)
            {
                $uploaded_images[] = [$image_column => $image->store('products', 'public')];
            }
        }
        else 
        {
            $uploaded_images = $images->store('logo', 'public');
        }

        return $uploaded_images;
    }
}