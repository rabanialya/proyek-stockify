<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStockInRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => [
                'required',
                'exists:products,id',
            ],

            'qty' => [
                'required',
                'integer',
                'min:1',
            ],

            'purchase_price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'date' => [
                'required',
                'date',
            ],

            'note' => [
                'nullable',
                'string',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.required' => 'Produk wajib dipilih.',
            'product_id.exists' => 'Produk tidak ditemukan.',

            'qty.required' => 'Jumlah stok wajib diisi.',
            'qty.integer' => 'Jumlah harus berupa angka.',
            'qty.min' => 'Jumlah minimal 1.',

            'purchase_price.required' => 'Harga beli per unit wajib diisi.',
            'purchase_price.numeric'  => 'Harga beli harus berupa angka.',
            'purchase_price.min'      => 'Harga beli tidak boleh negatif.',

            'date.required' => 'Tanggal wajib diisi.',
            'date.date' => 'Format tanggal tidak valid.',

            'note.string' => 'Keterangan harus berupa teks.',
        ];
    }
}