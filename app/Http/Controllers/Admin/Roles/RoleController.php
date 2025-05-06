<?php

namespace App\Http\Controllers\Admin\Roles;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Utils\ViewPath;
use App\Models\Role;
use App\Models\Permission;
use App\Models\RolePermission;

class RoleController extends Controller
{
    public function roles()
    {
        $roles = Role::paginate(20);
        return view(ViewPath::ADMIN_ROLES, compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        Role::create([
            'name' => $request->name,
        ]);
        Toastr::success('Role created successfully!', 'Success');
        return redirect()->back();
    }  
    public function status(Request $request, $id){
        $role = Role::find($id);
        $role->status = $request->active;
        $role->save();
        Toastr::success('Status updated successfully!', 'Success');
        return redirect()->back();
    } 
    public function update(Request $reqeust, $id){
        $role = Role::find($id);
        $role->name = $reqeust->name;
        $role->save();
        Toastr::success('Role updated successfully!', 'Success');
        return redirect()->back();
    }

    public function permissionAssignment(){
        $roles = Role::all();
        $permissions = Permission::all();
        
        $assigned_permissions = Role::with('permissions')->paginate(20);        
       return view(ViewPath::ADMIN_PERMISSION_ASSIGNMENT, compact('roles', 'permissions','assigned_permissions'));
    }    

    public function assign(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permission_id' => 'required|array',
            'permission_id.*' => 'exists:permissions,id', // Ensure each permission exists
        ]);

        $role = Role::find($request->role_id);

        if (!$role) {
            Toastr::error('Role not found!', 'Error');
            return redirect()->back();
        }

        // If using a many-to-many relationship, sync permissions
        $role->permissions()->sync($request->permission_id);

        Toastr::success('Permissions assigned successfully!', 'Success');
        return redirect()->back();
    }

    
    
}
