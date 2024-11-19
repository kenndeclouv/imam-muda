<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Imam;
use App\Models\Masjid;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $imams = Imam::all()->count();

        $currentMonthCount = Imam::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();

        $lastMonthCount = Imam::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->count();


        $percentageChange = 0;
        if ($lastMonthCount > 0) {
            $percentageChange = (($currentMonthCount - $lastMonthCount) / $lastMonthCount) * 100;
        } elseif ($currentMonthCount > 0) {
            $percentageChange = 100;
        }

        $masjids = Masjid::all()->count();


        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $weeklyJadwal = DB::table('schedules')
            ->selectRaw('DATE(date) as day, COUNT(*) as total')
            ->whereBetween('date', [$startOfWeek, $endOfWeek])
            ->count();

        $schedules = Schedule::where('status', 'to_do')
            ->where('is_badal', operator: 1)->where('badal_id', null)->get();

        return view('Admin.index', compact('imams', 'masjids', 'weeklyJadwal', 'percentageChange', 'schedules'));
    }
    public function account()
    {
        return view('Admin.account');
    }
}
