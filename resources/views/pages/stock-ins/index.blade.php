@extends('layouts.dashboard')

@section('title', 'Stok Masuk')

@section('content')
<div class="px-4 pt-6">

    <div class="mb-4 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                Stok Masuk
            </h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Kelola seluruh transaksi barang masuk.
            </p>
        </div>

        @if(auth()->user()->hasRole('admin', 'warehouse-manager'))
            <a
                href="{{ route('stock-ins.create') }}"
                class="inline-flex items-center justify-center rounded-lg bg-primary-700 px-4 py-2.5 text-sm font-medium text-white hover:bg-primary-800"
            >
                Tambah Stok Masuk
            </a>
        @endif

    </div>

    @if(session('success'))
        <div class="mb-4 rounded-lg bg-green-100 p-4 text-sm text-green-800 dark:bg-green-900 dark:text-green-300">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">

                <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                    <tr>
                        <th class="px-6 py-3">No</th>
                        <th class="px-6 py-3">Produk</th>
                        <th class="px-6 py-3">Jumlah</th>
                        <th class="px-6 py-3">Tanggal</th>
                        <th class="px-6 py-3">Keterangan</th>
                        @if(auth()->user()->hasRole('admin', 'warehouse-manager'))
                            <th class="px-6 py-3 text-right">Aksi</th>
                        @endif
                    </tr>
                </thead>

                <tbody>
                @forelse($stockIns as $stock)
                    <tr class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">

                        <td class="px-6 py-4">{{ $loop->iteration }}</td>

                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            {{ $stock->product->name }}
                        </td>

                        <td class="px-6 py-4">{{ $stock->qty }}</td>

                        <td class="px-6 py-4">
                            {{ \Carbon\Carbon::parse($stock->date)->format('d-m-Y') }}
                        </td>

                        <td class="px-6 py-4">{{ $stock->note ?? '-' }}</td>

                        @if(auth()->user()->hasRole('admin', 'warehouse-manager'))
                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-3">
                                    <a
                                        href="{{ route('stock-ins.edit', $stock->id) }}"
                                        class="font-medium text-primary-700 hover:underline dark:text-primary-500"
                                    >
                                        Edit
                                    </a>
                                    <form
                                        method="POST"
                                        action="{{ route('stock-ins.destroy', $stock->id) }}"
                                        onsubmit="return confirm('Hapus data?')"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="font-medium text-red-600 hover:underline dark:text-red-500">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        @endif

                    </tr>
                @empty
                    <tr>
                        <td
                            colspan="{{ auth()->user()->hasRole('admin', 'warehouse-manager') ? 6 : 5 }}"
                            class="px-6 py-8 text-center text-gray-500 dark:text-gray-400"
                        >
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
