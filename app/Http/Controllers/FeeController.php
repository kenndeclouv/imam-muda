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
        $imams = Imam::all();
        return view('admin.bayaran.create', compact('imams'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'imam_id' => 'required|array',
            'imam_id.*' => 'exists:imams,id',
            'fee' => 'required|numeric',
        ]);

        foreach ($request->imam_id as $imamId) {
            $imamExists = Fee::where('imam_id', $imamId)->exists();
            if ($imamExists) {
                return back()->withErrors(['error' => 'Bayaran Imam ini sudah ditetapkan']);
            }
            Fee::create(['imam_id' => $imamId, 'fee' => $request->fee]);
        }

        return redirect()->route('admin.bayaran.index')->with('success', 'Bayaran berhasil dibuat.');
    }

    public function edit($id)
    {
        $fee = Fee::findOrFail($id);
        return view('admin.bayaran.edit', compact('fee'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fee' => 'required|numeric',
        ]);

        $fee = Fee::findOrFail($id);
        $fee->update($request->all());
        return redirect()->route('admin.bayaran.index')->with('success', 'Bayaran berhasil diupdate.');
    }

    public function destroy($id)
    {
        $fee = Fee::findOrFail($id);
        $fee->delete();
        return redirect()->route('admin.bayaran.index')->with('success', 'Bayaran berhasil dihapus.');
    }
}
