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
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            $data = $this->dashboardService->adminData();
            return view('pages.dashboard.admin', $data);
        }

        if ($user->hasRole('warehouse-manager')) {
            $data = $this->dashboardService->statistics();
            return view('pages.dashboard.manager', $data);
        }

        if ($user->hasRole('warehouse-staff')) {
            $data = $this->dashboardService->staffData();
            return view('pages.dashboard.staff', $data);
        }

        abort(403);
    }
}
