@extends('layouts.dashboard')

@section('title','Dashboard')

@section('content')

<div class="px-4 pt-6">

    <h1 class="mb-6 text-2xl font-bold text-gray-900 dark:text-white">
        Dashboard Admin
    </h1>

    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">

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
                Total Kategori
            </p>

            <h2 class="mt-2 text-3xl font-bold">
                {{ $totalCategories }}
            </h2>
        </div>

        <div class="rounded-lg bg-white p-6 shadow dark:bg-gray-800">
            <p class="text-sm text-gray-500">
                Total Supplier
            </p>

            <h2 class="mt-2 text-3xl font-bold">
                {{ $totalSuppliers }}
            </h2>
        </div>

        <div class="rounded-lg bg-white p-6 shadow dark:bg-gray-800">
            <p class="text-sm text-gray-500">
                Stock Masuk Hari Ini
            </p>

            <h2 class="mt-2 text-3xl font-bold text-green-600">
                {{ $stockInToday }}
            </h2>
        </div>

        <div class="rounded-lg bg-white p-6 shadow dark:bg-gray-800">
            <p class="text-sm text-gray-500">
                Stock Keluar Hari Ini
            </p>

            <h2 class="mt-2 text-3xl font-bold text-red-600">
                {{ $stockOutToday }}
            </h2>
        </div>

        <div class="rounded-lg bg-white p-6 shadow dark:bg-gray-800">
            <p class="text-sm text-gray-500">
                Produk Hampir Habis
            </p>

            <h2 class="mt-2 text-3xl font-bold text-yellow-600">
                {{ $lowStocks }}
            </h2>
        </div>

    </div>

</div>

@endsection