<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserNotificationController extends Controller
{
    public function getNotifications()
    {
        if (Auth::check()) {
            $userId = Auth::id();
            $newNotifications = UserNotification::where('user_id', $userId)
                ->where('is_displayed', 0)
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json($newNotifications);
        }
        return response()->json([]);
    }

    public function markNotificationAsRead(Request $request)
    {
        $notificationId = $request->input('notification_id');

        if (Auth::check() && $notificationId) {

            UserNotification::where('id', $notificationId)
                ->where('user_id', Auth::id())
                ->update(['is_displayed' => 1]);

            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'failed']);
    }
}
