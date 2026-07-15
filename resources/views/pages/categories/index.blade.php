@extends('layouts.dashboard')

@section('title', 'Kategori')

@section('content')
    <div class="px-4 pt-6">
        <div class="mb-4 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                    Kategori Produk
                </h1>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Kelola kategori yang digunakan untuk mengelompokkan produk.
                </p>
            </div>

            <a
                href="{{ route('categories.create') }}"
                class="inline-flex items-center justify-center rounded-lg bg-primary-700 px-4 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300"
            >
                Tambah Kategori
            </a>
        </div>

        @if (session('success'))
            <div
                class="mb-4 rounded-lg bg-green-100 p-4 text-sm text-green-800 dark:bg-green-900 dark:text-green-300"
                role="alert"
            >
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                    <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No.
                            </th>

                            <th scope="col" class="px-6 py-3">
                                Nama
                            </th>

                            <th scope="col" class="px-6 py-3">
                                Slug
                            </th>

                            <th scope="col" class="px-6 py-3">
                                Deskripsi
                            </th>

                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>

                            <th scope="col" class="px-6 py-3 text-right">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($categories as $category)
                            <tr class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                                <td class="px-6 py-4">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                    {{ $category->name }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $category->slug }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $category->description ?? '-' }}
                                </td>

                                <td class="px-6 py-4">
                                    @if ($category->is_active)
                                        <span class="rounded-full bg-green-100 px-2.5 py-1 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300">
                                            Aktif
                                        </span>
                                    @else
                                        <span class="rounded-full bg-red-100 px-2.5 py-1 text-xs font-medium text-red-800 dark:bg-red-900 dark:text-red-300">
                                            Tidak Aktif
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-3">
                                        <a
                                            href="{{ route('categories.edit', $category->id) }}"
                                            class="font-medium text-primary-700 hover:underline dark:text-primary-500"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            method="POST"
                                            action="{{ route('categories.destroy', $category->id) }}"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="font-medium text-red-600 hover:underline dark:text-red-500"
                                            >
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                                    Belum ada data kategori.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection