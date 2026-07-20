@extends('layouts.dashboard')

@section('title', 'Profil Saya')

@section('content')
<div class="px-4 pt-6 pb-10">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Profil Saya</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
            Informasi akun dan pengaturan keamanan.
        </p>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-lg bg-green-100 p-4 text-sm font-medium text-green-800 dark:bg-green-900 dark:text-green-300">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid gap-6 lg:grid-cols-2">

        {{-- ===== INFORMASI AKUN ===== --}}
        <div class="rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">

            <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                <h2 class="text-base font-semibold text-gray-900 dark:text-white">Informasi Akun</h2>
            </div>

            <div class="px-6 py-6">

                {{-- Avatar --}}
                <div class="mb-6 flex items-center gap-4">
                    <div class="flex h-16 w-16 items-center justify-center rounded-full bg-primary-700 text-2xl font-bold text-white">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $user->name }}</p>
                        <span class="inline-block mt-1 rounded-full bg-primary-100 px-2.5 py-0.5 text-xs font-medium text-primary-800 dark:bg-primary-900 dark:text-primary-300">
                            @switch($user->role?->slug)
                                @case('admin') Administrator @break
                                @case('warehouse-manager') Manajer Gudang @break
                                @case('warehouse-staff') Staff Gudang @break
                                @default {{ $user->role?->name ?? 'User' }}
                            @endswitch
                        </span>
                    </div>
                </div>

                {{-- Detail --}}
                <div class="space-y-4">

                    <div>
                        <label class="mb-1 block text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">
                            Nama Lengkap
                        </label>
                        <p class="rounded-lg border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            {{ $user->name }}
                        </p>
                    </div>

                    <div>
                        <label class="mb-1 block text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">
                            Alamat Email
                        </label>
                        <p class="rounded-lg border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            {{ $user->email }}
                        </p>
                    </div>

                    <div>
                        <label class="mb-1 block text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">
                            Role
                        </label>
                        <p class="rounded-lg border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            @switch($user->role?->slug)
                                @case('admin') Administrator @break
                                @case('warehouse-manager') Manajer Gudang @break
                                @case('warehouse-staff') Staff Gudang @break
                                @default {{ $user->role?->name ?? '-' }}
                            @endswitch
                        </p>
                    </div>

                    <div>
                        <label class="mb-1 block text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">
                            Bergabung Sejak
                        </label>
                        <p class="rounded-lg border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            {{ $user->created_at->translatedFormat('d F Y') }}
                        </p>
                    </div>

                </div>

                <p class="mt-5 text-xs text-gray-400 dark:text-gray-500">
                    Untuk mengubah nama atau email, hubungi Administrator.
                </p>

            </div>
        </div>

        {{-- ===== UBAH PASSWORD ===== --}}
        <div class="rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">

            <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                <h2 class="text-base font-semibold text-gray-900 dark:text-white">Ubah Password</h2>
            </div>

            <div class="px-6 py-6">

                <form action="{{ route('profile.password') }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')

                    {{-- Password Lama --}}
                    <div>
                        <label for="current_password" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Password Saat Ini
                        </label>
                        <input
                            type="password"
                            id="current_password"
                            name="current_password"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500 @error('current_password') border-red-500 @enderror"
                            placeholder="••••••••"
                            autocomplete="current-password"
                        >
                        @error('current_password')
                            <p class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password Baru --}}
                    <div>
                        <label for="password" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Password Baru
                        </label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500 @error('password') border-red-500 @enderror"
                            placeholder="••••••••"
                            autocomplete="new-password"
                        >
                        @error('password')
                            <p class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div>
                        <label for="password_confirmation" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Konfirmasi Password Baru
                        </label>
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                            placeholder="••••••••"
                            autocomplete="new-password"
                        >
                    </div>

                    <div class="pt-1">
                        <button
                            type="submit"
                            class="w-full rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                        >
                            Perbarui Password
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>

</div>
@endsection
