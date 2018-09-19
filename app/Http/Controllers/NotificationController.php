<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getUserNotifications(Request $request)
    {
        return view('notifications.notifications');
    }

    public function markNotificationAsRead(Request $request, $id)
    {
        // Set the notification as read
        Auth::user()->unreadNotifications->where('id', $id)->markAsRead();
        return response()->json(['status'=>'Success']);
    }
}
