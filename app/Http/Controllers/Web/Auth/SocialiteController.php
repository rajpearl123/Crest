<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Google Callback
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $user = User::where('google_id', $googleUser->getId())->first();
            if ($user) {
                Auth::login($user);
                return redirect('/');
            }
            $user = User::updateOrCreate(
                ['email' => $googleUser->getEmail()], 
                [
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'image' => $googleUser->getAvatar(),
                    'password' => Hash::make(Str::random(16)), 
                ]
            );            
            Mail::to($email)->send(new RegistrationMail($user, $user->password));
            $login = Auth::login($user);
            return redirect('/'); 
        } catch (\Exception $e) {
            Toastr::error('Something went wrong!'. $e->getMessage(), 'Error');
            return redirect('/login')->with('error', 'Something went wrong!');
        }
    }

    // Apple Redirect
    public function redirectToApple()
    {
        return Socialite::driver('apple')->redirect();
    }
    // Apple Callback
    public function handleAppleCallback()
    {
        try {
            $appleUser = Socialite::driver('apple')->user();
            $user = User::updateOrCreate(
                ['email' => $appleUser->getEmail()],
                [
                    'name' => $appleUser->getName(),
                    'apple_id' => $appleUser->getId(),
                    'password' => bcrypt('password'),
                ]
            );
            Auth::login($user);
            return redirect('/dashboard');
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Something went wrong!');
        }
    }
}
