<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MainController;
use App\Http\Requests\StoreImamRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        // Jika user sudah login, arahkan berdasarkan role-nya
        if (Auth::check()) {
            return app(MainController::class)->dashboard();
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        $remember = $request->has('remember');

        // Cari user berdasarkan username
        $user = User::where('username', $credentials['username'])->first();

        // Validasi apakah user aktif
        if ($user && !$user->is_active) {
            return back()->withErrors([
                'error' => 'Akun Anda tidak aktif. Silakan hubungi admin.',
            ])->withInput($request->except('password'));
        }

        // Lanjutkan login jika user aktif
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return app(MainController::class)->dashboard();
        }

        return back()->withErrors([
            'username' => 'Username atau password tidak sesuai.',
        ])->withInput($request->except('password'));
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('status', 'Logout berhasil.');
    }
}
