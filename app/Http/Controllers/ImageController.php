<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{

    public function upload(Request $request)
    {
        if ($request->hasFile('image')) {
            $imageName = Image::make($request->image)
                ->resize($request->width, $request->height)
                ->encode('png');

            Storage::disk('local')->put('public/projects/' . $request->file->hashName(), (string) $imageName, 'public');

            ProjectImage::create([
                'name'          => $request->file->hashName(),
                'project_id'    => $request->project_id,
                'path'          => 'public/projects/' . $request->file->hashName()
            ]);

            return response()->json([
                'name'          => $request->file->hashName(),
                'original_name' => $request->file->getClientOriginalName(),
                'path'          => 'public/projects/' . $request->file->hashName()
            ], 200);
        }
    }

    public function delete(Request $request)
    {
        $image = ProjectImage::findOrFail($request->image_id);
        Storage::disk('local')->delete($image->path);
        $image->delete();
        return response()->json([
            'message'       => 'Image Removed Successfully'
        ], 200);
    }
}