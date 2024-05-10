<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\Images;
use App\Models\User;
use Log;

class GalleryController extends Controller
{
    public function showgallery(Request $request)
    {
        $user = auth()->user(); // Get the currently logged-in user
        $galleries = Gallery::where('user_id', $user->id)->get(); // Fetch galleries belonging to the user
        return view("pages/viewgallery", compact('galleries'));
    }
    // ============++++++++++++++++++++++++++++++++++++++++++++++++++++++++============ //

    public function gallery(Request $request)
    {
        $user = auth()->user();
        if ($request->hasFile('galleryimage')) {
            $filename = time() . "carsafe." . $request->file('galleryimage')->getClientOriginalExtension();
            $filePath = $request->file('galleryimage')->storeAs('public/galleryimages', $filename);
            $galleryname = $request->input('galleryname');
            $gallery = new gallery;
            $gallery->gallery_name = $galleryname;
            $gallery->gallery_cover_image = $filename;
            $gallery->user_id = $user->id;
            $gallery->save();
            return redirect()->route('view.gallery')->with('success', 'Profile updated successfully.');
        }
    }

    public function showImageForm($gallery_id)
    {
        $gallery = Gallery::find($gallery_id);
        return view('pages.imagesform', ['gallery_id' => $gallery_id]);
    }

    public function uploadimages(Request $request)
    {
        $request->validate
        ([
                'gallery_id' => 'required',
                'uploadimage.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

        $gallery_id = $request->input('gallery_id');
        foreach ($request->file('uploadimage') as $file) {
            $filename = time() . "_" . $file->getClientOriginalName();
            $filePath = $file->storeAs('public/galleryimages', $filename);
            $image = new Images;
            $image->image = $filename;
            $image->gallery_id = $gallery_id;
            $image->save();
        }
        return redirect()->route('view.images', ['gallery_id' => $gallery_id])->with('success', 'Images uploaded successfully.');
    }


    public function deleteGallery(Request $request, $gallery_id)
    {
        $gallery = Gallery::find($gallery_id);
        if (!$gallery) {
            return response()->json(['error' => 'Gallery not found'], 404);
        }
        $gallery->delete();
        return response()->json(['message' => 'Gallery deleted successfully'], 200);
    }
}
