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
    // public function berdasarkanShalat(Request $request)
    // {
    //     $monthYear = $request->input('month');
    //     if (!$monthYear || !preg_match('/^\d{4}-\d{2}$/', $monthYear)) {
    //         $monthYear = Carbon::now()->format('Y-m');
    //     }
    //     [$year, $month] = explode('-', $monthYear);

    //     $defaultShalat = Shalat::all();
    //     $defaultImam = Imam::where('is_active', true)->get();
    //     $schedules = Schedule::whereYear('date', $year)
    //         ->whereMonth('date', $month)
    //         ->get();

    //     $groupedSchedules = $schedules->groupBy('imam_id')->map(function ($imamSchedules, $imamId) use ($defaultShalat) {
    //         $totals = [];
    //         $grandTotal = 0;
    //         $totalSalary = 0;
    //         $imamMarbot = Imam::find($imamId);
    //         $addBonus = false;

    //         foreach ($defaultShalat as $shalat) {
    //             $shalatSchedules = $imamSchedules->where('shalat_id', $shalat->id);
    //             $count = $shalatSchedules->count();
    //             $salary = 0;

    //             // Flag to track if masjid_id matches with Marbot's masjid_id
    //             $masjidMatch = false;

    //             foreach ($shalatSchedules as $schedule) {
    //                 // Ambil fee spesial dan grade fee
    //                 $specialFee = ListFee::where('shalat_id', $shalat->id)->value('fee_id');
    //                 $gradeFee = ListFee::where('imam_id', $imamId)->whereNull('shalat_id')->value('fee_id');

    //                 $specialAmount = Fee::find($specialFee)->amount ?? 0;
    //                 $defaultAmount = $gradeFee ? Fee::find($gradeFee)->amount : 0;

    //                 if ($imamMarbot?->Marbot) {
    //                     $marbot = $imamMarbot->Marbot;
    //                     // Jika tipe marbot adalah 3, langsung tambahkan gaji
    //                     if ($marbot->type == '3') {
    //                         $scheduleSalary = $specialAmount ?: $defaultAmount;
    //                         $addBonus = true; // Bonus langsung diberikan untuk tipe 3
    //                     } elseif ($schedule->masjid_id == $marbot->masjid_id) {
    //                         // Pengecekan untuk tipe 1 dan tipe 2
    //                         $masjidMatch = true;
    //                         if ($marbot->type == '1') {
    //                             $scheduleSalary = 0;
    //                         } elseif ($marbot->type == '2') {
    //                             $scheduleSalary = $specialAmount ?: $defaultAmount;
    //                         }
    //                     }
    //                 }

    //                 // Jika ada kecocokan masjid, beri bonus
    //                 if ($masjidMatch) {
    //                     $addBonus = true;
    //                 }

    //                 $salary += $scheduleSalary ?? 0;
    //             }

    //             $totals[$shalat->id] = [
    //                 'count' => $count,
    //                 'salary' => $salary,
    //             ];
    //             $grandTotal += $count;
    //             $totalSalary += $salary;
    //         }

    //         $totals['total'] = [
    //             'count' => $grandTotal,
    //             'salary' => $totalSalary + ($addBonus ? ($imamMarbot->Marbot->bayaran ?? 0) : 0),
    //         ];

    //         return $totals;
    //     });

    //     return view('admin.rekap.berdasarkan-shalat', compact('defaultShalat', 'defaultImam', 'groupedSchedules'));
    // }

    // public function berdasarkanShalat(Request $request)
    // {
    //     $monthYear = $request->input('month');
    //     if (!$monthYear || !preg_match('/^\d{4}-\d{2}$/', $monthYear)) {
    //         $monthYear = Carbon::now()->format('Y-m');
    //     }
    //     [$year, $month] = explode('-', $monthYear);
    //     $defaultShalat = Shalat::all();
    //     $defaultImam = Imam::where('is_active', true)->get();
    //     $schedules = Schedule::whereYear('date', $year)
    //         ->whereMonth('date', $month)
    //         ->get();
    //     $groupedSchedules = $schedules->groupBy('imam_id')->map(function ($imamSchedules, $imamId) use ($defaultShalat) {
    //         $totals = [];
    //         $grandTotal = 0;
    //         $totalSalary = 0;
    //         $imamMarbot = Imam::find($imamId);
    //         foreach ($defaultShalat as $shalat) {
    //             $shalatSchedules = $imamSchedules->where('shalat_id', $shalat->id);
    //             $count = $shalatSchedules->count();
    //             $salary = 0;
    //             $addBonus = isset($addBonus) ? $addBonus : false;
    //             foreach ($shalatSchedules as $schedule) {
    //                 $specialFee = ListFee::where('shalat_id', $shalat->id)->value('fee_id');
    //                 $gradeFee = ListFee::where('imam_id', $imamId)->whereNull('shalat_id')->value('fee_id');

    //                 $specialAmount = Fee::find($specialFee)->amount ?? 0;
    //                 $defaultAmount = $gradeFee ? Fee::find($gradeFee)->amount : 0;

    //                 if ($imamMarbot?->Marbot) {
    //                     $marbot = $imamMarbot->Marbot;
    //                     if ($marbot->type == '1' && $schedule->masjid_id == $marbot->masjid_id) {
    //                         $scheduleSalary = 0;
    //                         $addBonus = true;
    //                     } elseif ($marbot->type == '2' && $schedule->masjid_id == $marbot->masjid_id) {
    //                         $scheduleSalary = $specialAmount ?: $defaultAmount;
    //                         $addBonus = true;
    //                     } elseif ($marbot->type == '3') {
    //                         $scheduleSalary = $specialAmount ?: $defaultAmount;
    //                         $addBonus = true;
    //                     } else {
    //                         $scheduleSalary = $specialAmount ?: $defaultAmount;
    //                     }
    //                 } else {
    //                     $scheduleSalary = $specialAmount ?: $defaultAmount;
    //                 }

    //                 $salary += $scheduleSalary;
    //             }
    //             $totals[$shalat->id] = [
    //                 'count' => $count,
    //                 'salary' => $salary,
    //             ];
    //             $grandTotal += $count;
    //             $totalSalary += $salary;
    //         }
    //         $totals['total'] = [
    //             'count' => $grandTotal,
    //             'salary' => $totalSalary + ($addBonus && $imamMarbot->Marbot->bayaran ? $imamMarbot->Marbot->bayaran : 0),
    //         ];
    //         return $totals;
    //     });
    //     return view('admin.rekap.berdasarkan-shalat', compact('defaultShalat', 'defaultImam', 'groupedSchedules'));
    // }

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
        $imamMarbot = Imam::find($imamId);
        $addBonus = false;

        foreach ($defaultShalat as $shalat) {
            $shalatSchedules = $imamSchedules->where('shalat_id', $shalat->id);
            $count = $shalatSchedules->count();
            $salary = 0;

            // Flag to track if masjid_id matches with Marbot's masjid_id
            $masjidMatch = false;

            foreach ($shalatSchedules as $schedule) {
                // Ambil fee spesial dan grade fee
                $specialFee = ListFee::where('shalat_id', $shalat->id)->value('fee_id');
                $gradeFee = ListFee::where('imam_id', $imamId)->whereNull('shalat_id')->value('fee_id');

                $specialAmount = Fee::find($specialFee)->amount ?? 0;
                $defaultAmount = $gradeFee ? Fee::find($gradeFee)->amount : 0;

                if ($imamMarbot?->Marbot) {
                    $marbot = $imamMarbot->Marbot;
                    // Jika tipe marbot adalah 3, langsung tambahkan gaji
                    if ($marbot->type == '3') {
                        $scheduleSalary = $specialAmount ?: $defaultAmount;
                        $addBonus = true; // Bonus langsung diberikan untuk tipe 3
                    } elseif ($schedule->masjid_id == $marbot->masjid_id) {
                        // Pengecekan untuk tipe 1 dan tipe 2
                        $masjidMatch = true;
                        if ($marbot->type == '1') {
                            $scheduleSalary = 0;
                        } elseif ($marbot->type == '2') {
                            $scheduleSalary = $specialAmount ?: $defaultAmount;
                        }
                    }
                }

                // Jika tidak ada Marbot, tetap hitung gaji
                if (!$imamMarbot || !$imamMarbot->Marbot) {
                    $scheduleSalary = $specialAmount ?: $defaultAmount;
                }

                // Jika ada kecocokan masjid, beri bonus
                if ($masjidMatch) {
                    $addBonus = true;
                }

                $salary += $scheduleSalary ?? 0;
            }

            $totals[$shalat->id] = [
                'count' => $count,
                'salary' => $salary,
            ];
            $grandTotal += $count;
            $totalSalary += $salary;
        }

        $totals['total'] = [
            'count' => $grandTotal,
            'salary' => $totalSalary + ($addBonus ? ($imamMarbot->Marbot->bayaran ?? 0) : 0),
        ];

        return $totals;
    });

    return view('admin.rekap.berdasarkan-shalat', compact('defaultShalat', 'defaultImam', 'groupedSchedules'));
}

}
