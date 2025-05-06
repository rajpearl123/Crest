<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Models\Login as LoginModel;
use Illuminate\Support\Facades\Request;

class LogSuccessfulLogin
{
    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        LoginModel::create([
            'user_id' => $event->user->id,
            'ip_address' => Request::ip(),
            'device' => Request::header('User-Agent'), // Captures device/browser info
        ]);
    }
}
