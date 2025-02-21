<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreImamRequest;
use App\Http\Requests\StoreStudentRequest;
use App\Models\Account;
use App\Models\Imam;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }
    public function imam()
    {
        return view('auth.imam-register');
    }
    public function student()
    {
        return view('auth.student-register');
    }

    public function storeImam(StoreImamRequest $request)
    {
        $validated = $request->validated();

        // Simpan user
        $user = User::create([
            'username' => $validated['username'],
            'email' => $validated['email'] ?? null,
            'password' => $validated['password'],
            'name' => $validated['fullname'],
            'role_id' => 3,
        ]);

        // Simpan admin
        Imam::create([
            'user_id' => $user->id,
            'fullname' => $validated['fullname'],
            'phone' => $validated['phone'],
            'birthplace' => $validated['birthplace'],
            'birthdate' => $validated['birthdate'],
            'juz' => $validated['juz'],
            'school' => $validated['school'],
            'description' => $validated['description'] ?? null,
            'address' => $validated['address'] ?? null,
            'join_date' => $validated['join_date'],
            'no_rekening' => $validated['no_rekening'],
            'status' => $validated['status'],
            'child_count' => $validated['child_count'],
            'wife_count' => $validated['wife_count'],
            'is_active' => false,
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat.');
    }

    public function storeStudent(StoreStudentRequest $request)
    {
        $validated = $request->validated();

        // Create user
        $user = User::create([
            'username' => $validated['username'],
            'email' => $validated['email'] ?? null,
            'password' => $validated['password'],
            'name' => $validated['fullname'],
            'role_id' => 4,
        ]);

        // Create student
        Student::create([
            'user_id' => $user->id,
            'fullname' => $validated['fullname'],
            'birthplace' => $validated['birthplace'],
            'birthdate' => $validated['birthdate'],
            'address' => $validated['address'],
            'school' => $validated['school'],
            'father_name' => $validated['father_name'],
            'father_job' => $validated['father_job'],
            'mother_name' => $validated['mother_name'],
            'mother_job' => $validated['mother_job'],
            'motivation' => $validated['motivation'],
            'class_time' => $validated['class_time'],
            'residence_status' => $validated['residence_status'],
            'infaq' => $validated['infaq'],
            'whatsapp' => $validated['whatsapp'],
            'youtube_link' => $validated['youtube_link'],
            'is_active' => false,
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat.');
    }
}
