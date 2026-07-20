@extends('layouts.dashboard')

@section('title', 'Dashboard Admin')

@section('content')
<div class="px-4 pt-6 pb-10">

    {{-- ===== HEADER ===== --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
            Selamat Datang, {{ auth()->user()->name }}
        </h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
            Berikut ringkasan kondisi sistem Stockify hari ini,
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

        {{-- Total User --}}
        <div class="flex items-center rounded-lg border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="mr-4 flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-purple-100 dark:bg-purple-900">
                <svg class="h-6 w-6 text-purple-600 dark:text-purple-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Total Pengguna</p>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalUsers }}</h3>
            </div>
        </div>

        {{-- Produk Stok Menipis --}}
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

        {{-- Total Transaksi Masuk --}}
        <div class="flex items-center rounded-lg border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="mr-4 flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-green-100 dark:bg-green-900">
                <svg class="h-6 w-6 text-green-600 dark:text-green-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Total Barang Masuk</p>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalStockIn }}</h3>
            </div>
        </div>

        {{-- Total Transaksi Keluar --}}
        <div class="flex items-center rounded-lg border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="mr-4 flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 dark:bg-red-900">
                <svg class="h-6 w-6 text-red-600 dark:text-red-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Total Barang Keluar</p>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalStockOut }}</h3>
            </div>
        </div>

        {{-- Total Stock Opname --}}
        <div class="flex items-center rounded-lg border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="mr-4 flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-indigo-100 dark:bg-indigo-900">
                <svg class="h-6 w-6 text-indigo-600 dark:text-indigo-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Total Stock Opname</p>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalOpname }}</h3>
            </div>
        </div>

        {{-- Total Kategori --}}
        <div class="flex items-center rounded-lg border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="mr-4 flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-orange-100 dark:bg-orange-900">
                <svg class="h-6 w-6 text-orange-600 dark:text-orange-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Total Kategori</p>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalCategories }}</h3>
            </div>
        </div>

    </div>

    {{-- ===== GRAFIK STOK 7 HARI TERAKHIR ===== --}}
    <div class="mb-6 rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">

        <div class="mb-4 flex items-center justify-between">
            <div>
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Grafik Barang Masuk & Keluar
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400">7 hari terakhir</p>
            </div>
            <div class="flex items-center gap-4 text-sm">
                <span class="flex items-center gap-1.5 text-gray-500 dark:text-gray-400">
                    <span class="inline-block h-3 w-3 rounded-full bg-blue-500"></span> Masuk
                </span>
                <span class="flex items-center gap-1.5 text-gray-500 dark:text-gray-400">
                    <span class="inline-block h-3 w-3 rounded-full bg-red-400"></span> Keluar
                </span>
            </div>
        </div>

        <div id="stock-chart"></div>

    </div>

    {{-- ===== RINGKASAN HARI INI ===== --}}
    <div class="mb-6 grid gap-4 sm:grid-cols-3">

        <div class="rounded-lg border border-green-200 bg-green-50 p-5 dark:border-green-700 dark:bg-green-900/20">
            <p class="text-sm font-medium text-green-700 dark:text-green-400">Barang Masuk Hari Ini</p>
            <h3 class="mt-1 text-3xl font-bold text-green-700 dark:text-green-400">{{ $stockInToday }}</h3>
            <p class="mt-1 text-xs text-green-600 dark:text-green-500">unit diterima</p>
        </div>

        <div class="rounded-lg border border-red-200 bg-red-50 p-5 dark:border-red-700 dark:bg-red-900/20">
            <p class="text-sm font-medium text-red-700 dark:text-red-400">Barang Keluar Hari Ini</p>
            <h3 class="mt-1 text-3xl font-bold text-red-700 dark:text-red-400">{{ $stockOutToday }}</h3>
            <p class="mt-1 text-xs text-red-600 dark:text-red-500">unit dikirim</p>
        </div>

        <div class="rounded-lg border border-indigo-200 bg-indigo-50 p-5 dark:border-indigo-700 dark:bg-indigo-900/20">
            <p class="text-sm font-medium text-indigo-700 dark:text-indigo-400">Stock Opname Hari Ini</p>
            <h3 class="mt-1 text-3xl font-bold text-indigo-700 dark:text-indigo-400">{{ $opnameToday }}</h3>
            <p class="mt-1 text-xs text-indigo-600 dark:text-indigo-500">transaksi opname</p>
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
                    Lihat Semua
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                    <thead class="bg-gray-50 text-xs uppercase text-gray-600 dark:bg-gray-700 dark:text-gray-300">
                        <tr>
                            <th class="px-6 py-3">Produk</th>
                            <th class="px-6 py-3">Kategori</th>
                            <th class="px-6 py-3 text-center">Stok</th>
                            <th class="px-6 py-3 text-center">Min.</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($lowStockProducts as $product)
                        <tr class="border-b bg-white last:border-0 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                            <td class="px-6 py-3 font-medium text-gray-900 dark:text-white">
                                {{ $product->name }}
                            </td>
                            <td class="px-6 py-3">{{ $product->category->name ?? '-' }}</td>
                            <td class="px-6 py-3 text-center">
                                <span class="rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-semibold text-red-700 dark:bg-red-900 dark:text-red-300">
                                    {{ $product->stock }}
                                </span>
                            </td>
                            <td class="px-6 py-3 text-center text-gray-500">{{ $product->minimum_stock }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-6 text-center text-green-600 dark:text-green-400">
                                Semua stok masih aman.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Aktivitas Terbaru --}}
        <div class="rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                <h2 class="font-semibold text-gray-900 dark:text-white">
                    Aktivitas Terbaru
                </h2>
                <span class="rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-600 dark:bg-gray-700 dark:text-gray-300">
                    10 terbaru
                </span>
            </div>

            <div class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($recentActivities as $activity)
                    <div class="flex items-start gap-3 px-6 py-3">

                        {{-- Icon --}}
                        @if($activity['type'] === 'stock-in')
                            <span class="mt-0.5 flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-green-100 dark:bg-green-900">
                                <svg class="h-4 w-4 text-green-600 dark:text-green-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                </svg>
                            </span>
                        @elseif($activity['type'] === 'stock-out')
                            <span class="mt-0.5 flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-red-100 dark:bg-red-900">
                                <svg class="h-4 w-4 text-red-600 dark:text-red-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                </svg>
                            </span>
                        @else
                            <span class="mt-0.5 flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-indigo-100 dark:bg-indigo-900">
                                <svg class="h-4 w-4 text-indigo-600 dark:text-indigo-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                </svg>
                            </span>
                        @endif

                        {{-- Text --}}
                        <div class="flex-1 min-w-0">
                            <p class="truncate text-sm font-medium text-gray-900 dark:text-white">
                                {{ $activity['label'] }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                {{ $activity['sub'] }}
                            </p>
                        </div>

                        {{-- Time --}}
                        <span class="flex-shrink-0 text-xs text-gray-400 dark:text-gray-500">
                            {{ $activity['time_human'] }}
                        </span>

                    </div>
                @empty
                    <div class="px-6 py-8 text-center text-sm text-gray-400 dark:text-gray-500">
                        Belum ada aktivitas.
                    </div>
                @endforelse
            </div>
        </div>

    </div>

</div>

{{-- ===== APEXCHARTS — DATA DARI BLADE ===== --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const isDark = document.documentElement.classList.contains('dark');

        const labelColor  = isDark ? '#9CA3AF' : '#6B7280';
        const borderColor = isDark ? '#374151' : '#F3F4F6';

        const options = {
            chart: {
                height: 320,
                type: 'area',
                fontFamily: 'Inter, sans-serif',
                foreColor: labelColor,
                toolbar: { show: false },
            },
            fill: {
                type: 'gradient',
                gradient: {
                    enabled: true,
                    opacityFrom: isDark ? 0 : 0.35,
                    opacityTo: 0,
                },
            },
            dataLabels: { enabled: false },
            stroke: { curve: 'smooth', width: 2 },
            series: [
                {
                    name: 'Barang Masuk',
                    data: @json($chartStockIn),
                    color: '#3B82F6',
                },
                {
                    name: 'Barang Keluar',
                    data: @json($chartStockOut),
                    color: '#EF4444',
                },
            ],
            xaxis: {
                categories: @json($chartLabels),
                labels: {
                    style: { colors: labelColor, fontSize: '13px' },
                },
                axisBorder: { color: borderColor },
                axisTicks: { color: borderColor },
            },
            yaxis: {
                labels: {
                    style: { colors: labelColor, fontSize: '13px' },
                    formatter: (v) => v + ' unit',
                },
            },
            grid: {
                borderColor: borderColor,
                strokeDashArray: 2,
                padding: { left: 10, bottom: 10 },
            },
            tooltip: {
                style: { fontSize: '13px', fontFamily: 'Inter, sans-serif' },
            },
            legend: {
                show: false,
            },
            markers: {
                size: 4,
                strokeColors: '#fff',
                hover: { sizeOffset: 2 },
            },
        };

        const chart = new ApexCharts(document.getElementById('stock-chart'), options);
        chart.render();

        // Update saat toggle dark mode
        document.addEventListener('dark-mode', function () {
            const d = document.documentElement.classList.contains('dark');
            chart.updateOptions({
                chart: { foreColor: d ? '#9CA3AF' : '#6B7280' },
                grid:  { borderColor: d ? '#374151' : '#F3F4F6' },
            });
        });
    });
</script>
@endpush

@endsection
