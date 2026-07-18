@extends('layouts.dashboard')

@section('title', 'Detail Produk')

@section('content')
<div class="px-4 pt-6">

    <div class="mb-6 flex items-center gap-4">
        <a
            href="{{ route('products.index') }}"
            class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-white"
        >
            &larr; Kembali
        </a>
    </div>

    <h1 class="mb-6 text-2xl font-bold text-gray-900 dark:text-white">
        Detail Produk
    </h1>

    <div class="grid gap-6 lg:grid-cols-2">

        {{-- Info Utama --}}
        <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <h2 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Informasi Produk</h2>

            <dl class="space-y-3">
                <div class="flex justify-between border-b pb-2 dark:border-gray-700">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Nama Produk</dt>
                    <dd class="text-sm text-gray-900 dark:text-white font-medium">{{ $product->name }}</dd>
                </div>
                <div class="flex justify-between border-b pb-2 dark:border-gray-700">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">SKU</dt>
                    <dd class="text-sm text-gray-900 dark:text-white">{{ $product->sku }}</dd>
                </div>
                <div class="flex justify-between border-b pb-2 dark:border-gray-700">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Kategori</dt>
                    <dd class="text-sm text-gray-900 dark:text-white">{{ $product->category->name ?? '-' }}</dd>
                </div>
                <div class="flex justify-between border-b pb-2 dark:border-gray-700">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Supplier</dt>
                    <dd class="text-sm text-gray-900 dark:text-white">{{ $product->supplier->name ?? '-' }}</dd>
                </div>
                <div class="flex justify-between border-b pb-2 dark:border-gray-700">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Deskripsi</dt>
                    <dd class="text-sm text-gray-900 dark:text-white">{{ $product->description ?? '-' }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</dt>
                    <dd>
                        @if($product->status)
                            <span class="rounded-full bg-green-100 px-2.5 py-1 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300">
                                Aktif
                            </span>
                        @else
                            <span class="rounded-full bg-red-100 px-2.5 py-1 text-xs font-medium text-red-800 dark:bg-red-900 dark:text-red-300">
                                Tidak Aktif
                            </span>
                        @endif
                    </dd>
                </div>
            </dl>
        </div>

        {{-- Harga & Stok --}}
        <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <h2 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Harga & Stok</h2>

            <dl class="space-y-3">
                <div class="flex justify-between border-b pb-2 dark:border-gray-700">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Harga Beli</dt>
                    <dd class="text-sm font-medium text-gray-900 dark:text-white">
                        Rp {{ number_format($product->purchase_price, 0, ',', '.') }}
                    </dd>
                </div>
                <div class="flex justify-between border-b pb-2 dark:border-gray-700">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Harga Jual</dt>
                    <dd class="text-sm font-medium text-gray-900 dark:text-white">
                        Rp {{ number_format($product->selling_price, 0, ',', '.') }}
                    </dd>
                </div>
                <div class="flex justify-between border-b pb-2 dark:border-gray-700">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Stok Saat Ini</dt>
                    <dd>
                        @if($product->stock <= $product->minimum_stock)
                            <span class="rounded-full bg-red-100 px-2.5 py-1 text-xs font-semibold text-red-800 dark:bg-red-900 dark:text-red-300">
                                {{ $product->stock }} (Menipis)
                            </span>
                        @else
                            <span class="rounded-full bg-green-100 px-2.5 py-1 text-xs font-semibold text-green-800 dark:bg-green-900 dark:text-green-300">
                                {{ $product->stock }}
                            </span>
                        @endif
                    </dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Stok Minimum</dt>
                    <dd class="text-sm text-gray-900 dark:text-white">{{ $product->minimum_stock }}</dd>
                </div>
            </dl>
        </div>

    </div>

</div>
@endsection
