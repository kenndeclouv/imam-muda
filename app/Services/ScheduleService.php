<?php

namespace App\Services;

use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ScheduleService
{
    public function getSchedulesByRole($role, $request)
    {
        $monthYear = $request->input('month', Carbon::now()->format('Y-m'));
        if (!preg_match('/^\d{4}-\d{2}$/', $monthYear)) {
            $monthYear = Carbon::now()->format('Y-m');
        }
        [$year, $month] = explode('-', $monthYear);
        switch ($role) {
            case 'admin':
                return Schedule::query()
                    ->filterByImam($request->input('filter_imam'))
                    ->filterByShalat($request->input('filter_shalat'))
                    ->filterByMasjid($request->input('filter_masjid'))
                    ->whereYear('date', $year)
                    ->whereMonth('date', $month)
                    ->get();
            case 'imam':
                $jadwals = Schedule::where('imam_id', Auth::user()->Imam->id)
                    ->whereYear('date', $year)
                    ->whereMonth('date', $month)
                    ->get();
                $jadwalBadals = Schedule::where('badal_id', Auth::user()->Imam->id)
                    ->where('is_badal', true)
                    ->get();
                return [
                    'jadwals' => $jadwals,
                    'jadwalBadals' => $jadwalBadals
                ];
        }
        return null;
    }
}
