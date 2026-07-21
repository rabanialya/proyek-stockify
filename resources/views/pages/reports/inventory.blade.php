@extends('layouts.dashboard')

@section('title', 'Laporan Persediaan')

@section('content')
<div class="px-4 pt-6">

    <div class="mb-4 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                Laporan Persediaan Barang
            </h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Ringkasan kondisi persediaan barang di gudang saat ini.
            </p>
        </div>
    </div>

    {{-- ===== SUMMARY CARDS ===== --}}
    <div class="mb-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-5">

        {{-- Total Produk --}}
        <div class="flex items-center rounded-lg border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="mr-4 flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900">
                <svg class="h-6 w-6 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0v10l-8 4m0-10L4 7m8 4v10"/>
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Total Produk</p>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ number_format($summary['totalProducts']) }}</h3>
            </div>
        </div>

        {{-- Total Unit Stok --}}
        <div class="flex items-center rounded-lg border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="mr-4 flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-indigo-100 dark:bg-indigo-900">
                <svg class="h-6 w-6 text-indigo-600 dark:text-indigo-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Total Unit Stok</p>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ number_format($summary['totalStock']) }}</h3>
            </div>
        </div>

        {{-- Nilai Persediaan (Harga Beli) --}}
        <div class="flex items-center rounded-lg border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="mr-4 flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-green-100 dark:bg-green-900">
                <svg class="h-6 w-6 text-green-600 dark:text-green-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Nilai (Harga Beli Terakhir)</p>
                <h3 class="text-base font-bold text-gray-900 dark:text-white">Rp {{ number_format($summary['totalValuePurchase'], 0, ',', '.') }}</h3>
            </div>
        </div>

        {{-- Nilai Persediaan (Harga Jual) --}}
        <div class="flex items-center rounded-lg border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="mr-4 flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-purple-100 dark:bg-purple-900">
                <svg class="h-6 w-6 text-purple-600 dark:text-purple-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Nilai (Harga Jual)</p>
                <h3 class="text-base font-bold text-gray-900 dark:text-white">Rp {{ number_format($summary['totalValueSelling'], 0, ',', '.') }}</h3>
            </div>
        </div>

        {{-- Stok Menipis --}}
        <div class="flex items-center rounded-lg border border-yellow-200 bg-yellow-50 p-5 shadow-sm dark:border-yellow-700 dark:bg-yellow-900/20">
            <div class="mr-4 flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-yellow-100 dark:bg-yellow-900">
                <svg class="h-6 w-6 text-yellow-600 dark:text-yellow-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs text-yellow-600 dark:text-yellow-400">Stok Menipis</p>
                <h3 class="text-xl font-bold text-yellow-700 dark:text-yellow-300">{{ number_format($summary['lowStockCount']) }}</h3>
                <p class="text-xs text-yellow-500 dark:text-yellow-500">produk</p>
            </div>
        </div>

    </div>

    {{-- ===== EXPORT BUTTONS ===== --}}
    <div class="mb-6 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-end">
        <div class="flex flex-wrap gap-3">
            <a
                href="{{ route('reports.inventory.excel') }}"
                class="rounded-lg bg-green-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-green-700"
            >
                Export Excel
            </a>
            <a
                href="{{ route('reports.inventory.pdf') }}"
                class="rounded-lg bg-red-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-red-700"
            >
                Export PDF
            </a>
        </div>
    </div>

    {{-- ===== TABEL PERSEDIAAN ===== --}}
    <div class="rounded-xl bg-white shadow dark:bg-gray-800">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                <thead class="bg-gray-100 text-xs uppercase tracking-wider text-gray-700 dark:bg-gray-700 dark:text-gray-200">
                    <tr>
                        <th class="px-6 py-3">No</th>
                        <th class="px-6 py-3">Produk</th>
                        <th class="px-6 py-3">SKU</th>
                        <th class="px-6 py-3">Kategori</th>
                        <th class="px-6 py-3">Supplier</th>
                        <th class="px-6 py-3">Harga Beli Terakhir</th>
                        <th class="px-6 py-3">Harga Jual</th>
                        <th class="px-6 py-3">Stok</th>
                        <th class="px-6 py-3">Minimum</th>
                        <th class="px-6 py-3">Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($products as $product)
                        <tr class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                            <td class="px-6 py-4">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $product->name }}</td>
                            <td class="px-6 py-4">{{ $product->sku }}</td>
                            <td class="px-6 py-4">{{ $product->category->name }}</td>
                            <td class="px-6 py-4">{{ $product->supplier->name }}</td>
                            <td class="px-6 py-4">Rp {{ number_format($product->purchase_price,0,',','.') }}</td>
                            <td class="px-6 py-4">Rp {{ number_format($product->selling_price,0,',','.') }}</td>
                            <td class="px-6 py-4">
                                @if($product->stock <= $product->minimum_stock)
                                    <span class="font-semibold text-red-600">{{ $product->stock }}</span>
                                @else
                                    {{ $product->stock }}
                                @endif
                            </td>
                            <td class="px-6 py-4">{{ $product->minimum_stock }}</td>
                            <td class="px-6 py-4">
                                @if($product->stock <= $product->minimum_stock)
                                    <span class="rounded-full bg-red-100 px-2.5 py-1 text-xs font-medium text-red-800 dark:bg-red-900 dark:text-red-300">
                                        Stok Menipis
                                    </span>
                                @else
                                    <span class="rounded-full bg-green-100 px-2.5 py-1 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300">
                                        Aman
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10">
                                <div class="flex flex-col items-center justify-center px-6 py-14 text-center">
                                    <svg class="mb-4 h-14 w-14 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0v10l-8 4m0-10L4 7m8 4v10"/>
                                    </svg>
                                    <p class="text-base font-semibold text-gray-500 dark:text-gray-400">Belum ada data persediaan.</p>
                                    <p class="mt-1 text-sm text-gray-400 dark:text-gray-500">Silakan tambahkan produk terlebih dahulu.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection