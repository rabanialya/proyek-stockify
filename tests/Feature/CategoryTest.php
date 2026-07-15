<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    private function createAdmin(): User
    {
        $role = Role::factory()->create([
            'name' => 'Admin',
            'slug' => Role::ADMIN,
        ]);

        return User::factory()->create([
            'role_id' => $role->id,
        ]);
    }

    public function test_admin_can_view_category_list(): void
    {
        $admin = $this->createAdmin();

        Category::factory()->count(3)->create();

        $response = $this
            ->actingAs($admin)
            ->get(route('categories.index'));

        $response->assertOk();
        $response->assertViewIs('pages.categories.index');
        $response->assertViewHas('categories');
    }

    public function test_admin_can_create_category(): void
    {
        $admin = $this->createAdmin();

        $response = $this
            ->actingAs($admin)
            ->post(route('categories.store'), [
                'name' => 'Peralatan Kantor',
                'description' => 'Perlengkapan operasional kantor.',
                'is_active' => true,
            ]);

        $response->assertRedirect(route('categories.index'));

        $this->assertDatabaseHas('categories', [
            'name' => 'Peralatan Kantor',
            'slug' => 'peralatan-kantor',
            'description' => 'Perlengkapan operasional kantor.',
            'is_active' => true,
        ]);
    }

    public function test_admin_can_update_category(): void
    {
        $admin = $this->createAdmin();

        $category = Category::factory()->create([
            'name' => 'Peralatan Lama',
            'slug' => 'peralatan-lama',
        ]);

        $response = $this
            ->actingAs($admin)
            ->put(route('categories.update', $category->id), [
                'name' => 'Peralatan Baru',
                'description' => 'Deskripsi kategori diperbarui.',
                'is_active' => false,
            ]);

        $response->assertRedirect(route('categories.index'));

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => 'Peralatan Baru',
            'slug' => 'peralatan-baru',
            'description' => 'Deskripsi kategori diperbarui.',
            'is_active' => false,
        ]);
    }

    public function test_admin_can_delete_category(): void
    {
        $admin = $this->createAdmin();

        $category = Category::factory()->create();

        $response = $this
            ->actingAs($admin)
            ->delete(route('categories.destroy', $category->id));

        $response->assertRedirect(route('categories.index'));

        $this->assertDatabaseMissing('categories', [
            'id' => $category->id,
        ]);
    }

    public function test_staff_cannot_access_category_page(): void
    {
        $staffRole = Role::factory()->create([
            'name' => 'Staff Gudang',
            'slug' => Role::WAREHOUSE_STAFF,
        ]);

        $staff = User::factory()->create([
            'role_id' => $staffRole->id,
        ]);

        $response = $this
            ->actingAs($staff)
            ->get(route('categories.index'));

        $response->assertForbidden();
    }
}