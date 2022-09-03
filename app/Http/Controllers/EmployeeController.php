<?php

namespace App\Http\Controllers;

use App\Services\Company\CompanyService;
use App\Services\Employee\EmployeeService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
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
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
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
