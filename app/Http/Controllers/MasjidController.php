<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Masjid;
use Illuminate\Http\Request;
class MasjidController extends Controller
{
    public function index()
    {
        $masjids = Masjid::all();
        return view('admin.masjid.index', compact('masjids'));
    }
    public function create()
    {
        return view('admin.masjid.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'address' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        Masjid::create($validated);

        return redirect()->route('admin.masjid.index')->with('success', 'Masjid berhasil ditambahkan.');
    }
    public function edit(Masjid $masjid)
    {
        return view('admin.masjid.edit', compact('masjid'));
    }
    public function update(Request $request, Masjid $masjid)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'address' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);
        $masjid->update($validated);
        return redirect()->route('admin.masjid.index', $masjid->id)->with('success', 'Masjid berhasil diperbarui.');
    }
    public function destroy(Masjid $masjid)
    {
        $masjid->delete();
        return redirect()->route('admin.masjid.index')->with('success', 'Masjid berhasil dihapus.');
    }
}
