<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\GalleryCategory;

use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    // public function index()
    // {
    //     $categories = GalleryCategory::all();
    //     $galleries = Gallery::paginate(10);
    //     //dd($galleries);
    //     return view('admin.gallery.index', compact('galleries', 'categories'));
    // }

    public function index(Request $request)
{
    $categories = GalleryCategory::all();

    $query = Gallery::query();

    if ($request->filled('category_id')) {
        $query->where('gallery_category_id', $request->category_id);
    }

    $galleries = $query->paginate(10)->appends($request->all());

    return view('admin.gallery.index', compact('galleries', 'categories'));
}

    public function index_category()
    {
        $categories = GalleryCategory::all();
        return view('admin.gallery_categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = GalleryCategory::all();
        return view('admin.gallery.create', compact('categories'));
    }

    public function create_category()
    {
        return view('admin.gallery_categories.create');
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'author' => 'nullable|string|max:255',
    //         'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //         'link' => 'nullable|url',
    //     ]);

    //     $image = $request->file('image');
    //     $imageName = time() . '.' . $image->getClientOriginalExtension();
    //     $image->move(public_path('uploads/gallery'), $imageName);

    //     $imagePath = 'uploads/gallery/' . $imageName;

    //     Gallery::create([
    //         'title' => $request->title,
    //         'author' => $request->author,
    //         'image' => $imagePath,
    //         'link' => $request->link,
    //     ]);

    //     return redirect()->route('admin.gallery.index')->with('success', 'Image added successfully!');
    // }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'author' => 'nullable|string|max:255',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10000',
        // 'link' => 'nullable|url',
        'gallery_category_id' => 'required|exists:gallery_categories,id',
    ]);

    $image = $request->file('image');
    $imageName = time() . '.' . $image->getClientOriginalExtension();
    $image->move(public_path('uploads/gallery'), $imageName);

    Gallery::create([
        'title' => $request->input('title'),
        'author' => $request->input('author'),
        'image' => 'uploads/gallery/' . $imageName,
        'link' => $request->input('link'),
        'gallery_category_id' => $request->input('gallery_category_id'),
    ]);

    return redirect()->route('admin.gallery.index')->with('success', 'Image added successfully!');
}



    public function store_category(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:gallery_categories,name',
        ]);

        GalleryCategory::create([
            'name' => $request->name
        ]);

        return redirect()->route('admin.gallery-categories.index')->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {   
        $gallery = Gallery::findOrFail($id);
        $categories = GalleryCategory::all();

        return view('admin.gallery.edit', compact('gallery','categories'));
    }

    public function edit_category (GalleryCategory $galleryCategory)
    {
        return view('admin.gallery_categories.edit', compact('galleryCategory'));
    }

    // public function update(Request $request, $id)
    // {
    //     $gallery = Gallery::findOrFail($id);

    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'author' => 'nullable|string|max:255',
    //         'link' => 'required|url',
    //         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);

    //     if ($request->hasFile('image')) {
    //         if (file_exists(public_path($gallery->image))) {
    //             unlink(public_path($gallery->image));
    //         }

    //         $image = $request->file('image');
    //         $imageName = time() . '.' . $image->getClientOriginalExtension();
    //         $image->move(public_path('uploads/gallery'), $imageName);
    //         $gallery->image = 'uploads/gallery/' . $imageName;
    //     }

    //     $gallery->update([
    //         'title' => $request->title,
    //         'author' => $request->author,
    //         'link' => $request->link,
    //     ]);

    //     return redirect()->route('admin.gallery.index')->with('success', 'Gallery item updated successfully!');
    // }

    public function update(Request $request, $id)
{
    $gallery = Gallery::findOrFail($id);

    $request->validate([
        'title' => 'required|string|max:255',
        'author' => 'nullable|string|max:255',
        // 'link' => 'required|url',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'gallery_category_id' => 'required|exists:gallery_categories,id',
    ]);

    // Handle image upload
    if ($request->hasFile('image')) {
        // Delete the old image if it exists
        if ($gallery->image && file_exists(public_path($gallery->image))) {
            unlink(public_path($gallery->image));
        }

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/gallery'), $imageName);
        $gallery->image = 'uploads/gallery/' . $imageName;
    }

    // Update other fields
    $gallery->title = $request->input('title');
    $gallery->author = $request->input('author');
    $gallery->link = $request->input('link');
    $gallery->gallery_category_id = $request->input('gallery_category_id');
    $gallery->save();

    return redirect()->route('admin.gallery.index')->with('success', 'Gallery item updated successfully!');
}


    public function update_category(Request $request, GalleryCategory $galleryCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:gallery_categories,name,' . $galleryCategory->id,
        ]);

        $galleryCategory->update([
            'name' => $request->name
        ]);

        return redirect()->route('admin.gallery-categories.index')->with('success', 'Category updated successfully.');
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

    public function destroycategory(GalleryCategory $galleryCategory)
    {
        $galleryCategory->delete();

        return redirect()->route('admin.gallery-categories.index')->with('success', 'Category deleted successfully.');
    }
}
