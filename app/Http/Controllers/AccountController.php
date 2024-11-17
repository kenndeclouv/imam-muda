<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserShortcut;
use Auth;
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
            $photoPath = $request->file('photo')->store('photo/imam/', 'public');
            $validated['photo'] = $photoPath;
        }

        $user->update($validated);

        // Redirect back with a success message
        return redirect()->route('account')->with('success', 'Profile updated successfully!');
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
}
