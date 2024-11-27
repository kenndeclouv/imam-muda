<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Role;
use App\Models\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AnnouncementController extends Controller
{
    private function sendNotification($userId, $title, $content, $link)
    {
        UserNotification::create([
            'user_id' => $userId,
            'title' => $title,
            'content' => $content,
            'link' => $link,
            'is_displayed' => false,
        ]);
    }
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
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'target_id' => 'required|array',
            'target_id.*' => 'required|exists:roles,id',
            'date' => 'required|date',
            'is_active' => 'required|boolean',
            'link' => 'nullable|string|max:255',
        ]);
        $announcements = collect($validated['target_id'])->map(function ($targetId) use ($validated) {
            return [
                'title' => $validated['title'],
                'content' => $validated['content'],
                'target_id' => $targetId,
                'date' => $validated['date'],
                'is_active' => $validated['is_active'],
                'link' => $validated['link'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        });
        $this->sendNotification($announcements->pluck('target_id'), $validated['title'], Str::limit($validated['content'], 50), $validated['link']);
        Announcement::insert($announcements->toArray());
        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function edit(Announcement $announcement)
    {
        return view('admin.pengumuman.edit', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'date' => 'required',
            'is_active' => 'required',
            'link' => 'nullable',
        ]);

        $announcement->update($validated);
        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil diubah');
    }

    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil dihapus');
    }
}
