<?php

namespace App\Http\Controllers;

use App\Services\Company\CompanyService;
use App\Services\Employee\EmployeeService;
use App\Services\Service;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Throwable;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  Request  $request
     * @param  Service  $service
     * @param  CompanyService  $companyService
     * @param  EmployeeService  $employeeService
     * @return RedirectResponse|View
     *
     * @throws Throwable
     */
    public function __invoke(Request $request, Service $service, CompanyService $companyService, EmployeeService $employeeService): RedirectResponse|View
    {
        if (auth()->user()->isSuperAdmin() || auth()->user()->isAdmin()) {
            $metrics = $service->getMetrics();

            return view('dashboard', compact('metrics'));
        }

        if (auth()->user()->isCompany()) {
            $company = $companyService->getCompany(auth()->user()->company->uuid);
            $employees = $employeeService->getEmployeesByCompany(auth()->user()->company->uuid);

            return view('dashboard', compact('company', 'employees'));
        }

        if (auth()->user()->isEmployee()) {
            $company = $companyService->getCompany(auth()->user()->employee->company->uuid);

            return view('dashboard', compact('company'));
        }

        return back()->with('error', 'No defined role for this user.');
    }
}
