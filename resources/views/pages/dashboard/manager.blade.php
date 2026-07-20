@extends('layouts.dashboard')

@section('title', 'Dashboard Manager')

@section('content')
<div class="px-4 pt-6 pb-10">

    {{-- ===== HEADER ===== --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
            Selamat Datang, {{ auth()->user()->name }}
        </h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
            Ringkasan kondisi stok gudang hari ini,
            {{ now()->translatedFormat('l, d F Y') }}.
        </p>
    </div>

    {{-- ===== STATISTIC CARDS ===== --}}
    <div class="mb-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">

        {{-- Total Produk --}}
        <div class="flex items-center rounded-lg border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="mr-4 flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900">
                <svg class="h-6 w-6 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0v10l-8 4m0-10L4 7m8 4v10"/>
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Total Produk</p>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalProducts }}</h3>
            </div>
        </div>

        {{-- Total Stok --}}
        <div class="flex items-center rounded-lg border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="mr-4 flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-indigo-100 dark:bg-indigo-900">
                <svg class="h-6 w-6 text-indigo-600 dark:text-indigo-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Total Stok</p>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalStock }}</h3>
            </div>
        </div>

        {{-- Stok Menipis --}}
        <div class="flex items-center rounded-lg border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="mr-4 flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-yellow-100 dark:bg-yellow-900">
                <svg class="h-6 w-6 text-yellow-600 dark:text-yellow-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Stok Menipis</p>
                <h3 class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">{{ $lowStocks }}</h3>
            </div>
        </div>

        {{-- Total Supplier --}}
        <div class="flex items-center rounded-lg border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="mr-4 flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-green-100 dark:bg-green-900">
                <svg class="h-6 w-6 text-green-600 dark:text-green-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/>
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Total Supplier</p>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalSuppliers }}</h3>
            </div>
        </div>

    </div>

    {{-- ===== RINGKASAN HARI INI ===== --}}
    <div class="mb-6 grid gap-4 sm:grid-cols-2">

        <div class="rounded-lg border border-green-200 bg-green-50 p-5 dark:border-green-700 dark:bg-green-900/20">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-green-700 dark:text-green-400">Barang Masuk Hari Ini</p>
                    <h3 class="mt-1 text-3xl font-bold text-green-700 dark:text-green-400">{{ $stockInToday }}</h3>
                    <p class="mt-1 text-xs text-green-600 dark:text-green-500">unit diterima</p>
                </div>
                <div class="flex h-14 w-14 items-center justify-center rounded-full bg-green-200 dark:bg-green-800">
                    <svg class="h-7 w-7 text-green-700 dark:text-green-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="rounded-lg border border-red-200 bg-red-50 p-5 dark:border-red-700 dark:bg-red-900/20">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-red-700 dark:text-red-400">Barang Keluar Hari Ini</p>
                    <h3 class="mt-1 text-3xl font-bold text-red-700 dark:text-red-400">{{ $stockOutToday }}</h3>
                    <p class="mt-1 text-xs text-red-600 dark:text-red-500">unit dikirim</p>
                </div>
                <div class="flex h-14 w-14 items-center justify-center rounded-full bg-red-200 dark:bg-red-800">
                    <svg class="h-7 w-7 text-red-700 dark:text-red-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                </div>
            </div>
        </div>

    </div>

    {{-- ===== PRODUK STOK MENIPIS + AKTIVITAS TERBARU ===== --}}
    <div class="grid gap-6 lg:grid-cols-2">

        {{-- Produk Stok Menipis --}}
        <div class="rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                <h2 class="font-semibold text-red-600 dark:text-red-400">
                    Produk dengan Stok Menipis
                </h2>
                <a href="{{ route('reports.inventory') }}"
                   class="text-sm font-medium text-primary-700 hover:underline dark:text-primary-400">
                    Lihat Laporan
                </a>
            </div>

            <div class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($lowStockProducts as $product)
                    <div class="flex items-center justify-between px-6 py-3">
                        <div>
                            <p class="font-medium text-gray-900 dark:text-white">{{ $product->name }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $product->category->name ?? '-' }}</p>
                        </div>
                        <div class="flex items-center gap-3 text-sm">
                            <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700 dark:bg-red-900 dark:text-red-300">
                                Sisa {{ $product->stock }}
                            </span>
                            <span class="text-xs text-gray-400">Min. {{ $product->minimum_stock }}</span>
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-8 text-center text-sm text-green-600 dark:text-green-400">
                        Semua stok masih aman.
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Aktivitas Gudang Terbaru --}}
        <div class="rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                <h2 class="font-semibold text-gray-900 dark:text-white">
                    Aktivitas Gudang Terbaru
                </h2>
            </div>

            <div class="divide-y divide-gray-100 dark:divide-gray-700">

                {{-- Stock Masuk --}}
                @foreach($latestStockIns as $item)
                    <div class="flex items-start gap-3 px-6 py-3">
                        <span class="mt-0.5 flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-green-100 dark:bg-green-900">
                            <svg class="h-4 w-4 text-green-600 dark:text-green-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                            </svg>
                        </span>
                        <div class="flex-1 min-w-0">
                            <p class="truncate text-sm font-medium text-gray-900 dark:text-white">
                                {{ $item->product->name ?? '-' }}
                            </p>
                            <p class="text-xs text-green-600 dark:text-green-400">Barang Masuk</p>
                        </div>
                        <span class="flex-shrink-0 text-sm font-semibold text-green-600 dark:text-green-400">
                            +{{ $item->qty }}
                        </span>
                    </div>
                @endforeach

                {{-- Stock Keluar --}}
                @foreach($latestStockOuts as $item)
                    <div class="flex items-start gap-3 px-6 py-3">
                        <span class="mt-0.5 flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-red-100 dark:bg-red-900">
                            <svg class="h-4 w-4 text-red-600 dark:text-red-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                        </span>
                        <div class="flex-1 min-w-0">
                            <p class="truncate text-sm font-medium text-gray-900 dark:text-white">
                                {{ $item->product->name ?? '-' }}
                            </p>
                            <p class="text-xs text-red-600 dark:text-red-400">Barang Keluar</p>
                        </div>
                        <span class="flex-shrink-0 text-sm font-semibold text-red-600 dark:text-red-400">
                            -{{ $item->qty }}
                        </span>
                    </div>
                @endforeach

                @if($latestStockIns->isEmpty() && $latestStockOuts->isEmpty())
                    <div class="px-6 py-8 text-center text-sm text-gray-400 dark:text-gray-500">
                        Belum ada aktivitas.
                    </div>
                @endif

            </div>
        </div>

    </div>

</div>
@endsection
