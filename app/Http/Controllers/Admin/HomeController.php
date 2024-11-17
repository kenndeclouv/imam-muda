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

        return view('Admin.index', compact('imams', 'masjids', 'weeklyJadwal', 'percentageChange'));
    }
    public function account()
    {
        return view('Admin.account');
    }

    public function statistik()
    {
        return view('Admin.statistik.index');
    }
    public function bayaranimam(Request $request)
    {
        $monthYear = $request->input('month');
        if (!$monthYear || !preg_match('/^\d{4}-\d{2}$/', $monthYear)) {
            $monthYear = Carbon::now()->format('Y-m'); // Default ke bulan dan tahun sekarang jika input tidak valid
        }

        [$year, $month] = explode('-', $monthYear);

        $imams = Imam::whereHas('schedules', function ($query) use ($year, $month) {
            $query->whereYear('date', $year)
                ->whereMonth('date', $month);
        })->get();

        return view('Admin.statistik.bayaranimam', compact('imams', 'monthYear'));
    }
}
