<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    // public function index()
    // {
    //     $galleries = Gallery::orderBy('created_at', 'desc')->paginate(10);
    //     //dd("here");
    //     return view('admin.gallery.index', compact('galleries'));
    // }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|url',
        ]);

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/gallery'), $imageName);

        $imagePath = 'uploads/gallery/' . $imageName;

        Gallery::create([
            'title' => $request->title,
            'author' => $request->author,
            'image' => $imagePath,
            'link' => $request->link,
        ]);

        return redirect()->route('admin.gallery.index')->with('success', 'Image added successfully!');
    }

    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('admin.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'link' => 'required|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if (file_exists(public_path($gallery->image))) {
                unlink(public_path($gallery->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/gallery'), $imageName);
            $gallery->image = 'uploads/gallery/' . $imageName;
        }

        $gallery->update([
            'title' => $request->title,
            'author' => $request->author,
            'link' => $request->link,
        ]);

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item updated successfully!');
    }

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);

        if (file_exists(public_path($gallery->image))) {
            unlink(public_path($gallery->image));
        }

        $gallery->delete();

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item deleted successfully!');
    }
}
