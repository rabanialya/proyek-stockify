<?php

namespace App\Repositories\Report;

use App\Models\Product;
use App\Models\StockIn;
use App\Models\StockOut;
use LaravelEasyRepository\Implementations\Eloquent;

class ReportRepositoryImplement extends Eloquent implements ReportRepository
{
    protected $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function stockInReport($startDate = null, $endDate = null)
    {
        return StockIn::with('product')
            ->when($startDate, function ($query) use ($startDate) {
                $query->whereDate('date', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                $query->whereDate('date', '<=', $endDate);
            })
            ->latest('date')
            ->get();
    }

    public function stockOutReport($startDate = null, $endDate = null)
    {
        return StockOut::with('product')
            ->when($startDate, function ($query) use ($startDate) {
                $query->whereDate('date', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                $query->whereDate('date', '<=', $endDate);
            })
            ->latest('date')
            ->get();
    }

    public function inventoryReport()
    {
        return Product::with([
            'category',
            'supplier'
        ])->orderBy('name')->get();
    }
}