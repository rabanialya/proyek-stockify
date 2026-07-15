<div class="space-y-6">
    <div>
        <label
            for="name"
            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
        >
            Nama Supplier
        </label>

        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name', $supplier->name ?? '') }}"
            placeholder="Contoh: PT Sumber Elektronik"
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
            for="contact_person"
            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
        >
            Nama Kontak
        </label>

        <input
            type="text"
            id="contact_person"
            name="contact_person"
            value="{{ old('contact_person', $supplier->contact_person ?? '') }}"
            placeholder="Nama orang yang dapat dihubungi"
            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-600 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
        >

        @error('contact_person')
            <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                {{ $message }}
            </p>
        @enderror
    </div>

    <div class="grid gap-6 md:grid-cols-2">
        <div>
            <label
                for="phone"
                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
            >
                Nomor Telepon
            </label>

            <input
                type="text"
                id="phone"
                name="phone"
                value="{{ old('phone', $supplier->phone ?? '') }}"
                placeholder="Contoh: 081234567890"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-600 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
            >

            @error('phone')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div>
            <label
                for="email"
                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
            >
                Email
            </label>

            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email', $supplier->email ?? '') }}"
                placeholder="supplier@example.com"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-600 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
            >

            @error('email')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                    {{ $message }}
                </p>
            @enderror
        </div>
    </div>

    <div>
        <label
            for="address"
            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
        >
            Alamat
        </label>

        <textarea
            id="address"
            name="address"
            rows="4"
            placeholder="Masukkan alamat lengkap supplier"
            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-600 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
        >{{ old('address', $supplier->address ?? '') }}</textarea>

        @error('address')
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
            <option
                value="1"
                @selected(
                    old(
                        'is_active',
                        isset($supplier) ? (string) $supplier->is_active : '1'
                    ) === '1'
                )
            >
                Aktif
            </option>

            <option
                value="0"
                @selected(
                    old(
                        'is_active',
                        isset($supplier) ? (string) $supplier->is_active : '1'
                    ) === '0'
                )
            >
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
            href="{{ route('suppliers.index') }}"
            class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700"
        >
            Batal
        </a>

        <button
            type="submit"
            class="inline-flex items-center justify-center rounded-lg bg-primary-700 px-4 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300"
        >
            {{ $submitLabel }}
        </button>
    </div>
</div>