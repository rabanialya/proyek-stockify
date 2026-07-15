<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            ['name' => 'Admin', 'slug' => Role::ADMIN, 'description' => 'Mengelola seluruh aspek aplikasi'],
            ['name' => 'Manajer Gudang', 'slug' => Role::WAREHOUSE_MANAGER, 'description' => 'Bertanggung jawab atas manajemen stok barang'],
            ['name' => 'Staff Gudang', 'slug' => Role::WAREHOUSE_STAFF, 'description' => 'Membantu operasional gudang sehari-hari'],
        ] as $role) {
            Role::query()->updateOrCreate(['name' => $role['name']], $role);
        }
    }
}
