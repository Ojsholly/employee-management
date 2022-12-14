<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Throwable;

class AuthController extends Controller
{
    public AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @param  LoginRequest  $request
     * @return RedirectResponse
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        try {
            $credentials = $request->only(['identifier', 'password']);

            $user = $this->authService->verifyUserCredentials($credentials);

            if (! $user) {
                return back()->with('error', 'Invalid credentials provided.');
            }

            Auth::login($user, $request->has('remember'));
        } catch (Throwable $exception) {
            report($exception);

            return back()->with('error', 'An error occurred while logging in.');
        }

        return match ($user->getRoleNames()->first()) {
            'super-admin' => redirect()->route('super-admin.dashboard')->with('success', 'Super Admin Login Successful.'),
            'admin' => redirect()->route('admin.dashboard')->with('success', 'Admin Login Successful.'),
            'company' => redirect()->route('company.dashboard')->with('success', 'Company Login Successful.'),
            'employee' => redirect()->route('employee.dashboard')->with('success', 'Employee Login Successful.'),
            default => redirect()->route('welcome'),
        };
    }

    /**
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logoutCurrentDevice();

        return redirect()->route('login')->with('success', 'You have been logged out successfully.');
    }
}
