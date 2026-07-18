<x-sidebar-dashboard>
    <x-sidebar-menu-dashboard
        routeName="dashboard"
        title="Dashboard"
    />

    @if (auth()->user()->hasRole(\App\Models\Role::ADMIN))

        <li class="px-2 pt-4 text-xs font-semibold uppercase tracking-wide text-gray-400">
            Master Data
        </li>

        <x-sidebar-menu-dashboard
            routeName="categories.index"
            title="Kategori"
        />

        <x-sidebar-menu-dashboard
            routeName="suppliers.index"
            title="Supplier"
        />

        <x-sidebar-menu-dashboard
            routeName="products.index"
            title="Produk"
        />

        <li class="px-2 pt-4 text-xs font-semibold uppercase tracking-wide text-gray-400">
            Pengguna
        </li>

        <x-sidebar-menu-dashboard
            routeName="users.index"
            title="Manajemen User"
        />

        <li class="px-2 pt-4 text-xs font-semibold uppercase tracking-wide text-gray-400">
            Transaksi
        </li>

        <x-sidebar-menu-dashboard
            routeName="stock-ins.index"
            title="Stok Masuk"
        />

        <x-sidebar-menu-dashboard
            routeName="stock-outs.index"
            title="Stok Keluar"
        />

        <x-sidebar-menu-dashboard
            routeName="stock-opnames.index"
            title="Stock Opname"
        />

        <li class="px-2 pt-4 text-xs font-semibold uppercase tracking-wide text-gray-400">
            Laporan
        </li>

        <x-sidebar-menu-dashboard
            routeName="reports.stock-in"
            title="Laporan Stok Masuk"
        />

        <x-sidebar-menu-dashboard
            routeName="reports.stock-out"
            title="Laporan Stok Keluar"
        />

        <x-sidebar-menu-dashboard
            routeName="reports.inventory"
            title="Laporan Persediaan"
        />

        <x-sidebar-menu-dashboard
            routeName="reports.stock-opname"
            title="Laporan Stock Opname"
        />

    @else

        <li class="px-2 pt-4 text-xs font-semibold uppercase tracking-wide text-gray-400">
            Operasional Gudang
        </li>

        <li class="px-2 py-2 text-sm text-gray-500 dark:text-gray-400">
            Menu produk dan stok akan ditambahkan berikutnya.
        </li>

    @endif
</x-sidebar-dashboard>