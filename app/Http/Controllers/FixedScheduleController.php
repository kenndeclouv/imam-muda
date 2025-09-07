<?php

namespace App\Http\Controllers;

use App\Models\FixedSchedule;
use App\Http\Requests\StoreFixedScheduleRequest;
use App\Models\Imam;
use App\Models\Masjid;
use App\Models\Shalat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FixedScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil semua data yang diperlukan
        $masjids = Masjid::query();
        $shalats = Shalat::whereIn('id', [1, 2])->get();
        $imams = Imam::orderBy('id')->get(); // Urutkan imam agar konsisten
        // Filter masjid jika ada input dari user
        if ($request->has('filter_masjid') && $request->filter_masjid != '') {
            $masjids->where('id', $request->filter_masjid);
        }

        $masjids = $masjids->get();
        $allMasjids = Masjid::all(); // Untuk dropdown filter

        // Data hari dalam bahasa Indonesia untuk tampilan
        $days = [
            'monday' => 'SENIN',
            'tuesday' => 'SELASA',
            'wednesday' => 'RABU',
            'thursday' => 'KAMIS',
            'friday' => 'JUMAT',
            'saturday' => 'SABTU',
            'sunday' => 'AHAD',
        ];

        // Ambil semua jadwal tetap dan eager load relasinya
        $schedulesData = FixedSchedule::with('Imam', 'Shalat', 'Masjid')->get();

        // Proses data jadwal menjadi format yang mudah di-render di view
        // Strukturnya: [masjid_id][day_key][shalat_id] => imam_name
        $schedules = [];
        foreach ($schedulesData as $schedule) {
            $schedules[$schedule->masjid_id][$schedule->day][$schedule->shalat_id] = $schedule->Imam->fullname;
        }

        // Ambil permissions user
        $permissions = Auth::user()->getPermissionCodes();

        return view('admin.jadwal.fixed.index', compact(
            'masjids',
            'allMasjids',
            'shalats',
            'days',
            'schedules',
            'permissions',
            'imams'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFixedScheduleRequest $request)
    {
        FixedSchedule::create($request->validated());
        return redirect()->route('admin.jadwal.fixed.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(StoreFixedScheduleRequest $request, FixedSchedule $fixedSchedule)
    {
        $fixedSchedule->update($request->validated());
        return redirect()->route('admin.jadwal.fixed.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $fixedSchedule = FixedSchedule::where('masjid_id', $request->masjid_id)
            ->where('shalat_id', $request->shalat_id)
            ->where('day', $request->day)->delete();

        if ($fixedSchedule) {
            return redirect()->back()->with('success', 'Jadwal berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Jadwal tidak ditemukan.');
        }
    }
}
