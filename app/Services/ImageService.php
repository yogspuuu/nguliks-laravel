<?php

namespace App\Services;

use App\Models\Image\Image;
use Illuminate\Http\Request;

class ImageService
{
    public function saveImage(Request $request, Image $image = null)
    {
        if ($image instanceof Image) {
            $imagePath = $image->file;
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('image', 'public');
        }

        return $imagePath;
    }
}
