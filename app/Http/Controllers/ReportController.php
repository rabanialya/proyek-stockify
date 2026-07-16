<?php

namespace App\Http\Controllers;

use App\Services\Report\ReportService;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct(
        protected ReportService $reportService
    ) {}

    public function stockIn(Request $request)
    {
        $stockIns = $this->reportService->stockInReport(
            $request->start_date,
            $request->end_date
        );

        return view('pages.reports.stock-in', compact('stockIns'));
    }

    public function stockOut(Request $request)
    {
        $stockOuts = $this->reportService->stockOutReport(
            $request->start_date,
            $request->end_date
        );

        return view('pages.reports.stock-out', compact('stockOuts'));
    }

    public function inventory()
    {
        $products = $this->reportService->inventoryReport();

        return view('pages.reports.inventory', compact('products'));
    }
}