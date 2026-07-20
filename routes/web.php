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
    | Admin Only — Categories, Users
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin')->group(function () {
        Route::resource('categories', CategoryController::class)->except('show');
        Route::resource('users', UserController::class)->except('show');
    });

    /*
    |--------------------------------------------------------------------------
    | Produk — Index & Show: admin, manager, staff
    |           Create/Store/Edit/Update/Destroy: admin only
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin,warehouse-manager,warehouse-staff')->group(function () {
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    });

    Route::middleware('role:admin')->group(function () {
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    });

    Route::middleware('role:admin,warehouse-manager,warehouse-staff')->group(function () {
        // Didaftarkan setelah /products/create agar tidak menangkap string 'create'
        Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    });

    /*
    |--------------------------------------------------------------------------
    | Supplier — Index: admin, manager
    |             Create/Store/Edit/Update/Destroy: admin only
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin,warehouse-manager')->group(function () {
        Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
    });

    Route::middleware('role:admin')->group(function () {
        Route::get('/suppliers/create', [SupplierController::class, 'create'])->name('suppliers.create');
        Route::post('/suppliers', [SupplierController::class, 'store'])->name('suppliers.store');
        Route::get('/suppliers/{supplier}/edit', [SupplierController::class, 'edit'])->name('suppliers.edit');
        Route::put('/suppliers/{supplier}', [SupplierController::class, 'update'])->name('suppliers.update');
        Route::delete('/suppliers/{supplier}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | Stock In — Index: admin, manager, staff
    |             CRUD: admin, manager
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin,warehouse-manager,warehouse-staff')->group(function () {
        Route::get('/stock-ins', [StockInController::class, 'index'])->name('stock-ins.index');
    });

    Route::middleware('role:admin,warehouse-manager')->group(function () {
        Route::get('/stock-ins/create', [StockInController::class, 'create'])->name('stock-ins.create');
        Route::post('/stock-ins', [StockInController::class, 'store'])->name('stock-ins.store');
        Route::get('/stock-ins/{stock_in}/edit', [StockInController::class, 'edit'])->name('stock-ins.edit');
        Route::put('/stock-ins/{stock_in}', [StockInController::class, 'update'])->name('stock-ins.update');
        Route::delete('/stock-ins/{stock_in}', [StockInController::class, 'destroy'])->name('stock-ins.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | Stock Out — Index: admin, manager, staff
    |              CRUD: admin, manager
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin,warehouse-manager,warehouse-staff')->group(function () {
        Route::get('/stock-outs', [StockOutController::class, 'index'])->name('stock-outs.index');
    });

    Route::middleware('role:admin,warehouse-manager')->group(function () {
        Route::get('/stock-outs/create', [StockOutController::class, 'create'])->name('stock-outs.create');
        Route::post('/stock-outs', [StockOutController::class, 'store'])->name('stock-outs.store');
        Route::get('/stock-outs/{stock_out}/edit', [StockOutController::class, 'edit'])->name('stock-outs.edit');
        Route::put('/stock-outs/{stock_out}', [StockOutController::class, 'update'])->name('stock-outs.update');
        Route::delete('/stock-outs/{stock_out}', [StockOutController::class, 'destroy'])->name('stock-outs.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | Stock Opname — Index: admin, manager, staff
    |                 CRUD: admin, manager
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin,warehouse-manager,warehouse-staff')->group(function () {
        Route::get('/stock-opnames', [StockOpnameController::class, 'index'])->name('stock-opnames.index');
    });

    Route::middleware('role:admin,warehouse-manager')->group(function () {
        Route::get('/stock-opnames/create', [StockOpnameController::class, 'create'])->name('stock-opnames.create');
        Route::post('/stock-opnames', [StockOpnameController::class, 'store'])->name('stock-opnames.store');
        Route::get('/stock-opnames/{stock_opname}/edit', [StockOpnameController::class, 'edit'])->name('stock-opnames.edit');
        Route::put('/stock-opnames/{stock_opname}', [StockOpnameController::class, 'update'])->name('stock-opnames.update');
        Route::delete('/stock-opnames/{stock_opname}', [StockOpnameController::class, 'destroy'])->name('stock-opnames.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | Laporan — admin, manager
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin,warehouse-manager')->group(function () {
        Route::get('/reports/stock-in', [ReportController::class, 'stockIn'])->name('reports.stock-in');
        Route::get('/reports/stock-in/export-excel', [ReportController::class, 'exportStockInExcel'])->name('reports.stock-in.excel');
        Route::get('/reports/stock-in/export-pdf', [ReportController::class, 'exportStockInPdf'])->name('reports.stock-in.pdf');

        Route::get('/reports/stock-out', [ReportController::class, 'stockOut'])->name('reports.stock-out');
        Route::get('/reports/stock-out/export-excel', [ReportController::class, 'exportStockOutExcel'])->name('reports.stock-out.excel');
        Route::get('/reports/stock-out/export-pdf', [ReportController::class, 'exportStockOutPdf'])->name('reports.stock-out.pdf');

        Route::get('/reports/inventory', [ReportController::class, 'inventory'])->name('reports.inventory');
        Route::get('/reports/inventory/export-excel', [ReportController::class, 'exportInventoryExcel'])->name('reports.inventory.excel');
        Route::get('/reports/inventory/export-pdf', [ReportController::class, 'exportInventoryPdf'])->name('reports.inventory.pdf');

        Route::get('/reports/stock-opname', [ReportController::class, 'stockOpname'])->name('reports.stock-opname');
        Route::get('/reports/stock-opname/export-excel', [ReportController::class, 'exportStockOpnameExcel'])->name('reports.stock-opname.excel');
        Route::get('/reports/stock-opname/export-pdf', [ReportController::class, 'exportStockOpnamePdf'])->name('reports.stock-opname.pdf');
    });

    /*
    |--------------------------------------------------------------------------
    | Logout
    |--------------------------------------------------------------------------
    */
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
