<div class="space-y-6">

    <div>
        <label
            for="product_id"
            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
            Produk
        </label>

        <select
            id="product_id"
            name="product_id"
            required
            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">

            <option value="">Pilih Produk</option>

            @foreach($products as $product)
                <option
                    value="{{ $product->id }}"
                    @selected(old('product_id', $stockOut->product_id ?? '') == $product->id)
                >
                    {{ $product->name }}
                    (Stok: {{ $product->stock }})
                </option>
            @endforeach

        </select>

        @error('product_id')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>


    <div class="grid gap-6 md:grid-cols-2">

        <div>
            <label
                for="qty"
                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                Jumlah Keluar
            </label>

            <input
                type="number"
                id="qty"
                name="qty"
                min="1"
                required
                value="{{ old('qty', $stockOut->qty ?? '') }}"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">

            @error('qty')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>


        <div>
            <label
                for="date"
                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                Tanggal
            </label>

            <input
                type="date"
                id="date"
                name="date"
                required
                value="{{ old('date', isset($stockOut) ? $stockOut->date : now()->format('Y-m-d')) }}"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">

            @error('date')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

    </div>


    <div>
        <label
            for="note"
            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
            Keterangan
        </label>

        <textarea
            id="note"
            name="note"
            rows="4"
            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ old('note', $stockOut->note ?? '') }}</textarea>

        @error('note')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>


    <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

        <a
            href="{{ route('stock-outs.index') }}"
            class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium">

            Batal

        </a>

        <button
            type="submit"
            class="inline-flex items-center justify-center rounded-lg bg-primary-700 px-4 py-2.5 text-sm font-medium text-white">

            {{ $submitLabel }}

        </button>

    </div>

</div>