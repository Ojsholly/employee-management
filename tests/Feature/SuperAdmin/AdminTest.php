<?php

namespace Tests\Feature\SuperAdmin;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function superAdmin(): User
    {
        return User::where('username', 'Ojsholly')->first();
    }

    public function test_other_roles_cannot_access_super_admin_dashboard()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $this->actingAs($admin)->get(route('super-admin.dashboard'))->assertForbidden();

        $company = User::factory()->create();
        $company->assignRole('company');

        $this->actingAs($company)->get(route('super-admin.dashboard'))->assertForbidden();

        $employee = User::factory()->create();
        $employee->assignRole('employee');

        $this->actingAs($employee)->get(route('super-admin.dashboard'))->assertForbidden();
    }

    public function test_super_admin_can_access_super_admin_dashboard()
    {
        $this->withoutExceptionHandling();

        $superAdmin = $this->superAdmin();

        $this->actingAs($superAdmin)->get(route('super-admin.dashboard'))->assertOk();
    }

    public function test_other_roles_cannot_access_super_admin_admins_index()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $this->actingAs($admin)->get(route('super-admin.admins.index'))->assertForbidden();

        $company = User::factory()->create();
        $company->assignRole('company');

        $this->actingAs($company)->get(route('super-admin.admins.index'))->assertForbidden();

        $employee = User::factory()->create();
        $employee->assignRole('employee');

        $this->actingAs($employee)->get(route('super-admin.admins.index'))->assertForbidden();
    }

    public function test_super_admin_can_access_super_admin_admins_index()
    {
        $this->withoutExceptionHandling();

        $superAdmin = $this->superAdmin();

        $this->actingAs($superAdmin)->get(route('super-admin.admins.index'))->assertOk();
    }

    public function test_other_roles_cannot_access_super_admin_admins_create()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $this->actingAs($admin)->get(route('super-admin.admins.create'))->assertForbidden();

        $company = User::factory()->create();
        $company->assignRole('company');

        $this->actingAs($company)->get(route('super-admin.admins.create'))->assertForbidden();

        $employee = User::factory()->create();
        $employee->assignRole('employee');

        $this->actingAs($employee)->get(route('super-admin.admins.create'))->assertForbidden();
    }

    public function test_super_admin_can_access_super_admin_admins_create()
    {
        $this->withoutExceptionHandling();

        $superAdmin = $this->superAdmin();

        $this->actingAs($superAdmin)->get(route('super-admin.admins.create'))->assertOk();
    }

    public function test_other_roles_cannot_access_super_admin_admins_store()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $this->actingAs($admin)->post(route('super-admin.admins.store'))->assertForbidden();

        $company = User::factory()->create();
        $company->assignRole('company');

        $this->actingAs($company)->post(route('super-admin.admins.store'))->assertForbidden();

        $employee = User::factory()->create();
        $employee->assignRole('employee');

        $this->actingAs($employee)->post(route('super-admin.admins.store'))->assertForbidden();
    }

    public function test_super_admin_has_permission_to_create_admin()
    {
        $this->withoutExceptionHandling();
        $superAdmin = $this->superAdmin();

        $adminCount = User::role('admin')->count();

        $this->assertTrue($superAdmin->can('create admin account'));

        $admin = [
            'username' => fake()->unique(true)->userName,
            'email' => fake()->unique(true)->safeEmail,
            'first_name' => fake()->firstName,
            'last_name' => fake()->lastName,
        ];

        $this->actingAs($superAdmin)->post(route('super-admin.admins.store'), $admin);

        $this->assertDatabaseHas('users', $admin);

        $this->assertEquals(User::role('admin')->count(), $adminCount + 1);
    }
}
