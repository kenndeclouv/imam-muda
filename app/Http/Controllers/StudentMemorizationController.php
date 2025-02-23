<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentMemorization;
use App\Models\Student;
use App\Models\Imam;
use Illuminate\Support\Facades\Auth;

class StudentMemorizationController extends Controller
{
    public function index()
    {
        $role = Auth::user()->Role->code;
        if ($role == 'admin') {
            $memorizations = StudentMemorization::all();
        } else if ($role == 'imam') {
            $memorizations = StudentMemorization::where('imam_id', Auth::user()->Imam->id)->get();
        } else if ($role == 'student') {
            $memorizations = StudentMemorization::where('student_id', Auth::user()->Student->id)->get();
        }
        return view("{$role}.student.memorization.index", compact('memorizations'));
    }

    public function create()
    {
        $role = Auth::user()->Role->code;
        if ($role == 'admin') {
            $students = Student::all();
            $imams = Imam::all();
        } else if ($role == 'imam') {
            $students = Student::all();
            $imams = [];
        } else if ($role == 'student') {
            $students = [];
            $imams = Imam::all();
        }

        return view("{$role}.student.memorization.create", compact('students', 'imams'));
    }

    public function store(Request $request)
    {
        $role = Auth::user()->Role->code;
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'imam_id' => 'nullable|exists:imams,id',
            'surah_number' => 'required|integer|min:1|max:114',
            'from' => 'required|integer|min:1|max:286',
            'to' => 'required|integer|min:1|max:286',
            'is_continue' => 'nullable|boolean',
            'date' => 'required|date'
        ], [
            'student_id.required' => 'Santri harus diisi',
            'student_id.exists' => 'Santri tidak ditemukan',
            'imam_id.required' => 'Ustadz harus diisi',
            'imam_id.exists' => 'Ustadz tidak ditemukan',
            'surah_number.required' => 'Surat harus diisi',
            'surah_number.min' => 'Surat harus lebih besar dari al-fatiha',
            'surah_number.max' => 'Surat harus lebih kecil dari an-nas',
            'from.required' => 'Ayat awal harus diisi',
            'from.integer' => 'Ayat awal harus berupa angka',
            'from.min' => 'Ayat awal harus lebih besar dari 0',
            'from.max' => 'Ayat awal harus lebih kecil dari 286',
            'to.required' => 'Ayat akhir harus diisi',
            'to.integer' => 'Ayat akhir harus berupa angka',
            'to.min' => 'Ayat akhir harus lebih besar dari 0',
            'to.max' => 'Ayat akhir harus lebih kecil dari 286',
            'date.required' => 'Tanggal harus diisi',
            'date.date' => 'Tanggal harus berupa tanggal',
        ]);
        StudentMemorization::create($validated);
        return redirect()->route("{$role}.student.memorization.index")->with('success', 'Hafalan berhasil ditambahkan.');
    }

    public function show(StudentMemorization $memorization)
    {
        $role = Auth::user()->Role->code;
        return view("{$role}.student.memorization.show", compact('memorization'));
    }

    public function edit(StudentMemorization $memorization)
    {
        $role = Auth::user()->Role->code;
        if ($role == 'admin') {
            $students = Student::all();
            $imams = Imam::all();
        } else if ($role == 'imam') {
            $students = Student::all();
            $imams = [];
        } else if ($role == 'student') {
            $students = [];
            $imams = Imam::all();
        }
        return view("{$role}.student.memorization.edit", compact('memorization', 'students', 'imams'));
    }

    public function update(Request $request, StudentMemorization $memorization)
    {
        $role = Auth::user()->Role->code;
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'imam_id' => 'nullable|exists:imams,id',
            'surah_number' => 'required|integer|min:1|max:114',
            'from' => 'required|integer|min:1|max:286',
            'to' => 'required|integer|min:1|max:286',
            'is_continue' => 'nullable|boolean',
            'date' => 'required|date'
        ], [
            'student_id.required' => 'Santri harus diisi',
            'student_id.exists' => 'Santri tidak ditemukan',
            'imam_id.required' => 'Ustadz harus diisi',
            'imam_id.exists' => 'Ustadz tidak ditemukan',
            'surah_number.required' => 'Surat harus diisi',
            'surah_number.min' => 'Surat harus lebih besar dari al-fatiha',
            'surah_number.max' => 'Surat harus lebih kecil dari an-nas',
            'from.required' => 'Ayat awal harus diisi',
            'from.integer' => 'Ayat awal harus berupa angka',
            'from.min' => 'Ayat awal harus lebih besar dari 0',
            'from.max' => 'Ayat awal harus lebih kecil dari 286',
            'to.required' => 'Ayat akhir harus diisi',
            'to.integer' => 'Ayat akhir harus berupa angka',
            'to.min' => 'Ayat akhir harus lebih besar dari 0',
            'to.max' => 'Ayat akhir harus lebih kecil dari 286',
            'date.required' => 'Tanggal harus diisi',
            'date.date' => 'Tanggal harus berupa tanggal',
        ]);

        $memorization->update($validated);

        return redirect()->route("{$role}.student.memorization.index")->with('success', 'Hafalan berhasil diperbarui.');
    }

    public function destroy(StudentMemorization $memorization)
    {
        $role = Auth::user()->Role->code;
        $memorization->delete();
        return redirect()->route("{$role}.student.memorization.index")->with('success', 'Hafalan berhasil dihapus.');
    }

    public function isContinueTrue(StudentMemorization $memorization)
    {
        $role = Auth::user()->Role->code;
        $memorization->is_continue = true;
        $memorization->save();
        return redirect()->route("{$role}.student.memorization.index")->with('success', 'Hafalan Santri lulus.');
    }

    public function isContinueFalse(StudentMemorization $memorization)
    {
        $role = Auth::user()->Role->code;
        $memorization->is_continue = false;
        $memorization->save();
        return redirect()->route("{$role}.student.memorization.index")->with('success', 'Hafalan Santri tidak lulus.');
    }
}
