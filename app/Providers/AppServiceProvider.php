<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// Category
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\CategoryRepositoryImplement;
use App\Services\Category\CategoryService;
use App\Services\Category\CategoryServiceImplement;

// Supplier
use App\Repositories\Supplier\SupplierRepository;
use App\Repositories\Supplier\SupplierRepositoryImplement;
use App\Services\Supplier\SupplierService;
use App\Services\Supplier\SupplierServiceImplement;

// Product
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductRepositoryImplement;
use App\Services\Product\ProductService;
use App\Services\Product\ProductServiceImplement;

// User
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryImplement;
use App\Services\User\UserService;
use App\Services\User\UserServiceImplement;

// StockIn
use App\Repositories\StockIn\StockInRepository;
use App\Repositories\StockIn\StockInRepositoryImplement;
use App\Services\StockIn\StockInService;
use App\Services\StockIn\StockInServiceImplement;

// StockOut
use App\Repositories\StockOut\StockOutRepository;
use App\Repositories\StockOut\StockOutRepositoryImplement;
use App\Services\StockOut\StockOutService;
use App\Services\StockOut\StockOutServiceImplement;

// Report
use App\Repositories\Report\ReportRepository;
use App\Repositories\Report\ReportRepositoryImplement;
use App\Services\Report\ReportService;
use App\Services\Report\ReportServiceImplement;

// Dashboard
use App\Repositories\Dashboard\DashboardRepository;
use App\Repositories\Dashboard\DashboardRepositoryImplement;
use App\Services\Dashboard\DashboardService;
use App\Services\Dashboard\DashboardServiceImplement;

// StockOpname
use App\Repositories\StockOpname\StockOpnameRepository;
use App\Repositories\StockOpname\StockOpnameRepositoryImplement;
use App\Services\StockOpname\StockOpnameService;
use App\Services\StockOpname\StockOpnameServiceImplement;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Category
        $this->app->bind(
            CategoryRepository::class,
            CategoryRepositoryImplement::class
        );

        $this->app->bind(
            CategoryService::class,
            CategoryServiceImplement::class
        );

        // Supplier
        $this->app->bind(
            SupplierRepository::class,
            SupplierRepositoryImplement::class
        );

        $this->app->bind(
            SupplierService::class,
            SupplierServiceImplement::class
        );

        // Product
        $this->app->bind(
            ProductRepository::class,
            ProductRepositoryImplement::class
        );

        $this->app->bind(
            ProductService::class,
            ProductServiceImplement::class
        );

        // User
        $this->app->bind(
            UserRepository::class,
            UserRepositoryImplement::class
        );

        $this->app->bind(
            UserService::class,
            UserServiceImplement::class
        );

        // StockIn
        $this->app->bind(
            StockInRepository::class,
            StockInRepositoryImplement::class
        );

        $this->app->bind(
            StockInService::class,
            StockInServiceImplement::class
        );

        // StockOut
        $this->app->bind(
            StockOutRepository::class,
            StockOutRepositoryImplement::class
        );

        $this->app->bind(
            StockOutService::class,
            StockOutServiceImplement::class
        );

        // Report
        $this->app->bind(
            ReportRepository::class,
            ReportRepositoryImplement::class
        );

        $this->app->bind(
            ReportService::class,
            ReportServiceImplement::class
        );

        // Dashboard
        $this->app->bind(
            DashboardRepository::class,
            DashboardRepositoryImplement::class
        );

        $this->app->bind(
            DashboardService::class,
            DashboardServiceImplement::class
        );

        // StockOpname
        $this->app->bind(
            StockOpnameRepository::class,
            StockOpnameRepositoryImplement::class
        );

        $this->app->bind(
            StockOpnameService::class,
            StockOpnameServiceImplement::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}