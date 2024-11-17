<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user === null) {
            abort(404);
        }

        switch (optional($user->Role)->code) {
            case 'admin':
                return redirect()->route('admin.home');
            case 'super_admin':
                return redirect()->route('superadmin.home');
            case 'imam':
                return redirect()->route('imam.home');
            default:
                abort(403, 'Role tidak dikenali.');
        }
    }
}
