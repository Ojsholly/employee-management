<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class EmployeeTest extends TestCase
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

    public function company(): User
    {
        return User::factory()->company()->create();
    }

    public function employee(): User
    {
        return User::factory()->employee()->create();
    }

    public function test_only_super_admin_and_admin_can_access_employee_index_page()
    {
        $superAdmin = $this->superAdmin();

        $company = User::factory()->create();
        $this->company();
        $companyDetails = $company->company()->save(Company::factory()->make());

        $this->actingAs($superAdmin)->get(route('super-admin.companies.employees.index', ['company' => $companyDetails->uuid]))->assertOk();

        $admin = $this->admin();

        $this->actingAs($admin)->get(route('admin.companies.employees.index', ['company' => $companyDetails->uuid]))->assertOk();

        $company = $this->company();

        $this->actingAs($company)->get(route('super-admin.companies.employees.index', ['company' => $companyDetails->uuid]))->assertForbidden();

        $employee = $this->employee();

        $this->actingAs($employee)->get(route('admin.companies.employees.index', ['company' => $companyDetails->uuid]))->assertForbidden();
    }

    public function test_employee_can_login()
    {
        $this->withoutExceptionHandling();
        $employee = $this->employee();
        $this->post(route('verify-credentials'), [
            'identifier' => $employee->username,
            'password' => 'password',
        ])->assertRedirect();
    }

    public function test_employee_can_not_login_with_wrong_credentials()
    {
        $employee = $this->employee();
        $this->post(route('verify-credentials'), [
            'identifier' => $employee->username,
            'password' => 'wrong-password',
        ])->assertSessionHas('error');
    }
}
