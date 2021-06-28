<?php

namespace App\Listeners;

use App\Notifications\NewPostNotification;
use Illuminate\Support\Facades\Notification;

use App\Models\User;

class SendNewPostNotification
{
    public function handle($event)
    {
        $admins = User::whereHas('roles', function ($query) {
            $query->where('id', 1);
        })->get();

        Notification::send($admins, new NewPostNotification($event));
    }
}
