@extends('layouts.dashboard')

@section('title','Dashboard Manager')

@section('content')

<div class="px-4 pt-6">

    <h1 class="mb-6 text-2xl font-bold text-gray-900 dark:text-white">
        Dashboard Manager Gudang
    </h1>

    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-5">

        <div class="rounded-lg bg-white p-6 shadow dark:bg-gray-800">
            <p class="text-sm text-gray-500">
                Total Produk
            </p>

            <h2 class="mt-2 text-3xl font-bold">
                {{ $totalProducts }}
            </h2>
        </div>

        <div class="rounded-lg bg-white p-6 shadow dark:bg-gray-800">
            <p class="text-sm text-gray-500">
                Total Stok
            </p>

            <h2 class="mt-2 text-3xl font-bold text-blue-600">
                {{ $totalStock }}
            </h2>
        </div>

        <div class="rounded-lg bg-white p-6 shadow dark:bg-gray-800">
            <p class="text-sm text-gray-500">
                Produk Menipis
            </p>

            <h2 class="mt-2 text-3xl font-bold text-yellow-600">
                {{ $lowStocks }}
            </h2>
        </div>

        <div class="rounded-lg bg-white p-6 shadow dark:bg-gray-800">
            <p class="text-sm text-gray-500">
                Barang Masuk Hari Ini
            </p>

            <h2 class="mt-2 text-3xl font-bold text-green-600">
                {{ $stockInToday }}
            </h2>
        </div>

        <div class="rounded-lg bg-white p-6 shadow dark:bg-gray-800">
            <p class="text-sm text-gray-500">
                Barang Keluar Hari Ini
            </p>

            <h2 class="mt-2 text-3xl font-bold text-red-600">
                {{ $stockOutToday }}
            </h2>
        </div>

    </div>

    <div class="mt-8 grid gap-6 lg:grid-cols-2">

        <div class="rounded-lg bg-white p-6 shadow dark:bg-gray-800">

            <h2 class="mb-4 text-lg font-semibold text-red-600">
                Produk dengan Stok Menipis
            </h2>

            @forelse($lowStockProducts as $product)

                <div class="flex items-center justify-between border-b py-3">

                    <div>

                        <div class="font-medium text-gray-900 dark:text-white">
                            {{ $product->name }}
                        </div>

                        <div class="text-sm text-gray-500">
                            {{ $product->category->name }}
                        </div>

                    </div>

                    <span class="rounded-full bg-red-100 px-3 py-1 text-sm font-semibold text-red-700">

                        {{ $product->stock }}

                    </span>

                </div>

            @empty

                <p class="text-green-600">

                    Semua stok masih aman.

                </p>

            @endforelse

        </div>

        <div class="rounded-lg bg-white p-6 shadow dark:bg-gray-800">

            <h2 class="mb-4 text-lg font-semibold">
                Aktivitas Gudang Terbaru
            </h2>

            <div class="space-y-4">

                @foreach($latestStockIns as $item)

                    <div class="flex justify-between">

                        <div>

                            <div class="font-medium">

                                {{ $item->product->name }}

                            </div>

                            <div class="text-sm text-green-600">

                                Barang Masuk

                            </div>

                        </div>

                        <div class="font-semibold text-green-600">

                            +{{ $item->qty }}

                        </div>

                    </div>

                @endforeach

                @foreach($latestStockOuts as $item)

                    <div class="flex justify-between">

                        <div>

                            <div class="font-medium">

                                {{ $item->product->name }}

                            </div>

                            <div class="text-sm text-red-600">

                                Barang Keluar

                            </div>

                        </div>

                        <div class="font-semibold text-red-600">

                            -{{ $item->qty }}

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    </div>

</div>

@endsection