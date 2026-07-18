<?php

namespace App\Repositories\StockOpname;

use App\Models\StockOpname;
use LaravelEasyRepository\Implementations\Eloquent;

class StockOpnameRepositoryImplement extends Eloquent implements StockOpnameRepository
{
    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(StockOpname $model)
    {
        $this->model = $model;
    }

    public function allWithRelations()
    {
        return StockOpname::with(['product', 'user'])
            ->orderByDesc('date')
            ->get();
    }

    public function filterByDate(?string $startDate, ?string $endDate)
    {
        return StockOpname::with(['product', 'user'])
            ->when($startDate, fn($q) => $q->whereDate('date', '>=', $startDate))
            ->when($endDate,   fn($q) => $q->whereDate('date', '<=', $endDate))
            ->orderByDesc('date')
            ->get();
    }
}
