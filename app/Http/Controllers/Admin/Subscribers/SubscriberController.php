<?php

namespace App\Http\Controllers\Admin\Subscribers;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Utils\ViewPath;

class SubscriberController extends Controller
{
    public function subscribers(){
        $subscribers = Subscriber::paginate(10);
        return view(ViewPath::ADMIN_SUBSCRIBERS, compact('subscribers'));
    }
}
