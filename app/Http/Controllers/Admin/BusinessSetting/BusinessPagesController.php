<?php

namespace App\Http\Controllers\Admin\BusinessSetting;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\BusinessPages;
use App\Models\SocialLinks;
use App\Models\ImageGallary;
use Illuminate\Http\Request;
use App\Utils\ViewPath;
use App\Models\Admins;
use Illuminate\Support\Facades\File;


class BusinessPagesController extends Controller
{

    public function admin_profile(){
        $admin = Admins::first();
       return view('admin.admin_profile',compact('admin'));
    }

    public function list_profile(){
        $admin = Admins::first();
        // dd($admin);
       return view('admin.admin_profile_list',compact('admin'));
    }


    public function admin_profile_update(Request $request)
{
    $admin = Admins::first();
    
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        // 'mobile' => 'required|numeric',
        'phone' => 'nullable|numeric',
        'password' => 'nullable|min:8|confirmed',
        'image' => 'nullable|image|max:2048'
    ]);

    $data = $request->only(['name', 'email', 'mobile', 'phone']);
    
    
    if ($request->hasFile('image')) {
        $directory = public_path('assets/images/admin');

        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $timestamp = now()->timestamp;
    $fileName = $timestamp . '.' . $request->file('image')->getClientOriginalExtension();
    $request->file('image')->move($directory, $fileName);

    $data['profile'] = $fileName;
    }
    if ($request->filled('password')) {
        $data['password'] = bcrypt($request->password);
    }

    $admin->update($data);
    
    return redirect()->back()->with('success', 'Profile updated successfully');
}


    public function aboutUs(){
        $about_us = BusinessPages::where('title', 'about-us')->first();
        return view(ViewPath::ADMIN_ABOUT_US, compact('about_us'));
    }
    public function aboutUsStore(Request $request){
        $request->validate([
            'content' => 'required',
        ]);
        $about_us = BusinessPages::where('title', 'about-us')->first();
        $about_us->content = $request->content;
        $about_us->save();
        Toastr::success('About Us Content Updated!', 'Success');
        return redirect()->back();    
    } 
    
    public function termsConditions(){
        $terms_conditions = BusinessPages::where('title', 'terms-conditions')->first();

        return view(ViewPath::ADMIN_TERMS_CONDITIONS, compact('terms_conditions'));
    } 
    public function termsConditionsStore(Request $request){
        $request->validate([
            'content' => 'required',
        ]);
        $terms_conditions = BusinessPages::where('title', 'terms-conditions')->first();
        $terms_conditions->content = $request->content;
        $terms_conditions->save();
    
        Toastr::success('Terms & Conditions Content Updated!', 'Success');
        return redirect()->back();    
    } 
    public function privacyPolicy(){
        $privacy_policy = BusinessPages::where('title', 'privacy-policy')->first();

        return view(ViewPath::ADMIN_PRIVACY_POLICY, compact('privacy_policy'));
    } 
    public function privacyPolicyStore(Request $request){
        $request->validate([
            'content' => 'required',
        ]);
        $privacy_policy = BusinessPages::where('title', 'privacy-policy')->first();
        $privacy_policy->content = $request->content;
        $privacy_policy->save();

        Toastr::success('Privacy Policy Content Updated!', 'Success');
        return redirect()->back();
    } 
    public function refundPolicy(){
        $refund_policy = BusinessPages::where('title', 'refund-policy')->first();

        return view(ViewPath::ADMIN_REFUND_POLICY, compact('refund_policy'));
    } 
    public function refundPolicyStore(Request $request){
        $request->validate([
            'content' => 'required',
        ]);
        $refund_policy = BusinessPages::where('title', 'refund-policy')->first();
        $refund_policy->content = $request->content;
        $refund_policy->save();

        Toastr::success('Refund Policy Content Updated!', 'Success');
        return redirect()->back();
    } 
    // WHY CHOOSE US ON HOME PAGE
    public function whyChooseUs(){
        $why_choose_us = BusinessPages::where('title', 'why-choose-us')->first();

        return view(ViewPath::ADMIN_WHY_CHOOSE_US, compact('why_choose_us'));
    }

    public function whyChooseUsStore(Request $request)
    {
        $request->validate([
            'content' => 'required',
        ]);
    
        $why_choose_us = BusinessPages::where('title', 'why-choose-us')->first();
        $why_choose_us->content = $request->content;
    
        if ($request->hasFile('images')) {
            $newImages = [];
            $path = public_path('assets/images/whyChooseUs/');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move($path, $filename);
                $newImages[] = $filename;
            }
            $existingImages = json_decode($why_choose_us->images, true) ?? []; 
            $updatedImages = array_merge($existingImages, $newImages);
            $why_choose_us->images = json_encode($updatedImages);
        }
        $why_choose_us->save();
        Toastr::success('Why Choose Us content updated successfully!', 'Success');
        return redirect()->back();
    }
    public function deleteWhyChooseUsImages(Request $request){
        $request->validate([
            'image' => 'required|string'
        ]);
        $imageName = $request->image;
        $businessPage = BusinessPages::where('title', 'why-choose-us')->first();
        if ($businessPage) {
            $images = json_decode($businessPage->images, true) ?? [];
            if (($key = array_search($imageName, $images)) !== false) {
                unset($images[$key]);
                $businessPage->images = json_encode(array_values($images)); 
                $businessPage->save();
                $imagePath = public_path('assets/images/gallary/' . $imageName);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
                return response()->json(['success' => true, 'message' => 'Image deleted successfully!']);
            }
        }
        return response()->json(['success' => false, 'message' => 'Image not found!']);
    }

    public function socialLinks(){
        $social_links = SocialLinks::all();
        return view(ViewPath::ADMIN_SOCIAL_LINKS, compact('social_links'));
    }

    public function socialLinksStore(Request $request){
        $request->validate([
            'name' => 'required',
            'link' => 'required',
           
        ]);
        $social_links = SocialLinks::where('name', $request->name)->first();
        $social_links->link = $request->link;
        $social_links->save();
        Toastr::success('Social Links Added!', 'Success');
        return redirect()->back();
    }

    public function statusSocialLink(Request $request, $id){
        $socialLink = SocialLinks::findOrFail($id);
        $socialLink->status = $request->active; 
        $socialLink->save();

        Toastr::success('Social link status updated successfully.', 'Success');
        return back();
    }
    public function editView($id){
        return view(ViewPath::ADMIN_SOCIAL_LINKS_EDIT, compact('id'));
    }
    public function editSocialLink(Request $request, $id){
        $socialLink = SocialLinks::find($id);
        $socialLink->link = $request->link;
        $socialLink->save();
        Toastr::success('Social link updated successfully.', 'Success');

        return redirect()->route('admin.business-setting.social-links');
    }


    // IMAGE GALLARY 
        public function imageGallary()
    {
        $imageGalleries = ImageGallary::where('id', 1)->first(); 
        $images = json_decode($imageGalleries->image, true) ?? [];
        return view(ViewPath::ADMIN_IMAGE_GALLARY, compact('images'));
    }

    public function gallaryStore(Request $request)
    {
        $request->validate([
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
    
        $imageGallary = ImageGallary::firstOrCreate(['id' => 1], ['images' => json_encode([])]);
    
        $storedImages = json_decode($imageGallary->image, true) ?? [];
    
        if ($request->hasFile('images')) {
            $path = public_path('assets/images/gallary/');
    
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
    
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move($path, $filename);
                $storedImages[] = $filename; 
            }
        }
        $imageGallary->image = json_encode($storedImages);
        $imageGallary->save();
    
        Toastr::success('Image Gallery Updated!', 'Success');
        return redirect()->back();
    }
    
    public function deleteImage(Request $request)
    {
        $request->validate([
            'image' => 'required|string'
        ]);

        $imageName = $request->image;
        $imageGallary = ImageGallary::first(); 

        if ($imageGallary) {
            $images = json_decode($imageGallary->image, true) ?? [];

            if (($key = array_search($imageName, $images)) !== false) {
                unset($images[$key]); 
                $imageGallary->image = json_encode(array_values($images));
                $imageGallary->save();

                $imagePath = public_path('assets/images/gallary/' . $imageName);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
                return response()->json(['success' => true, 'message' => 'Image deleted successfully!']);
            }
        }
        return response()->json(['success' => false, 'message' => 'Image not found!']);
    }
}
