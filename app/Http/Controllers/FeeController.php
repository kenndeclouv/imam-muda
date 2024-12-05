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
}
