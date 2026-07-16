<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStockInRequest;
use App\Http\Requests\UpdateStockInRequest;
use App\Models\Product;
use App\Services\StockIn\StockInService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class StockInController extends Controller
{
    public function __construct(
        protected StockInService $stockInService
    ) {}

    public function index(): View
    {
        $stockIns = $this->stockInService->all();

        return view('pages.stock-ins.index', compact('stockIns'));
    }

    public function create(): View
    {
        $products = Product::orderBy('name')->get();

        return view('pages.stock-ins.create', compact('products'));
    }

    public function store(StoreStockInRequest $request): RedirectResponse
    {
        $this->stockInService->create(
            $request->validated()
        );

        return redirect()
            ->route('stock-ins.index')
            ->with('success', 'Data barang masuk berhasil ditambahkan.');
    }

    public function edit(int $stock_in): View
    {
        $products = Product::orderBy('name')->get();

        $stockIn = $this->stockInService->findOrFail($stock_in);

        return view(
            'pages.stock-ins.edit',
            compact('stockIn', 'products')
        );
    }

    public function update(
        UpdateStockInRequest $request,
        int $stock_in
    ): RedirectResponse {

        $this->stockInService->update(
            $stock_in,
            $request->validated()
        );

        return redirect()
            ->route('stock-ins.index')
            ->with('success', 'Data barang masuk berhasil diperbarui.');
    }

    public function destroy(int $stock_in): RedirectResponse
    {
        $this->stockInService->delete($stock_in);

        return redirect()
            ->route('stock-ins.index')
            ->with('success', 'Data barang masuk berhasil dihapus.');
    }
}