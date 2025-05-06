<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Utils\ViewPath;
use App\Models\WebsiteSetting;

class LoginController extends Controller
{
    public function loginView(){
        return view(ViewPath::ADMIN_LOGIN);
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
       $websiteSetting = WebsiteSetting::first();

        $credentials = $request->only('email', 'password');
    
        if (auth()->guard('admin')->attempt($credentials)) {
            $admin = auth()->guard('admin')->user();
    
            // If staff (role_id > 0), check status and role status
            if ($admin->role_id > 0) {
                if ($admin->status == 'inactive') {
                    auth()->guard('admin')->logout();
                    Toastr::warning('Your account is inactive. Contact the administrator.', 'Warning');
                    return back()->with('error', 'Your account is inactive.');
                }
    
                if ($admin->role && $admin->role->status == 'inactive') {
                    auth()->guard('admin')->logout();
                    Toastr::warning('Your role is inactive. Contact the administrator.', 'Warning');
                    return back()->with('error', 'Your role is inactive.');
                }
            }
    
            // Redirect based on role
            if ($admin->role_id == 0) { // Super Admin
                Toastr::success('Welcome Admin!', 'Success');
                return redirect()->route('admin.dashboard');
            } elseif ($admin->role_id > 0) { // Staff
                Toastr::success('Welcome Staff Member of ' . $websiteSetting->name .'!', 'Success');
                return redirect()->route('admin.dashboard');
            }
    
            auth()->guard('admin')->logout();
            Toastr::warning('Invalid Access!', 'Warning');
            return back()->with('error', 'Invalid access.');
        }
    
        Toastr::warning('Incorrect credentials.');
        return back()->with('error', 'Invalid credentials');
    }
    

    public function logout(Request $request){
        auth()->guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Toastr::success('You are logged out.!', 'Success');
        return redirect()->route('admin.login');
    }
}
