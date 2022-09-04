<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Services\Service;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param Service $service
     * @return View
     */
    public function __invoke(Request $request, Service $service): View
    {
        $metrics = $service->getMetrics();

        return view('dashboard', compact('metrics'));
    }
}
