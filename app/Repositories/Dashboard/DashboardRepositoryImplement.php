<?php

namespace App\Repositories\Dashboard;

use App\Models\Category;
use App\Models\Product;
use App\Models\StockIn;
use App\Models\StockOut;
use App\Models\StockOpname;
use App\Models\Supplier;
use App\Models\User;
use Carbon\Carbon;
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
            'totalProducts'    => Product::count(),
            'totalCategories'  => Category::count(),
            'totalSuppliers'   => Supplier::count(),
            'stockInToday'     => StockIn::whereDate('date', today())->sum('qty'),
            'stockOutToday'    => StockOut::whereDate('date', today())->sum('qty'),
            'totalStock'       => Product::sum('stock'),
            'lowStocks'        => Product::whereColumn('stock', '<=', 'minimum_stock')->count(),
            'lowStockProducts' => Product::with('category')
                ->whereColumn('stock', '<=', 'minimum_stock')
                ->orderBy('stock')
                ->take(5)
                ->get(),
            'latestStockIns'  => StockIn::with('product')->latest()->take(5)->get(),
            'latestStockOuts' => StockOut::with('product')->latest()->take(5)->get(),
        ];
    }

    public function adminData()
    {
        // --- Statistic Cards ---
        $totalProducts   = Product::count();
        $totalCategories = Category::count();
        $totalSuppliers  = Supplier::count();
        $totalUsers      = User::count();
        $totalStockIn    = StockIn::count();
        $totalStockOut   = StockOut::count();
        $totalOpname     = StockOpname::count();
        $lowStocks       = Product::whereColumn('stock', '<=', 'minimum_stock')->count();

        // --- Transaksi Hari Ini ---
        $stockInToday     = StockIn::whereDate('date', today())->sum('qty');
        $stockOutToday    = StockOut::whereDate('date', today())->sum('qty');
        $opnameToday      = StockOpname::whereDate('date', today())->count();

        // --- Produk Stok Menipis ---
        $lowStockProducts = Product::with('category')
            ->whereColumn('stock', '<=', 'minimum_stock')
            ->orderBy('stock')
            ->take(10)
            ->get();

        // --- Grafik 7 Hari Terakhir ---
        $chartLabels   = [];
        $chartStockIn  = [];
        $chartStockOut = [];

        for ($i = 6; $i >= 0; $i--) {
            $date            = Carbon::today()->subDays($i);
            $chartLabels[]   = $date->translatedFormat('d M');
            $chartStockIn[]  = StockIn::whereDate('date', $date)->sum('qty');
            $chartStockOut[] = StockOut::whereDate('date', $date)->sum('qty');
        }

        // --- Aktivitas Terbaru (gabungan StockIn, StockOut, StockOpname) ---
        $stockIns = StockIn::with(['product', 'product.category'])
            ->latest()
            ->take(5)
            ->get()
            ->map(fn($s) => [
                'type'       => 'stock-in',
                'label'      => 'Barang Masuk: ' . ($s->product->name ?? '-'),
                'sub'        => '+' . $s->qty . ' unit',
                'color'      => 'green',
                'time'       => $s->created_at,
                'time_human' => $s->created_at->diffForHumans(),
            ]);

        $stockOuts = StockOut::with(['product'])
            ->latest()
            ->take(5)
            ->get()
            ->map(fn($s) => [
                'type'       => 'stock-out',
                'label'      => 'Barang Keluar: ' . ($s->product->name ?? '-'),
                'sub'        => '-' . $s->qty . ' unit',
                'color'      => 'red',
                'time'       => $s->created_at,
                'time_human' => $s->created_at->diffForHumans(),
            ]);

        $opnames = StockOpname::with(['product', 'user'])
            ->latest()
            ->take(5)
            ->get()
            ->map(fn($s) => [
                'type'       => 'opname',
                'label'      => 'Stock Opname: ' . ($s->product->name ?? '-'),
                'sub'        => 'Oleh ' . ($s->user->name ?? '-'),
                'color'      => 'blue',
                'time'       => $s->created_at,
                'time_human' => $s->created_at->diffForHumans(),
            ]);

        $recentActivities = $stockIns
            ->concat($stockOuts)
            ->concat($opnames)
            ->sortByDesc('time')
            ->take(10)
            ->values();

        return compact(
            'totalProducts', 'totalCategories', 'totalSuppliers',
            'totalUsers', 'totalStockIn', 'totalStockOut', 'totalOpname', 'lowStocks',
            'stockInToday', 'stockOutToday', 'opnameToday',
            'lowStockProducts',
            'chartLabels', 'chartStockIn', 'chartStockOut',
            'recentActivities'
        );
    }

    public function staffData()
    {
        return [
            'pendingStockIns'  => StockIn::with('product')->orderByDesc('date')->take(10)->get(),
            'pendingStockOuts' => StockOut::with('product')->orderByDesc('date')->take(10)->get(),
            'stockInToday'     => StockIn::whereDate('date', today())->sum('qty'),
            'stockOutToday'    => StockOut::whereDate('date', today())->sum('qty'),
        ];
    }
}