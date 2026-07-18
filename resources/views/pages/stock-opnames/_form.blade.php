{{-- Shared form for create & edit Stock Opname --}}

<div class="grid gap-6 sm:grid-cols-2">

    {{-- Tanggal --}}
    <div>
        <label for="date" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
            Tanggal <span class="text-red-500">*</span>
        </label>
        <input
            type="date"
            name="date"
            id="date"
            value="{{ old('date', isset($stockOpname) ? $stockOpname->date?->format('Y-m-d') : date('Y-m-d')) }}"
            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white @error('date') border-red-500 @enderror"
        >
        @error('date')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Produk --}}
    <div>
        <label for="product_id" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
            Produk <span class="text-red-500">*</span>
        </label>
        <select
            name="product_id"
            id="product_id"
            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white @error('product_id') border-red-500 @enderror"
            @isset($stockOpname) disabled @endisset
        >
            <option value="">-- Pilih Produk --</option>
            @foreach($products as $product)
                <option
                    value="{{ $product->id }}"
                    data-stock="{{ $product->stock }}"
                    {{ old('product_id', $stockOpname->product_id ?? '') == $product->id ? 'selected' : '' }}
                >
                    {{ $product->name }} (Stok: {{ $product->stock }})
                </option>
            @endforeach
        </select>
        {{-- Jika edit, kirim product_id via hidden karena select disabled --}}
        @isset($stockOpname)
            <input type="hidden" name="product_id" value="{{ $stockOpname->product_id }}">
        @endisset
        @error('product_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Stok Sistem (readonly) --}}
    <div>
        <label for="system_stock_display" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
            Stok Sistem
        </label>
        <input
            type="text"
            id="system_stock_display"
            value="{{ isset($stockOpname) ? $stockOpname->system_stock : '' }}"
            class="block w-full rounded-lg border border-gray-300 bg-gray-100 p-2.5 text-sm text-gray-500 dark:border-gray-600 dark:bg-gray-600 dark:text-gray-400 cursor-not-allowed"
            placeholder="Otomatis dari produk yang dipilih"
            readonly
        >
        <p class="mt-1 text-xs text-gray-400">Diambil otomatis dari stok produk saat ini.</p>
    </div>

    {{-- Stok Fisik --}}
    <div>
        <label for="physical_stock" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
            Stok Fisik <span class="text-red-500">*</span>
        </label>
        <input
            type="number"
            name="physical_stock"
            id="physical_stock"
            min="0"
            value="{{ old('physical_stock', $stockOpname->physical_stock ?? '') }}"
            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white @error('physical_stock') border-red-500 @enderror"
            placeholder="Masukkan jumlah stok fisik hasil hitung"
        >
        @error('physical_stock')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Keterangan --}}
    <div class="sm:col-span-2">
        <label for="note" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
            Keterangan
        </label>
        <textarea
            name="note"
            id="note"
            rows="3"
            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white @error('note') border-red-500 @enderror"
            placeholder="Catatan tambahan (opsional)"
        >{{ old('note', $stockOpname->note ?? '') }}</textarea>
        @error('note')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

</div>

<div class="mt-6 flex items-center gap-4">
    <button
        type="submit"
        class="rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300"
    >
        {{ $submitLabel ?? 'Simpan' }}
    </button>

    <a
        href="{{ route('stock-opnames.index') }}"
        class="rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700"
    >
        Batal
    </a>
</div>

{{-- Script: isi stok sistem otomatis saat produk dipilih --}}
@once
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const select  = document.getElementById('product_id');
        const display = document.getElementById('system_stock_display');
        if (!select) return;

        select.addEventListener('change', function () {
            const opt = this.options[this.selectedIndex];
            display.value = opt.dataset.stock ?? '';
        });
    });
</script>
@endonce
