<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\Replies;
use App\Utils\ViewPath;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class DashboardController extends Controller
{
    public function index()
    {
        return view(ViewPath::USER_DASHBOARD);
    }
    public function updateProfileImage(Request $request){
        $user = Auth::user();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/images/user'), $filename);
            $user->image = $filename;
            $user->save();
            return response()->json(['status' => 'success', 'message' => 'Profile updated successfully!', 'image' => $filename]);
        }
        return response()->json(['status' => 'error', 'message' => 'No image uploaded.']);
    }

    public function updateProfileDetails(Request $request){
        $user = Auth::user();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:15',
            'password' => 'nullable|min:6',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();
        Toastr::success('Profile updated successfully!');
        return back();
    }

    public function contactMessages(){
        $user = Auth::user();
        $messages = ContactUs::where('email', $user->email)->get();
        return view(ViewPath::CONTACT_MESSAGES, compact('messages'));
    }

    public function replies($id){
        $user = Auth::user();

        $contact = ContactUs::where('id', $id)->first();
        $messages = Replies::where('user_email', $user->email)->where('contact_id', $contact->id)->where('is_admin', 0)->get();
        $adminMessages = Replies::where('user_email', $user->email)->where('contact_id', $contact->id)->where('is_admin', 1)->get();
        return view(ViewPath::CONTACT_REPLIES, compact('contact','messages', 'adminMessages'));
    }

    public function sendReply(Request $request, $id){
        $user = Auth::user();

        $reply = Replies::create([
            'message' => $request->message,
            'is_admin' => 0,
            'is_User' => $user->id,
            'contact_id' => $id,
            'user_email' => $request->user_email,
        ]);

        return back();
    }
}
