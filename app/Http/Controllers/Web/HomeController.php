<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriberNotification;
use Illuminate\Http\Request;
use App\Utils\ViewPath;
use App\Models\BusinessPages;
use App\Models\ContactUs;
use App\Models\SocialLinks;
use App\Models\Subscriber;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Gallery;
use App\Models\VideoGallery;
use App\Models\Comment;
use App\Models\Testimonial;
use App\Models\ContactInfo;
use App\Models\Aboutus;
use App\Models\WhyChooseUs;
use App\Models\HomeVideo;
use App\Models\HomeAlbum;
use App\Models\Album;
use App\Models\Chooseus;
use App\Models\Step;
use App\Models\Package;
use App\Models\CustomPackage;
use App\Models\Appointment;



use App\Models\BlogCategory;
use App\Models\GalleryCategory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;



class HomeController extends Controller
{
    public function home()
    {
        $socialLinks = SocialLinks::where('status', 0)->get();
        $banners = Banner::all();
        $contactInfo = ContactInfo::first();
        $blogs = Blog::orderBy('publish_date', 'desc')->paginate(3);
        $settings = Blog::first();
        $testimonials = Testimonial::all();
        $services = Step::all();

        $section = Aboutus::first();
        $features = WhyChooseUs::all();
        $homeVideo = HomeVideo::first();
        $op_data = json_decode($section->operation_data, true);
        $albums = Album::all(); // Fetch all albums
        $allImages = collect(); // Initialize an empty collection
        $HomeAlbum = HomeAlbum::first();
        foreach ($albums as $album) {
            if (!empty($album->image_url) && is_array($album->image_url)) {
                $allImages = $allImages->merge($album->image_url); // Merge all images into a single collection
            }
        }

        $randomImages = $allImages->shuffle();




        return view(ViewPath::HOME, compact('services', 'op_data', 'socialLinks', 'HomeAlbum', 'banners', 'contactInfo', 'blogs', 'settings', 'testimonials', 'section', 'features', 'homeVideo', 'album', 'randomImages'));
    }

    public function aboutUs()
    {
        $about = BusinessPages::where('title', 'about-us')->first();
        $section = Aboutus::first();
        $features = WhyChooseUs::all();
        $items = Chooseus::all();
        $albums = Album::all(); // Fetch all albums
        $allImages = collect();
        foreach ($albums as $album) {
            if (!empty($album->image_url) && is_array($album->image_url)) {
                $allImages = $allImages->merge($album->image_url); // Merge all images into a single collection
            }
        }
        $randomImages = $allImages->shuffle();
        // dd($about);
        return view(ViewPath::ABOUT_US, compact('about', 'section', 'features', 'items', 'randomImages'));
    }

    // public function gallery()
    // {

    //     $galleries = Gallery::orderby('created_at', 'desc')->paginate(9);
    //     return view(ViewPath::GALLERY, compact('galleries'));
    // }

    public function gallery(Request $request)
    {
        $query = Gallery::with('category')->orderBy('created_at', 'desc');

        $cat_name = 'All'; // Default name
        if ($request->has('category') && $request->category != '') {
            $category = GalleryCategory::where('name', $request->category)->first();

            if ($category) {
                $query->where('gallery_category_id', $category->id);
                $cat_name = $category->name;
            }
        }
        //dd("here");
        $galleries = $query->paginate(6);
        //dd($galleries);
        $categories = GalleryCategory::all();

        return view(ViewPath::GALLERY, compact('galleries', 'categories', 'cat_name'));
    }



    // public function blog()
    // {
    //     $blogs = Blog::orderBy('publish_date', 'desc')->paginate(6);
    //     $settings = Blog::first();
    //     return view(ViewPath::BLOG, compact('blogs', 'settings'));
    // }

    public function blog($category = null)
    {
        $categoryModel = null;

        if ($category) {
            $categoryModel = BlogCategory::where('name', $category)->first();
            // dd($categoryModel);
        }

        if ($categoryModel) {
            $blogs = Blog::where('blog_category_id', $categoryModel->id)
                ->orderBy('publish_date', 'desc')
                ->paginate(4);
        } else {
            $blogs = Blog::orderBy('publish_date', 'desc')->paginate(4);
        }

        $settings = Blog::first();
        $categories = BlogCategory::all();
        // $blog = Blog::where('slug', $slug)->firstOrFail();

        $recentBlogs = Blog::orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        return view(ViewPath::BLOG, compact('blogs', 'settings', 'categories', 'category', 'recentBlogs'));
    }


    public function blogdetail($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        $categories = BlogCategory::all();
        $comments = Comment::where('blog_id', $blog->id)
            ->where('approve', 1)
            ->paginate(5);


        $recentBlogs = Blog::where('id', '!=', $blog->id)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();
        $settings = Blog::first();

        return view(ViewPath::BLOGDETAIL, compact('blog', 'comments', 'settings', 'recentBlogs', 'categories'));
    }

    public function video()
    {
        $galleries = VideoGallery::orderby('created_at', 'desc')
            ->where('active', 'yes')
            ->paginate(6);
        //dd($galleries);

        return view(ViewPath::VIDEO, compact('galleries'));
    }

    public function servicesWedding()
    {
        return view(ViewPath::SERVICES_WEDDING);
    }


    public function services($slug)
    {
        $banner;
        $title = "";
        if ($slug == 'wedding') {
            $title = "Wedding Photography";
            $banner = getBanner('wedding ');
        } elseif ($slug == 'event') {
            $title = "Event Photography";
            $banner = getBanner('events ');
        } elseif ($slug == 'video_production') {
            $title = "Video Production Photography";
            $banner = getBanner('video_prod');
        } elseif ($slug == 'kids_photography') {
            $title = "Kids Photography";
            $banner = getBanner('kids');
        } elseif ($slug == 'product_photography') {
            $title = "Product Photography";
            $banner = getBanner('product');
        }
        // dd($banner );
        $homeVideo = HomeVideo::first();

        $album = Album::where('slug', $slug)->firstOrFail();
        return view('web-views.services.index', compact('title', 'banner', 'album', 'homeVideo'));
    }

    public function termsConditions()
    {
        $terms_conditions = BusinessPages::where('title', 'terms-conditions')->first();

        return view(ViewPath::TERMS_CONDITIONS, compact('terms_conditions'));
    }
    public function privacyPolicy()
    {
        $privacy_policy = BusinessPages::where('title', 'privacy-policy')->first();
        return view(ViewPath::PRIVACY_POLICY, compact('privacy_policy'));
    }
    public function refundPolicy()
    {
        $refund_policy = BusinessPages::where('title', 'refund-policy')->first();
        return view(ViewPath::REFUND_POLICY, compact('refund_policy'));
    }
    public function contactUs()
    {

        $contactInfo = ContactInfo::first();
        return view(ViewPath::CONTACT_US, compact('contactInfo'));
    }

    // public function contactUsStore(Request $request){

    //     $request->validate([
    //         'name' => 'required', 
    //         'email' => 'required',
    //         'phone' => 'required',
    //         'subject' => 'required',
    //         'message' => 'required',
    //     ]);
    //     $contact = new ContactUs();
    //     $contact->name = $request->name;
    //     $contact->email = $request->email;  
    //     $contact->phone = $request->phone;
    //     $contact->subject = $request->subject;
    //     $contact->message = $request->message;
    //     $contact->save();
    //     Toastr::success('Message Sent Successfully!', 'Success');
    //     return redirect()->back();
    // }

    public function contactUsStore(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email:rfc,dns|max:255',
                'phone' => 'nullable|string|max:255',
                'subject' => 'nullable|string|max:255',
                'message' => 'required|string',
            ]);

            // Save to Database
            ContactUs::create($request->all());

            $logoUrl = asset('assets/web-assets/images/email_logo.png');
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone ?? 'No Phone',
                'subject' => $request->subject ?? 'No Subject',
                'userMessage' => $request->message,
                'logoUrl' => $logoUrl
            ];

            Mail::send('email-templates.contact', $data, function ($message) use ($request) {
                $message->to($request->email)
                    ->subject('Thank You for Contacting Us')
                    ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            });

            Toastr::success('Message Sent Successfully!', 'Success');
        } catch (\Illuminate\Validation\ValidationException $e) {
            foreach ($e->errors() as $error) {
                Toastr::error($error[0], 'Validation Error');
            }
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            \Log::error('Contact form error: ' . $e->getMessage());

            Toastr::error('Something went wrong! Please try again later.', 'Error');
        }

        return redirect()->back();
    }



    public function subscribeStore(Request $request)
    {
        $existingSubscriber = Subscriber::where('email', $request->email)->first();

        if ($existingSubscriber) {
            Toastr::warning('You are already subscribed!', 'Warning');
            return redirect()->back();
        }

        try {
            Validator::make($request->all(), [
                'email' => [
                    'required',
                    'email:rfc,dns',
                    'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
                    'unique:subscribers,email',
                ],
            ])->validate();
        } catch (ValidationException $e) {
            foreach ($e->errors() as $messages) {
                foreach ($messages as $message) {
                    Toastr::error($message, 'Validation Error');
                }
            }
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        $subscriber = new Subscriber();
        $subscriber->email = $request->email;
        $subscriber->save();

        $logoUrl = asset('assets/web-assets/images/email_logo.png');
        Mail::to($subscriber->email)->send(new SubscriberNotification($subscriber, $logoUrl));
        Toastr::success('Subscribed Successfully!', 'Success');
        return redirect()->back();
    }

    public function package()
    {

        $packages = Package::where('type', 'photography')->get();

        return view('web-views.packages.index', compact('packages'));
    }

    public function videoPackage()
    {

        $packages = Package::where('type', 'videography')->get();

        return view('web-views.packages.video', compact('packages'));
    }

    public function offerPackage()
    {

        $packages = Package::where('type', 'offers')->get();
        //dd($packages);
        return view('web-views.packages.offer', compact('packages'));
    }


    public function custom_package_store(Request $request)
    {
        // DD($request->ALL());
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'package' => 'required|string|max:100',
            'event' => 'required|array',
            'event_datetime' => 'required|date',
            'venue' => 'required|string',
            'requirement' => 'nullable|string',
            'photography' => 'nullable|array',
            'videography' => 'nullable|array',
            'extras' => 'nullable|array',
            'budget' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        // Create new custom package
        $customPackage = CustomPackage::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->contact,
            'package' => $request->package,
            'event' => $request->event,
            'event_datetime' => $request->event_datetime,
            'venue' => $request->venue,
            'requirement' => $request->requirements,
            'photography' => $request->photography,
            'videography' => $request->videography,
            'extras' => $request->extras,
            'budget' => $request->budget,
        ]);

        // Send confirmation email
        try {
            Mail::to($customPackage->email)->send(new CustomPackageConfirmation($customPackage));
        } catch (\Exception $e) {
            // Log the error or handle it as needed
            \Log::error('Failed to send email: ' . $e->getMessage());
        }
        return redirect()->back()->with('message', 'Custom package created successfully and confirmation email sent');
    }

    public function storeAppointment(Request $request)
    {
        //dd($request->all());
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'wedding_date' => 'required|date',
            'wedding_venue' => 'required|string|max:255',
            'package_id' => 'required|exists:packages,id',
            'type' => 'required|string'
        ]);

        Appointment::create($validated);
        $package = Package::find($validated['package_id']);

        $emailData = [
            'name' => $validated['name'],
            'contact' => $validated['contact'],
            'email' => $validated['email'],
            'wedding_date' => $validated['wedding_date'],
            'wedding_venue' => $validated['wedding_venue'],
            'type' => ucfirst($validated['type']),
            'package_name' => $package->name ?? 'N/A',
            'package_price' => $package->price ?? 'N/A',
        ];

        Mail::send('email-templates.appointment', $emailData, function ($message) use ($emailData) {
            $message->to($emailData['email'])
                    ->subject('Your Appointment Confirmation');
        });
        
        Toastr::success('We will reach out to you soon !!!', 'Success');

        return back()->with('success', 'Your appointment has been booked successfully!');
    }
}
