<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Masjid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MasjidController extends Controller
{
    public function index()
    {
        $masjids = Masjid::all();
        return view('Admin.masjid.index', compact('masjids'));
    }

    public function create()
    {
        return view('Admin.masjid.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'address' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        Masjid::create($validated);

        return redirect()->route('admin.masjid.index')->with('success', 'Masjid berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $masjid = Masjid::findOrFail($id);
        return view('Admin.masjid.edit', compact('masjid'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'address' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $masjid = Masjid::findOrFail($id);
        $masjid->update($validated);

        return redirect()->route('admin.masjid.index', $masjid->id)->with('success', 'Masjid berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $masjid = Masjid::findOrFail($id);
        $masjid->delete();

        return redirect()->route('admin.masjid.index')->with('success', 'Masjid berhasil dihapus.');
    }
}
