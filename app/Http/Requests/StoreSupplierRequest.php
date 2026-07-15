<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupplierRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:suppliers,name',
            ],
            'contact_person' => [
                'nullable',
                'string',
                'max:255',
            ],
            'phone' => [
                'nullable',
                'string',
                'max:30',
            ],
            'email' => [
                'nullable',
                'email',
                'max:255',
                'unique:suppliers,email',
            ],
            'address' => [
                'nullable',
                'string',
            ],
            'is_active' => [
                'required',
                'boolean',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama supplier wajib diisi.',
            'name.string' => 'Nama supplier harus berupa teks.',
            'name.max' => 'Nama supplier maksimal 255 karakter.',
            'name.unique' => 'Nama supplier sudah digunakan.',

            'contact_person.string' => 'Nama kontak harus berupa teks.',
            'contact_person.max' => 'Nama kontak maksimal 255 karakter.',

            'phone.string' => 'Nomor telepon harus berupa teks.',
            'phone.max' => 'Nomor telepon maksimal 30 karakter.',

            'email.email' => 'Format email supplier tidak valid.',
            'email.max' => 'Email supplier maksimal 255 karakter.',
            'email.unique' => 'Email supplier sudah digunakan.',

            'address.string' => 'Alamat supplier harus berupa teks.',

            'is_active.required' => 'Status supplier wajib dipilih.',
            'is_active.boolean' => 'Status supplier tidak valid.',
        ];
    }
}