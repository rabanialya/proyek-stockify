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

        <a
            href="{{ route('stock-ins.create') }}"
            class="inline-flex items-center justify-center rounded-lg bg-primary-700 px-4 py-2.5 text-sm font-medium text-white hover:bg-primary-800"
        >
            Tambah Stok Masuk
        </a>

    </div>

    @if(session('success'))
        <div class="mb-4 rounded-lg bg-green-100 p-4 text-sm text-green-800">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">

        <div class="overflow-x-auto">

            <table class="w-full text-left text-sm text-gray-500">

                <thead class="bg-gray-50 text-xs uppercase text-gray-700">

                <tr>

                    <th class="px-6 py-3">No</th>

                    <th class="px-6 py-3">Produk</th>

                    <th class="px-6 py-3">Jumlah</th>

                    <th class="px-6 py-3">Tanggal</th>

                    <th class="px-6 py-3">Keterangan</th>

                    <th class="px-6 py-3 text-right">
                        Aksi
                    </th>

                </tr>

                </thead>

                <tbody>

                @forelse($stockIns as $stock)

                    <tr class="border-b bg-white hover:bg-gray-50">

                        <td class="px-6 py-4">
                            {{ $loop->iteration }}
                        </td>

                        <td class="px-6 py-4 font-medium text-gray-900">
                            {{ $stock->product->name }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $stock->qty }}
                        </td>

                        <td class="px-6 py-4">
                            {{ \Carbon\Carbon::parse($stock->date)->format('d-m-Y') }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $stock->note ?? '-' }}
                        </td>

                        <td class="px-6 py-4">

                            <div class="flex justify-end gap-3">

                                <a
                                    href="{{ route('stock-ins.edit',$stock->id) }}"
                                    class="font-medium text-primary-700 hover:underline"
                                >
                                    Edit
                                </a>

                                <form
                                    method="POST"
                                    action="{{ route('stock-ins.destroy',$stock->id) }}"
                                    onsubmit="return confirm('Hapus data?')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button class="font-medium text-red-600 hover:underline">
                                        Hapus
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6" class="px-6 py-8 text-center">
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