<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Album;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::all();
        return view('admin.albums.index', compact('albums'));
    }

    public function create()
    {

        $slugs = Album::getEnumValues('slug');
        return view('admin.albums.create', compact('slugs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:albums',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension(); 
            $image->move(public_path('uploads'), $imageName); 
            $imagePath = 'uploads/' . $imageName; 
        } else {
            return redirect()->back()->with('error', 'Image upload failed.');
        }

        Album::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'image_url' => $imagePath, 
        ]);
        return redirect()->route('admin.albums.index')->with('success', 'Album created successfully.');
    }

    public function edit($id)
    {
        $album = Album::findOrFail($id);
        $slugs = Album::getEnumValues('slug');
        return view('admin.albums.edit', compact('album', 'slugs'));
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        $album = Album::findOrFail($id);
    
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:albums,slug,' . $id,
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp',
        ]);
    
        // Start with the current images
        $imagePaths = $album->image_url ?? [];


        if ($request->has('removed_images')) {
            foreach ($request->removed_images as $imageToRemove) {
                $fullImagePath = 'uploads/' . $imageToRemove; // Construct full image path
                
                if (($key = array_search($fullImagePath, $imagePaths)) !== false) {
                    unset($imagePaths[$key]); // Remove only the selected image
    
                    $imagePathToDelete = public_path($fullImagePath); // Get full path
                    if (file_exists($imagePathToDelete)) {
                        unlink($imagePathToDelete); // Delete the file from storage
                    }
                }
            }
        }
    
        // Handle multiple images upload
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads'), $imageName);
                $imagePaths[] = 'uploads/' . $imageName;  // Add each new image to the array
            }
        }
    

    
        // Update the album with the new images
        $album->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'image_url' => array_values($imagePaths),  // Store the updated image array
        ]);
    
        return redirect()->route('admin.albums.index')->with('success', 'Album updated successfully.');
    }
    


    public function removeImage($albumId, $imageName)
    {
        $album = Album::findOrFail($albumId);
    
        $imageUrls = $album->image_url ?? [];
        $imagePath = 'uploads/' . $imageName;
    
        if (($key = array_search($imagePath, $imageUrls)) !== false) {
            unset($imageUrls[$key]);
    
            // Delete the image file from the public directory
            if (file_exists(public_path($imagePath))) {
                unlink(public_path($imagePath));
            }
    
            // Update the album record
            $album->update(['image_url' => array_values($imageUrls)]);
    
            return response()->json(['success' => true]);
        }
    
        return response()->json(['success' => false]);
    }
    
    

    public function destroy($id)
    {
        Album::findOrFail($id)->delete();

        if (file_exists(public_path($album->image_url))) {
            unlink(public_path($album->image_url));
        }

        $album->delete();

        return redirect()->route('admin.albums.index')->with('success', 'Album deleted successfully.');
    }
}
