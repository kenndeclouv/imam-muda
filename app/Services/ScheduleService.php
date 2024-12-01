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
        $query = Schedule::query()
            ->whereYear('date', $year)
            ->whereMonth('date', $month);
        if ($role === 'admin') {
            $query->filterByImam($request->input('filter_imam'))
                  ->filterByShalat($request->input('filter_shalat'))
                  ->filterByMasjid($request->input('filter_masjid'));
            return $query->get();
        }
        if ($role === 'imam') {
            $imamId = Auth::user()->Imam->id;
            return $query->where(function ($q) use ($imamId) {
                $q->where('imam_id', $imamId)
                  ->orWhere(function ($subQuery) use ($imamId) {
                      $subQuery->where('badal_id', $imamId)
                               ->where('is_badal', true);
                  });
            })->get();
        }
        return null;
    }
}
