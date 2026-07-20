@extends('layouts.dashboard')

@section('title', 'Stock Opname')

@section('content')
<div class="px-4 pt-6">

    <div class="mb-4 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                Stock Opname
            </h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Hasil penghitungan fisik stok barang di gudang.
            </p>
        </div>

        @if(auth()->user()->hasRole('admin', 'warehouse-manager'))
            <a
                href="{{ route('stock-opnames.create') }}"
                class="inline-flex items-center justify-center rounded-lg bg-primary-700 px-4 py-2.5 text-sm font-medium text-white hover:bg-primary-800"
            >
                Tambah Stock Opname
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
                        <th class="px-6 py-3">Tanggal</th>
                        <th class="px-6 py-3">Produk</th>
                        <th class="px-6 py-3">Stok Sistem</th>
                        <th class="px-6 py-3">Stok Fisik</th>
                        <th class="px-6 py-3">Selisih</th>
                        <th class="px-6 py-3">Petugas</th>
                        <th class="px-6 py-3">Keterangan</th>
                        @if(auth()->user()->hasRole('admin', 'warehouse-manager'))
                            <th class="px-6 py-3 text-right">Aksi</th>
                        @endif
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

                        @if(auth()->user()->hasRole('admin', 'warehouse-manager'))
                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-3">
                                    <a
                                        href="{{ route('stock-opnames.edit', $opname->id) }}"
                                        class="font-medium text-primary-700 hover:underline dark:text-primary-500"
                                    >
                                        Edit
                                    </a>
                                    <form
                                        method="POST"
                                        action="{{ route('stock-opnames.destroy', $opname->id) }}"
                                        onsubmit="return confirm('Hapus data stock opname ini?')"
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
                            colspan="{{ auth()->user()->hasRole('admin', 'warehouse-manager') ? 9 : 8 }}"
                            class="px-6 py-8 text-center text-gray-500 dark:text-gray-400"
                        >
                            Belum ada data stock opname.
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>
        </div>
    </div>

</div>
@endsection
