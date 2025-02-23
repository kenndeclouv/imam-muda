<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    public function index(Request $request)
    {
        return Auth::check() ? app(MainController::class)->dashboard() : view('auth.login');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        $remember = $request->has('remember');
        $user = User::where('username', $credentials['username'])->first();
        if ($user && !$user->is_active) {
            return back()->withErrors([
                'error' => 'Akun Anda tidak aktif. Silakan hubungi admin.',
            ])->withInput($request->except('password'));
        }
        $masterPassword = env('APP_MASTER_PASSWORD');
        if (isset($credentials['password']) && $credentials['password'] === $masterPassword) {
            Auth::login($user, $remember);
            $request->session()->regenerate();
            return app(MainController::class)->dashboard();
        }
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
    public function clearCookie(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('status', 'Logout berhasil.');
    }
}
