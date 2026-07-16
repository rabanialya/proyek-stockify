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
                Menampilkan seluruh data persediaan barang yang tersedia di gudang.
            </p>
        </div>
    </div>

    <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                    <tr>
                        <th class="px-6 py-3">
                            No
                        </th>

                        <th class="px-6 py-3">
                            Produk
                        </th>

                        <th class="px-6 py-3">
                            SKU
                        </th>

                        <th class="px-6 py-3">
                            Kategori
                        </th>

                        <th class="px-6 py-3">
                            Supplier
                        </th>

                        <th class="px-6 py-3">
                            Harga Beli
                        </th>

                        <th class="px-6 py-3">
                            Harga Jual
                        </th>

                        <th class="px-6 py-3">
                            Stok
                        </th>

                        <th class="px-6 py-3">
                            Minimum
                        </th>

                        <th class="px-6 py-3">
                            Status
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($products as $product)

                        <tr class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">

                            <td class="px-6 py-4">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                {{ $product->name }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $product->sku }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $product->category->name }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $product->supplier->name }}
                            </td>

                            <td class="px-6 py-4">
                                Rp {{ number_format($product->purchase_price,0,',','.') }}
                            </td>

                            <td class="px-6 py-4">
                                Rp {{ number_format($product->selling_price,0,',','.') }}
                            </td>

                            <td class="px-6 py-4">
                                @if($product->stock <= $product->minimum_stock)

                                    <span class="font-semibold text-red-600">
                                        {{ $product->stock }}
                                    </span>

                                @else

                                    {{ $product->stock }}

                                @endif
                            </td>

                            <td class="px-6 py-4">
                                {{ $product->minimum_stock }}
                            </td>

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

                            <td colspan="10" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                                Belum ada data persediaan.
                            </td>

                        </tr>

                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

</div>
@endsection