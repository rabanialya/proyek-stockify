<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SupplierTest extends TestCase
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

    public function test_admin_can_view_supplier_list(): void
    {
        $admin = $this->createAdmin();

        Supplier::factory()->count(3)->create();

        $response = $this
            ->actingAs($admin)
            ->get(route('suppliers.index'));

        $response->assertOk();
        $response->assertViewIs('pages.suppliers.index');
        $response->assertViewHas('suppliers');
    }

    public function test_admin_can_create_supplier(): void
    {
        $admin = $this->createAdmin();

        $response = $this
            ->actingAs($admin)
            ->post(route('suppliers.store'), [
                'name' => 'PT Teknologi Indonesia',
                'contact_person' => 'Rian Pratama',
                'phone' => '081234567899',
                'email' => 'rian@teknologi.test',
                'address' => 'Jakarta Selatan',
                'is_active' => true,
            ]);

        $response->assertRedirect(route('suppliers.index'));

        $this->assertDatabaseHas('suppliers', [
            'name' => 'PT Teknologi Indonesia',
            'contact_person' => 'Rian Pratama',
            'phone' => '081234567899',
            'email' => 'rian@teknologi.test',
            'address' => 'Jakarta Selatan',
            'is_active' => true,
        ]);
    }

    public function test_admin_can_update_supplier(): void
    {
        $admin = $this->createAdmin();

        $supplier = Supplier::factory()->create([
            'name' => 'PT Supplier Lama',
            'email' => 'lama@supplier.test',
        ]);

        $response = $this
            ->actingAs($admin)
            ->put(route('suppliers.update', $supplier->id), [
                'name' => 'PT Supplier Baru',
                'contact_person' => 'Kontak Baru',
                'phone' => '081111111111',
                'email' => 'baru@supplier.test',
                'address' => 'Bandung',
                'is_active' => false,
            ]);

        $response->assertRedirect(route('suppliers.index'));

        $this->assertDatabaseHas('suppliers', [
            'id' => $supplier->id,
            'name' => 'PT Supplier Baru',
            'contact_person' => 'Kontak Baru',
            'phone' => '081111111111',
            'email' => 'baru@supplier.test',
            'address' => 'Bandung',
            'is_active' => false,
        ]);
    }

    public function test_admin_can_delete_supplier(): void
    {
        $admin = $this->createAdmin();

        $supplier = Supplier::factory()->create();

        $response = $this
            ->actingAs($admin)
            ->delete(route('suppliers.destroy', $supplier->id));

        $response->assertRedirect(route('suppliers.index'));

        $this->assertDatabaseMissing('suppliers', [
            'id' => $supplier->id,
        ]);
    }

    public function test_staff_cannot_access_supplier_page(): void
    {
        $role = Role::factory()->create([
            'name' => 'Staff Gudang',
            'slug' => Role::WAREHOUSE_STAFF,
        ]);

        $staff = User::factory()->create([
            'role_id' => $role->id,
        ]);

        $response = $this
            ->actingAs($staff)
            ->get(route('suppliers.index'));

        $response->assertForbidden();
    }
}