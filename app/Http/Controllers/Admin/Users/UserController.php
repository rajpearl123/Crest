<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Booking;
use App\Models\Transaction;
use App\Utils\ViewPath;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function list(){
        $users = User::paginate(20);
        return view(ViewPath::ADMIN_USERS_LIST, compact('users'));
    } 
}