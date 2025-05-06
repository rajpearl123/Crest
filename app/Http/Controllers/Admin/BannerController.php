<?php
namespace App\Http\Controllers\Admin;
use App\Models\Banner;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'subtitle' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('uploads/banners'), $imageName);

        Banner::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'image' => 'uploads/banners/'.$imageName,
        ]);

        return redirect()->route('admin.banners.index')->with('success', 'Banner added successfully');
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'title' => 'required',
            'subtitle' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/banners'), $imageName);
            $banner->image = 'uploads/banners/'.$imageName;
        }

        $banner->update($request->except('image') + ['image' => $banner->image]);

        return redirect()->route('admin.banners.index')->with('success', 'Banner updated successfully');
    }

    public function destroy(Banner $banner)
    {
        if (file_exists(public_path($banner->image))) {
            unlink(public_path($banner->image));
        }

        $banner->delete();
        return redirect()->route('admin.banners.index')->with('success', 'Banner deleted successfully');
    }
}
