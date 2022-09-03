<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CompanyTest extends TestCase
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

    public function test_only_super_admin_and_admin_can_access_company_index_page()
    {
        $superAdmin = $this->superAdmin();
        $superAdmin->assignRole('super-admin');
        $this->actingAs($superAdmin)->get(route('super-admin.companies.index'))->assertOk();

        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $this->actingAs($admin)->get(route('admin.companies.index'))->assertOk();

        $company = User::factory()->create();
        $company->assignRole('company');

        $this->actingAs($company)->get(route('super-admin.companies.index'))->assertForbidden();

        $employee = User::factory()->create();
        $employee->assignRole('employee');

        $this->actingAs($employee)->get(route('super-admin.companies.index'))->assertForbidden();
    }

    public function test_super_admin_create_company()
    {
        $this->withoutExceptionHandling();

        $superAdmin = $this->superAdmin();
        $companyCount = User::role('company')->count();

        $company = [
            'name' => fake()->company.' '.fake()->companySuffix,
            'email' => fake()->unique(true)->companyEmail,
            'website' => fake()->unique(true)->url(),
            'username' => fake()->unique(true)->userName,
        ];

        $this->actingAs($superAdmin)->post(route('super-admin.companies.store'), $company);

        $this->assertEquals($companyCount + 1, User::role('company')->count());

        $this->assertDatabaseHas('companies', collect($company)->except('username')->toArray());

        $this->assertDatabaseHas('users', collect($company)->only('username')->toArray());
    }

    public function test_super_admin_can_delete_company()
    {
        $superAdmin = $this->superAdmin();

        $company = User::factory()->create();
        $company->assignRole('company');

        $this->actingAs($superAdmin)->delete(route('super-admin.companies.destroy', $company->uuid));

        $this->assertDatabaseMissing('companies', ['uuid' => $company->uuid]);
    }

    public function test_super_admin_can_update_company()
    {
        $superAdmin = $this->superAdmin();

        $user = User::factory()->has(Company::factory()->count(1))->company()->create();
        $user->assignRole('company');

        $companyData = [
            'name' => fake()->company.' '.fake()->companySuffix,
            'email' => fake()->unique(true)->companyEmail,
            'website' => fake()->unique(true)->url(),
            'username' => fake()->unique(true)->userName,
        ];

        $this->actingAs($superAdmin)->put(route('super-admin.companies.update', ['company' => $user->company->uuid]), $companyData);

        $this->assertDatabaseHas('companies', collect($companyData)->except('username')->toArray());
        $this->assertDatabaseHas('users', collect($companyData)->only('username')->toArray());
    }

    public function test_super_admin_can_view_company()
    {
        $superAdmin = $this->superAdmin();

        $user = User::factory()->has(Company::factory()->count(1))->company()->create();
        $user->assignRole('company');

        $this->actingAs($superAdmin)->get(route('super-admin.companies.show', ['company' => $user->company->uuid]))->assertOk();
    }
}
