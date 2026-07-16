@extends('layouts.dashboard')

@section('title','Stok Keluar')

@section('content')

<div class="px-4 pt-6">

    <div class="mb-4 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                Stok Keluar
            </h1>

            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Kelola seluruh transaksi barang keluar.
            </p>

        </div>

        <a
            href="{{ route('stock-outs.create') }}"
            class="inline-flex items-center justify-center rounded-lg bg-primary-700 px-4 py-2.5 text-sm font-medium text-white hover:bg-primary-800">

            Tambah Stok Keluar

        </a>

    </div>

    @if(session('success'))

        <div class="mb-4 rounded-lg bg-green-100 p-4 text-sm text-green-800">

            {{ session('success') }}

        </div>

    @endif

    <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">

        <div class="overflow-x-auto">

            <table class="w-full text-left text-sm text-gray-500">

                <thead class="bg-gray-50 text-xs uppercase text-gray-700">

                    <tr>

                        <th class="px-6 py-3">No</th>
                        <th class="px-6 py-3">Produk</th>
                        <th class="px-6 py-3">Jumlah</th>
                        <th class="px-6 py-3">Tanggal</th>
                        <th class="px-6 py-3">Keterangan</th>
                        <th class="px-6 py-3 text-right">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($stockOuts as $stockOut)

                        <tr class="border-b hover:bg-gray-50">

                            <td class="px-6 py-4">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $stockOut->product->name }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $stockOut->qty }}
                            </td>

                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($stockOut->date)->format('d-m-Y') }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $stockOut->note ?? '-' }}
                            </td>

                            <td class="px-6 py-4">

                                <div class="flex justify-end gap-3">

                                    <a
                                        href="{{ route('stock-outs.edit',$stockOut->id) }}"
                                        class="font-medium text-primary-700 hover:underline">

                                        Edit

                                    </a>

                                    <form
                                        action="{{ route('stock-outs.destroy',$stockOut->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="font-medium text-red-600 hover:underline">

                                            Hapus

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="px-6 py-8 text-center text-gray-500">

                                Belum ada data stok keluar.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection