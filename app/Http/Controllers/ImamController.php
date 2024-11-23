<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreImamRequest;
use App\Models\Imam;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImamController extends Controller
{
    private function uploadPhoto($photo)
    {
        return $photo->store('imam', 'public');
    }

    public function index()
    {
        $imams = Imam::all();
        return view('admin.imam.index', compact('imams'));
    }

    public function create()
    {
        return view('admin.imam.create');
    }

    public function store(StoreImamRequest $request)
    {
        $validated = $request->validated();

        $validated['photo'] = $request->hasFile('photo')
            ? $this->uploadPhoto($request->file('photo'))
            : null;

        // Simpan user
        $user = User::create([
            'username' => $validated['username'],
            'email' => $validated['email'] ?? null,
            'password' => $validated['password'],
            'photo' => $validated['photo'],
            'name' => $validated['fullname'],
            'role_id' => 3,
        ]);

        // Simpan admin
        Imam::create([
            'user_id' => $user->id,
            'fullname' => $validated['fullname'],
            'phone' => $validated['phone'],
            'birthplace' => $validated['birthplace'],
            'birthdate' => $validated['birthdate'],
            'juz' => $validated['juz'],
            'school' => $validated['school'],
            'description' => $validated['description'] ?? null,
            'address' => $validated['address'] ?? null,
        ]);

        return redirect()->route('admin.imam.index')->with('success', 'Imam berhasil ditambahkan.');
    }


    public function show(Imam $imam)
    {
        return view('admin.imam.show', compact('imam'));
    }

    public function edit(Imam $imam)
    {
        return view('admin.imam.edit', compact('imam'));
    }

    public function update(StoreImamRequest $request, Imam $imam)
    {
        $user = User::findOrFail($imam->user_id);
        $validated = $request->validated();

        // Proses upload foto (kalau ada)
        $validated['photo'] = $request->hasFile('photo')
            ? $this->uploadPhoto($request->file('photo'))
            : null;

        // Simpan user
        $user->update([
            'username' => $validated['username'],
            'email' => $validated['email'] ?? null,
            'photo' => $validated['photo'],
            'name' => $validated['fullname'],
        ]);

        // Simpan admin
        $imam->update([
            'fullname' => $validated['fullname'],
            'phone' => $validated['phone'],
            'birthplace' => $validated['birthplace'],
            'birthdate' => $validated['birthdate'],
            'juz' => $validated['juz'],
            'school' => $validated['school'],
            'description' => $validated['description'] ?? null,
            'address' => $validated['address'] ?? null,
        ]);
        return redirect()->route('admin.imam.index', $imam->id)->with('success', 'Imam berhasil diperbarui.');
    }

    public function destroy(Imam $imam)
    {
        $user = $imam->User; // Get the associated user
        $imam->delete();
        if ($user) {
            $user->delete(); // Delete the user as well
        }
        return redirect()->route('admin.imam.index')->with('success', 'Imam berhasil dihapus.');
    }
}
