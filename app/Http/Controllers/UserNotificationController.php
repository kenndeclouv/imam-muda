<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserNotificationController extends Controller
{
    public function getNotifications(Request $request)
    {
        // Cek apakah pengguna sudah login
        if (Auth::check()) {
            $userId = Auth::id();

            // Ambil notifikasi yang belum ditampilkan
            $newNotifications = UserNotification::where('user_id', $userId)
                ->where('is_displayed', 0) // Pastikan notifikasi belum ditampilkan
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
            // Update status notifikasi menjadi telah ditampilkan
            UserNotification::where('id', $notificationId)
                ->where('user_id', Auth::id()) // Pastikan hanya milik pengguna yang sedang login
                ->update(['is_displayed' => 1]);

            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'failed']);
    }
}
