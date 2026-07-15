<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Elektronik',
                'slug' => 'elektronik',
                'description' => 'Produk elektronik dan perangkat pendukung.',
                'is_active' => true,
            ],
            [
                'name' => 'Pakaian',
                'slug' => 'pakaian',
                'description' => 'Produk pakaian dan perlengkapan fashion.',
                'is_active' => true,
            ],
            [
                'name' => 'Makanan',
                'slug' => 'makanan',
                'description' => 'Produk makanan dan bahan konsumsi.',
                'is_active' => true,
            ],
            [
                'name' => 'Peralatan Rumah Tangga',
                'slug' => 'peralatan-rumah-tangga',
                'description' => 'Produk kebutuhan dan perlengkapan rumah tangga.',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::query()->updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
