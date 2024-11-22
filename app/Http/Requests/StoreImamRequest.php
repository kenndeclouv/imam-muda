<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreImamRequest extends FormRequest
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
            'username' => 'required|string|max:50',
            'email' => 'nullable|email|max:255',
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|same:password',
            'photo' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:5000',
            'fullname' => 'required|string|max:50',
            'phone' => 'required|string|max:20',
            'birthplace' => 'required|string|max:100',
            'birthdate' => 'required|date',
            'juz' => 'nullable|integer',
            'school' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
        ];
    }
    public function messages()
    {
        return [
            'username.required' => 'Username harus diisi.',
            'username.string' => 'Username harus berupa string.',
            'username.max' => 'Username maksimal 50 karakter.',
            'password.required' => 'Password harus diisi.',
            'password.string' => 'Password harus berupa string.',
            'password.min' => 'Password minimal 8 karakter.',
            'confirm_password.required' => 'Konfirmasi password harus diisi.',
            'confirm_password.same' => 'Konfirmasi password harus sama dengan password.',
            'email.email' => 'Email harus berupa email yang valid.',
            'fullname.required' => 'Nama harus diisi.',
            'fullname.string' => 'Nama harus berupa string.',
            'fullname.max' => 'Nama maksimal 50 karakter.',
            'phone.required' => 'Nomor telepon harus diisi.',
            'phone.string' => 'Nomor telepon harus berupa string.',
            'phone.max' => 'Nomor telepon maksimal 20 karakter.',
            'birthplace.required' => 'Tempat lahir harus diisi.',
            'birthplace.string' => 'Tempat lahir harus berupa string.',
            'birthplace.max' => 'Tempat lahir maksimal 100 karakter.',
            'birthdate.required' => 'Tanggal lahir harus diisi.',
            'photo.mimes' => 'Foto harus berupa gambar dengan format jpeg, png, jpg, atau gif.',
            'photo.max' => 'Foto maksimal 5MB.',
            'address.max' => 'Alamat maksimal 255 karakter.',
            'juz.integer' => 'Juz harus berupa angka.',
            'school.max' => 'Sekolah maksimal 100 karakter.',
        ];
    }
}
