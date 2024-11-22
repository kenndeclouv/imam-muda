<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Announcement;
use App\Models\Imam;
use App\Models\Masjid;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $imams = Imam::all()->count();
        $masjids = Masjid::all()->count();
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $weeklyJadwal = DB::table('schedules')
            ->selectRaw('DATE(date) as day, COUNT(*) as total')
            ->whereBetween('date', [$startOfWeek, $endOfWeek])
            ->count();

        $bayaranImam = Schedule::where('status', 'done')
            ->with('imam.fee')
            ->get()
            ->reduce(function ($carry, $schedule) {
                $imamFee = $schedule->imam->Fee->fee ?? 0;
                return $carry + $imamFee;
            }, 0);

        $schedules = Schedule::where('status', 'to_do')
            ->where('is_badal', operator: 1)->where('badal_id', null)->get();

        $announcements = Announcement::all();
        return view('Admin.index', compact('imams', 'masjids', 'weeklyJadwal', 'schedules', 'announcements', 'bayaranImam'));
    }
    public function account()
    {
        return view('Admin.account');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'fullname' => 'required|string|max:50',
            'phone' => 'required|string|max:20',
            'birthplace' => 'required|string|max:100',
            'birthdate' => 'required|date',
            'description' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
        ]);

        $admin = Admin::where('user_id', Auth::id())->firstOrFail();

        $admin->update($validated);

        return redirect()->route('account')->with('success', 'Admin berhasil diperbarui.');
    }
}
