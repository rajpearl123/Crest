<?php

use App\Http\Controllers\Web\TheaterController;
use App\Http\Controllers\Web\Auth\AuthController;
use App\Http\Controllers\Web\BookingController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\RazorpayController;
use App\Http\Controllers\Web\ReviewController;
use App\Http\Controllers\Web\InstagramController;

use App\Http\Controllers\Web\Auth\SocialiteController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
require_once __DIR__ . '/admin/routes.php';
Route::get('/clear-cache', function() {
    try {
        Artisan::call('optimize:clear');
        Artisan::call('route:clear');
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        return "Cache is cleared";
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
});
Route::get('/logout',[AuthController::class, 'logout'])->name('logout');
Route::post('/register-book',[AuthController::class, 'bookRegister'])->name('register-book');
// Route::post('/register-book', 'bookRegister')->name('register-book');
Route::get('auth/google', [SocialiteController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [SocialiteController::class, 'handleGoogleCallback']);
Route::get('/instagram-posts', [InstagramController::class, 'fetchInstagramPosts']);

Route::get('/proxy-image', function () {
    $imageUrl = request('url'); 

    if (!$imageUrl) {
        return response("No URL provided", 400);
    }

    $response = Http::get($imageUrl);

    if ($response->failed()) {
        return response("Failed to load image", 500);
    }

    return response($response->body(), 200)
        ->header("Content-Type", $response->header("Content-Type"));
});

Route::get('auth/apple', [SocialiteController::class, 'redirectToApple']);
Route::get('auth/apple/callback', [SocialiteController::class, 'handleAppleCallback']);
Route::middleware('guest')->group(function(){
    Route::controller(AuthController::class)->group(function(){
        Route::get('/register', 'register')->name('register');
        Route::post('/register', 'registerStore')->name('register-store');
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'loginStore')->name('login-store');
        Route::get('/forgot-password', 'forgotPassword')->name('forgotPassword');
        Route::post('/send-mail', 'sendMail')->name('sendMail');
        Route::get('/reset-password', 'showResetForm')->name('showResetForm');
        Route::post('/reset-password', 'resetPassword')->name('resetPassword');
    });
});

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/about-us', 'aboutUs')->name('aboutUs');    
    Route::get('/gallery', 'gallery')->name('gallery');
    Route::get('/blogs/category/{category?}', 'blog')->name('blogs');
    Route::get('/blogdetail/{slug}', 'blogdetail')->name('blogdetail');
    Route::get('/videos', 'video')->name('videos');
    Route::get('/services-wedding', 'servicesWedding')->name('servicesWedding');
    Route::get('/service/{slug}', 'services')->name('services');
    Route::get('/albums/{slug}', 'services')->name('albums.show');
    Route::post('/custom-packages', 'custom_package_store')->name('package.custom-packages');
    Route::get('/package', 'package')->name('package.index');
    Route::get('/package-video', 'videoPackage')->name('package.videoPackage');
    Route::get('/package-offer', 'offerPackage')->name('package.offerPackage');
    Route::post('/book-appointment', 'storeAppointment')->name('appointment.store');





    Route::get('/portfolio-new', 'portfolio')->name('portfolio_new');

    Route::get('/terms-conditions', 'termsConditions')->name('termsConditions');
    Route::get('/privacy-policy', 'privacyPolicy')->name('privacyPolicy');
    Route::get('/refund-policy', 'refundPolicy')->name('refund-policy');
    Route::get('/contact-us', 'contactUs')->name('contactUs');
    Route::post('/contact-us', 'contactUsStore')->name('contactUs-store');
    Route::post('/subscribe', 'subscribeStore')->name('subscribe');
});

Route::controller(DashboardController::class)->group(function () {
    Route::get('/dashboard', 'index')->name('dashboard');
    Route::post('/update-profile-image', 'updateProfileImage')->name('update-profile-image');
    Route::post('/update-profile', 'updateProfileDetails')->name('updateProfileDetails');
    Route::get('/messages', 'contactMessages')->name('messages');
    Route::get('/replies/{id}', 'replies')->name('replies');
    Route::post('/sendReply/{id}', 'sendReply')->name('sendReply');
});

Route::controller(TheaterController::class)->group(function () {
    Route::get('/theater/{id}', 'theaterView')->name('theater-view');
});

Route::controller(RazorpayController::class)->group(function(){
    Route::post('/initiatePayment', 'initiatePayment')->name('initiatePayment');
    Route::post('/razorpay-success', 'paymentSuccess')->name('paymentSuccess');
});

Route::controller(ReviewController::class)->group(function(){
    Route::post('/review-store', 'storeReview')->name('reviewStore');
});

// Route::controller(BlogController::class)->group(function(){
//     Route::get('/blogs', 'index')->name('blogs.index'); 
//     Route::get('/blogs/{slug}', 'show')->name('blogs.show'); 
// });