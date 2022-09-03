<?php

namespace Tests\Feature\SuperAdmin;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function superAdmin()
    {
        return User::where('username', 'Ojsholly')->first();
    }

    public function test_super_admin_can_login_with_email()
    {
        $this->withoutExceptionHandling();

        $superAdmin = $this->superAdmin();

        $response = $this->post(route('verify-credentials'), [
            'identifier' => $superAdmin->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('super-admin.dashboard'));

        $this->assertAuthenticatedAs($superAdmin);
    }

    public function test_super_admin_can_login_with_username()
    {
        $this->withoutExceptionHandling();

        $superAdmin = $this->superAdmin();

        $response = $this->post(route('verify-credentials'), [
            'identifier' => $superAdmin->username,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('super-admin.dashboard'));

        $this->assertAuthenticatedAs($superAdmin);
    }

    public function test_super_admin_can_logout()
    {
        $this->withoutExceptionHandling();
        $superAdmin = $this->superAdmin();

        $this->actingAs($superAdmin)->post(route('logout'))->assertRedirect(route('login'));

        $this->assertGuest();
    }
}
