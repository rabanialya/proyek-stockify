<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InventoryExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Product::with(['category','supplier'])
            ->get()
            ->map(function ($product) {

                return [

                    'Produk' => $product->name,

                    'SKU' => $product->sku,

                    'Kategori' => $product->category->name,

                    'Supplier' => $product->supplier->name,

                    'Stok' => $product->stock,

                    'Minimum' => $product->minimum_stock,

                ];

            });
    }

    public function headings(): array
    {
        return [
            'Produk',
            'SKU',
            'Kategori',
            'Supplier',
            'Stok',
            'Minimum',
        ];
    }
}