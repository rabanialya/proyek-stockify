<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Supplier;
use App\Services\Product\ProductService;

class ProductController extends Controller
{
    public function __construct(
        protected ProductService $productService
    ) {}

    public function index()
    {
        $products = $this->productService->all();

        return view('pages.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();

        return view('pages.products.create', compact('categories', 'suppliers'));
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();

        $data['stock'] = $data['stock'] ?? 0;
        $data['minimum_stock'] = $data['minimum_stock'] ?? 5;
        $data['status'] = $request->boolean('status');

        $this->productService->create($data);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(int $product)
    {
        $categories = Category::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();

        $product = $this->productService->findOrFail($product);

        return view('pages.products.edit', compact(
            'product',
            'categories',
            'suppliers'
        ));
    }

    public function update(UpdateProductRequest $request, int $product)
    {
        $data = $request->validated();

        $data['status'] = $request->boolean('status');

        $this->productService->update($product, $data);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(int $product)
    {
        $this->productService->delete($product);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}