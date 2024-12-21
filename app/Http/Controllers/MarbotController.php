<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Imam;
use App\Models\Marbot;
use App\Models\Masjid;
use Illuminate\Http\Request;

class MarbotController extends Controller
{
    public function index()
    {
        $marbots = Marbot::all();
        return view('admin.marbot.index', compact('marbots'));
    }

    public function create()
    {
        $imams = Imam::doesntHave('Marbot')->get();
        $masjids = Masjid::all();
        return view('admin.marbot.create', compact('imams', 'masjids'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'imam_id' => 'required|exists:imams,id',
            'masjid_id' => 'required|exists:masjids,id',
            'bayaran_pokok' => 'required|integer'
        ]);

        Marbot::create($validated);

        return redirect()->route('admin.marbot.index')->with('success', 'Marbot berhasil ditambahkan.');
    }

    public function edit(Marbot $marbot)
    {
        $imams = Imam::whereDoesntHave('Marbot')
            ->orWhere('id', $marbot->imam_id)
            ->get();

        $masjids = Masjid::all();
        return view('admin.marbot.edit', compact('marbot', 'imams', 'masjids'));
    }

    public function update(Request $request, Marbot $marbot)
    {
        $validated = $request->validate([
            'imam_id' => 'required|exists:imams,id',
            'masjid_id' => 'required|exists:masjids,id',
            'bayaran_pokok' => 'required|integer'
        ]);

        $marbot->update($validated);

        return redirect()->route('admin.marbot.index', $marbot->id)->with('success', 'Marbot berhasil diperbarui.');
    }

    public function destroy(Marbot $marbot)
    {
        $marbot->delete();
        return redirect()->route('admin.marbot.index')->with('success', 'Marbot berhasil dihapus.');
    }
}
