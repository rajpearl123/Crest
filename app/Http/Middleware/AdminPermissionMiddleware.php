<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPermissionMiddleware
{
    public function handle(Request $request, Closure $next, $permission)
    {
        $admin = Auth::guard('admin')->user();

        if (!$admin || !$admin->hasPermission($permission)) {
            return redirect()->route('admin.dashboard')->with('error', 'Access Denied!');
        }

        return $next($request);
    }
}
