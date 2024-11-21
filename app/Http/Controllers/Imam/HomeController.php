<?php

namespace App\Http\Controllers\Imam;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Imam;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $schedules = Schedule::where('status', 'to_do')
            ->where('is_badal', true)
            ->where('badal_id', null)
            ->where('imam_id', '!=', Auth::user()->imam->id)
            ->get();

        $announcements = Announcement::where('is_active', 1)
            ->where('target_id', Auth::user()->role->id)
            ->whereMonth('date', now()->month)
            // ->orWhereDate('date', '<=', now())
            ->get();
        return view('Imam.index', compact('schedules', 'announcements'));
    }
    public function update(Request $request)
    {
        $validated = $request->validate([
            'fullname' => 'required|string|max:50',
            'phone' => 'required|string|max:20',
            'birthplace' => 'required|string|max:100',
            'birthdate' => 'required|date',
            'juz' => 'nullable|integer',
            'school' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
        ]);

        $imam = Imam::where('user_id', Auth::id())->firstOrFail();

        $imam->update($validated);

        return redirect()->route('account')->with('success', 'Imam berhasil diperbarui.');
    }
}
