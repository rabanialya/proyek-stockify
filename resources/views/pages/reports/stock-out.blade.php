@extends('layouts.dashboard')

@section('title', 'Laporan Stok Masuk')

@section('content')
<div class="px-4 pt-6">

    <div class="mb-4 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                Laporan Stok Keluar
            </h1>

            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Riwayat seluruh transaksi stok keluar.
            </p>
        </div>
    </div>

    <form method="GET" class="mb-6 grid gap-4 md:grid-cols-3">

        <input
            type="date"
            name="start_date"
            value="{{ request('start_date') }}"
            class="rounded-lg border border-gray-300 p-2.5 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
        >

        <input
            type="date"
            name="end_date"
            value="{{ request('end_date') }}"
            class="rounded-lg border border-gray-300 p-2.5 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
        >

        <button
            class="rounded-lg bg-primary-700 px-4 py-2 text-white hover:bg-primary-800"
        >
            Filter
        </button>

    </form>

    <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">

        <div class="overflow-x-auto">

            <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">

                <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-300">

                    <tr>

                        <th class="px-6 py-3">No</th>

                        <th class="px-6 py-3">Tanggal</th>

                        <th class="px-6 py-3">Produk</th>

                        <th class="px-6 py-3">Qty</th>

                        <th class="px-6 py-3">Catatan</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($stockOuts as $stock)

                    <tr class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">

                        <td class="px-6 py-4">
                            {{ $loop->iteration }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $stock->date }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $stock->product->name }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $stock->qty }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $stock->note ?? '-' }}
                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5"
                            class="px-6 py-8 text-center">

                            Belum ada data.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>
@endsection