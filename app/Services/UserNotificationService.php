<?php

namespace App\Services;

use Illuminate\Http\Request;
use Auth;

class UserNotificationService
{
    public function __construct()
    {
        $this->user = auth()->user();
    }

    public function getUnReadNotifications()
    {
        $userNotifications = $this->user->unreadNotifications;
        return $userNotifications;
    }

    public function getNotifications()
    {
        $userNotifications = $this->user->notifications;
        return $userNotifications;
    }
}