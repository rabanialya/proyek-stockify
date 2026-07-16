<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\DashboardRepository;
use LaravelEasyRepository\Service;

class DashboardServiceImplement extends Service implements DashboardService
{
    protected $mainRepository;

    public function __construct(
        DashboardRepository $mainRepository
    )
    {
        $this->mainRepository = $mainRepository;
    }

    public function statistics()
    {
        return $this->mainRepository->statistics();
    }
}