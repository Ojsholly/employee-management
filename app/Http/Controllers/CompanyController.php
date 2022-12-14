<?php

namespace App\Http\Controllers;

use App\Http\Requests\Company\CreateCompanyRequest;
use App\Http\Requests\Company\UpdateCompanyRequest;
use App\Services\Company\CompanyService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Throwable;

class CompanyController extends Controller
{
    public CompanyService $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return RedirectResponse|View
     */
    public function index()
    {
        try {
            $companies = $this->companyService->getCompanies();
        } catch (Throwable $exception) {
            report($exception);

            return back()->with('error', 'An error occurred while fetching the list of companies. Please try again later');
        }

        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateCompanyRequest  $request
     * @return RedirectResponse
     */
    public function store(CreateCompanyRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $this->companyService->createCompany($request->validated() + ['password' => Hash::make('password')]);
            });
        } catch (Throwable $exception) {
            report($exception);

            return back()->with('error', 'An error occurred while creating the company. Please try again later');
        }

        return back()->with('success', 'Company account created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $id
     * @return RedirectResponse|View
     */
    public function edit(string $id)
    {
        try {
            $company = $this->companyService->getCompany($id);
        } catch (Throwable $exception) {
            report($exception);

            return back()->with('error', 'An error occurred while fetching the company details. Please try again later');
        }

        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCompanyRequest  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(UpdateCompanyRequest $request, $id)
    {
        try {
            DB::transaction(function () use ($request, $id) {
                $this->companyService->updateCompany($request->validated(), $id);
            });
        } catch (Throwable $exception) {
            report($exception);

            return back()->with('error', 'An error occurred while updating the company details. Please try again later');
        }

        return back()->with('success', 'Company details updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return JsonResponse|RedirectResponse
     */
    public function destroy(string $id)
    {
        try {
            $company = $this->companyService->deleteCompany($id);
        } catch (Throwable $exception) {
            report($exception);

            if (request()->ajax()) {
                return response()->json(['error' => 'An error occurred while deleting the company. Please try again later'], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
            }

            return back()->with('error', 'An error occurred while deleting the company. Please try again later');
        }

        if (request()->ajax()) {
            return response()->json(['success' => 'Company deleted successfully'], ResponseAlias::HTTP_OK);
        }

        return back()->with('success', 'Company deleted successfully');
    }
}
