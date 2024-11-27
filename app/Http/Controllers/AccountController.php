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
    private function uploadPhoto($photo)
    {
        if ($photo && file_exists(public_path($photo))) {
            unlink(public_path($photo));
        }
        $filename = uniqid() . '_' . time() . '.' . $photo->getClientOriginalExtension();
        $photo->move(public_path('public/uploads/photo/'), $filename);
        return 'public/uploads/photo/' . $filename;
    }

    public function index()
    {
        return view('account.index');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'photo' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:5000',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user = User::findOrFail($id);

        if ($request->hasFile('photo')) {
            if ($user->photo && file_exists(public_path($user->photo))) {
                unlink(public_path($user->photo));
            }
            $validated['photo'] = $this->uploadPhoto($request->file('photo'));
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
