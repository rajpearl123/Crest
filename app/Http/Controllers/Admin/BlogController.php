<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Utils\ViewPath;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\BlogCategory;


class BlogController extends Controller
{
    // Show all blogs
    public function index(Request $request)
{   
    $categories = BlogCategory::all();

    $query = Blog::with('category')->orderBy('publish_date', 'desc');

    if ($request->filled('category')) {
        $query->where('blog_category_id', $request->category);
    }

    if ($request->filled('author')) {
        $query->where('author', 'like', '%' . $request->author . '%');
    }

    $blogs = $query->get();

    return view('admin.blogs.index', compact('blogs', 'categories'));
}

    public function index_category()
    {
        $categories = BlogCategory::all();
        return view('admin.blog_categories.index', compact('categories'));
    }

    // Show form to create a blog
    public function create()
    {
        $categories=BlogCategory::all();
        return view('admin.blogs.create', compact('categories'));
    }

    public function create_category()
    {
        return view('admin.blog_categories.create');
    }

    // Store a new blog
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'author' => 'required|string|max:255',
    //         'content' => 'required',
    //         'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
    //         'publish_date' => 'required|date',
    //     ]);

    //     if ($request->hasFile('image')) {
    //         $image = $request->file('image');
    //         $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
    //         $image->move(public_path('uploads/blogs'), $imageName);
    //         $imagePath = 'uploads/blogs/' . $imageName;
    //     } else {
    //         $imagePath = null;
    //     }
    //     Blog::create([
    //         'title' => $request->title,
    //         'slug' => Str::slug($request->title),
    //         'author' => $request->author,
    //         'content' => $request->content,
    //         'image' => $imagePath,
    //         'publish_date' => $request->publish_date,
    //     ]);

    //     return redirect()->route('admin.blogs.index')->with('success', 'Blog added successfully!');
    // }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'content' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        'publish_date' => 'required|date',
        'blog_category_id' => 'required|exists:blog_categories,id',
    ]);

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/blogs'), $imageName);
        $imagePath = 'uploads/blogs/' . $imageName;
    } else {
        $imagePath = null;
    }

    Blog::create([
        'title' => $request->title,
        'slug' => Str::slug($request->title),
        'author' => $request->author,
        'content' => $request->content,
        'image' => $imagePath,
        'publish_date' => $request->publish_date,
        'blog_category_id' => $request->blog_category_id,
    ]);

    return redirect()->route('admin.blogs.index')->with('success', 'Blog added successfully!');
}



    public function store_category(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:blog_categories,name',
        ]);

        BlogCategory::create([
            'name' => $request->name
        ]);

        return redirect()->route('admin.blog-categories.index')->with('success', 'Category created successfully.');
    }


    // Show blog details
    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        return view('web-views.blogdetail', compact('blog'));
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        $categories=BlogCategory::all();

        return view('admin.blogs.edit', compact('blog','categories'));
    }
    public function edit_category (BlogCategory $blogCategory)
    {
        return view('admin.blog_categories.edit', compact('blogCategory'));
    }

    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'author' => 'required|string|max:255',
    //         'content' => 'required',
    //         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //         'publish_date' => 'required|date',
    //     ]);

    //     $blog = Blog::findOrFail($id);

    //     if ($request->hasFile('image')) {
    //         // Delete the old image
    //         if (file_exists(public_path($blog->image))) {
    //             unlink(public_path($blog->image));
    //         }

    //         // Upload new image
    //         $image = $request->file('image');
    //         $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
    //         $image->move(public_path('uploads/blogs'), $imageName);
    //         $blog->image = 'uploads/blogs/' . $imageName;
    //     }

    //     $blog->update([
    //         'title' => $request->title,
    //         'slug' => Str::slug($request->title),
    //         'author' => $request->author,
    //         'content' => $request->content,
    //         'publish_date' => $request->publish_date,
    //     ]);

    //     return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully!');
    // }

    public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'content' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'publish_date' => 'required|date',
        'blog_category_id' => 'required|exists:blog_categories,id',
    ]);

    $blog = Blog::findOrFail($id);

    if ($request->hasFile('image')) {
        if (file_exists(public_path($blog->image))) {
            unlink(public_path($blog->image));
        }

        $image = $request->file('image');
        $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/blogs'), $imageName);
        $blog->image = 'uploads/blogs/' . $imageName;
    }

    $blog->update([
        'title' => $request->title,
        'slug' => Str::slug($request->title),
        'author' => $request->author,
        'content' => $request->content,
        'publish_date' => $request->publish_date,
        'blog_category_id' => $request->blog_category_id,
        'image' => $blog->image, // retain image if not updated
    ]);

    return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully!');
}


    public function update_category(Request $request, BlogCategory $blogCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:blog_categories,name,' . $blogCategory->id,
        ]);

        $blogCategory->update([
            'name' => $request->name
        ]);

        return redirect()->route('admin.blog-categories.index')->with('success', 'Category updated successfully.');
    }

     public function destroy(BlogCategory $blogCategory)
    {
        $blogCategory->delete();

        return redirect()->route('admin.blog-categories.index')->with('success', 'Category deleted successfully.');
    }


    public function destroy_blog($id)
{
    $blog = Blog::findOrFail($id);
    $blog->delete();

    return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully.');
}


    public function toggleVisibility(Request $request)
{
    $settings = Blog::first();
    $settings->show_author_date = $request->show_author_date;
    $settings->save();

    return response()->json(['message' => 'Visibility updated successfully!']);
}

}
