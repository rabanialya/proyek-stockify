<?php

namespace App\Http\Controllers;

use App\Services\Category\CategoryService;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(): View
    {
        $categories = $this->categoryService->all();

        return view('pages.categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('pages.categories.create');
    }

    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $this->categoryService->create($request->validated());

        return redirect()
            ->route('categories.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(int $category): View
    {
        $category = $this->categoryService->findOrFail($category);

        return view('pages.categories.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, int $category): RedirectResponse
    {
        $this->categoryService->update($category, $request->validated());

        return redirect()
            ->route('categories.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(int $category): RedirectResponse
    {
        $this->categoryService->delete($category);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
