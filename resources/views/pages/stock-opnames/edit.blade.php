@extends('layouts.dashboard')

@section('title', 'Edit Stock Opname')

@section('content')
<div class="px-4 pt-6">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
            Edit Stock Opname
        </h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
            Perbarui data hasil penghitungan fisik stok barang.
        </p>
    </div>

    <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <form action="{{ route('stock-opnames.update', $stockOpname->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('pages.stock-opnames._form', ['submitLabel' => 'Perbarui'])
        </form>
    </div>

</div>
@endsection
