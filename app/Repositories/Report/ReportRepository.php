<?php

namespace App\Repositories\Report;

use LaravelEasyRepository\Repository;

interface ReportRepository extends Repository{
    
    public function stockInReport($startDate = null, $endDate = null);

    public function stockOutReport($startDate = null, $endDate = null);

    public function inventoryReport();

    public function inventorySummary(): array;

    public function stockOpnameSummary(?string $startDate, ?string $endDate): array;
}
