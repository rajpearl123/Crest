<?php

namespace App\Http\Controllers\Admin\BusinessSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\BannerAddRequest;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\WebsiteSettingRequest;
use App\Models\Banners;
use App\Models\WebsiteSetting;
use App\Utils\ViewPath;

class WebsiteSettingController extends Controller
{
    public function index()
    {
        $websiteSetting = WebsiteSetting::first();
        return view(ViewPath::ADMIN_WEBSITE_SETTING, compact('websiteSetting'));
    }

    public function store(WebsiteSettingRequest $request){
        $data = $request->validated();
        
        $websiteSetting = WebsiteSetting::first();

        $uploadPath = public_path('assets/images/logo/');

        if (!File::exists($uploadPath)) {
            File::makeDirectory($uploadPath, 0777, true, true);
        }

        if ($request->hasFile('header_logo')) {
            $headerLogoName = time() . '_header.' . $request->file('header_logo')->getClientOriginalExtension();
            $request->file('header_logo')->move($uploadPath, $headerLogoName);
            $data['header_logo'] = $headerLogoName;

            if ($websiteSetting && File::exists(public_path($websiteSetting->header_logo))) {
                File::delete(public_path($websiteSetting->header_logo));
            }
        }

        if ($request->hasFile('footer_logo')) {
            $footerLogoName = time() . '_footer.' . $request->file('footer_logo')->getClientOriginalExtension();
            $request->file('footer_logo')->move($uploadPath, $footerLogoName);
            $data['footer_logo'] = $footerLogoName;

            if ($websiteSetting && File::exists(public_path($websiteSetting->footer_logo))) {
                File::delete(public_path($websiteSetting->footer_logo));
            }
        }

        if ($request->hasFile('favicon')) {
            $faviconName = time() . '_favicon.' . $request->file('favicon')->getClientOriginalExtension();
            $request->file('favicon')->move($uploadPath, $faviconName);
            $data['favicon'] = $faviconName;

            if ($websiteSetting && File::exists(public_path($websiteSetting->favicon))) {
                File::delete(public_path($websiteSetting->favicon));
            }
        }

        if ($websiteSetting) {
            $websiteSetting->update($data);
        } else {
            WebsiteSetting::create($data);
        }

        Toastr::success('Website Info Updated.', 'Success');
        return back()->with('success', 'Website setting updated successfully');        
    }

    public function banners(){
        $banners = Banners::all();
        return view(ViewPath::ADMIN_WEBSITE_BANNER, compact('banners'));
    }

    public function bannerStore(BannerAddRequest $request){
        $bannerData = $request->validated();
        $banner = new Banners();

        if ($request->hasFile('banner')) {
            $image = $request->file('banner');
            $filename = date('d-m-y') . '-' . time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('assets/images/banners'); 
            $image->move($path, $filename);           
            $banner->banner = $filename;
        }

        $banner->status = 0;
        $banner->save(); 

        Toastr::success('Banner Added.', 'Success');
        return redirect()->back();
    }

    public function bannerStatus(Request $request, $id){
        $banner = Banners::find($id);
        $banner->status = $request->active;
        $banner->save();

        Toastr::success('Banner Status Updated.', 'Success');
        return redirect()->back();
    }

    public function bannerDelete($id){
        $banner = Banners::find($id);
        $banner->delete();
        Toastr::success('Banner Deleted.', 'Success');
        return redirect()->back();
    }
}
