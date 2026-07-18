<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StockInController;
use App\Http\Controllers\StockOpnameController;
use App\Http\Controllers\StockOutController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::redirect('/', '/dashboard');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard — semua role
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Admin Only
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin')->group(function () {

        Route::resource('categories', CategoryController::class)
            ->except('show');

        Route::resource('users', UserController::class)
            ->except('show');

        // Admin: CRUD penuh produk & supplier
        Route::resource('products', ProductController::class)
            ->except('show');

        Route::resource('suppliers', SupplierController::class)
            ->except('show');
    });

    /*
    |--------------------------------------------------------------------------
    | Admin + Manager — akses bersama
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin,warehouse-manager')->group(function () {

        // Produk — manager hanya bisa lihat index & detail
        Route::get('/products', [ProductController::class, 'index'])
            ->name('products.index');

        Route::get('/products/{product}', [ProductController::class, 'show'])
            ->name('products.show');

        // Supplier — manager hanya bisa lihat index
        Route::get('/suppliers', [SupplierController::class, 'index'])
            ->name('suppliers.index');

        // Stock In — CRUD penuh untuk admin & manager
        Route::resource('stock-ins', StockInController::class)
            ->except('show');

        // Stock Out — CRUD penuh untuk admin & manager
        Route::resource('stock-outs', StockOutController::class)
            ->except('show');

        // Stock Opname — CRUD penuh untuk admin & manager
        Route::resource('stock-opnames', StockOpnameController::class)
            ->except('show');

        /*
        |----------------------------------------------------------------------
        | Laporan
        |----------------------------------------------------------------------
        */
        Route::get('/reports/stock-in', [ReportController::class, 'stockIn'])
            ->name('reports.stock-in');
        Route::get('/reports/stock-in/export-excel', [ReportController::class, 'exportStockInExcel'])
            ->name('reports.stock-in.excel');
        Route::get('/reports/stock-in/export-pdf', [ReportController::class, 'exportStockInPdf'])
            ->name('reports.stock-in.pdf');

        Route::get('/reports/stock-out', [ReportController::class, 'stockOut'])
            ->name('reports.stock-out');
        Route::get('/reports/stock-out/export-excel', [ReportController::class, 'exportStockOutExcel'])
            ->name('reports.stock-out.excel');
        Route::get('/reports/stock-out/export-pdf', [ReportController::class, 'exportStockOutPdf'])
            ->name('reports.stock-out.pdf');

        Route::get('/reports/inventory', [ReportController::class, 'inventory'])
            ->name('reports.inventory');
        Route::get('/reports/inventory/export-excel', [ReportController::class, 'exportInventoryExcel'])
            ->name('reports.inventory.excel');
        Route::get('/reports/inventory/export-pdf', [ReportController::class, 'exportInventoryPdf'])
            ->name('reports.inventory.pdf');

        Route::get('/reports/stock-opname', [ReportController::class, 'stockOpname'])
            ->name('reports.stock-opname');
        Route::get('/reports/stock-opname/export-excel', [ReportController::class, 'exportStockOpnameExcel'])
            ->name('reports.stock-opname.excel');
        Route::get('/reports/stock-opname/export-pdf', [ReportController::class, 'exportStockOpnamePdf'])
            ->name('reports.stock-opname.pdf');
    });

    /*
    |--------------------------------------------------------------------------
    | Logout
    |--------------------------------------------------------------------------
    */
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
