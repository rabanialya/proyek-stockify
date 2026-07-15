@extends('layouts.dashboard')
@section('title', 'Dashboard')

@section('content')
    <div class="px-4 pt-6">
        <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <p class="text-sm font-medium text-primary-700">{{ auth()->user()->role->name }}</p>
            <h1 class="mt-1 text-2xl font-bold text-gray-900 dark:text-white">Selamat datang, {{ auth()->user()->name }}</h1>
            <p class="mt-2 text-gray-500 dark:text-gray-400">Fondasi autentikasi dan role Stockify sudah aktif. Modul stok akan ditambahkan pada tahap berikutnya.</p>
        </div>
    </div>
@endsection
