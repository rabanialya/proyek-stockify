<?php

namespace App\Services\Report;

use App\Repositories\Report\ReportRepository;
use LaravelEasyRepository\Service;

class ReportServiceImplement extends Service implements ReportService
{
    protected $mainRepository;

    public function __construct(
        ReportRepository $mainRepository
    )
    {
        $this->mainRepository = $mainRepository;
    }

    public function stockInReport($startDate = null, $endDate = null)
    {
        return $this->mainRepository->stockInReport($startDate, $endDate);
    }

    public function stockOutReport($startDate = null, $endDate = null)
    {
        return $this->mainRepository->stockOutReport($startDate, $endDate);
    }

    public function inventoryReport()
    {
        return $this->mainRepository->inventoryReport();
    }

    public function inventorySummary(): array
    {
        return $this->mainRepository->inventorySummary();
    }

    public function stockOpnameSummary(?string $startDate, ?string $endDate): array
    {
        return $this->mainRepository->stockOpnameSummary($startDate, $endDate);
    }
}