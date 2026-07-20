<?php

namespace App\Repositories\Report;

use App\Models\Product;
use App\Models\StockIn;
use App\Models\StockOpname;
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

    public function inventorySummary(): array
    {
        $products = Product::all();

        return [
            'totalProducts'      => $products->count(),
            'totalStock'         => $products->sum('stock'),
            'totalValuePurchase' => $products->sum(fn($p) => $p->stock * $p->purchase_price),
            'totalValueSelling'  => $products->sum(fn($p) => $p->stock * $p->selling_price),
            'lowStockCount'      => $products->filter(fn($p) => $p->stock <= $p->minimum_stock)->count(),
        ];
    }

    public function stockOpnameSummary(?string $startDate, ?string $endDate): array
    {
        $query = StockOpname::query()
            ->when($startDate, fn($q) => $q->whereDate('date', '>=', $startDate))
            ->when($endDate,   fn($q) => $q->whereDate('date', '<=', $endDate));

        $records = $query->get();

        return [
            'totalTransactions'  => $records->count(),
            'totalPositive'      => $records->where('difference', '>', 0)->sum('difference'),
            'totalNegative'      => $records->where('difference', '<', 0)->sum('difference'),
            'productsWithDiff'   => $records->where('difference', '!=', 0)->pluck('product_id')->unique()->count(),
        ];
    }
}