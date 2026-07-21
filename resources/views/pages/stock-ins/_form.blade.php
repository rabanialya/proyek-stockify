<div class="space-y-6">

    <div>

        <label class="mb-2 block text-sm font-medium">
            Produk
        </label>

        <select
            name="product_id"
            required
            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm"
        >

            <option value="">
                Pilih Produk
            </option>

            @foreach($products as $product)

                <option
                    value="{{ $product->id }}"
                    @selected(old('product_id',$stockIn->product_id ?? '')==$product->id)
                >
                    {{ $product->name }}
                </option>

            @endforeach

        </select>

        @error('product_id')
            <p class="mt-2 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror

    </div>

    <div class="grid gap-6 md:grid-cols-2">

        <div>

            <label class="mb-2 block text-sm font-medium">
                Jumlah
            </label>

            <input
                type="number"
                name="qty"
                value="{{ old('qty', $stockIn->qty ?? '') }}"
                required
                min="1"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm"
            >

            @error('qty')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror

        </div>

        <div>

            <label class="mb-2 block text-sm font-medium">
                Harga Beli per Unit (Rp)
            </label>

            <input
                type="number"
                name="purchase_price"
                value="{{ old('purchase_price', isset($stockIn) ? $stockIn->product->purchase_price ?? '' : '') }}"
                required
                min="0"
                step="0.01"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm"
                placeholder="Contoh: 15000"
            >

            <p class="mt-1.5 text-xs text-gray-500 dark:text-gray-400">
                Masukkan harga beli per unit. Jika pembelian dilakukan per lusin, box, atau pack, hitung terlebih dahulu menjadi harga per unit sebelum diinput.
            </p>

            @error('purchase_price')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror

        </div>

    </div>

    <div>

        <label class="mb-2 block text-sm font-medium">
            Tanggal
        </label>

        <input
            type="date"
            name="date"
            value="{{ old('date', $stockIn->date ?? now()->toDateString()) }}"
            required
            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm"
        >

    </div>

    <div>

        <label class="mb-2 block text-sm font-medium">
            Keterangan
        </label>

        <textarea
            name="note"
            rows="4"
            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm"
        >{{ old('note', $stockIn->note ?? '') }}</textarea>

    </div>

    <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

        <a
            href="{{ route('stock-ins.index') }}"
            class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm"
        >
            Batal
        </a>

        <button
            class="inline-flex items-center justify-center rounded-lg bg-primary-700 px-4 py-2.5 text-sm font-medium text-white"
        >
            {{ $submitLabel }}
        </button>

    </div>

</div>