<?php

namespace Tests\Feature;

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

    public function admin()
    {
        return User::factory()->admin()->create();
    }

    public function test_admin_can_access_admin_dashboard()
    {
        $admin = $this->admin();

        $this->actingAs($admin)->get(route('admin.dashboard'))->assertOk();
    }

    public function test_admin_can_access_admin_companies_index()
    {
        $admin = $this->admin();

        $this->actingAs($admin)->get(route('admin.companies.index'))->assertOk();
    }

    public function test_admin_can_access_admin_companies_create()
    {
        $admin = $this->admin();

        $this->actingAs($admin)->get(route('admin.companies.create'))->assertOk();
    }

    public function test_admin_can_access_admin_companies_store()
    {
        $admin = $this->admin();

        $this->actingAs($admin)->post(route('admin.companies.store'), [
            'name' => 'Test Company',
            'email' => fake()->unique(true)->email,
            'website' => fake()->unique(true)->url,
            'username' => fake()->unique(true)->userName,
        ])->assertRedirect(route('welcome'))->assertSessionHas('success', 'Company account created successfully');
    }

    public function test_admin_cannot_access_admin_companies_edit()
    {
        $admin = $this->admin();
        $company = User::factory()->company()->create();

        $this->actingAs($admin)->get(route('super-admin.companies.edit', $company))->assertForbidden();
    }

    public function test_admin_cannot_access_admin_companies_update()
    {
        $admin = $this->admin();
        $company = User::factory()->company()->create();

        $this->actingAs($admin)->put(route('super-admin.companies.update', $company), [
            'name' => 'Test Company',
            'email' => fake()->unique(true)->email,
            'website' => fake()->unique(true)->url,
            'username' => fake()->unique(true)->userName,
        ])->assertForbidden();
    }

    public function test_admin_cannot_access_admin_companies_destroy()
    {
        $admin = $this->admin();
        $company = User::factory()->company()->create();

        $this->actingAs($admin)->delete(route('super-admin.companies.destroy', $company))->assertForbidden();
    }

    public function test_admin_can_access_admin_employees_index()
    {
        $admin = $this->admin();

        $company = User::factory()->company()->create();

        $this->actingAs($admin)->get(route('admin.companies.employees.index', ['company' => $company->uuid]))->assertRedirect();
    }

    public function test_admin_can_access_admin_employees_create()
    {
        $admin = $this->admin();

        $user = User::factory()->company()->create();
        $company = $user->company()->create([
            'name' => fake()->company.' '.fake()->companySuffix,
            'email' => fake()->unique(true)->email,
            'website' => fake()->unique(true)->url,
            'username' => fake()->unique(true)->userName,
        ]);

        $this->actingAs($admin)->get(route('admin.companies.employees.create', ['company' => $company->uuid]))->assertOk();
    }

    public function test_admin_can_create_company()
    {
        $admin = $this->admin();

        $company = [
            'name' => fake()->company.' '.fake()->companySuffix,
            'email' => fake()->unique(true)->email,
            'website' => fake()->unique(true)->url,
            'username' => fake()->unique(true)->userName,
        ];

        $this->actingAs($admin)->post(route('admin.companies.store'), [
            'name' => fake()->name,
            'email' => fake()->unique(true)->email,
            'username' => fake()->unique(true)->userName,
            'website' => fake()->unique(true)->url,
        ])->assertRedirect()->assertSessionHas('success', 'Company account created successfully');
    }

    public function test_admin_can_create_employee()
    {
        $admin = $this->admin();

        $user = User::factory()->company()->create();
        $company = $user->company()->create([
            'name' => fake()->company.' '.fake()->companySuffix,
            'email' => fake()->unique(true)->email,
            'website' => fake()->unique(true)->url,
            'username' => fake()->unique(true)->userName,
        ]);

        $data = [
            'first_name' => fake()->firstName,
            'last_name' => fake()->lastName,
            'email' => fake()->unique(true)->email,
            'phone' => fake()->unique(true)->phoneNumber,
            'username' => fake()->unique(true)->userName,
            'company_id' => $company->uuid,
        ];

        $this->actingAs($admin)->post(route('admin.companies.employees.store', ['company' => $company->uuid]), $data)
            ->assertRedirect()->assertSessionHas('success', 'Employee '.$data['first_name'].' '.$data['last_name'].' created successfully.');
    }
}
