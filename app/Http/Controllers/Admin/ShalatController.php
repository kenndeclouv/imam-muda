<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shalat;
use Illuminate\Http\Request;

class ShalatController extends Controller
{
    public function index()
    {
        $shalats = Shalat::all();
        return view('Admin.shalat.index', compact('shalats'));
    }

    public function create()
    {
        return view('Admin.shalat.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'start' => 'required|date_format:H:i',
            'end' => 'required|date_format:H:i',
        ]);

        Shalat::create($validated);

        return redirect()->route('admin.shalat.index')->with('success', 'Shalat berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $shalat = Shalat::findOrFail($id);
        return view('Admin.shalat.edit', compact('shalat'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'start' => 'required|date_format:H:i',
            'end' => 'required|date_format:H:i',
        ]);

        $shalat = Shalat::findOrFail($id);
        $shalat->update($validated);

        return redirect()->route('admin.shalat.index')->with('success', 'Shalat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $shalat = Shalat::findOrFail($id);
        $shalat->delete();

        return redirect()->route('admin.shalat.index')->with('success', 'Shalat berhasil dihapus.');
    }
}
