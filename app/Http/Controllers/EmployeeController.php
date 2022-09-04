<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employee\CreateEmployeeRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;
use App\Services\Company\CompanyService;
use App\Services\Employee\EmployeeService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Throwable;

class EmployeeController extends Controller
{
    public CompanyService $companyService;

    public EmployeeService $employeeService;

    public function __construct(CompanyService $companyService, EmployeeService $employeeService)
    {
        $this->companyService = $companyService;
        $this->employeeService = $employeeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|RedirectResponse
     */
    public function index()
    {
        try {
            $company = $this->companyService->getCompany(request()->route('company'), ['employees']);
            $employees = $this->employeeService->getEmployeesByCompany($company->uuid);
        } catch (Throwable $exception) {
            report($exception);

            return redirect()->back()->with('error', 'An error occurred while loading the page for this company.');
        }

        return view('company.index', compact('company', 'employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     *
     * @throws Throwable
     */
    public function create()
    {
        $company = $this->companyService->getCompany(request()->route('company'));

        return view('employees.create', compact('company'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateEmployeeRequest  $request
     * @return RedirectResponse
     */
    public function store(CreateEmployeeRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $this->employeeService->createEmployee($request->validated() + ['company_id' => request()->route('company'), 'password' => Hash::make('password')]);
            });
        } catch (Throwable $exception) {
            report($exception);

            return back()->withInput()->with('error', 'An error occurred while creating the employee.');
        }

        return redirect()->back()->with('success', "Employee {$request->first_name} {$request->last_name} created successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $id
     * @return Application|Factory|RedirectResponse|View
     */
    public function edit(string $id)
    {
        try {
            $employee = $this->employeeService->getEmployee(request()->route('employee'));
        } catch (Throwable $exception) {
            report($exception);

            return back()->withInput()->with('error', 'An error occurred while loading the page for this employee.');
        }

        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateEmployeeRequest  $request
     * @param  string  $id
     * @return RedirectResponse
     */
    public function update(UpdateEmployeeRequest $request, $id): RedirectResponse
    {
        try {
            DB::transaction(function () use ($request) {
                $this->employeeService->updateEmployee($request->validated(), request()->route('employee'));
            });
        } catch (Throwable $exception) {
            report($exception);

            return back()->withInput()->with('error', 'An error occurred while updating the employee.');
        }

        return back()->with('success', "Employee {$request->first_name} {$request->last_name} updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(string $id)
    {
        try {
            $this->employeeService->deleteEmployee(request()->route('employee'));
        } catch (Throwable $exception) {
            report($exception);

            if (request()->ajax()) {
                return response()->json(['error' => 'An error occurred while deleting the employee. Please try again later.'], 500);
            }

            return redirect()->back()->with('error', 'An error occurred while deleting the employee. Please try again later.');
        }

        if (request()->ajax()) {
            return response()->json(['success' => 'Employee deleted successfully.'], 200);
        }

        return redirect()->back()->with('success', 'Employee deleted successfully.');
    }
}
