<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\CreateAdminRequest;
use App\Services\Admin\AdminService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Throwable;

class AdminController extends Controller
{
    public AdminService $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return RedirectResponse|View
     */
    public function index(): RedirectResponse|View
    {
        try {
            $admins = $this->adminService->getAdmins();
        } catch (Throwable $exception) {
            report($exception);

            return back()->with('error', 'An error occurred while trying to retrieve administrators. Please try again later.');
        }

        return view('super-admin.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('super-admin.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateAdminRequest  $request
     * @return RedirectResponse
     */
    public function store(CreateAdminRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $this->adminService->createAdmin($request->validated() + ['password' => Hash::make('password'), 'email_verified_at' => now()]);
            });
        } catch (Throwable $exception) {
            report($exception);

            return back()->withInput()->with('error', 'An error occurred while trying to create administrator. Please try again later.');
        }

        return back()->with('success', 'Administrator account created successfully.');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return JsonResponse|RedirectResponse
     */
    public function destroy(string $id): JsonResponse|RedirectResponse
    {
        try {
            $this->adminService->deleteAdmin($id);
        } catch (Throwable $exception) {
            report($exception);

            if (request()->ajax()) {
                return response()->json(['message' => 'An error occurred while trying to delete administrator. Please try again later.'], 500);
            }

            return back()->with('error', 'An error occurred while trying to delete administrator. Please try again later.');
        }

        if (request()->ajax()) {
            return response()->json(['message' => 'Administrator deleted successfully.'], 200);
        }

        return back()->with('success', 'Administrator deleted successfully.');
    }
}
