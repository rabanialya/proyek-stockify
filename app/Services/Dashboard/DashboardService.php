<?php

namespace App\Services\Dashboard;

use LaravelEasyRepository\BaseService;

interface DashboardService extends BaseService{

    public function statistics();

    public function adminData();

    public function staffData();
}
