<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Imam;
use App\Models\User;
use App\Models\UserShortcut;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

// use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        return view('account.index');
    }
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'photo' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:5000',
        ]);
        if ($request->input('password')) {
            $validated = $request->validate([
                'password' => 'nullable|string|min:8',
                'confirm_password' => 'nullable|same:password',
            ]);
        }

        // Update the authenticated user's information
        $user = User::findOrFail($id);

        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($user->photo && file_exists(public_path($user->photo))) {
                unlink(public_path($user->photo));
            }
            // Generate nama unik untuk file
            $filename = uniqid() . '_' . time() . '.' . $request->file('photo')->getClientOriginalExtension();

            // Pindahkan file ke folder
            $photoPath = $request->file('photo')->move(public_path('public/uploads/photo/'), $filename);
            $validated['photo'] = 'public/uploads/photo/' . $filename;
        }

        $user->update($validated);

        // Redirect back with a success message
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
        $validated['user_id'] = Auth::user()->id;

        UserShortcut::create($validated);

        // Lakukan penyimpanan data di sini...
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
        ]);

        $imam = Imam::where('user_id', Auth::id())->firstOrFail();

        $imam->update($validated);

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

        $admin = Admin::where('user_id', Auth::id())->firstOrFail();

        $admin->update($validated);

        return redirect()->route('account')->with('success', 'Admin berhasil diperbarui.');
    }
}
