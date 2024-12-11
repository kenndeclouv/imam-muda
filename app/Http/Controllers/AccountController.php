<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Imam;
use App\Models\User;
use App\Models\UserShortcut;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        return view('account.index');
    }
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'photo' => 'nullable',
        ], [
            'name.required' => 'Nama harus diisi',
            'username.required' => 'Username harus diisi',
            'username.unique' => 'Username sudah ada',
            'email.required' => 'Email harus diisi',
            'email.unique' => 'Email sudah ada',
        ]);
        if ($request->password) {
            $request->validate(['password' => 'required|string|min:8|confirmed|regex:/^(?=.*[A-Z]).+$/'], [
                'password.required' => 'Password harus diisi',
                'password.min' => 'Password minimal 8 karakter',
                'password.confirmed' => 'Password tidak cocok',
                'password.regex' => 'Password harus mengandung setidaknya satu huruf besar',
            ]);
            $validated['password'] = $request->password;
        }
        if ($request->photo) {
            if (preg_match('/^data:image\/(\w+);base64,/', $request->photo)) {
                $validated['photo'] = $request->photo;
            } else {
                throw new \Exception('Invalid base64 image');
            }
        }
        $user->update($validated);
        return redirect()->route('account')->with('success', 'Profile berhasil diperbarui!');
    }
    public function storeShortcut(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'required|string',
            'icon' => 'nullable|string',
            'description' => 'nullable|string',
        ]);
        UserShortcut::create(array_merge($validated, ['user_id' => Auth::id()]));
        return back()->with('success', 'berhasil menambahkan shortcut');
    }
    public function updateImam(Request $request)
    {
        $validated = $request->validate([
            'fullname' => 'required|string|max:50',
            'phone' => 'required|string|max:20',
            'birthplace' => 'required|string|max:100',
            'birthdate' => 'required|date',
            'juz' => 'nullable|integer',
            'school' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'join_date' => 'nullable|date',
            'no_rekening' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
            'child_count' => 'nullable|integer',
            'wife_count' => 'nullable|integer',
        ]);
        Imam::where('user_id', Auth::id())->firstOrFail()->update($validated);
        return redirect()->route('account')->with('success', 'Imam berhasil diperbarui.');
    }
    public function updateAdmin(Request $request)
    {
        $validated = $request->validate([
            'fullname' => 'required|string|max:50',
            'phone' => 'required|string|max:20',
            'birthplace' => 'required|string|max:100',
            'birthdate' => 'required|date',
            'description' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
        ]);
        Admin::where('user_id', Auth::id())->firstOrFail()->update($validated);
        return redirect()->route('account')->with('success', 'Admin berhasil diperbarui.');
    }
}
