<?php

namespace App\Repositories\Dashboard;

use LaravelEasyRepository\Repository;

interface DashboardRepository extends Repository{

    public function statistics();

    public function adminData();

    public function staffData();
}
