<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function uploadPhoto(Request $request)
    {
        $files = $request->file('image');

        // for save thumnail image
        $imageName = Image::make($files)
            ->resize(120, 120)
            ->encode('png', 50);
        Storage::disk('local')->put('public/' . $request->path . '/thumbnail/' . $request->image->hashName(), (string) $imageName, 'public');


        $imageName2 = Image::make($request->image)
            ->resize($request->width, $request->height)
            ->encode('png', 50);
        Storage::disk('local')->put('public/' . $request->path .'/'. $request->image->hashName(), (string) $imageName2, 'public');



        return $request->image->hashName();
    }

    public function removePhoto(Request $request)
    {
        Storage::disk('local')->delete('public/' . $request->path .'/'. $request->image);
        Storage::disk('local')->delete('public/'. $request->path .'/thumbnail/' . $request->image);
        return "Removed";
    }
}
