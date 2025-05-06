<?php

use App\Http\Controllers\Admin\Auth\AdminController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Booking\BookingController;
use App\Http\Controllers\Admin\BusinessSetting\BusinessPagesController;
use App\Http\Controllers\Admin\BusinessSetting\ContactUsSubmission;
use App\Http\Controllers\Admin\BusinessSetting\WebsiteSettingController;
use App\Http\Controllers\Admin\Prospects\ProspectsController;
use App\Http\Controllers\Admin\Subscribers\SubscriberController;
use App\Http\Controllers\Admin\Theater\TheaterController;
use App\Http\Controllers\Admin\Timing\ScheduleTimingController;
use App\Http\Controllers\Admin\Users\UserController;
use App\Http\Controllers\Admin\Roles\RoleController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\VideoGalleryController;
use App\Http\Controllers\Admin\CommentController ;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\AboutusController;
use App\Http\Controllers\Admin\HomeVideoController;
use App\Http\Controllers\Admin\AlbumController;
use App\Http\Controllers\Admin\HomeAlbumController;
use App\Http\Controllers\Admin\StepController;
use App\Http\Controllers\Admin\PageBannerController;
use App\Http\Controllers\Admin\PackageController;



use App\Http\Controllers\Admin\Staff\StaffController;
use App\Http\Controllers\Web\RazorpayController;
use App\Models\ContactUs;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('admin/login', [LoginController::class, 'loginView'])->name('admin.login');
    Route::post('admin/login', [LoginController::class, 'login'])->name('admin.login.post');
});
Route::get('admin/logout', [LoginController::class, 'logout'])->name('admin.logout');
Route::post('/blogs/{blog}/comments', [CommentController::class, 'store'])->name('comments.store');



Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    Route::resource('testimonials', TestimonialController::class);
    Route::get('/profile', [BusinessPagesController::class, 'admin_profile'])->name('profile');
    Route::get('/profile/list', [BusinessPagesController::class, 'list_profile'])->name('profile_list');

    Route::put('/profile-update', [BusinessPagesController::class, 'admin_profile_update'])->name('profile.update');
    Route::resource('video-gallery', VideoGalleryController::class);
	Route::resource('steps', StepController::class);

    Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
    Route::patch('/comments/{id}/approve', [CommentController::class, 'approve'])->name('comments.approve');
    Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');


Route::get('/home_albums', [HomeAlbumController::class, 'index'])->name('home_albums.index');
Route::get('/home_albums/edit', [HomeAlbumController::class, 'edit'])->name('home_albums.edit');
Route::put('/home_albums/update', [HomeAlbumController::class, 'update'])->name('home_albums.update');


Route::get('/page_banners', [PageBannerController::class, 'index'])->name('page_banner.index');
Route::get('/page_banners/{id}/edit', [PageBannerController::class, 'edit'])->name('page_banner.edit');
Route::put('/page_banners/{id}', [PageBannerController::class, 'update'])->name('page_banner.update');

    Route::controller(RoleController::class)->middleware('checkPermission:Access Management')->group(function(){
        Route::get('roles', 'roles')->name('roles');
        Route::post('roles-store', 'store')->name('role-store');
        Route::post('roles-status/{id}', 'status')->name('role-status');
        Route::post('roles-update/{id}', 'update')->name('role-update');
        Route::get('assign-permissions', 'permissionAssignment')->name('assign-permission');
        Route::post('assign-permissions', 'assign')->name('assign-permission-store');

    });
    Route::controller(StaffController::class)->middleware('checkPermission:Access Management')->group(function(){
        Route::get('staff', 'staff')->name('staff');
        Route::post('staff-add', 'addStaff')->name('staff-add');
        Route::post('staff-status/{id}', 'status')->name('staff-status');
        Route::post('staff-update/{id}', 'update')->name('staff-update');
    });

    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    

    Route::prefix('business-setting')->name('business-setting.')->group(function(){
        Route::controller(BusinessPagesController::class)->middleware('checkPermission:Business Setting')->group(function(){
            Route::get('about-us', 'aboutUs')->name('about-us');
            Route::post('about-us', 'aboutUsStore')->name('about-us-store');
            Route::get('terms-conditions', 'termsConditions')->name('terms-conditions');
            Route::post('terms-conditions', 'termsConditionsStore')->name('terms-conditions-store');
            Route::get('privacy-policy', 'privacyPolicy')->name('privacy-policy');
            Route::post('privacy-policy', 'privacyPolicyStore')->name('privacy-policy-store');
            Route::get('refund-policy', 'refundPolicy')->name('refund-policy');
            Route::post('refund-policy', 'refundPolicyStore')->name('refund-policy-store');
            Route::get('why-choose-us', 'whyChooseUs')->name('why-choose-us');
            Route::post('why-choose-us', 'whyChooseUsStore')->name('why-choose-us-store');
            Route::post('why-choose-us-img-delete', 'deleteWhyChooseUsImages')->name('why-choose-us-img-delete');
            Route::get('social-links', 'socialLinks')->name('social-links');
            Route::post('social-links', 'socialLinksStore')->name('social-links-store');
            Route::post('social-link/status/{id}', 'statusSocialLink')->name('social-links-status');
            Route::get('social-link/edit/{id}', 'editView')->name('social-links-edit');
            Route::post('social-link/editStore/{id}', 'editSocialLink')->name('social-links-edit-store');
            Route::get('gallary', 'imageGallary')->name('imageGallary');
            Route::post('gallary', 'gallaryStore')->name('imageGallaryStore');
            Route::post('delete-image', 'deleteImage')->name('deleteImage');
            
        });
    });
    Route::prefix('website-setting')->name('website-setting.')->group(function(){
        Route::controller(WebsiteSettingController::class)->middleware('checkPermission:Website Setting')->group(function(){
            Route::get('index', 'index')->name('index');
            Route::post('index', 'store')->name('store');
            Route::get('banners', 'banners')->name('banners');
            Route::post('banners', 'bannerStore')->name('bannerStore');
            Route::post('banner-status/{id}', 'bannerStatus')->name('bannerStatus');
            Route::get('banner-delete/{id}', 'bannerDelete')->name('bannerDelete');
            
        });
    });
    Route::controller(SubscriberController::class)->middleware('checkPermission:Subscribers')->group(function(){
        Route::get('subscribers', 'subscribers')->name('subscribers');
    });



    Route::controller(ContactUsSubmission::class)->middleware('checkPermission:Contact Us')->group(function(){
        Route::get('contact-list', 'contactList')->name('contact-list');
        Route::delete('/contacts/{id}', 'destroy')->name('contacts.destroy');
        Route::get('contact-info/edit', 'edit')->name('contact-info.edit');
        Route::get('contact-info', 'contactinfoview')->name('contact-info.view');
        Route::put('contact-info/update', 'update')->name('contact-info.update');
        Route::get('replies/{id}', 'replyView')->name('replyView');
        Route::post('reply/{id}', 'reply')->name('reply');
        Route::post('contacts/{id}/reply', 'reply_user')->name('contacts.reply');

    });
    Route::prefix('users')->name('user.')->middleware('checkPermission:Users')->group(function(){        
        Route::controller(UserController::class)->group(function(){
            Route::get('/', 'list')->name('list');
        });
    });

    Route::get('/packages/customize/user_request', [PackageController::class, 'user_requests'])->name('packages.user_requests');
    Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');
    Route::get('/packages/create', [PackageController::class, 'create'])->name('packages.create');
    Route::post('/packages/store', [PackageController::class, 'store'])->name('packages.store');
    Route::get('/packages/{id}/edit', [PackageController::class, 'edit'])->name('packages.edit');
    Route::post('/packages/{id}/update', [PackageController::class, 'update'])->name('packages.update');
    Route::delete('/packages/{id}/delete', [PackageController::class, 'destroy'])->name('packages.delete');
    Route::get('/appointments', [PackageController::class, 'appointments'])->name('appointments');



    Route::get('/banners', [BannerController::class, 'index'])->name('banners.index');
    Route::get('/banners/create', [BannerController::class, 'create'])->name('banners.create');
    Route::post('/banners/store', [BannerController::class, 'store'])->name('banners.store');
    Route::get('/banners/edit/{banner}', [BannerController::class, 'edit'])->name('banners.edit');
    Route::post('/banners/update/{banner}', [BannerController::class, 'update'])->name('banners.update');
    Route::delete('/banners/delete/{banner}', [BannerController::class, 'destroy'])->name('banners.destroy');

    
    Route::get('/home_video', [HomeVideoController::class, 'index'])->name('video.index');
    Route::get('/home_video/edit', [HomeVideoController::class, 'show'])->name('video.edit');
    Route::post('/home_video/update', [HomeVideoController::class, 'update'])->name('video.update');


    Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index'); 
    Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create'); 
    Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store'); 
    Route::get('/blogs/{id}/edit', [BlogController::class, 'edit'])->name('blogs.edit'); 
    Route::put('/blogs/{id}', [BlogController::class, 'update'])->name('blogs.update'); 
    Route::delete('/blogs/{id}', [BlogController::class, 'destroy_blog'])->name('blogs.destroy'); 
    Route::post('/blog/toggle-visibility', [BlogController::class, 'toggleVisibility'])->name('blog.toggleVisibility');

    Route::get('/blog-categories', [BlogController::class, 'index_category'])->name('blog-categories.index');
    Route::get('/blog-categories/create', [BlogController::class, 'create_category'])->name('blog-categories.create');
    Route::post('/blog-categories', [BlogController::class, 'store_category'])->name('blog-categories.store');
    Route::get('/blog-categories/{blogCategory}/edit', [BlogController::class, 'edit_category'])->name('blog-categories.edit');
    Route::put('/blog-categories/{blogCategory}', [BlogController::class, 'update_category'])->name('blog-categories.update');
    Route::delete('/blog-categories/{blogCategory}', [BlogController::class, 'destroy'])->name('blog-categories.destroy');

    
    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
    Route::get('/gallery/create', [GalleryController::class, 'create'])->name('gallery.create');
    Route::post('/gallery/store', [GalleryController::class, 'store'])->name('gallery.store');
    Route::get('/gallery/edit/{id}', [GalleryController::class, 'edit'])->name('gallery.edit');
    Route::post('/gallery/update/{id}', [GalleryController::class, 'update'])->name('gallery.update');
    Route::delete('/gallery/delete/{id}', [GalleryController::class, 'destroy'])->name('gallery.destroy');


    Route::get('/gallery-categories', [GalleryController::class, 'index_category'])->name('gallery-categories.index');
    Route::get('/gallery-categories/create', [GalleryController::class, 'create_category'])->name('gallery-categories.create');
    Route::post('/gallery-categories', [GalleryController::class, 'store_category'])->name('gallery-categories.store');
    Route::get('/gallery-categories/{galleryCategory}/edit', [GalleryController::class, 'edit_category'])->name('gallery-categories.edit');
    Route::put('/gallery-categories/{galleryCategory}', [GalleryController::class, 'update_category'])->name('gallery-categories.update');
    Route::delete('/gallery-categories/{galleryCategory}', [GalleryController::class, 'destroycategory'])->name('gallery-categories.destroy');


    Route::get('/about-us', [AboutusController::class, 'index'])->name('about.index');
    Route::post('/about-us', [AboutusController::class, 'update'])->name('about.update');
    

    Route::get('why-choose-us', [AboutusController::class, 'section_index'])->name('why_choose_us.index');  
    Route::get('why-choose-us/create', [AboutusController::class, 'section_create'])->name('why_choose_us.create');  
    Route::post('why-choose-us', [AboutusController::class, 'section_store'])->name('why_choose_us.store');  
    Route::get('why-choose-us/{id}/edit', [AboutusController::class, 'section_edit'])->name('why_choose_us.edit');  
    Route::put('why-choose-us/{id}', [AboutusController::class, 'section_update'])->name('why_choose_us.update');  
    Route::delete('why-choose-us/{id}', [AboutusController::class, 'section_destroy'])->name('why_choose_us.destroy');  


    Route::get('/albums', [AlbumController::class, 'index'])->name('albums.index');
    Route::get('/albums/create', [AlbumController::class, 'create'])->name('albums.create');
    Route::post('/albums/store', [AlbumController::class, 'store'])->name('albums.store');
    Route::get('/albums/edit/{id}', [AlbumController::class, 'edit'])->name('albums.edit');
    Route::post('/albums/update/{id}', [AlbumController::class, 'update'])->name('albums.update');
    Route::get('/albums/delete/{id}', [AlbumController::class, 'destroy'])->name('albums.destroy');
    Route::delete('/albums/{album}/remove-image/{image}', [AlbumController::class, 'removeImage'])->name('albums.removeImage');

    Route::get('/choose-us', [AboutusController::class, 'choose_us_index'])->name('choose_us.index');
    Route::get('/choose-us/create', [AboutusController::class, 'choose_us_create'])->name('choose_us.create');
    Route::post('/choose-us', [AboutusController::class, 'choose_us_store'])->name('choose_us.store');
    Route::get('/choose-us/{whyChooseUs}/edit', [AboutusController::class, 'choose_us_edit'])->name('choose_us.edit');
    Route::put('/choose-us/{whyChooseUs}', [AboutusController::class, 'choose_us_update'])->name('choose_us.update');
    Route::delete('/choose-us/{whyChooseUs}', [AboutusController::class, 'choose_us_destroy'])->name('choose_us.destroy');

});
