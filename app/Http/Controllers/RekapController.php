<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Fee;
use App\Models\Imam;
use App\Models\ListFee;
use App\Models\Schedule;
use App\Models\Shalat;
use Carbon\Carbon;
use Illuminate\Http\Request;
class RekapController extends Controller
{
    public function berdasarkanImam(Request $request)
    {
        $monthYear = $request->input('month');
        if (!$monthYear || !preg_match('/^\d{4}-\d{2}$/', $monthYear)) {
            $monthYear = Carbon::now()->format('Y-m');
        }
        [$year, $month] = explode('-', $monthYear);
        $imamId = $request->input('imam');
        $defaultImam = Imam::where('is_active', true)->get();
        $imams = Imam::with([
            'Schedules' => function ($query) use ($year, $month) {
                $query->whereYear('date', $year)->whereMonth('date', $month);
            },
            'BadalSchedules' => function ($query) use ($year, $month) {
                $query->whereYear('date', $year)->whereMonth('date', $month);
            },
        ])
            ->where(function ($query) use ($year, $month) {
                $query->whereHas('schedules', function ($query) use ($year, $month) {
                    $query->whereYear('date', $year)->whereMonth('date', $month);
                })->orWhereHas('badalSchedules', function ($query) use ($year, $month) {
                    $query->whereYear('date', $year)->whereMonth('date', $month);
                });
            })
            ->when($imamId, function ($query) use ($imamId) {
                $query->where('id', $imamId);
            })
            ->get();
        return view('admin.rekap.berdasarkan-imam', compact('imams', 'monthYear', 'defaultImam'));
    }
    public function berdasarkanShalat(Request $request)
    {
        $monthYear = $request->input('month');
        if (!$monthYear || !preg_match('/^\d{4}-\d{2}$/', $monthYear)) {
            $monthYear = Carbon::now()->format('Y-m');
        }
        [$year, $month] = explode('-', $monthYear);
        $defaultShalat = Shalat::all();
        $defaultImam = Imam::where('is_active', true)->get();
        $schedules = Schedule::whereYear('date', $year)
            ->whereMonth('date', $month)
            ->get();
        $groupedSchedules = $schedules->groupBy('imam_id')->map(function ($imamSchedules, $imamId) use ($defaultShalat) {
            $totals = [];
            $grandTotal = 0;
            $totalSalary = 0;
            foreach ($defaultShalat as $shalat) {
                $count = $imamSchedules->where('shalat_id', $shalat->id)->count();
                $specialFee = ListFee::where('shalat_id', $shalat->id)
                    ->value('fee_id');
                $gradeFee = ListFee::where('imam_id', $imamId)
                    ->whereNull('shalat_id')
                    ->value('fee_id');
                $specialAmount = Fee::find($specialFee)->amount ?? null;
                $defaultAmount = $gradeFee ? Fee::find($gradeFee)->amount : 0;
                $salary = ($specialAmount ?? $defaultAmount) * $count;
                $totals[$shalat->id] = [
                    'count' => $count,
                    'salary' => $salary,
                ];
                $grandTotal += $count;
                $totalSalary += $salary;
            }
            $totals['total'] = [
                'count' => $grandTotal,
                'salary' => $totalSalary,
            ];
            return $totals;
        });
        return view('admin.rekap.berdasarkan-shalat', compact('defaultShalat', 'defaultImam', 'groupedSchedules'));
    }
}
