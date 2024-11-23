<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateScheduleRequest extends FormRequest
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
            'masjid_id' => 'required|exists:masjids,id',
            'shalat_id' => 'exists:shalats,id',
            'date' => 'required|date',
            'status' => 'required|in:to_do,done',
            'is_badal' => 'nullable|in:0,1',
            'badal_id' => 'nullable|exists:imams,id',
            'note' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'shalat_id.exists' => 'Shalat tidak ditemukan.',
            'date.required' => 'Tanggal harus diisi.',
            'date.date' => 'Tanggal harus berupa tanggal yang valid.',
            'status.required' => 'Status harus diisi.',
            'status.in' => 'Status harus berupa akan dilaksanakan atau sudah dilaksanakan.',
            'is_badal.in' => 'Status harus berupa tidak badal atau badal.',
            'badal_id.exists' => 'Imam tidak ditemukan.',
            'note.string' => 'Catatan harus berupa string.',
        ];
    }
}
