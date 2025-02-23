<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Musyrif;

class MusyrifController extends Controller
{
    public function index()
    {
        return view('admin.musyrif.index', ['musyrifs' => Musyrif::all()]);
    }
    public function create()
    {
        return view('admin.musyrif.create');
    }
    public function store(StoreAdminRequest $request)
    {
        $validated = $request->validated();
        $user = User::create([
            'username' => $validated['username'],
            'email' => $validated['email'] ?? null,
            'password' => $validated['password'],
            'name' => $validated['fullname'],
            'role_id' => 5,
        ]);
        Musyrif::create([
            'user_id' => $user->id,
            'fullname' => $validated['fullname'],
            'phone' => $validated['phone'],
            'birthplace' => $validated['birthplace'],
            'birthdate' => $validated['birthdate'],
            'description' => $validated['description'] ?? null,
            'address' => $validated['address'] ?? null,
        ]);
        return redirect()->route('admin.musyrif.index')->with('success', 'Musyrif berhasil ditambahkan.');
    }
    public function edit(Musyrif $musyrif)
    {
        return view('admin.musyrif.edit', compact('musyrif'));
    }
    public function update(UpdateAdminRequest $request, Musyrif $musyrif)
    {
        $user = User::findOrFail($musyrif->user_id);
        $validated = $request->validated();
        $user->update([
            'username' => $validated['username'],
            'email' => $validated['email'] ?? null,
            'name' => $validated['fullname'],
        ]);
        $musyrif->update([
            'fullname' => $validated['fullname'],
            'phone' => $validated['phone'],
            'birthplace' => $validated['birthplace'],
            'birthdate' => $validated['birthdate'],
            'description' => $validated['description'] ?? null,
            'address' => $validated['address'] ?? null,
        ]);
        return redirect()->route('admin.musyrif.index')->with('success', 'Musyrif berhasil diperbarui.');
    }
    public function destroy(Musyrif $musyrif)
    {
        $musyrif->delete();
        return redirect()->route('admin.musyrif.index')->with('success', 'Musyrif berhasil dihapus.');
    }
}
