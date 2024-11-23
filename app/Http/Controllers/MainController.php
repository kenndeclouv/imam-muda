<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class MainController extends Controller
{
    public function dashboard()
    {
        // Ambil role user
        $role = Auth::user()->Role->code;

        if ($role) {
            return redirect()->route("{$role}.home");
        }

        // Jika view tidak ditemukan, redirect atau beri pesan error
        abort(404, 'Dashboard untuk role ini tidak tersedia.');
    }
}
