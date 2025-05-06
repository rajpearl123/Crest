<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    public function handle(Request $request, Closure $next, $permission)
    {
        // Get the logged-in admin user
        $admin = Auth::guard('admin')->user();

        // Ensure the admin is logged in
        if (!$admin) {
            abort(403, 'Unauthorized Access');
        }

        // If user is super admin, allow all access
        if ($admin->isSuperAdmin()) {
            return $next($request);
        }

        // Check if the staff has permission
        if (!$admin->hasPermission($permission)) {
            abort(403, 'Unauthorized Access');
        }

        return $next($request);
    }
}


