<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\StockIn;
use App\Models\StockOut;
use App\Models\Supplier;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.dashboard.index', [
            'totalProducts'   => Product::count(),
            'totalCategories' => Category::count(),
            'totalSuppliers'  => Supplier::count(),
            'stockInToday'    => StockIn::whereDate('date', today())->sum('qty'),
            'stockOutToday'   => StockOut::whereDate('date', today())->sum('qty'),
            'lowStocks'       => Product::whereColumn('stock','<=','minimum_stock')->count(),
        ]);
    }
}