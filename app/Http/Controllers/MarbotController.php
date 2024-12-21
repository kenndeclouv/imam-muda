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
            'bayaran' => 'required|integer',
            'type' => 'required|in:1,2,3',
            'masjid_id' => 'required_if:type,1,2',
        ], [
            'imam_id.required' => 'Imam harus dipilih.',
            'imam_id.exists' => 'Imam yang dipilih tidak valid.',
            'bayaran.required' => 'Bayaran harus diisi.',
            'bayaran.integer' => 'Bayaran harus berupa angka.',
            'type.required' => 'Tipe harus dipilih.',
            'type.in' => 'Tipe yang dipilih tidak valid.',
            'masjid_id.required_if' => 'Masjid harus dipilih jika tipe adalah 1 atau 2.',
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
            'bayaran' => 'required|integer',
            'type' => 'required|in:1,2,3',
            'masjid_id' => 'required_if:type,1,2',
        ], [
            'imam_id.required' => 'Imam harus dipilih.',
            'imam_id.exists' => 'Imam yang dipilih tidak valid.',
            'bayaran.required' => 'Bayaran harus diisi.',
            'bayaran.integer' => 'Bayaran harus berupa angka.',
            'type.required' => 'Tipe harus dipilih.',
            'type.in' => 'Tipe yang dipilih tidak valid.',
            'masjid_id.required_if' => 'Masjid harus dipilih jika tipe adalah 1 atau 2.',
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
