@extends('layouts.dashboard')

@section('title','Edit Stok Masuk')

@section('content')

<div class="px-4 pt-6">

    <div class="mb-6">

        <h1 class="text-2xl font-bold text-gray-900">

            Edit Stok Masuk

        </h1>

        <p class="mt-1 text-sm text-gray-500">

            Perbarui transaksi stok masuk.

        </p>

    </div>

    <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">

        <form
            action="{{ route('stock-ins.update',$stockIn->id) }}"
            method="POST"
        >

            @csrf
            @method('PUT')

            @include('pages.stock-ins._form',[
                'submitLabel'=>'Perbarui'
            ])

        </form>

    </div>

</div>

@endsection