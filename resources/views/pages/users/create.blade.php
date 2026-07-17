@extends('layouts.dashboard')

@section('title','Tambah User')

@section('content')

<div class="px-4 pt-6">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
            Tambah User
        </h1>

        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
            Tambahkan pengguna baru ke sistem.
        </p>
    </div>

    <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">

        <form
            action="{{ route('users.store') }}"
            method="POST"
        >

            @csrf

            @include('pages.users._form',[
                'submitLabel'=>'Simpan User'
            ])

        </form>

    </div>

</div>

@endsection