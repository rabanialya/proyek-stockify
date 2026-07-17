<?php

namespace App\Repositories\Dashboard;

use App\Models\Category;
use App\Models\Product;
use App\Models\StockIn;
use App\Models\StockOut;
use App\Models\Supplier;
use LaravelEasyRepository\Implementations\Eloquent;

class DashboardRepositoryImplement extends Eloquent implements DashboardRepository
{
    protected $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function statistics()
    {
        return [
            'totalProducts' => Product::count(),

            'totalCategories' => Category::count(),

            'totalSuppliers' => Supplier::count(),

            'stockInToday' => StockIn::whereDate('date', today())
                ->sum('qty'),

            'stockOutToday' => StockOut::whereDate('date', today())
                ->sum('qty'),

            'totalStock' => Product::sum('stock'),

            'lowStocks' => Product::whereColumn(
                'stock',
                '<=',
                'minimum_stock'
            )->count(),

            'lowStockProducts' => Product::with('category')
                ->whereColumn('stock', '<=', 'minimum_stock')
                ->orderBy('stock')
                ->take(5)
                ->get(),

            'latestStockIns' => StockIn::with('product')
                ->latest()
                ->take(5)
                ->get(),

            'latestStockOuts' => StockOut::with('product')
                ->latest()
                ->take(5)
                ->get(),
        ];
    }
}