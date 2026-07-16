<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStockOutRequest;
use App\Http\Requests\UpdateStockOutRequest;
use App\Models\Product;
use App\Services\StockOut\StockOutService;

class StockOutController extends Controller
{
    public function __construct(
        protected StockOutService $stockOutService
    ) {
    }

    public function index()
    {
        $stockOuts = $this->stockOutService->all();

        return view('pages.stock-outs.index', compact('stockOuts'));
    }

    public function create()
    {
        $products = Product::where('status', true)
            ->orderBy('name')
            ->get();

        return view('pages.stock-outs.create', compact('products'));
    }

    public function store(StoreStockOutRequest $request)
    {
        $this->stockOutService->create(
            $request->validated()
        );

        return redirect()
            ->route('stock-outs.index')
            ->with('success', 'Stock keluar berhasil ditambahkan.');
    }

    public function edit(int $stock_out)
    {
        $products = Product::where('status', true)
            ->orderBy('name')
            ->get();

        $stockOut = $this->stockOutService->findOrFail($stock_out);

        return view(
            'pages.stock-outs.edit',
            compact('stockOut', 'products')
        );
    }

    public function update(
        UpdateStockOutRequest $request,
        int $stock_out
    ) {

        $this->stockOutService->update(
            $stock_out,
            $request->validated()
        );

        return redirect()
            ->route('stock-outs.index')
            ->with('success', 'Stock keluar berhasil diperbarui.');
    }

    public function destroy(int $stock_out)
    {
        $this->stockOutService->delete($stock_out);

        return redirect()
            ->route('stock-outs.index')
            ->with('success', 'Stock keluar berhasil dihapus.');
    }
}