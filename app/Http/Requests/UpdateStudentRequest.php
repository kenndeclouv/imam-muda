<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required|string|max:50|unique:users,username,' . $this->student->user_id,
            'email' => 'nullable|email|max:255|unique:users,email,' . $this->student->user_id,
            'fullname' => 'required|string|max:255',
            'birthplace' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'address' => 'nullable|string',
            'school' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'father_job' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'mother_job' => 'required|string|max:255',
            'motivation' => 'nullable|string',
            'class_time' => 'required|in:morning,evening',
            'residence_status' => 'required|in:mukim,non_mukim',
            'infaq' => 'required|string|max:255',
            'whatsapp' => 'required|string|max:255',
            'youtube_link' => 'nullable|string|max:255',
        ];
    }
    public function messages()
    {
        return [
            'username.required' => 'Username harus diisi.',
            'username.string' => 'Username harus berupa string.',
            'username.max' => 'Username maksimal 50 karakter.',
            'username.unique' => 'Username sudah terdaftar.',
            'email.email' => 'Email harus berupa email yang valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'fullname.required' => 'Nama harus diisi.',
            'fullname.string' => 'Nama harus berupa string.',
            'fullname.max' => 'Nama maksimal 255 karakter.',
            'birthplace.required' => 'Tempat lahir harus diisi.',
            'birthplace.string' => 'Tempat lahir harus berupa string.',
            'birthplace.max' => 'Tempat lahir maksimal 255 karakter.',
            'birthdate.required' => 'Tanggal lahir harus diisi.',
            'birthdate.date' => 'Tanggal lahir harus berupa tanggal yang valid.',
            'address.string' => 'Alamat harus berupa string.',
            'school.required' => 'Sekolah harus diisi.',
            'school.string' => 'Sekolah harus berupa string.',
            'school.max' => 'Sekolah maksimal 255 karakter.',
            'father_name.required' => 'Nama ayah harus diisi.',
            'father_name.string' => 'Nama ayah harus berupa string.',
            'father_name.max' => 'Nama ayah maksimal 255 karakter.',
            'father_job.required' => 'Pekerjaan ayah harus diisi.',
            'father_job.string' => 'Pekerjaan ayah harus berupa string.',
            'father_job.max' => 'Pekerjaan ayah maksimal 255 karakter.',
            'mother_name.required' => 'Nama ibu harus diisi.',
            'mother_name.string' => 'Nama ibu harus berupa string.',
            'mother_name.max' => 'Nama ibu maksimal 255 karakter.',
            'mother_job.required' => 'Pekerjaan ibu harus diisi.',
            'mother_job.string' => 'Pekerjaan ibu harus berupa string.',
            'mother_job.max' => 'Pekerjaan ibu maksimal 255 karakter.',
            'motivation.string' => 'Motivasi harus berupa string.',
            'motivation.max' => 'Motivasi maksimal 255 karakter.',
            'class_time.required' => 'Waktu kelas harus diisi.',
            'class_time.in' => 'Waktu kelas harus berupa pagi atau sore.',
            'residence_status.required' => 'Status tempat tinggal harus diisi.',
            'residence_status.in' => 'Status tempat tinggal harus berupa mukim atau non mukim.',
            'infaq.required' => 'Infaq harus diisi.',
            'infaq.string' => 'Infaq harus berupa string.',
            'infaq.max' => 'Infaq maksimal 255 karakter.',
            'whatsapp.required' => 'Whatsapp harus diisi.',
            'whatsapp.string' => 'Whatsapp harus berupa string.',
            'whatsapp.max' => 'Whatsapp maksimal 255 karakter.',
            'youtube_link.string' => 'Link Youtube harus berupa string.',
            'youtube_link.max' => 'Link Youtube maksimal 255 karakter.',
        ];
    }
}
