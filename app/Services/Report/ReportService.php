<?php

namespace App\Services\Report;

use LaravelEasyRepository\BaseService;

interface ReportService extends BaseService{

    public function stockInReport($startDate = null, $endDate = null);

    public function stockOutReport($startDate = null, $endDate = null);

    public function inventoryReport();
}
