<div class="grid gap-6">

    <div>
        <label class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
            Nama
        </label>

        <input
            type="text"
            name="name"
            value="{{ old('name', $user->name ?? '') }}"
            class="block w-full rounded-lg border border-gray-300 p-2.5 text-sm focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
        >

        @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
            Email
        </label>

        <input
            type="email"
            name="email"
            value="{{ old('email', $user->email ?? '') }}"
            class="block w-full rounded-lg border border-gray-300 p-2.5 text-sm focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
        >

        @error('email')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
            Role
        </label>

        <select
            name="role_id"
            class="block w-full rounded-lg border border-gray-300 p-2.5 text-sm focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
        >
            <option value="">-- Pilih Role --</option>

            @foreach ($roles as $role)
                <option
                    value="{{ $role->id }}"
                    @selected(old('role_id', $user->role_id ?? '') == $role->id)
                >
                    {{ $role->name }}
                </option>
            @endforeach
        </select>

        @error('role_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
            Password
        </label>

        <input
            type="password"
            name="password"
            class="block w-full rounded-lg border border-gray-300 p-2.5 text-sm focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
        >

        @if(isset($user))
            <p class="mt-1 text-xs text-gray-500">
                Kosongkan jika tidak ingin mengubah password.
            </p>
        @endif

        @error('password')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
            Konfirmasi Password
        </label>

        <input
            type="password"
            name="password_confirmation"
            class="block w-full rounded-lg border border-gray-300 p-2.5 text-sm focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
        >
    </div>

    <div class="flex justify-end gap-3">

        <a
            href="{{ route('users.index') }}"
            class="rounded-lg border border-gray-300 px-5 py-2.5 text-sm font-medium hover:bg-gray-100 dark:border-gray-600 dark:hover:bg-gray-700"
        >
            Batal
        </a>

        <button
            type="submit"
            class="rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800"
        >
            {{ $submitLabel }}
        </button>

    </div>

</div>