<?php

namespace App\Http\Controllers\API;

use App\Models\Shalat;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Masjid;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class APIController extends Controller
{
    public function getImamScheduleData(Request $request)
    {
        $range = $request->input('range');
        $start = null;
        $end = Carbon::tomorrow();
        Carbon::setLocale('id');


        $start = match ($range) {
            'today' => Carbon::today(),
            'yesterday' => Carbon::yesterday(),
            'last7days' => Carbon::now()->subDays(6),
            'last30days' => Carbon::now()->subDays(29),
            'currentmonth' => Carbon::now()->startOfMonth(),
            'lastmonth' => Carbon::now()->subMonth()->startOfMonth(),
            default => Carbon::now()->startOfMonth(),
        };

        $data = Schedule::selectRaw('DATE(date) as day, COUNT(*) as total')
            ->whereBetween('date', [$start, $end])
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        $days = [];
        $totals = [];

        $period = CarbonPeriod::create($start, $end);
        foreach ($period as $date) {
            $day = $date->toDateString();
            $days[] = $day;
            $totals[] = $data->firstWhere('day', $day)?->total ?? 0;
        }

        return response()->json([
            'days' => $days,
            'totals' => $totals,
        ]);
    }

    // public function getMasjidScheduleData(Request $request)
    // {
    //     $range = $request->input('range');
    //     $start = null;
    //     $end = Carbon::tomorrow();
    //     Carbon::setLocale('id');

    //     $start = match ($range) {
    //         'today' => Carbon::today(),
    //         'yesterday' => Carbon::yesterday(),
    //         'last7days' => Carbon::now()->subDays(6),
    //         'last30days' => Carbon::now()->subDays(29),
    //         'currentmonth' => Carbon::now()->startOfMonth(),
    //         'lastmonth' => Carbon::now()->subMonth()->startOfMonth(),
    //         default => Carbon::now()->startOfMonth(),
    //     };

    //     $scheduleData = Schedule::whereBetween('date', [$start, $end])
    //         ->selectRaw('masjid_id, date, COUNT(*) as total')
    //         ->groupBy('masjid_id', 'date')
    //         ->orderBy('date')
    //         ->get();

    //     $masjids = Masjid::whereIn('id', $scheduleData->pluck('masjid_id')->unique())
    //         ->pluck('name', 'id');

    //     // Siapkan array hari
    //     $days = [];
    //     $dateCursor = $start->copy();
    //     while ($dateCursor <= $end) {
    //         $days[] = $dateCursor->format('Y-m-d');
    //         $dateCursor->addDay();
    //     }

    //     // Siapkan data untuk setiap masjid
    //     $series = [];
    //     foreach ($masjids as $masjidId => $masjidName) {
    //         $data = [];
    //         foreach ($days as $day) {
    //             $total = $scheduleData
    //                 ->where('masjid_id', $masjidId)
    //                 ->where('date', $day)
    //                 ->first()?->total ?? 0;
    //             $data[] = $total;
    //         }

    //         $series[] = [
    //             'name' => $masjidName,
    //             'data' => $data,
    //         ];
    //     }

    //     return response()->json([
    //         'days' => $days,
    //         'series' => $series,
    //     ]);
    // }

    public function getMasjidScheduleData(Request $request)
    {
        $range = $request->input('range');
        $end = Carbon::tomorrow();
        Carbon::setLocale('id');

        $start = match ($range) {
            'today' => Carbon::today(),
            'yesterday' => Carbon::yesterday(),
            'last7days' => Carbon::now()->subDays(6),
            'last30days' => Carbon::now()->subDays(29),
            'currentmonth' => Carbon::now()->startOfMonth(),
            'lastmonth' => Carbon::now()->subMonth()->startOfMonth(),
            default => Carbon::now()->startOfMonth(),
        };

        // Ambil data jadwal berdasarkan rentang waktu
        $scheduleData = Schedule::whereBetween('date', [$start, $end])
            ->selectRaw('masjid_id, DATE(date) as date, COUNT(*) as total')
            ->groupBy('masjid_id', 'date')
            ->orderBy('date')
            ->get(); // Mengambil sebagai Collection

        // Ambil nama masjid berdasarkan masjid_id
        $masjids = Masjid::whereIn('id', $scheduleData->pluck('masjid_id')->unique())
            ->pluck('name', 'id');

        // Siapkan array hari
        $days = [];
        $dateCursor = $start->copy();
        while ($dateCursor <= $end) {
            $days[] = $dateCursor->format('Y-m-d');
            $dateCursor->addDay();
        }

        // Siapkan data untuk setiap masjid
        $series = [];
        foreach ($masjids as $masjidId => $masjidName) {
            $data = [];
            foreach ($days as $day) {
                $total = $scheduleData
                    ->where('masjid_id', $masjidId)
                    ->where('date', $day) // Hanya tanggal yang dibandingkan
                    ->first()?->total ?? 0;
                $data[] = $total;
            }

            $series[] = [
                'name' => $masjidName,
                'data' => $data,
            ];
        }

        return response()->json([
            'days' => $days,
            'series' => $series,
        ]);
    }

    public function getMasjidShalatScheduleData(Request $request)
    {
        $range = $request->input('range');
        $start = null;
        $end = Carbon::tomorrow();
        Carbon::setLocale('id');

        $start = match ($range) {
            'today' => Carbon::today(),
            'yesterday' => Carbon::yesterday(),
            'last7days' => Carbon::now()->subDays(6),
            'last30days' => Carbon::now()->subDays(29),
            'currentmonth' => Carbon::now()->startOfMonth(),
            'lastmonth' => Carbon::now()->subMonth()->startOfMonth(),
            default => Carbon::now()->startOfMonth(),
        };

        // Ambil jadwal shalat untuk semua masjid
        $scheduleData = Schedule::whereBetween('date', [$start, $end])
            ->selectRaw('masjid_id, shalat_id, DATE(date) as date, COUNT(*) as total')
            ->groupBy('masjid_id', 'shalat_id', 'date')
            ->get();

        // Ambil nama masjid
        $masjids = Masjid::whereIn('id', $scheduleData->pluck('masjid_id')->unique())
            ->pluck('name', 'id');

        // Ambil nama shalat
        $shalats = Shalat::pluck('name', 'id');

        // Siapkan daftar tanggal dalam rentang waktu
        $days = [];
        $dateCursor = $start->copy();
        while ($dateCursor <= $end) {
            $days[] = $dateCursor->format('Y-m-d');
            $dateCursor->addDay();
        }

        // Siapkan data untuk ditampilkan
        $results = [];
        foreach ($masjids as $masjidId => $masjidName) {
            $masjidSchedules = $scheduleData->where('masjid_id', $masjidId);
            $shalatTotals = [];

            // Loop untuk setiap tanggal
            foreach ($days as $day) {
                $dayData = [];
                foreach ($shalats as $shalatId => $shalatName) {
                    $total = $masjidSchedules->where('shalat_id', $shalatId)->where('date', $day)->sum('total');
                    $dayData[] = $total;
                }
                $shalatTotals[] = $dayData;
            }

            $results[] = [
                'masjid' => $masjidName,
                'days' => $days,
                'series' => $shalatTotals
            ];
        }

        return response()->json($results);
    }
}
