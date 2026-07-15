<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Services\Supplier\SupplierService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SupplierController extends Controller
{
    private SupplierService $supplierService;

    public function __construct(SupplierService $supplierService)
    {
        $this->supplierService = $supplierService;
    }

    public function index(): View
    {
        $suppliers = $this->supplierService->all();

        return view('pages.suppliers.index', compact('suppliers'));
    }

    public function create(): View
    {
        return view('pages.suppliers.create');
    }

    public function store(
        StoreSupplierRequest $request
    ): RedirectResponse {
        $this->supplierService->create(
            $request->validated()
        );

        return redirect()
            ->route('suppliers.index')
            ->with('success', 'Supplier berhasil ditambahkan.');
    }

    public function edit(int $supplier): View
    {
        $supplier = $this->supplierService->findOrFail($supplier);

        return view(
            'pages.suppliers.edit',
            compact('supplier')
        );
    }

    public function update(
        UpdateSupplierRequest $request,
        int $supplier
    ): RedirectResponse {
        $this->supplierService->update(
            $supplier,
            $request->validated()
        );

        return redirect()
            ->route('suppliers.index')
            ->with('success', 'Supplier berhasil diperbarui.');
    }

    public function destroy(int $supplier): RedirectResponse
    {
        $this->supplierService->delete($supplier);

        return redirect()
            ->route('suppliers.index')
            ->with('success', 'Supplier berhasil dihapus.');
    }
}