<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = [
            [
                'name' => 'PT Sumber Elektronik',
                'contact_person' => 'Andi Wijaya',
                'phone' => '081234567801',
                'email' => 'andi@sumberelektronik.test',
                'address' => 'Jakarta Pusat',
                'is_active' => true,
            ],
            [
                'name' => 'CV Mitra Fashion',
                'contact_person' => 'Siti Rahma',
                'phone' => '081234567802',
                'email' => 'siti@mitrafashion.test',
                'address' => 'Bandung',
                'is_active' => true,
            ],
            [
                'name' => 'PT Pangan Nusantara',
                'contact_person' => 'Budi Santoso',
                'phone' => '081234567803',
                'email' => 'budi@pangannusantara.test',
                'address' => 'Surabaya',
                'is_active' => true,
            ],
            [
                'name' => 'CV Perlengkapan Sejahtera',
                'contact_person' => 'Dewi Lestari',
                'phone' => '081234567804',
                'email' => 'dewi@perlengkapansejahtera.test',
                'address' => 'Yogyakarta',
                'is_active' => true,
            ],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::query()->updateOrCreate(
                ['name' => $supplier['name']],
                $supplier
            );
        }
    }
}
