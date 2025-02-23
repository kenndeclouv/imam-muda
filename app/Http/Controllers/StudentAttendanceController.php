<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentAttendanceController extends Controller
{
    public function index()
    {
        $role = Auth::user()->Role->code;
        if ($role == 'musyrif') {
            $attendances = StudentAttendance::all();
        } else if ($role == 'student') {
            $attendances = StudentAttendance::where('student_id', Auth::user()->Student->id)->get();
        }
        return view("{$role}.student.attendance.index", compact('attendances'));
    }

    public function show(StudentAttendance $attendance)
    {
        $role = Auth::user()->Role->code;
        return view("{$role}.student.attendance.show", compact('attendance'));
    }

    public function create()
    {
        $role = Auth::user()->Role->code;
        if ($role == 'musyrif') {
            $students = Student::all();
        } else if ($role == 'student') {
            $students = [];
        }
        return view("{$role}.student.attendance.create", compact('students'));
    }

    public function store(Request $request)
    {
        $role = Auth::user()->Role->code;
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'date' => 'required|date',
            'status' => 'required|in:hadir,sakit,izin',
            'description' => 'nullable|string',
        ], [
            'student_id.required' => 'Santri harus diisi.',
            'student_id.exists' => 'Santri tidak ditemukan.',
            'date.required' => 'Tanggal harus diisi.',
            'date.date' => 'Tanggal harus berupa tanggal.',
            'status.required' => 'Status harus diisi.',
            'status.in' => 'Status harus berupa hadir, sakit, atau izin.',
            'description.string' => 'Keterangan harus berupa teks.',
        ]);

        $existingAttendance = StudentAttendance::where('student_id', $request->student_id)->where('date', $request->date)->first();
        if ($existingAttendance) {
            return back()->with('error', 'Kehadiran pada tanggal ini sudah ada.');
        }
        StudentAttendance::create($request->all());
        return redirect()->route("{$role}.student.attendance.index")->with('success', 'Kehadiran berhasil ditambahkan.');
    }

    public function storeMultiple(Request $request)
    {
        $role = Auth::user()->Role->code;

        $request->validate([
            'student_ids' => 'required|array',
            'student_ids.*' => 'exists:students,id',
            'date' => 'required|date',
            'status' => 'required|in:hadir,sakit,izin',
            'description' => 'nullable|string',
        ], [
            'student_ids.required' => 'Santri harus diisi.',
            'student_ids.*.exists' => 'Santri tidak ditemukan.',
            'date.required' => 'Tanggal harus diisi.',
            'date.date' => 'Tanggal harus berupa tanggal.',
            'status.required' => 'Status harus diisi.',
            'status.in' => 'Status harus berupa hadir, sakit, atau izin.',
            'description.string' => 'Keterangan harus berupa teks.',
        ]);

        foreach ($request->student_ids as $studentId) {
            StudentAttendance::create([
                'student_id' => $studentId,
                'date' => $request->date,
                'status' => $request->status,
                'description' => $request->description,
            ]);
            $existingAttendance = StudentAttendance::where('student_id', $studentId)->where('date', $request->date)->first();
            if ($existingAttendance) {
                return back()->with('error', 'Kehadiran pada tanggal ini sudah ada.');
            }
        }

        return redirect()->route("{$role}.student.attendance.index")->with('success', 'Kehadiran berhasil ditambahkan.');
    }

    public function edit(StudentAttendance $attendance)
    {
        $role = Auth::user()->Role->code;
        if ($role == 'musyrif') {
            $students = Student::all();
        } else if ($role == 'student') {
            $students = [];
        }
        return view("{$role}.student.attendance.edit", compact('attendance', 'students'));
    }

    public function update(Request $request, StudentAttendance $attendance)
    {
        $role = Auth::user()->Role->code;
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'date' => 'required|date',
            'status' => 'required|in:hadir,sakit,izin',
            'description' => 'nullable|string',
        ], [
            'student_id.required' => 'Santri harus diisi.',
            'student_id.exists' => 'Santri tidak ditemukan.',
            'date.required' => 'Tanggal harus diisi.',
            'date.date' => 'Tanggal harus berupa tanggal.',
            'status.required' => 'Status harus diisi.',
            'status.in' => 'Status harus berupa hadir, sakit, atau izin.',
            'description.string' => 'Keterangan harus berupa teks.',
        ]);

        $attendance->update($request->all());
        return redirect()->route("{$role}.student.attendance.index")->with('success', 'Kehadiran berhasil diubah.');
    }

    public function destroy(StudentAttendance $attendance)
    {
        $role = Auth::user()->Role->code;
        $attendance->delete();
        return redirect()->route("{$role}.student.attendance.index")->with('success', 'Kehadiran berhasil dihapus.');
    }
}
