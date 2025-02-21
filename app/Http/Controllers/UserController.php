<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('superadmin.user.index', compact('users'));
    }

    public function resetPassword(User $user)
    {
        $user->password = 'password';
        $user->save();
        return redirect()->route('superadmin.user.index')->with('success', 'Password berhasil direset.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('superadmin.user.index')->with('success', 'User berhasil dihapus.');
    }
}
