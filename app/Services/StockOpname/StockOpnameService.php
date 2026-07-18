<?php

namespace App\Services\StockOpname;

use LaravelEasyRepository\BaseService;

interface StockOpnameService extends BaseService
{
    public function allWithRelations();

    public function reportFilter(?string $startDate, ?string $endDate);
}
