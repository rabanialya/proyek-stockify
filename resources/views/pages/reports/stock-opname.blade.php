@extends('layouts.dashboard')

@section('title', 'Laporan Stock Opname')

@section('content')
<div class="px-4 pt-6">

    <div class="mb-4 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                Laporan Stock Opname
            </h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Riwayat seluruh kegiatan penghitungan fisik stok barang.
            </p>
        </div>
    </div>

    {{-- ===== FILTER TANGGAL ===== --}}
    <div class="mb-6 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">

        <form method="GET" class="flex flex-wrap gap-3">
            <input
                type="date"
                name="start_date"
                value="{{ request('start_date') }}"
                class="rounded-lg border border-gray-300 p-2.5 text-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white"
            >
            <input
                type="date"
                name="end_date"
                value="{{ request('end_date') }}"
                class="rounded-lg border border-gray-300 p-2.5 text-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white"
            >
            <button
                type="submit"
                class="rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800"
            >
                Filter
            </button>
        </form>

        <div class="flex flex-wrap gap-3">
            <a
                href="{{ route('reports.stock-opname.excel', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}"
                class="rounded-lg bg-green-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-green-800"
            >
                Export Excel
            </a>
            <a
                href="{{ route('reports.stock-opname.pdf', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}"
                class="rounded-lg bg-red-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-red-800"
            >
                Export PDF
            </a>
        </div>

    </div>

    {{-- ===== SUMMARY CARDS ===== --}}
    <div class="mb-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">

        {{-- Total Transaksi --}}
        <div class="flex items-center rounded-lg border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="mr-4 flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-indigo-100 dark:bg-indigo-900">
                <svg class="h-6 w-6 text-indigo-600 dark:text-indigo-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Total Transaksi</p>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ number_format($summary['totalTransactions']) }}</h3>
            </div>
        </div>

        {{-- Selisih Positif --}}
        <div class="flex items-center rounded-lg border border-green-200 bg-green-50 p-5 shadow-sm dark:border-green-700 dark:bg-green-900/20">
            <div class="mr-4 flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-green-100 dark:bg-green-900">
                <svg class="h-6 w-6 text-green-600 dark:text-green-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
            </div>
            <div>
                <p class="text-xs text-green-600 dark:text-green-400">Total Selisih Positif</p>
                <h3 class="text-xl font-bold text-green-700 dark:text-green-300">+{{ number_format($summary['totalPositive']) }}</h3>
                <p class="text-xs text-green-500">unit lebih</p>
            </div>
        </div>

        {{-- Selisih Negatif --}}
        <div class="flex items-center rounded-lg border border-red-200 bg-red-50 p-5 shadow-sm dark:border-red-700 dark:bg-red-900/20">
            <div class="mr-4 flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 dark:bg-red-900">
                <svg class="h-6 w-6 text-red-600 dark:text-red-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4"/>
                </svg>
            </div>
            <div>
                <p class="text-xs text-red-600 dark:text-red-400">Total Selisih Negatif</p>
                <h3 class="text-xl font-bold text-red-700 dark:text-red-300">{{ number_format($summary['totalNegative']) }}</h3>
                <p class="text-xs text-red-500">unit kurang</p>
            </div>
        </div>

        {{-- Produk dengan Selisih --}}
        <div class="flex items-center rounded-lg border border-yellow-200 bg-yellow-50 p-5 shadow-sm dark:border-yellow-700 dark:bg-yellow-900/20">
            <div class="mr-4 flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-yellow-100 dark:bg-yellow-900">
                <svg class="h-6 w-6 text-yellow-600 dark:text-yellow-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs text-yellow-600 dark:text-yellow-400">Produk Ada Selisih</p>
                <h3 class="text-xl font-bold text-yellow-700 dark:text-yellow-300">{{ number_format($summary['productsWithDiff']) }}</h3>
                <p class="text-xs text-yellow-500">produk</p>
            </div>
        </div>

    </div>

    {{-- ===== TABEL HISTORI ===== --}}
    <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">

                <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                    <tr>
                        <th class="px-6 py-3">No</th>
                        <th class="px-6 py-3">Tanggal</th>
                        <th class="px-6 py-3">Produk</th>
                        <th class="px-6 py-3">Stok Sistem</th>
                        <th class="px-6 py-3">Stok Fisik</th>
                        <th class="px-6 py-3">Selisih</th>
                        <th class="px-6 py-3">Petugas</th>
                        <th class="px-6 py-3">Keterangan</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($stockOpnames as $opname)
                    <tr class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">

                        <td class="px-6 py-4">{{ $loop->iteration }}</td>

                        <td class="px-6 py-4">
                            {{ $opname->date?->format('d-m-Y') }}
                        </td>

                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            {{ $opname->product->name ?? '-' }}
                        </td>

                        <td class="px-6 py-4">{{ $opname->system_stock }}</td>

                        <td class="px-6 py-4">{{ $opname->physical_stock }}</td>

                        <td class="px-6 py-4">
                            @if($opname->difference > 0)
                                <span class="rounded-full bg-green-100 px-2.5 py-1 text-xs font-semibold text-green-800 dark:bg-green-900 dark:text-green-300">
                                    +{{ $opname->difference }}
                                </span>
                            @elseif($opname->difference < 0)
                                <span class="rounded-full bg-red-100 px-2.5 py-1 text-xs font-semibold text-red-800 dark:bg-red-900 dark:text-red-300">
                                    {{ $opname->difference }}
                                </span>
                            @else
                                <span class="rounded-full bg-gray-100 px-2.5 py-1 text-xs font-semibold text-gray-600 dark:bg-gray-700 dark:text-gray-300">
                                    0
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4">{{ $opname->user->name ?? '-' }}</td>

                        <td class="px-6 py-4">{{ $opname->note ?? '-' }}</td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="8">
                            <div class="flex flex-col items-center justify-center px-6 py-14 text-center">
                                <svg class="mb-4 h-14 w-14 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                </svg>
                                <p class="text-base font-semibold text-gray-500 dark:text-gray-400">Belum ada data stock opname.</p>
                                <p class="mt-1 text-sm text-gray-400 dark:text-gray-500">Silakan tambahkan transaksi stock opname terlebih dahulu.</p>
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
