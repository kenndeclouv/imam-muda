<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Imam;
use App\Models\Masjid;
use App\Models\Schedule;
use App\Models\Announcement;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function adminHome()
    {
        // hitung total imam dan masjid
        $imams = Imam::count();
        $masjids = Masjid::count();

        // dapatkan rentang minggu ini
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        // hitung total jadwal mingguan
        $weeklyJadwal = Schedule::whereBetween('date', [$startOfWeek, $endOfWeek])->count();

        // hitung bayaran imam berdasarkan jadwal yang selesai
        $bayaranImam = Schedule::where('status', 'done')
            ->with(['Imam.ListFee.Fee']) // eager load relasi
            ->get()
            ->reduce(function ($carry, $schedule) {
                // cek fee spesial atau default untuk imam
                $imamFee = $schedule->Imam->ListFee
                    ->where('shalat_id', $schedule->shalat_id)
                    ->first()->Fee->amount
                    ?? $schedule->Imam->ListFee
                    ->where('shalat_id', null)
                    ->first()->Fee->amount
                    ?? 0;

                return $carry + $imamFee;
            }, 0);

        // ambil jadwal badal yang belum ada pengganti
        $schedules = Schedule::where('status', 'to_do')
            ->where('is_badal', true)
            ->whereNull('badal_id')
            ->get();

        // semua pengumuman
        $announcements = Announcement::all();

        // kirim data ke view
        return view('admin.index', compact('imams', 'masjids', 'weeklyJadwal', 'schedules', 'announcements', 'bayaranImam'));
    }

    public function superAdminHome()
    {
        $imams = Imam::all()->count();
        $masjids = Masjid::all()->count();
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $weeklyJadwal = DB::table('schedules')
            ->selectRaw('DATE(date) as day, COUNT(*) as total')
            ->whereBetween('date', [$startOfWeek, $endOfWeek])
            ->count();

        $bayaranImam = Schedule::where('status', 'done')
            ->with('imam.fee')
            ->get()
            ->reduce(function ($carry, $schedule) {
                $imamFee = $schedule->imam->Fee->fee ?? 0;
                return $carry + $imamFee;
            }, 0);

        $schedules = Schedule::where('status', 'to_do')
            ->where('is_badal', operator: 1)->where('badal_id', null)->get();

        $announcements = Announcement::all();
        return view('superadmin.index', compact('imams', 'masjids', 'weeklyJadwal', 'schedules', 'announcements', 'bayaranImam'));
    }

    public function imamHome()
    {
        $schedules = Schedule::where('status', 'to_do')
            ->where('is_badal', true)
            ->where('badal_id', null)
            ->where('imam_id', '!=', Auth::user()->imam->id)
            ->get();

        $announcements = Announcement::where('is_active', 1)
            ->where('target_id', Auth::user()->role->id)
            ->whereMonth('date', now()->month)
            // ->orWhereDate('date', '<=', now())
            ->get();
        return view('imam.index', compact('schedules', 'announcements'));
    }
}
