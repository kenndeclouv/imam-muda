<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Imam;
use App\Models\Masjid;
use App\Models\Schedule;
use App\Models\Announcement;
use App\Models\Quote;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function adminHome()
    {
        $role = optional(Auth::user()->Role)->code;
        $imams = Imam::where('is_active', true)->count();
        $masjids = Masjid::count();
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        $weeklyJadwal = Schedule::whereBetween('date', [$startOfWeek, $endOfWeek])->count();

        $schedules = Schedule::where('status', 'to_do')
            ->where('is_badal', true)
            ->whereNull('badal_id')
            ->get();
        $announcements = Announcement::all();
        $quote = Quote::where('status', true)->first();

        return view("{$role}.index", compact('imams', 'masjids', 'weeklyJadwal', 'schedules', 'announcements', 'quote'));
    }


    public function imamHome()
    {
        $toDoSchedules = Schedule::where('status', 'to_do');
        $schedules = $toDoSchedules
            ->where('is_badal', true)
            ->where('badal_id', null)
            ->where('imam_id', '!=', Auth::user()->imam->id)
            ->get();

        $announcements = Announcement::where('is_active', 1)
            ->where('target_id', optional(Auth::user()->role)->id)
            ->whereMonth('date', now()->month)
            ->get();

        $quote = cache()->remember('active_quote', now()->addMinutes(10), function () {
            return Quote::where('status', true)->first();
        });

        return view('imam.index', compact('schedules', 'announcements', 'quote'));
    }
}
