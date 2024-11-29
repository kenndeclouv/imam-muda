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
            'password' => 'required|string|min:8|confirmed|regex:/^(?=.*[A-Z]).+$/',
            'fullname' => 'required|string|max:50',
            'phone' => 'required|string|max:20',
            'birthplace' => 'required|string|max:100',
            'birthdate' => 'required|date',
            'juz' => 'nullable|integer',
            'school' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'join_date' => 'required|date',
            'no_rekening' => 'nullable|string|max:50',
            'status' => 'required|in:nikah,belum nikah',
            'child_count' => 'nullable|integer',
            'wife_count' => 'nullable|integer',
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
            'password.confirmed' => 'Password tidak cocok',
            'password.regex' => 'Password harus mengandung setidaknya satu huruf besar',
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
            'address.max' => 'Alamat maksimal 255 karakter.',
            'juz.integer' => 'Juz harus berupa angka.',
            'school.max' => 'Sekolah maksimal 100 karakter.',
            'join_date.required' => 'Tanggal bergabung harus diisi.',
            'join_date.date' => 'Tanggal bergabung harus berupa tanggal yang valid.',
            'no_rekening.string' => 'Nomor rekening harus berupa string.',
            'no_rekening.max' => 'Nomor rekening maksimal 50 karakter.',
            'status.in' => 'Status harus berupa nikah atau belum nikah.',
            'child_count.integer' => 'Jumlah anak harus berupa angka.',
            'wife_count.integer' => 'Jumlah istri harus berupa angka.',
        ];
    }
}
