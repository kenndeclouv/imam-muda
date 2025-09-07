<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TakmirRequest;
use App\Http\Requests\UserRequest;
use App\Models\Masjid;
use App\Models\Takmir;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class MasjidController extends Controller
{
    public function index()
    {
        $masjids = Masjid::all();
        return view('admin.masjid.index', compact('masjids'));
    }
    public function create()
    {
        return view('admin.masjid.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'address' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        Masjid::create($validated);

        return redirect()->route('admin.masjid.index')->with('success', 'Masjid berhasil ditambahkan.');
    }
    public function edit(Masjid $masjid)
    {
        return view('admin.masjid.edit', compact('masjid'));
    }
    public function update(Request $request, Masjid $masjid)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'address' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);
        $masjid->update($validated);
        return redirect()->route('admin.masjid.index', $masjid->id)->with('success', 'Masjid berhasil diperbarui.');
    }
    public function destroy(Masjid $masjid)
    {
        $masjid->delete();
        return redirect()->route('admin.masjid.index')->with('success', 'Masjid berhasil dihapus.');
    }

    // create takmir
    public function indexTakmir(Masjid $masjid)
    {
        $takmirs = Takmir::where('masjid_id', $masjid->id)->get();
        return view('admin.masjid.takmir.index', compact('masjid', 'takmirs'));
    }
    public function createTakmir(Masjid $masjid)
    {
        return view('admin.masjid.takmir.create', compact('masjid'));
    }
    public function storeTakmir(UserRequest $userRequest, TakmirRequest $takmirRequest, Masjid $masjid)
    {
        $validated = $userRequest->validated();
        $validatedTakmir = $takmirRequest->validated();

        $user = User::create([
            'username' => $validated['username'],
            'email' => $validated['email'] ?? null,
            'password' => $validated['password'],
            'name' => $validated['name'],
            'role_id' => 6,
        ]);
        Takmir::create([
            'user_id' => $user->id,
            'masjid_id' => $masjid->id,
            'fullname' => $validatedTakmir['fullname'],
            'phone' => $validatedTakmir['phone'],
            'address' => $validatedTakmir['address'],
        ]);

        return redirect()->route('admin.masjid.takmir.index', $masjid->id)->with('success', 'Takmir berhasil ditambahkan.');
    }
    public function editTakmir(Masjid $masjid, Takmir $takmir)
    {
        return view('admin.masjid.takmir.edit', compact('masjid', 'takmir'));
    }
    public function updateTakmir(Request $request, Masjid $masjid, Takmir $takmir)
    {
        // Validate user fields
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $takmir->user_id,
            'email' => 'nullable|email|max:255|unique:users,email,' . $takmir->user_id,
            'name' => 'required|string|max:255',
        ]);

        // Validate takmir fields
        $validatedTakmir = $request->validate([
            'fullname' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ]);

        $user = User::findOrFail($takmir->user_id);
        $user->update([
            'username' => $validated['username'],
            'email' => $validated['email'] ?? null,
            'name' => $validated['name'],
        ]);
        $takmir->update([
            'fullname' => $validatedTakmir['fullname'],
            'phone' => $validatedTakmir['phone'],
            'address' => $validatedTakmir['address'],
        ]);
        return redirect()->route('admin.masjid.takmir.index', $masjid->id)->with('success', 'Takmir berhasil diperbarui.');
    }
    public function destroyTakmir(Masjid $masjid, Takmir $takmir)
    {
        $takmir->delete();
        return redirect()->route('admin.masjid.takmir.index', $masjid->id)->with('success', 'Takmir berhasil dihapus.');
    }
}
