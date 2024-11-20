<?php

namespace App\Http\Controllers\Imam;

use App\Http\Controllers\Controller;
use App\Models\Imam;
use App\Models\Masjid;
use App\Models\Schedule;
use App\Models\Shalat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $monthYear = $request->input('month');
        if (!$monthYear || !preg_match('/^\d{4}-\d{2}$/', $monthYear)) {
            $monthYear = Carbon::now()->format('Y-m'); // Default ke bulan dan tahun sekarang jika input tidak valid
        }

        [$year, $month] = explode('-', $monthYear);

        $jadwals = Schedule::where('imam_id', Auth::user()->Imam->id)
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->get();

        $jadwalBadals = Schedule::where('badal_id', Auth::user()->Imam->id)
            ->where('is_badal', true)
            ->get();

        return view('Imam.jadwal.index', compact('jadwals', 'jadwalBadals'));
    }


    public function create()
    {
        $imams = Imam::all();
        $masjids = Masjid::all();
        $shalats = Shalat::all();
        return view('Imam.jadwal.create', compact('imams', 'masjids', 'shalats'));
    }

    public function fetch(Request $request)
    {
        $events = Schedule::with(['imam', 'masjid', 'shalat'])->get()
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
                        'note' => $schedule->note,
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
            'status' => 'required|in:to_do,done',
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
                'status' => $validated['status'],
            ]);
        }

        return redirect()->route('imam.jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $jadwal = Schedule::findOrFail($id);
        $shalats = Shalat::all();
        $masjids =  Masjid::all();
        $imams = Imam::all();
        return view('Imam.jadwal.edit', compact('jadwal', 'masjids', 'shalats', 'imams'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'masjid_id' => 'required|exists:masjids,id',
            'shalat_id' => 'required',
            'date' => 'required|date',
            'note' => 'nullable|string',
        ]);

        $inputDate = Carbon::parse($validated['date'])->toDateString(); // Format jadi 'Y-m-d'

        $existingSchedule = Schedule::where('masjid_id', $validated['masjid_id'])
            ->where('shalat_id', $validated['shalat_id'])
            ->whereDate('date', $inputDate) // Gunakan whereDate untuk mencocokkan hanya tanggal
            ->where('id', '!=', $id) // Abaikan jadwal yang sedang diperbarui
            ->exists();

        if ($existingSchedule) {
            $shalatName = Shalat::find($validated['shalat_id'])->name ?? 'Shalat Tidak Ditemukan';
            $masjidName = Masjid::find($validated['masjid_id'])->name ?? 'Masjid Tidak Ditemukan';

            return back()->withErrors([
                'error' => 'Hari ini sudah ada jadwal untuk shalat ' . $shalatName . ' di masjid ' . $masjidName . '.'
            ])->withInput();
        }

        $jadwal = Schedule::findOrFail($id);
        $jadwal->update($validated);

        return redirect()->route('imam.jadwal.index', $jadwal->id)->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jadwal = Schedule::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('imam.jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }

    public function cariBadal(Request $request, $id)
    {
        $jadwal = Schedule::findOrFail($id);
        $jadwal->update([
            'note' => $request->note,
            'is_badal' => true
        ]);
        return redirect()->route('imam.jadwal.index')->with('success', 'Badal berhasil dicarikan.');
    }

    public function done($id)
    {
        $jadwal = Schedule::findOrFail($id);
        $jadwal->update(['status' => 'done']);
        return redirect()->route('imam.jadwal.index')->with('success', 'Jadwal berhasil diselesaikan.');
    }

    public function cancel($id)
    {
        $jadwal = Schedule::findOrFail($id);
        $jadwal->update(['badal_id' => null]);
        return redirect()->route('imam.jadwal.index')->with('success', 'Badal berhasil dibatalkan.');
    }
}
