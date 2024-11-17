<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Imam;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImamController extends Controller
{
    public function index()
    {
        $imams = Imam::all();
        return view('Admin.imam.index', compact('imams'));
    }

    public function create()
    {
        return view('Admin.imam.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:50',
            'email' => 'nullable|email|max:255',
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|same:password',
            'photo' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:5000',
        ]);

        $validatedImam = $request->validate([
            'fullname' => 'required|string|max:50',
            'phone' => 'required|string|max:20',
            'birthplace' => 'required|string|max:100',
            'birthdate' => 'required|date',
            'juz' => 'nullable|integer',
            'school' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
        ]);

        $validated['name'] = $validatedImam['fullname'];
        $validated['role_id'] = 3;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('user/photos', 'public');
            $validated['photo'] = $photoPath;
        }

        $user = User::create($validated);

        $validatedImam['user_id'] = $user->id;


        Imam::create($validatedImam);

        return redirect()->route('admin.imam.index')->with('success', 'Imam berhasil ditambahkan.');
    }


    public function show($id)
    {
        $imam = Imam::findOrFail($id);
        return view('Admin.imam.show', compact('imam'));
    }

    public function edit($id)
    {
        $imam = Imam::findOrFail($id);
        return view('Admin.imam.edit', compact('imam'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:50',
            'email' => 'nullable|email|max:255',
            'password' => 'nullable|string|min:8',
            'confirm_password' => 'nullable|same:password',
            'photo' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:5000',
        ]);

        $validatedImam = $request->validate([
            'fullname' => 'required|string|max:50',
            'phone' => 'required|string|max:20',
            'birthplace' => 'required|string|max:100',
            'birthdate' => 'required|date',
            'juz' => 'nullable|integer',
            'school' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
        ]);

        $imam = Imam::findOrFail($id);
        $imam->user->update($validated);
        $validatedImam['user_id'] = $imam->user_id;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photo/imam/', 'public');
            $validatedImam['photo'] = $photoPath;
        }

        $imam->update($validatedImam);

        return redirect()->route('admin.imam.index', $imam->id)->with('success', 'Imam berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $imam = Imam::findOrFail($id);
        $user = $imam->User; // Get the associated user
        $imam->delete();

        if ($user) {
            $user->delete(); // Delete the user as well
        }

        return redirect()->route('admin.imam.index')->with('success', 'Imam berhasil dihapus.');
    }
}
