@extends('layouts.dashboard')

@section('title','Manajemen User')

@section('content')

<div class="px-4 pt-6">

    <div class="mb-4 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                Manajemen User
            </h1>

            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Kelola seluruh pengguna aplikasi.
            </p>

        </div>

        <a
            href="{{ route('users.create') }}"
            class="inline-flex items-center justify-center rounded-lg bg-primary-700 px-4 py-2.5 text-sm font-medium text-white hover:bg-primary-800"
        >
            Tambah User
        </a>

    </div>

    @if(session('success'))

        <div class="mb-4 rounded-lg bg-green-100 p-4 text-green-700">

            {{ session('success') }}

        </div>

    @endif

    <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">

        <div class="overflow-x-auto">

            <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">

                <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700">

                <tr>

                    <th class="px-6 py-3">No</th>
                    <th class="px-6 py-3">Nama</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Role</th>
                    <th class="px-6 py-3 text-right">Aksi</th>

                </tr>

                </thead>

                <tbody>

                @forelse($users as $user)

                    <tr class="border-b dark:border-gray-700">

                        <td class="px-6 py-4">

                            {{ $loop->iteration }}

                        </td>

                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">

                            {{ $user->name }}

                        </td>

                        <td class="px-6 py-4">

                            {{ $user->email }}

                        </td>

                        <td class="px-6 py-4">

                            @php
                                $color = match($user->role->slug){
                                    'admin'=>'green',
                                    'warehouse-manager'=>'blue',
                                    default=>'yellow'
                                };
                            @endphp

                            <span class="rounded-full bg-{{ $color }}-100 px-2.5 py-1 text-xs font-medium text-{{ $color }}-800">
                                {{ $user->role->name }}
                            </span>

                        </td>

                        <td class="px-6 py-4">

                            <div class="flex justify-end gap-3">

                                <a
                                    href="{{ route('users.edit',$user->id) }}"
                                    class="font-medium text-primary-700 hover:underline"
                                >
                                    Edit
                                </a>

                                <form
                                    method="POST"
                                    action="{{ route('users.destroy',$user->id) }}"
                                    onsubmit="return confirm('Yakin ingin menghapus user ini?')"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="font-medium text-red-600 hover:underline"
                                    >
                                        Hapus
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="px-6 py-8 text-center">

                            Belum ada data user.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection