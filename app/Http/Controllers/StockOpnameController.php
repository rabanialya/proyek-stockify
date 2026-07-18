<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStockOpnameRequest;
use App\Http\Requests\UpdateStockOpnameRequest;
use App\Models\Product;
use App\Services\StockOpname\StockOpnameService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class StockOpnameController extends Controller
{
    public function __construct(
        protected StockOpnameService $stockOpnameService
    ) {}

    public function index(): View
    {
        $stockOpnames = $this->stockOpnameService->allWithRelations();

        return view('pages.stock-opnames.index', compact('stockOpnames'));
    }

    public function create(): View
    {
        $products = Product::orderBy('name')->get();

        return view('pages.stock-opnames.create', compact('products'));
    }

    public function store(StoreStockOpnameRequest $request): RedirectResponse
    {
        $data                = $request->validated();
        $data['user_id']     = auth()->id();
        $data['system_stock'] = Product::findOrFail($data['product_id'])->stock;

        $this->stockOpnameService->create($data);

        return redirect()
            ->route('stock-opnames.index')
            ->with('success', 'Stock opname berhasil disimpan.');
    }

    public function edit(int $stock_opname): View
    {
        $stockOpname = $this->stockOpnameService->findOrFail($stock_opname);
        $products    = Product::orderBy('name')->get();

        return view('pages.stock-opnames.edit', compact('stockOpname', 'products'));
    }

    public function update(UpdateStockOpnameRequest $request, int $stock_opname): RedirectResponse
    {
        $data                = $request->validated();
        $data['user_id']     = auth()->id();

        // system_stock diambil dari data yang sedang diedit (tidak berubah)
        $existing            = $this->stockOpnameService->findOrFail($stock_opname);
        $data['system_stock'] = $existing->system_stock;

        $this->stockOpnameService->update($stock_opname, $data);

        return redirect()
            ->route('stock-opnames.index')
            ->with('success', 'Stock opname berhasil diperbarui.');
    }

    public function destroy(int $stock_opname): RedirectResponse
    {
        $this->stockOpnameService->delete($stock_opname);

        return redirect()
            ->route('stock-opnames.index')
            ->with('success', 'Stock opname berhasil dihapus.');
    }
}
