<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Admins;
use App\Models\Role;
use App\Utils\ViewPath;
use App\Http\Requests\StaffRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\StaffAddMail;

class StaffController extends Controller
{
    public function staff(){
        $staffs = Admins::where('role_id', '!=', 0)->paginate(20);
        $roles = Role::all();
        return view(ViewPath::ADMIN_STAFF, compact('staffs', 'roles'));
    }
    public function addStaff(StaffRequest $request){
        $member = $request->validated();
        // dd($member);
        $member['password'] = Hash::make($request->password);
        unset($member['confirm_password']);
        Admins::create($member);
        Mail::to($request->email)->send(new StaffAddMail($request->name, $request->email, $request->password));
        Toastr::success('Staff Member added successfully');
        return redirect()->back();
    }
    public function status(Request $request, $id){

        $staff = Admins::find($id);
        $staff->status = $request->active;
        $staff->save();
        Toastr::success('Staff status updated successfully');
        return redirect()->back();
    }
    public function update(Request $request, $id){
        $staff = Admins::find($id);
        $staff->name = $request->name;
        $staff->email = $request->email;
        $staff->phone = $request->phone;
        $staff->role_id = $request->role_id;
        $staff->save();
        return redirect()->back()->with('success', 'Staff updated successfully');
    }
}
