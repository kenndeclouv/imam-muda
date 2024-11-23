<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::all();
        return view('admin.pengumuman.index', compact('announcements'));
    }

    public function create()
    {
        $targets = Role::where('code', '!=', 'super_admin')->get();
        return view('admin.pengumuman.create', compact('targets'));
    }

    public function store(Request $request)
    {
        // validasi input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'target_id' => 'required|array',
            'target_id.*' => 'required|exists:roles,id',
            'date' => 'required|date',
            'is_active' => 'required|boolean',
            'link' => 'nullable|string|max:255',
            'photo' => 'nullable|max:5000|file|mimes:jpg,jpeg,png,svg,webp,jpeg,gif',
        ]);

        // handle upload foto kalau ada
        if ($request->hasFile('photo')) {
            $filename = uniqid() . '_' . time() . '.' . $request->file('photo')->getClientOriginalExtension();
            $path = $request->file('photo')->storeAs('uploads/pengumuman', $filename, 'public');
            $validated['photo'] = 'public/' . $path;
        }

        // buat array pengumuman untuk setiap target_id
        $announcements = collect($validated['target_id'])->map(function ($targetId) use ($validated) {
            return [
                'title' => $validated['title'],
                'content' => $validated['content'],
                'target_id' => $targetId,
                'date' => $validated['date'],
                'is_active' => $validated['is_active'],
                'link' => $validated['link'] ?? null,
                'photo' => $validated['photo'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        });

        // simpan semua data ke database
        Announcement::insert($announcements->toArray());

        return redirect()
            ->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $announcement = Announcement::find($id);
        return view('admin.pengumuman.edit', compact('announcement'));
    }

    public function update(Request $request, $id)
    {
        $announcement = Announcement::find($id);
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'date' => 'required',
            'is_active' => 'required',
            'link' => 'nullable',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ]);
        // handle upload foto kalau ada
        if ($request->hasFile('photo')) {
            $filename = uniqid() . '_' . time() . '.' . $request->file('photo')->getClientOriginalExtension();
            $oldPhoto = $announcement->photo;
            $path = $request->file('photo')->storeAs('uploads/pengumuman', $filename, 'public');
            $validated['photo'] = 'public/' . $path;
            if ($oldPhoto) {
                Storage::delete($oldPhoto);
            }
        }

        $announcement->update($validated);
        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil diubah');
    }

    public function destroy($id)
    {
        $announcement = Announcement::find($id);
        $announcement->delete();
        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil dihapus');
    }
}
