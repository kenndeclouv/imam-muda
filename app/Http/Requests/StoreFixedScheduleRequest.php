<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFixedScheduleRequest extends FormRequest
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
            'imam_id' => 'required|exists:imams,id',
            'masjid_id' => 'required|exists:masjids,id',
            'shalat_id' => 'required|exists:shalats,id',
            'day' => 'required|in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
        ];
    }

    public function messages()
    {
        return [
            'imam_id.required' => 'Imam harus dipilih.',
            'imam_id.exists' => 'Imam tidak ditemukan.',
            'masjid_id.required' => 'Masjid harus dipilih.',
            'masjid_id.exists' => 'Masjid tidak ditemukan.',
            'shalat_id.required' => 'Shalat harus dipilih.',
            'shalat_id.exists' => 'Shalat tidak ditemukan.',
            'day.required' => 'Hari harus diisi.',
            'day.in' => 'Hari harus berupa monday, tuesday, wednesday, thursday, friday, saturday, sunday.',
        ];
    }
}
