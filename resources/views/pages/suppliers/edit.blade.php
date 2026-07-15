@extends('layouts.dashboard')

@section('title', 'Edit Supplier')

@section('content')
    <div class="px-4 pt-6">
        <div class="mb-4">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                Edit Supplier
            </h1>

            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Perbarui informasi {{ $supplier->name }}.
            </p>
        </div>

        <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <form
                method="POST"
                action="{{ route('suppliers.update', $supplier->id) }}"
            >
                @csrf
                @method('PUT')

                @include('pages.suppliers._form', [
                    'submitLabel' => 'Simpan Perubahan',
                ])
            </form>
        </div>
    </div>
@endsection