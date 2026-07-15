<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['role' => Role::ADMIN, 'name' => 'Admin Stockify', 'email' => 'admin@stockify.test'],
            ['role' => Role::WAREHOUSE_MANAGER, 'name' => 'Manajer Gudang', 'email' => 'manager@stockify.test'],
            ['role' => Role::WAREHOUSE_STAFF, 'name' => 'Staff Gudang', 'email' => 'staff@stockify.test'],
        ];

        foreach ($users as $user) {
            $roleId = Role::query()->where('slug', $user['role'])->valueOrFail('id');

            User::query()->updateOrCreate(
                ['email' => $user['email']],
                [
                    'role_id' => $roleId,
                    'name' => $user['name'],
                    'email_verified_at' => now(),
                    'password' => Hash::make('password'),
                ]
            );
        }
    }
}
