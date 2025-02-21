<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentMemorization;
use App\Models\Student;
use App\Models\Imam;

class StudentMemorizationController extends Controller
{
    public function index()
    {
        $memorizations = StudentMemorization::all();
        return view('admin.student.memorization.index', compact('memorizations'));
    }

    public function create()
    {
        $students = Student::all();
        $imams = Imam::all();
        return view('admin.student.memorization.create', compact('students', 'imams'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'imam_id' => 'nullable|exists:imams,id',
            'surah_number' => 'required|integer|min:1|max:114',
            'from' => 'required|integer|min:1',
            'to' => 'required|integer|min:1',
            'is_continue' => 'nullable|boolean',
            'date' => 'required|date'
        ], [
            'student_id.required' => 'Santri harus diisi',
            'imam_id.required' => 'Ustadz harus diisi',
            'surah_number.required' => 'Surat harus diisi',
            'surah_number.min' => 'Surat harus lebih besar dari 0',
            'surah_number.max' => 'Surat harus lebih kecil dari 114',
            'from.required' => 'Dari harus diisi',
            'to.required' => 'Sampai harus diisi',
            'date.required' => 'Tanggal harus diisi',
            'from.min' => 'Dari harus lebih besar dari 0',
            'to.min' => 'Sampai harus lebih besar dari 0',
            'date.date' => 'Tanggal harus berupa tanggal',
        ]);
        StudentMemorization::create($validated);
        return redirect()->route('admin.student.memorization.index')->with('success', 'Hafalan berhasil ditambahkan.');
    }

    public function show(StudentMemorization $memorization)
    {
        return view('admin.student.memorization.show', compact('memorization'));
    }

    public function edit(StudentMemorization $memorization)
    {
        $students = Student::all();
        $imams = Imam::all();
        return view('admin.student.memorization.edit', compact('memorization', 'students', 'imams'));
    }

    public function update(Request $request, StudentMemorization $memorization)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'imam_id' => 'nullable|exists:imams,id',
            'surah_number' => 'required|integer|min:1|max:114',
            'from' => 'required|integer|min:1',
            'to' => 'required|integer|min:1',
            'is_continue' => 'nullable|boolean',
            'date' => 'required|date'
        ], [
            'student_id.required' => 'Santri harus diisi',
            'imam_id.required' => 'Ustadz harus diisi',
            'surah_number.required' => 'Surat harus diisi',
            'surah_number.min' => 'Surat harus lebih besar dari al-fatiha',
            'surah_number.max' => 'Surat harus lebih kecil dari an-nas',
            'from.required' => 'Dari harus diisi',
            'to.required' => 'Sampai harus diisi',
            'date.required' => 'Tanggal harus diisi',
            'from.min' => 'Ayat harus lebih besar dari 0',
            'to.min' => 'Ayat harus lebih besar dari 0',
            'date.date' => 'Tanggal harus berupa tanggal',
        ]);

        $memorization->update($validated);

        return redirect()->route('admin.student.memorization.index')->with('success', 'Hafalan berhasil diperbarui.');
    }

    public function destroy(StudentMemorization $memorization)
    {
        $memorization->delete();
        return redirect()->route('admin.student.memorization.index')->with('success', 'Hafalan berhasil dihapus.');
    }
}
