@extends('layouts.dashboard')

@section('title', 'Dashboard Staff')

@section('content')
<div class="px-4 pt-6 pb-10">

    {{-- ===== HEADER ===== --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
            Selamat Datang, {{ auth()->user()->name }}
        </h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
            Daftar tugas operasional gudang hari ini,
            {{ now()->translatedFormat('l, d F Y') }}.
        </p>
    </div>

    {{-- ===== RINGKASAN HARI INI ===== --}}
    <div class="mb-6 grid gap-4 sm:grid-cols-2">

        <div class="flex items-center rounded-lg border border-green-200 bg-green-50 p-5 dark:border-green-700 dark:bg-green-900/20">
            <div class="mr-4 flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-green-200 dark:bg-green-800">
                <svg class="h-6 w-6 text-green-700 dark:text-green-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-green-700 dark:text-green-400">Barang Masuk Hari Ini</p>
                <h3 class="mt-1 text-3xl font-bold text-green-700 dark:text-green-400">{{ $stockInToday }}</h3>
                <p class="mt-0.5 text-xs text-green-600 dark:text-green-500">unit diterima</p>
            </div>
        </div>

        <div class="flex items-center rounded-lg border border-red-200 bg-red-50 p-5 dark:border-red-700 dark:bg-red-900/20">
            <div class="mr-4 flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-200 dark:bg-red-800">
                <svg class="h-6 w-6 text-red-700 dark:text-red-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-red-700 dark:text-red-400">Barang Keluar Hari Ini</p>
                <h3 class="mt-1 text-3xl font-bold text-red-700 dark:text-red-400">{{ $stockOutToday }}</h3>
                <p class="mt-0.5 text-xs text-red-600 dark:text-red-500">unit dikirim</p>
            </div>
        </div>

    </div>

    {{-- ===== DAFTAR TUGAS ===== --}}
    <div class="grid gap-6 lg:grid-cols-2">

        {{-- Barang Masuk yang Perlu Diperiksa --}}
        <div class="rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">

            <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                <div class="flex items-center gap-2">
                    <span class="flex h-8 w-8 items-center justify-center rounded-full bg-green-100 dark:bg-green-900">
                        <svg class="h-4 w-4 text-green-600 dark:text-green-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                        </svg>
                    </span>
                    <h2 class="font-semibold text-gray-900 dark:text-white">
                        Barang Masuk Perlu Diperiksa
                    </h2>
                </div>
                <a href="{{ route('stock-ins.index') }}"
                   class="text-sm font-medium text-primary-700 hover:underline dark:text-primary-400">
                    Lihat Semua
                </a>
            </div>

            <div class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($pendingStockIns as $item)
                    <div class="flex items-start gap-3 px-6 py-3">

                        {{-- Status indicator --}}
                        <div class="mt-1 flex-shrink-0">
                            <span class="flex h-2.5 w-2.5 rounded-full bg-green-400"></span>
                        </div>

                        <div class="flex-1 min-w-0">
                            <p class="truncate text-sm font-medium text-gray-900 dark:text-white">
                                {{ $item->product->name ?? '-' }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                {{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}
                                @if($item->note)
                                    &mdash; {{ $item->note }}
                                @endif
                            </p>
                        </div>

                        <span class="flex-shrink-0 rounded-full bg-green-100 px-2.5 py-1 text-xs font-semibold text-green-700 dark:bg-green-900 dark:text-green-300">
                            +{{ $item->qty }} unit
                        </span>

                    </div>
                @empty
                    <div class="flex flex-col items-center justify-center px-6 py-10 text-center">
                        <svg class="mb-3 h-10 w-10 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-sm text-gray-400 dark:text-gray-500">Tidak ada barang masuk.</p>
                    </div>
                @endforelse
            </div>

        </div>

        {{-- Barang Keluar yang Perlu Disiapkan --}}
        <div class="rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">

            <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                <div class="flex items-center gap-2">
                    <span class="flex h-8 w-8 items-center justify-center rounded-full bg-red-100 dark:bg-red-900">
                        <svg class="h-4 w-4 text-red-600 dark:text-red-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                    </span>
                    <h2 class="font-semibold text-gray-900 dark:text-white">
                        Barang Keluar Perlu Disiapkan
                    </h2>
                </div>
                <a href="{{ route('stock-outs.index') }}"
                   class="text-sm font-medium text-primary-700 hover:underline dark:text-primary-400">
                    Lihat Semua
                </a>
            </div>

            <div class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($pendingStockOuts as $item)
                    <div class="flex items-start gap-3 px-6 py-3">

                        {{-- Status indicator --}}
                        <div class="mt-1 flex-shrink-0">
                            <span class="flex h-2.5 w-2.5 rounded-full bg-red-400"></span>
                        </div>

                        <div class="flex-1 min-w-0">
                            <p class="truncate text-sm font-medium text-gray-900 dark:text-white">
                                {{ $item->product->name ?? '-' }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                {{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}
                                @if($item->note)
                                    &mdash; {{ $item->note }}
                                @endif
                            </p>
                        </div>

                        <span class="flex-shrink-0 rounded-full bg-red-100 px-2.5 py-1 text-xs font-semibold text-red-700 dark:bg-red-900 dark:text-red-300">
                            -{{ $item->qty }} unit
                        </span>

                    </div>
                @empty
                    <div class="flex flex-col items-center justify-center px-6 py-10 text-center">
                        <svg class="mb-3 h-10 w-10 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-sm text-gray-400 dark:text-gray-500">Tidak ada barang keluar.</p>
                    </div>
                @endforelse
            </div>

        </div>

    </div>

</div>
@endsection
