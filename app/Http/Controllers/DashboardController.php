<?php

namespace App\Http\Controllers;

use App\Services\Dashboard\DashboardService;

class DashboardController extends Controller
{
    public function __construct(
        protected DashboardService $dashboardService
    ) {}

    public function index()
    {
        $data = $this->dashboardService->statistics();

        $user = auth()->user();

        if ($user->hasRole('admin')) {
            return view('pages.dashboard.admin', $data);
        }

        if ($user->hasRole('warehouse-manager')) {
            return view('pages.dashboard.manager', $data);
        }

        if ($user->hasRole('warehouse-staff')) {
            return view('pages.dashboard.staff', $data);
        }

        abort(403);
    }
}