<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Models\Imam;
use App\Models\Masjid;
use App\Models\Schedule;
use App\Models\Shalat;
use App\Models\User;
use App\Models\UserNotification;
use App\Services\ScheduleService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{

    protected $scheduleService;

    public function __construct(ScheduleService $scheduleService)
    {
        $this->scheduleService = $scheduleService;
    }

    private function createSchedule($validated)
    {
        foreach ($validated['shalat_id'] as $shalatId) {
            $shalat = Shalat::find($shalatId);
            Schedule::create([
                'imam_id' => $validated['imam_id'],
                'masjid_id' => $validated['masjid_id'],
                'shalat_id' => $shalatId,
                'date' => $validated['date'] . ' ' . $shalat->start,
                'end' => $validated['date'] . ' ' . $shalat->end,
            ]);
        }
    }
    private function sendNotification($userId, $title, $content, $link)
    {
        UserNotification::create([
            'user_id' => $userId,
            'title' => $title,
            'content' => $content,
            'link' => $link,
            'is_displayed' => false,
        ]);
    }
    private function isScheduleConflict($date, $masjidId, $shalatId, $excludeId = null)
    {
        $query = Schedule::whereDate('date', $date)
            ->where('masjid_id', $masjidId)
            ->where('shalat_id', $shalatId);

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        return $query->exists();
    }


    public function index(Request $request)
    {
        $role = Auth::user()->Role->code;
        $schedules = $this->scheduleService->getSchedulesByRole($role, $request);

        switch ($role) {
            case 'admin':
                return view("{$role}.jadwal.index", [
                    'jadwals' => $schedules,
                    'imams' => Imam::all(),
                    'masjids' => Masjid::all(),
                    'shalats' => Shalat::all(),
                ]);
            case 'imam':
                return view("{$role}.jadwal.index", [
                    'jadwals' => $schedules['jadwals'],
                    'jadwalBadals' => $schedules['jadwalBadals']
                ]);
        }
    }

    public function create()
    {
        $role = Auth::user()->Role->code;

        $imams = Imam::all();
        $masjids = Masjid::all();
        $shalats = Shalat::all();
        return view("{$role}.jadwal.create", compact('imams', 'masjids', 'shalats'));
    }

    public function fetch(Request $request)
    {
        $events = Schedule::with(['imam', 'masjid', 'shalat'])
            ->filterByImam($request->input('filter_imam'))
            ->filterByShalat($request->input('filter_shalat'))
            ->filterByMasjid($request->input('filter_masjid'))
            ->get()
            ->map(fn($schedule) => [
                'id' => $schedule->id,
                'title' => $schedule->shalat->name . ' - ' . $schedule->Imam->fullname,
                'start' => $schedule->date,
                'masjid_id' => $schedule->masjid_id,
                'shalat_id' => $schedule->shalat_id,
                'end' => $schedule->end,
                'extendedProps' => [
                    'imam' => $schedule->Imam->fullname,
                    'masjid' => $schedule->masjid->name,
                    'shalat' => $schedule->shalat->name,
                ]
            ]);

        return response()->json($events);
    }

    public function store(StoreScheduleRequest $request)
    {
        $role = Auth::user()->Role->code;
        $validated = $request->validated();

        foreach ($validated['shalat_id'] as $shalatId) {
            if ($this->isScheduleConflict($validated['date'], $validated['masjid_id'], $validated['shalat_id'], $schedule->id ?? null)) {
                return back()->withErrors(['error' => 'Jadwal bentrok.']);
            }
        }

        $this->createSchedule($validated);

        return redirect()->route("{$role}.jadwal.index")->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit(Schedule $schedule)
    {
        $role = Auth::user()->Role->code;
        $shalats = Shalat::all();
        $masjids = Masjid::all();
        $imams = Imam::where('id', '!=', $schedule->imam_id)->get();

        return view("{$role}.jadwal.edit", compact('schedule', 'masjids', 'shalats', 'imams'));
    }

    public function update(UpdateScheduleRequest $request, Schedule $schedule)
    {
        $role = Auth::user()->Role->code;
        $validated = $request->validated();

        $inputDate = Carbon::parse($validated['date'])->toDateString();

        if ($this->isScheduleConflict($validated['date'], $validated['masjid_id'], $validated['shalat_id'], $schedule->id ?? null)) {
            return back()->withErrors(['error' => 'Jadwal bentrok.']);
        }

        $validated['is_badal'] = true;
        $schedule->update($validated);
        $schedule = Schedule::with(['Shalat', 'Masjid', 'Badal'])->findOrFail($schedule->id);

        switch ($role) {
            case 'admin':
                if ($schedule->badal_id !== null) {
                    $this->sendNotification($schedule->Imam->user_id, 'Badal Telah Ditemukan', Auth::user()->name . " menyetujui jadwal shalat {$schedule->Shalat->name} pada {$schedule->date} di masjid {$schedule->Masjid->name} untuk dibadalkan oleh imam {$schedule->Badal->name}.", "/admin/jadwal/{$schedule->id}/edit");
                    $this->sendNotification($schedule->Badal->user_id, 'Jadwal Badal Telah Ditetapkan', Auth::user()->name . " mentetapkan jadwal shalat {$schedule->Shalat->name} pada {$schedule->date} di masjid {$schedule->Masjid->name} untuk kamu badalkan", "/admin/jadwal/{$schedule->id}/edit");
                }
                break;
            case 'imam':
                break;
        }
        return redirect()->route("{$role}.jadwal.index")->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $role = Auth::user()->Role->code;
        $jadwal = Schedule::findOrFail($id);
        $jadwal->delete();

        return redirect()->route("{$role}.jadwal.index")->with('success', 'Jadwal berhasil dihapus.');
    }

    public function updateJSON(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:schedules,id',
            'start' => 'required',
            'end' => 'nullable',
            'masjid_id' => 'required',
            'shalat_id' => 'required',
        ]);

        $date = Carbon::parse($validated['start'])->format('Y-m-d');

        if ($this->isScheduleConflict($date, $validated['masjid_id'], $validated['shalat_id'], $schedule->id ?? null)) {
            return response()->json(['error' => 'Jadwal bentrok.', 'success' => false]);
        }

        $schedule = Schedule::findOrFail($validated['id']);
        $schedule->update([
            'date' => Carbon::parse($validated['start'])->format('Y-m-d H:i:s'),
            'end' => $validated['end'] ? Carbon::parse($validated['end'])->format('Y-m-d H:i:s') : null,
        ]);

        return response()->json(['success' => true]);
    }


    public function imamCariBadal(Request $request, Schedule $schedule)
    {
        $schedule = Schedule::with(['Shalat', 'Masjid', 'Badal'])->findOrFail($schedule->id);

        $schedule->update([
            'note' => $request->note,
            'is_badal' => true
        ]);

        User::where('role_id', 2)->get()->each(function ($admin) use ($schedule) {
            $this->sendNotification(
                $admin->id,
                'Jadwal Badal',
                Auth::user()->Imam->fullname . " meminta jadwal badal untuk shalat {$schedule->Shalat->name} pada {$schedule->date} di masjid {$schedule->Masjid->name}.",
                "/admin/jadwal/{$schedule->id}/edit"
            );
        });

        return redirect()->route('imam.jadwal.index')->with('success', 'Badal berhasil dicarikan.');
    }

    public function imamDone(Schedule $schedule)
    {
        $schedule->update(['status' => 'done']);
        return redirect()->route('imam.jadwal.index')->with('success', 'Jadwal berhasil diselesaikan.');
    }

    public function imamCancel(Schedule $schedule)
    {
        $schedule->update(['badal_id' => null]);
        return redirect()->route('imam.jadwal.index')->with('success', 'Badal berhasil dibatalkan.');
    }

    public function destroySelected(Request $request)
    {
        $jadwalIds = $request->input('jadwal_id', []);

        if (empty($jadwalIds)) {
            return redirect()->back()->with('error', 'Tidak ada data yang dipilih untuk dihapus.');
        }


        Schedule::whereIn('id', $jadwalIds)->delete();

        return redirect()->back()->with('success', 'Jadwal berhasil dihapus.');
    }
}
