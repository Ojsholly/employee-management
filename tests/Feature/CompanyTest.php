<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Str;
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

    public function admin(): User
    {
        return User::factory()->admin()->create();
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
            'name' => fake()->unique(true)->company.' '.fake()->unique(true)->companySuffix.Str::random(),
            'email' => fake()->unique(true)->companyEmail.Str::random(),
            'website' => fake()->unique(true)->url().'/'.Str::random(),
            'username' => fake()->unique(true)->userName.Str::random(),
        ];

        $this->actingAs($superAdmin)->post(route('super-admin.companies.store'), $company)
            ->assertStatus(302)->assertSessionHas('success', 'Company account created successfully');

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

    public function test_admin_can_create_company()
    {
        $this->withoutExceptionHandling();

        $admin = $this->admin();
        $companyCount = User::role('company')->count();

        $company = [
            'name' => fake()->unique(true)->company.' '.fake()->unique(true)->companySuffix.Str::random(),
            'email' => fake()->unique(true)->companyEmail.Str::random(),
            'website' => fake()->unique(true)->url().'/'.Str::random(),
            'username' => fake()->unique(true)->userName.Str::random(),
        ];

        $this->actingAs($admin)->post(route('admin.companies.store'), $company)
            ->assertStatus(302)->assertSessionHas('success', 'Company account created successfully');

        $this->assertEquals($companyCount + 1, User::role('company')->count());

        $this->assertDatabaseHas('companies', collect($company)->except('username')->toArray());

        $this->assertDatabaseHas('users', collect($company)->only('username')->toArray());
    }

    public function test_company_can_login()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->company()->create();
       $company = $user->company()->save(Company::factory()->make());

        $this->post(route('verify-credentials'), [
            'identifier' => $user->username,
            'password' => 'password',
        ])->assertRedirect();
    }

    public function test_company_can_not_login_with_wrong_credentials()
    {
        $user = User::factory()->company()->create();
        $company = $user->company()->save(Company::factory()->make());

        $this->post(route('verify-credentials'), [
            'identifier' => $user->username,
            'password' => 'wrong-password',
        ])->assertSessionHas('error');
    }
}
