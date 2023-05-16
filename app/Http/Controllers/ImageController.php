<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class ImageController extends Controller
{
    public function uploadImage(Request $request)
    {
        $path = $request->file('image')->store('public/images');

        $image_url = Storage::url($path);

        return response()->json([
            'image_url' => $image_url
        ]);
    }


    public function approveImage(Request $request, $id)
{
    $imageApproval = Image::findOrFail($id);
    $imageApproval->status = $request->status;
    $imageApproval->save();

    return response()->json([
        'message' => 'Image approval status updated successfully'
    ]);
}
}
