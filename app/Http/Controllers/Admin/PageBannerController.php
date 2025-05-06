<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\PageBanner;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PageBannerController extends Controller
{	
    public function index()
    {
        $banners = PageBanner::all();
        return view('admin.page_banner.index', compact('banners'));
    }

    public function edit($id)
    {
        $banner = PageBanner::findOrFail($id);
        return view('admin.page_banner.edit', compact('banner'));
    }

    public function update(Request $request, $id)
    {

        $banner = PageBanner::findOrFail($id);

        $request->validate([
            'title' => 'nullable|string|max:255',
            'banner_img' => 'nullable|mimes:jpg,jpeg,png,gif,avif|max:10000'
        ]);

        $data = $request->only('page_name', 'title');
	$data['page_name']=$banner->page_name;
        // Handle Image Upload
        if ($request->hasFile('banner_img')) {
            // Delete the old image
            if ($banner->banner_img && file_exists(public_path('uploads/banners/' . $banner->banner_img))) {
                unlink(public_path('uploads/page_banners/' . $banner->banner_img));
            }

            // Store new image
            $image = $request->file('banner_img');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/page_banners'), $imageName);
            $data['banner_img'] = $imageName;
        }

        $banner->update($data);


return redirect()->route('admin.page_banner.index')->with('success', 'Banner updated successfully!');
    }
}
