<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_a_user_can_be_assigned_a_role()
    {
        $user = User::factory()->create();

        $role = Role::all()->random();

        $user->assignRole($role);
        $this->assertDatabaseHas('model_has_roles', [
            'model_id' => $user->id,
            'role_id' => $role->id
        ]);
    }

    public function test_a_user_can_be_removed_from_a_role()
    {
        $user = User::factory()->create();
        $role = Role::all()->random();

        $user->assignRole($role);

        $this->assertDatabaseHas('model_has_roles', [
            'model_id' => $user->id,
            'role_id' => $role->id
        ]);

        $user->removeRole($role);

        $this->assertDatabaseMissing('model_has_roles', [
            'model_id' => $user->id,
            'role_id' => $role->id
        ]);
    }

    public function test_super_admin_role_is_created_by_default()
    {
        $this->assertDatabaseHas('roles', [
            'name' => 'super-admin'
        ]);
    }

    public function test_admin_role_is_created_by_default()
    {
        $this->assertDatabaseHas('roles', [
            'name' => 'admin'
        ]);
    }

    public function test_company_role_is_created_by_default()
    {
        $this->assertDatabaseHas('roles', [
            'name' => 'company'
        ]);
    }

    public function test_employee_role_is_created_by_default()
    {
        $this->assertDatabaseHas('roles', [
            'name' => 'employee'
        ]);
    }

    public function test_super_admin_role_has_all_permissions()
    {
        $role = Role::where('name', 'super-admin')->first();

        $permissions = $role->permissions;

        $permissionCount = DB::table('permissions')->count();

        $this->assertEquals(count($permissions), $permissionCount);
    }

    public function test_admin_role_has_only_allowed_permissions()
    {
        $role = Role::where('name', 'admin')->first();

        $permissions = $role->permissions;

        $this->assertCount(4, $permissions);
    }

    public function test_company_role_has_only_allowed_permissions()
    {
        $role = Role::where('name', 'company')->first();

        $permissions = $role->permissions;

        $this->assertCount(2, $permissions);
    }

    public function test_employee_role_has_only_allowed_permissions()
    {
        $role = Role::where('name', 'employee')->first();

        $permissions = $role->permissions;

        $this->assertCount(2, $permissions);
    }
}
