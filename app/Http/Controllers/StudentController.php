<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use App\Models\User;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::where('is_active', true)->get();
        return view('admin.student.index', compact('students'));
    }

    public function create()
    {
        return view('admin.student.create');
    }

    public function store(StoreStudentRequest $request)
    {
        $validated = $request->validated();
        $user = User::create([
            'username' => $validated['username'],
            'email' => $validated['email'] ?? null,
            'password' => $validated['password'],
            'name' => $validated['fullname'],
            'role_id' => 4,
        ]);

        Student::create([
            'user_id' => $user->id,
            'fullname' => $validated['fullname'],
            'birthplace' => $validated['birthplace'],
            'birthdate' => $validated['birthdate'],
            'address' => $validated['address'] ?? null,
            'school' => $validated['school'],
            'father_name' => $validated['father_name'],
            'father_job' => $validated['father_job'],
            'mother_name' => $validated['mother_name'],
            'mother_job' => $validated['mother_job'],
            'motivation' => $validated['motivation'] ?? null,
            'class_time' => $validated['class_time'],
            'residence_status' => $validated['residence_status'],
            'infaq' => $validated['infaq'],
            'whatsapp' => $validated['whatsapp'],
            'youtube_link' => $validated['youtube_link'] ?? null,
            'is_active' => true,
        ]);

        return redirect()->route('admin.student.index')->with('success', 'Santri berhasil ditambahkan.');
    }

    public function show(Student $student)
    {
        return view('admin.student.show', compact('student'));
    }

    public function edit(Student $student)
    {
        return view('admin.student.edit', compact('student'));
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        $user = User::findOrFail($student->user_id);
        $validated = $request->validated();

        $user->update([
            'username' => $validated['username'],
            'email' => $validated['email'] ?? null,
            'name' => $validated['fullname'],
        ]);

        $student->update([
            'fullname' => $validated['fullname'],
            'birthplace' => $validated['birthplace'],
            'birthdate' => $validated['birthdate'],
            'address' => $validated['address'] ?? null,
            'school' => $validated['school'],
            'father_name' => $validated['father_name'],
            'father_job' => $validated['father_job'],
            'mother_name' => $validated['mother_name'],
            'mother_job' => $validated['mother_job'],
            'motivation' => $validated['motivation'] ?? null,
            'class_time' => $validated['class_time'],
            'residence_status' => $validated['residence_status'],
            'infaq' => $validated['infaq'],
            'whatsapp' => $validated['whatsapp'],
            'youtube_link' => $validated['youtube_link'] ?? null,
        ]);

        return redirect()->route('admin.student.index', $student->id)->with('success', 'Santri berhasil diperbarui.');
    }

    public function destroy(Student $student)
    {
        $student->User->delete();
        return redirect()->route('admin.student.index')->with('success', 'Santri berhasil dihapus.');
    }

    public function detail(Student $student)
    {
        $user = $student->User;
        $memorizations = $student->Memorizations;
        return view('admin.student.detail', compact('student', 'user', 'memorizations'));
    }

    public function isActive()
    {
        $students = Student::where('is_active', false)->get();
        return view('admin.student.is_active', compact('students'));
    }

    public function isActiveUpdate(Student $student)
    {
        $student->update(['is_active' => true]);
        return redirect()->route('admin.student.is_active')->with('success', 'Santri berhasil diaktifkan.');
    }

    public function isActiveUpdateFalse(Student $student)
    {
        $student->update(['is_active' => false]);
        return redirect()->route('admin.student.index')->with('success', 'Santri berhasil dinonaktifkan.');
    }
}
