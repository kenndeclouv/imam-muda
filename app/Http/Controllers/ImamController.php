<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreImamRequest;
use App\Http\Requests\UpdateImamRequest;
use App\Models\Imam;
use App\Models\Schedule;
use App\Models\User;
class ImamController extends Controller
{
    public function index()
    {
        $imams = Imam::where('is_active', true)->get();
        return view('admin.imam.index', compact('imams'));
    }
    public function create()
    {
        return view('admin.imam.create');
    }
    public function store(StoreImamRequest $request)
    {
        $validated = $request->validated();
        $user = User::create([
            'username' => $validated['username'],
            'email' => $validated['email'] ?? null,
            'password' => $validated['password'],
            'name' => $validated['fullname'],
            'role_id' => 3,
        ]);
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
            'join_date' => $validated['join_date'],
            'no_rekening' => $validated['no_rekening'],
            'status' => $validated['status'],
            'child_count' => $validated['child_count'],
            'wife_count' => $validated['wife_count'],
            'is_active' => true,
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
    public function update(UpdateImamRequest $request, Imam $imam)
    {
        $user = User::findOrFail($imam->user_id);
        $validated = $request->validated();
        $user->update([
            'username' => $validated['username'],
            'email' => $validated['email'] ?? null,
            'name' => $validated['fullname'],
        ]);
        $imam->update([
            'fullname' => $validated['fullname'],
            'phone' => $validated['phone'],
            'birthplace' => $validated['birthplace'],
            'birthdate' => $validated['birthdate'],
            'juz' => $validated['juz'],
            'school' => $validated['school'],
            'description' => $validated['description'] ?? null,
            'address' => $validated['address'] ?? null,
            'join_date' => $validated['join_date'],
            'no_rekening' => $validated['no_rekening'],
            'status' => $validated['status'],
            'child_count' => $validated['child_count'],
            'wife_count' => $validated['wife_count'],
        ]);
        return redirect()->route('admin.imam.index', $imam->id)->with('success', 'Imam berhasil diperbarui.');
    }
    public function destroy(Imam $imam)
    {
        $imam->User->delete();
        return redirect()->route('admin.imam.index')->with('success', 'Imam berhasil dihapus.');
    }
    public function detail(Imam $imam)
    {
        $user = $imam->User;
        $schedules = Schedule::where('imam_id', $imam->id)->get();
        return view('admin.imam.detail', compact('imam', 'user', 'schedules'));
    }
    public function isActive()
    {
        $imams = Imam::where('is_active', false)->get();
        return view('admin.imam.is_active', compact('imams'));
    }
    public function isActiveUpdate(Imam $imam)
    {
        $imam->update(['is_active' => true]);
        return redirect()->route('admin.imam.is_active')->with('success', 'Imam berhasil diaktifkan.');
    }
    public function isActiveUpdateFalse(Imam $imam)
    {
        $imam->update(['is_active' => false]);
        return redirect()->route('admin.imam.index')->with('success', 'Imam berhasil dinonaktifkan.');
    }
}
