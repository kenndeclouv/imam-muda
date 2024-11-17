<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Imam;
use App\Models\Masjid;
use App\Models\Schedule;
use App\Models\Shalat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $monthYear = $request->input('month');
        if (!$monthYear || !preg_match('/^\d{4}-\d{2}$/', $monthYear)) {
            $monthYear = Carbon::now()->format('Y-m'); // Default ke bulan dan tahun sekarang jika input tidak valid
        }

        [$year, $month] = explode('-', $monthYear);

        $jadwals = Schedule::query()
            ->when($request->filled('filter_imam'), function ($query) use ($request) {
                $query->where('imam_id', $request->input('filter_imam'));
            })
            ->when($request->filled('filter_shalat'), function ($query) use ($request) {
                $query->where('shalat_id', $request->input('filter_shalat'));
            })
            ->when($request->filled('filter_masjid'), function ($query) use ($request) {
                $query->where('masjid_id', $request->input('filter_masjid'));
            })
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->get();

        $imams = Imam::all();
        $masjids = Masjid::all();
        $shalats = Shalat::all();

        return view('Admin.jadwal.index', compact('jadwals', 'imams', 'masjids', 'shalats'));
    }


    public function create()
    {
        $imams = Imam::all();
        $masjids = Masjid::all();
        $shalats = Shalat::all();
        return view('Admin.jadwal.create', compact('imams', 'masjids', 'shalats'));
    }

    public function fetch(Request $request)
    {
        $events = Schedule::with(['imam', 'masjid', 'shalat'])
            ->when($request->filled('filter_imam'), function ($query) use ($request) {
                $query->where('imam_id', $request->input('filter_imam'));
            })
            ->when($request->filled('filter_shalat'), function ($query) use ($request) {
                $query->where('shalat_id', $request->input('filter_shalat'));
            })
            ->when($request->filled('filter_masjid'), function ($query) use ($request) {
                $query->where('masjid_id', $request->input('filter_masjid'));
            })
            ->get()
            ->map(function ($schedule) {
                return [
                    'id' => $schedule->id,
                    'title' => $schedule->shalat->name . ' - ' . $schedule->Imam->fullname, // Sesuaikan dengan relasi
                    'start' => $schedule->date,
                    'masjid_id' => $schedule->masjid_id,
                    'shalat_id' => $schedule->shalat_id,
                    'end' => $schedule->end,
                    'extendedProps' => [
                        'imam' => $schedule->Imam->fullname,
                        'masjid' => $schedule->masjid->name,
                        'shalat' => $schedule->shalat->name,
                    ]
                ];
            });

        return response()->json($events);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'imam_id' => 'required|exists:imams,id',
            'masjid_id' => 'required|exists:masjids,id',
            'shalat_id' => 'required|array',
            'shalat_id.*' => 'exists:shalats,id',
            'date' => 'required|date',
        ]);

        // Loop through each selected shalat_id to check if a schedule already exists
        foreach ($validated['shalat_id'] as $shalatId) {
            $existingSchedule = Schedule::whereRaw('DATE(`date`) = ?', [$validated['date']]) // Konversi timestamp ke date
                ->where('masjid_id', $validated['masjid_id'])
                ->where('shalat_id', $shalatId)
                ->exists();

            if ($existingSchedule) {
                return back()->withErrors(['error' => 'Hari ini sudah ada jadwal untuk shalat ini di masjid ini.']);
            }
        }


        // If no existing schedules found, create new schedules for each shalat_id
        foreach ($validated['shalat_id'] as $shalatId) {
            $shalat = Shalat::find($shalatId);
            Schedule::create([
                'imam_id' => $validated['imam_id'],
                'masjid_id' => $validated['masjid_id'],
                'shalat_id' => $shalatId,
                'date' => $validated['date'] . ' ' . $shalat->start,
                'end' => $validated['date'] . ' ' . $shalat->end,
            ]);
        }

        return redirect()->route('admin.jadwal.index')->with('success', 'Schedule berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $jadwal = Schedule::findOrFail($id);
        $shalats = Shalat::all();
        $masjids =  Masjid::all();
        return view('Admin.jadwal.edit', compact('jadwal', 'masjids', 'shalats'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'masjid_id' => 'required|exists:masjids,id',
            'shalat_id' => 'required',
            'date' => 'required|date',
        ]);
        $existingSchedule = Schedule::whereRaw('DATE(`date`) = ?', [$validated['date']]) // Konversi timestamp ke date
            ->where('masjid_id', $validated['masjid_id'])
            ->where('shalat_id', $validated['shalat_id'])
            ->exists();

        if ($existingSchedule) {
            return back()->withErrors(['error' => 'Hari ini sudah ada jadwal untuk shalat ini di masjid ini.']);
        }
        $jadwal = Schedule::findOrFail($id);
        $jadwal->update($validated);

        return redirect()->route('admin.jadwal.index', $jadwal->id)->with('success', 'Schedule berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jadwal = Schedule::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('admin.jadwal.index')->with('success', 'Schedule berhasil dihapus.');
    }
    public function updateJSON(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:schedules,id',
            'start' => 'required',
            'end' => 'nullable',
            'masjid_id' => 'required',
            'shalat_id' => 'required',
        ]);

        // dd($request);
        $date = Carbon::parse($validated['start'])->format('Y-m-d');
        $existingSchedule = Schedule::whereDate('date', $date)
            ->where('masjid_id', $validated['masjid_id'])
            ->where('shalat_id', $validated['shalat_id'])
            ->where('id', '!=', $validated['id'])
            ->exists();

        if ($existingSchedule) {
            return response()->json(['success' => false, 'message' => 'Schedule already exists for the given date, masjid, and shalat.']);
        }

        $schedule = Schedule::findOrFail($validated['id']);
        $schedule->date = Carbon::parse($validated['start'])->format('Y-m-d H:i:s');
        $schedule->end = $validated['end'] ? Carbon::parse($validated['end'])->format('Y-m-d H:i:s') : null;
        $schedule->save();

        return response()->json(['success' => true]);
    }
}
