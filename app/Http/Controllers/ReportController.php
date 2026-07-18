<?php

namespace App\Http\Controllers;

use App\Exports\InventoryExport;
use App\Exports\StockInExport;
use App\Exports\StockOpnameExport;
use App\Exports\StockOutExport;
use App\Services\Report\ReportService;
use App\Services\StockOpname\StockOpnameService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function __construct(
        protected ReportService $reportService,
        protected StockOpnameService $stockOpnameService
    ) {}

    public function stockIn(Request $request)
    {
        $stockIns = $this->reportService->stockInReport(
            $request->start_date,
            $request->end_date
        );

        return view('pages.reports.stock-in', compact('stockIns'));
    }

    public function exportStockInExcel(Request $request)
    {
        return Excel::download(
            new StockInExport(
                $request->start_date,
                $request->end_date
            ),
            'laporan-stok-masuk.xlsx'
        );
    }

    public function exportStockInPdf(Request $request)
    {
        $stockIns = $this->reportService->stockInReport(
            $request->start_date,
            $request->end_date
        );

        $pdf = Pdf::loadView('pages.reports.pdf.stock-in', [
            'stockIns' => $stockIns,
            'startDate' => $request->start_date,
            'endDate' => $request->end_date,
        ]);

        return $pdf->download('laporan-stok-masuk.pdf');
    }

    public function exportStockOutExcel(Request $request)
    {
        return Excel::download(
            new StockOutExport(
                $request->start_date,
                $request->end_date
            ),
            'laporan-stok-keluar.xlsx'
        );
    }

    public function exportInventoryExcel()
    {
        return Excel::download(
            new InventoryExport(),
            'laporan-persediaan.xlsx'
        );
    }

    public function exportStockOutPdf(Request $request)
    {
        $stockOuts = $this->reportService->stockOutReport(
            $request->start_date,
            $request->end_date
        );

        $pdf = Pdf::loadView('pages.reports.pdf.stock-out', [
            'stockOuts' => $stockOuts,
            'startDate' => $request->start_date,
            'endDate' => $request->end_date,
        ]);

        return $pdf->download('laporan-stok-keluar.pdf');
    }

    public function exportInventoryPdf()
    {
        $products = $this->reportService->inventoryReport();

        $pdf = Pdf::loadView('pages.reports.pdf.inventory', [
            'products' => $products,
        ]);

        return $pdf->download('laporan-persediaan.pdf');
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

    public function stockOpname(Request $request)
    {
        $stockOpnames = $this->stockOpnameService->reportFilter(
            $request->start_date,
            $request->end_date
        );

        return view('pages.reports.stock-opname', compact('stockOpnames'));
    }

    public function exportStockOpnameExcel(Request $request)
    {
        return Excel::download(
            new StockOpnameExport($request->start_date, $request->end_date),
            'laporan-stock-opname.xlsx'
        );
    }

    public function exportStockOpnamePdf(Request $request)
    {
        $stockOpnames = $this->stockOpnameService->reportFilter(
            $request->start_date,
            $request->end_date
        );

        $pdf = Pdf::loadView('pages.reports.pdf.stock-opname', [
            'stockOpnames' => $stockOpnames,
            'startDate'    => $request->start_date,
            'endDate'      => $request->end_date,
        ]);

        return $pdf->download('laporan-stock-opname.pdf');
    }
}