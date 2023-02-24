<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageService
{
    public function saveImage(Request $request, Image $image = null)
    {
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('image', 'public');
        } else {
            $imagePath = $image->file;
        }

        return $imagePath;
    }
}
