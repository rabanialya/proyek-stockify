<div class="space-y-6">

    <div class="grid gap-6 md:grid-cols-2">

        <div>
            <label
                for="name"
                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
            >
                Nama Produk
            </label>

            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name', $product->name ?? '') }}"
                placeholder="Contoh: Laptop ASUS Vivobook"
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
                for="sku"
                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
            >
                SKU
            </label>

            <input
                type="text"
                id="sku"
                name="sku"
                value="{{ old('sku', $product->sku ?? '') }}"
                placeholder="Contoh: SKU-001"
                required
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-600 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
            >

            @error('sku')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                    {{ $message }}
                </p>
            @enderror
        </div>

    </div>

    <div class="grid gap-6 md:grid-cols-2">

        <div>
            <label
                for="category_id"
                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
            >
                Kategori
            </label>

            <select
                id="category_id"
                name="category_id"
                required
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-600 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
            >
                <option value="">-- Pilih Kategori --</option>

                @foreach ($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        @selected(old('category_id', $product->category_id ?? '') == $category->id)
                    >
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            @error('category_id')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div>
            <label
                for="supplier_id"
                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
            >
                Supplier
            </label>

            <select
                id="supplier_id"
                name="supplier_id"
                required
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-600 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
            >
                <option value="">-- Pilih Supplier --</option>

                @foreach ($suppliers as $supplier)
                    <option
                        value="{{ $supplier->id }}"
                        @selected(old('supplier_id', $product->supplier_id ?? '') == $supplier->id)
                    >
                        {{ $supplier->name }}
                    </option>
                @endforeach
            </select>

            @error('supplier_id')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                    {{ $message }}
                </p>
            @enderror
        </div>

    </div>

    <div class="grid gap-6 md:grid-cols-2">

        <div>
            <label
                for="purchase_price"
                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
            >
                Harga Beli
            </label>

            <input
                type="number"
                id="purchase_price"
                name="purchase_price"
                value="{{ old('purchase_price', $product->purchase_price ?? '') }}"
                min="0"
                step="0.01"
                required
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-600 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
            >

            @error('purchase_price')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div>
            <label
                for="selling_price"
                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
            >
                Harga Jual
            </label>

            <input
                type="number"
                id="selling_price"
                name="selling_price"
                value="{{ old('selling_price', $product->selling_price ?? '') }}"
                min="0"
                step="0.01"
                required
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-600 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
            >

            @error('selling_price')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                    {{ $message }}
                </p>
            @enderror
        </div>

    </div>

    <div class="grid gap-6 md:grid-cols-2">

        <div>
            <label
                for="stock"
                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
            >
                Stok Awal
            </label>

            <input
                type="number"
                id="stock"
                name="stock"
                value="{{ old('stock', $product->stock ?? 0) }}"
                min="0"
                required
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-600 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
            >

            @error('stock')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div>
            <label
                for="minimum_stock"
                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
            >
                Minimum Stok
            </label>

            <input
                type="number"
                id="minimum_stock"
                name="minimum_stock"
                value="{{ old('minimum_stock', $product->minimum_stock ?? 5) }}"
                min="0"
                required
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-600 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
            >

            @error('minimum_stock')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                    {{ $message }}
                </p>
            @enderror
        </div>

    </div>

    <div>

        <label
            for="description"
            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
        >
            Deskripsi
        </label>

        <textarea
            id="description"
            name="description"
            rows="4"
            placeholder="Masukkan deskripsi produk..."
            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-600 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
        >{{ old('description', $product->description ?? '') }}</textarea>

        @error('description')
            <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                {{ $message }}
            </p>
        @enderror

    </div>

    <div>

        <label
            for="status"
            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
        >
            Status
        </label>

        <select
            id="status"
            name="status"
            required
            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-600 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
        >
            <option
                value="1"
                @selected(old('status', isset($product) ? (string) $product->status : '1') === '1')
            >
                Aktif
            </option>

            <option
                value="0"
                @selected(old('status', isset($product) ? (string) $product->status : '1') === '0')
            >
                Tidak Aktif
            </option>
        </select>

        @error('status')
            <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                {{ $message }}
            </p>
        @enderror

    </div>

    <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

        <a
            href="{{ route('products.index') }}"
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