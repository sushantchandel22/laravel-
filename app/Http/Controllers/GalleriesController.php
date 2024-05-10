<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $galleries = Gallery::where('user_id', $user->id)->get();
        return view("pages/viewgallery", compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
            return redirect()->route('gallery.index')->with('success', 'Profile updated successfully.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $gallery_id)
    {
        $gallery = Gallery::find($gallery_id);
        if (!$gallery) {
            return response()->json(['error' => 'Gallery not found'], 404);
        }
        $gallery->delete();
        return response()->json(['message' => 'Gallery deleted successfully'], 200);
    }
}
