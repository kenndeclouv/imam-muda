<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Imam;
use App\Models\Masjid;
use App\Models\Schedule;
use App\Models\Announcement;
use App\Models\Quote;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function adminHome()
    {
        $role = Auth::user()->Role->code;
        $imams = Imam::where('is_active', true)->count();
        $masjids = Masjid::count();
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        $weeklyJadwal = Schedule::whereBetween('date', [$startOfWeek, $endOfWeek])->count();

        try {
            $bayaranImam = Schedule::where('status', 'done')
                ->whereBetween('date', [$startOfMonth, $endOfMonth])
                ->with(['Imam.ListFee.Fee'])
                ->get()
                ->reduce(function ($carry, $schedule) {
                    $imamListFee = optional($schedule->Imam)->ListFee;

                    if (!$imamListFee) {
                        return $carry;
                    }

                    $imamFee = $imamListFee->where('shalat_id', $schedule->shalat_id)
                        ->first()
                        ?->Fee->amount
                        ?? $imamListFee->where('shalat_id', null)
                        ->first()
                        ?->Fee->amount
                        ?? 0;

                    return $carry + $imamFee;
                }, 0);
        } catch (\Exception $e) {
            Log::error("Error calculating Imam's fee: " . $e->getMessage());
            $bayaranImam = 0;
        }


        $schedules = Schedule::where('status', 'to_do')
            ->where('is_badal', true)
            ->whereNull('badal_id')
            ->get();
        $announcements = Announcement::all();
        $quote = Quote::where('status', true)->first();

        return view("{$role}.index", compact('imams', 'masjids', 'weeklyJadwal', 'schedules', 'announcements', 'bayaranImam', 'quote'));
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

        $quote = Quote::where('status', true)->first();

        return view('imam.index', compact('schedules', 'announcements', 'quote'));
    }
}
