<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Service;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param Service $service
     * @return Application|Factory|View
     */
    public function __invoke(Request $request, Service $service)
    {
        $metrics = $service->getMetrics();

        return view('dashboard', compact('metrics'));
    }
}
