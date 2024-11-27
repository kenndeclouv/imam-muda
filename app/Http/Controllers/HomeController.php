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
        $imams = Imam::count();
        $masjids = Masjid::count();
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $weeklyJadwal = Schedule::whereBetween('date', [$startOfWeek, $endOfWeek])->count();


        $bayaranImam = Schedule::where('status', 'done')
            ->with(['Imam.ListFee.Fee'])
            ->get()
            ->reduce(function ($carry, $schedule) {

                $imamFee = $schedule->Imam->ListFee
                    ->where('shalat_id', $schedule->shalat_id)
                    ->first()->Fee->amount
                    ?? $schedule->Imam->ListFee
                    ->where('shalat_id', null)
                    ->first()->Fee->amount
                    ?? 0;

                return $carry + $imamFee;
            }, 0);


        $schedules = Schedule::where('status', 'to_do')
            ->where('is_badal', true)
            ->whereNull('badal_id')
            ->get();


        $announcements = Announcement::all();


        return view('admin.index', compact('imams', 'masjids', 'weeklyJadwal', 'schedules', 'announcements', 'bayaranImam'));
    }

    public function superAdminHome()
    {

        $imams = Imam::count();
        $masjids = Masjid::count();


        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();


        $weeklyJadwal = Schedule::whereBetween('date', [$startOfWeek, $endOfWeek])->count();


        $bayaranImam = Schedule::where('status', 'done')
            ->with(['Imam.ListFee.Fee'])
            ->get()
            ->reduce(function ($carry, $schedule) {

                $imamFee = $schedule->Imam->ListFee
                    ->where('shalat_id', $schedule->shalat_id)
                    ->first()->Fee->amount
                    ?? $schedule->Imam->ListFee
                    ->where('shalat_id', null)
                    ->first()->Fee->amount
                    ?? 0;

                return $carry + $imamFee;
            }, 0);


        $schedules = Schedule::where('status', 'to_do')
            ->where('is_badal', true)
            ->whereNull('badal_id')
            ->get();


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

            ->get();
        return view('imam.index', compact('schedules', 'announcements'));
    }
}
