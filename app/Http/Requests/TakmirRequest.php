<?php

/**
 * File ini dibuat secara otomatis oleh perintah MakeFormRequest / make:form-req.
 * Kamu dapat memodifikasi file ini.
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TakmirRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'fullname' => 'string|max:255|required',
            'phone' => 'string|max:255',
            'address' => 'string|max:255',
        ];
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['fullname'] = 'sometimes|string|max:255';
            $rules['phone'] = 'sometimes|string|max:255';
            $rules['address'] = 'sometimes|string|max:255';
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'fullname.string' => 'fullname harus berupa string.',
            'fullname.max' => 'fullname tidak boleh lebih dari 255 karakter.',
            'fullname.required' => 'fullname harus diisi.',
            'phone.string' => 'phone harus berupa string.',
            'phone.max' => 'phone tidak boleh lebih dari 255 karakter.',
            'address.string' => 'address harus berupa string.',
            'address.max' => 'address tidak boleh lebih dari 255 karakter.',
        ];
    }
}
