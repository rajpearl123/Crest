<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Mail\RegistrationMail;
use Brian2694\Toastr\Facades\Toastr;
use App\Utils\ViewPath;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Mail\RegistrationAtBooking;
use App\Models\BookingProspect;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function register(){
        return view(ViewPath::REGSISTER);
    }
    public function registerStore(UserRequest $request){
        $user = $request->validated();
        $user = Arr::except($user, ['confirm_password']);
        $password = $user['password']; 
        $user['password'] = Hash::make($user['password']);
        $createdUser = User::create($user);
        Mail::to($createdUser->email)->send(new RegistrationMail($createdUser, $password));

        Toastr::success('You Are Registred Successfully!', 'Success');
        return redirect()->route('login');
    }
    // REGISTER THE USER AT THE TIME OF BOOKING AND CREATE PROSPECTS
    public function bookRegister(Request $request){
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $prospect = new BookingProspect();
            $prospect->user_id = $user->id;
            $prospect->theater_id = $request->theater_id;
            $prospect->date = $request->date;
            $prospect->slot_id = $request->slot_id;
            $prospect->save();
            return response()->json(['message' => 'Prospect Created!'], 409);
        }else{
            $name = $request->name;
            $email = $request->email;
            $phone = $request->phone;
            $password = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 10);
            $passwordHash = Hash::make(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 10));
            $user = [
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'password' => $passwordHash,
            ];
            $createdUser = User::create($user);
            Mail::to($email)->send(new RegistrationMail($createdUser, $password));
            // STORE PROSPECTS
            $prospect = new BookingProspect();
            $prospect->user_id = $createdUser->id;
            $prospect->theater_id = $request->theater_id;
            $prospect->date = $request->date;
            $prospect->slot_id = $request->slot_id;
            $prospect->save();
            return response()->json(['message' => 'Registration Successfull And Prospect Created!'], 409);
        }
    }
    public function login(){
        return view(ViewPath::LOGIN);
    }

    public function loginStore(UserLoginRequest $request){
        $credentials = $request->validated();
        if(auth()->attempt($credentials)){
            return redirect()->route('home');
        }
        Toastr::error('Invalid Credentials!', 'Error');
        return redirect()->back();
    }

    public function logout(){
        auth()->logout();
       
        Toastr::success('You are logged out.!', 'Success');        
        return redirect()->route('home');
    }

    public function forgotPassword(){
        return view(ViewPath::CUSTOMER_FORGOT_PASSWORD);
    }

    public function sendMail(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users,email'  
        ], [
            'email.exists' => 'This email is not registered with ' . $websiteSetting->name .'.'
        ]);

        // Generate a unique reset token
        $token = Str::random(600);

        // Store token in password_reset_tokens table (with expiry time of 5 minutes)
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email], 
            [
                'token' => Hash::make($token), 
                'created_at' => Carbon::now()
            ]
        );

        // Send email with the reset link
        $resetLink = url('/reset-password?token=' . $token . '&email=' . $request->email);
        Mail::send('email-templates.forgot-password', ['resetLink' => $resetLink], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Password Reset Request');
        });
        Toastr::success('A password reset link has been sent to your email!', 'Success');
        return back();
    }

    public function showResetForm(Request $request) {
        $tokenData = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();
    
        if (!$tokenData) {
            Toastr::error('Invalid or expired token!', 'error');
            return redirect('/forgot-password');
        }
    
        if (Carbon::parse($tokenData->created_at)->addMinutes(5)->isPast()) {
            Toastr::error('Token has expired. Please request a new one.', 'error');
            return redirect('/forgot-password')->with('error', 'Token has expired. Please request a new one.');
        }
    
        return view(ViewPath::CUSTOMER_RESET_PASSWORD_VIEW, ['email' => $request->email, 'token' => $request->token]);
    }
    
    public function resetPassword(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'token' => 'required',
            'password' => 'required|min:6|confirmed'
        ]);
        // Verify the token
        $tokenData = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();
        if (!$tokenData || !Hash::check($request->token, $tokenData->token)) {
            return redirect('/reset-password')->with('error', 'Invalid token.');
        }
        // Reset the password
        $user = User::where('email', $request->email)->update([
            'password' => Hash::make($request->password)
        ]);
    
        // Delete the reset token
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();
        Toastr::success('Your password has been reset successfully.', 'Success');
        return redirect('/login')->with('success', 'Your password has been reset successfully.');
    }
    
    
}
