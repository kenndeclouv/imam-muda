<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Fee;
use App\Models\Imam;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    public function index()
    {
        $fees = Fee::all();
        return view('admin.bayaran.index', compact('fees'));
    }
    public function create()
    {
        $imams = Imam::where('is_active', true)->get();
        return view('admin.bayaran.create', compact('imams'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required|in:imam,shalat,masjid',
            'amount' => 'required|numeric',
        ]);
        Fee::create($request->all());
        return redirect()->route('admin.bayaran.index')->with('success', 'Bayaran berhasil dibuat.');
    }
    public function edit(Fee $fee)
    {
        return view('admin.bayaran.edit', compact('fee'));
    }
    public function update(Request $request, Fee $fee)
    {
        $request->validate([
            'name' => 'required',
            'amount' => 'required|numeric',
        ]);

        $fee->update($request->all());
        return redirect()->route('admin.bayaran.index')->with('success', 'Bayaran berhasil diupdate.');
    }
    public function destroy(Fee $fee)
    {
        $fee->delete();
        return redirect()->route('admin.bayaran.index')->with('success', 'Bayaran berhasil dihapus.');
    }
    public function bayaranTambahanIndex()
    {
        $bayaranTambahan = Imam::whereNotNull('bayaran_tambahan')->get();
        return view('admin.bayarantambahan.index', compact('bayaranTambahan'));
    }

    public function bayaranTambahanCreate()
    {
        $imams = Imam::whereNull('bayaran_tambahan')->get();
        return view('admin.bayarantambahan.create', compact('imams'));
    }

    public function bayaranTambahanStore(Request $request)
    {
        $validated = $request->validate([
            'imam_id' => 'required|exists:imams,id',
            'bayaran_tambahan' => 'required|integer'
        ]);
        $imam = Imam::findOrFail($validated['imam_id']);
        $imam->update(['bayaran_tambahan' => $validated['bayaran_tambahan']]);
        return redirect()->route('admin.bayarantambahan.index')->with('success', 'Bayaran Tambahan berhasil dibuat.');
    }

    public function bayaranTambahanEdit(Imam $imam)
    {
        $imams = Imam::whereNull('bayaran_tambahan')
            ->orWhere('id', '=', $imam->id)
            ->get();
        $bayaranTambahan = $imam;
        return view('admin.bayarantambahan.edit', compact('imams', 'bayaranTambahan'));
    }

    public function bayaranTambahanUpdate(Request $request, Imam $imam)
    {
        $validated = $request->validate([
            'bayaran_tambahan' => 'required|integer'
        ]);
        $imam->update(['bayaran_tambahan' => $validated['bayaran_tambahan']]);
        return redirect()->route('admin.bayarantambahan.index')->with('success', 'Bayaran Tambahan berhasil diupdate.');
    }

    public function bayaranTambahanDestroy(Imam $imam)
    {
        $imam->update(['bayaran_tambahan' => null]);
        return redirect()->route('admin.bayarantambahan.index')->with('success', 'Bayaran Tambahan berhasil dihapus.');
    }
}
