@extends('layouts.dashboard')

@section('title', 'Tambah Kategori')

@section('content')
    <div class="px-4 pt-6">
        <div class="mb-4">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                Tambah Kategori
            </h1>

            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Tambahkan kategori baru untuk mengelompokkan produk.
            </p>
        </div>

        <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <form method="POST" action="{{ route('categories.store') }}">
                @csrf

                <div class="space-y-6">
                    <div>
                        <label
                            for="name"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                        >
                            Nama Kategori
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Contoh: Peralatan Kantor"
                            required
                            autofocus
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-600 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                        >

                        @error('name')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label
                            for="description"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                        >
                            Deskripsi
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="4"
                            placeholder="Masukkan deskripsi kategori"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-600 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                        >{{ old('description') }}</textarea>

                        @error('description')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label
                            for="is_active"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                        >
                            Status
                        </label>

                        <select
                            id="is_active"
                            name="is_active"
                            required
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-600 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                        >
                            <option value="1" @selected(old('is_active', '1') === '1')>
                                Aktif
                            </option>

                            <option value="0" @selected(old('is_active') === '0')>
                                Tidak Aktif
                            </option>
                        </select>

                        @error('is_active')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                        <a
                            href="{{ route('categories.index') }}"
                            class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="inline-flex items-center justify-center rounded-lg bg-primary-700 px-4 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300"
                        >
                            Simpan Kategori
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection