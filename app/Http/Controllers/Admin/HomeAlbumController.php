<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\HomeAlbum;
use App\Http\Controllers\Controller;


class HomeAlbumController extends Controller
{
    /**
     * Display a listing of the home albums.
     */
    public function index()
    {
        $album= HomeAlbum::first();
        return view('admin.home_albums.index', compact('album')); // Returning a Blade view
    }

    /**
     * Show the first entry for editing.
     */
    public function edit()
{
    $album = HomeAlbum::first(); // Fetch only the first album entry

    if (!$album) {
        return redirect()->route('admin.home_albums.index')->with('error', 'No album found');
    }



    return view('admin.home_albums.edit', compact('album')); // Returning an edit view
}

    /**
     * Update the first entry.
     */
    public function update(Request $request)
    {
        // dd($request->all());
        $album = HomeAlbum::first();
    
        if (!$album) {
            return redirect()->route('albums.index')->with('error', 'No album found to update');
        }
    
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'album' => 'required|array',
            'album.*.img_title' => 'required|string|max:255',
            'album.*.author' => 'required|string|max:255',
            'album.*.existing_src' => 'nullable|string', // Validate existing image path
            'album.*.src' => 'nullable|file|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $updatedAlbum = [];
    
        foreach ($request->album as $index => $imageData) {
            // Use existing image if no new image is uploaded
            $imagePath = $imageData['existing_src'] ?? null;
    
            // Check if a new image file is uploaded
            if ($request->hasFile("album.$index.src")) {
                $file = $request->file("album.$index.src");
    
                // Store in public folder
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('album_images'), $fileName);
                $imagePath = 'album_images/' . $fileName;
            }
    
            // Append updated album data
            $updatedAlbum[] = [
                'img_title' => $imageData['img_title'] ?? '',
                'author' => $imageData['author'] ?? '',
                'src' => $imagePath, // Updated image path
            ];
        }
    
        // Ensure data is correctly stored as JSON
        $album->update([
            'title' => $request->title,
            'description' => $request->description,
            'album' => $updatedAlbum, // Eloquent will cast it to JSON if set in the model
        ]);
    
        return redirect()->route('admin.home_albums.index')->with('success', 'Album updated successfully');
    }
    
}
