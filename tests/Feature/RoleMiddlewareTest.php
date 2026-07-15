<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class RoleMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    public function test_role_middleware_allows_matching_role(): void
    {
        Route::middleware(['web', 'auth', 'role:admin'])
            ->get('/test-admin', fn () => 'allowed');

        $adminRole = Role::factory()->create(['slug' => Role::ADMIN]);
        $admin = User::factory()->create(['role_id' => $adminRole->id]);

        $this->actingAs($admin)->get('/test-admin')->assertOk();
    }

    public function test_role_middleware_rejects_non_matching_role(): void
    {
        Route::middleware(['web', 'auth', 'role:admin'])
            ->get('/test-admin', fn () => 'allowed');

        $staffRole = Role::factory()->create(['slug' => Role::WAREHOUSE_STAFF]);
        $staff = User::factory()->create(['role_id' => $staffRole->id]);

        $this->actingAs($staff)->get('/test-admin')->assertForbidden();
    }
}
