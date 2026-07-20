<x-sidebar-dashboard>

    <x-sidebar-menu-dashboard
        routeName="dashboard"
        title="Dashboard"
    />

    <li class="px-2 pt-4 text-xs font-semibold uppercase tracking-wide text-gray-400">
        Produk
    </li>

    <x-sidebar-menu-dashboard
        routeName="products.index"
        title="Daftar Produk"
    />

    <li class="px-2 pt-4 text-xs font-semibold uppercase tracking-wide text-gray-400">
        Stok
    </li>

    <x-sidebar-menu-dashboard
        routeName="stock-ins.index"
        title="Barang Masuk"
    />

    <x-sidebar-menu-dashboard
        routeName="stock-outs.index"
        title="Barang Keluar"
    />

    <x-sidebar-menu-dashboard
        routeName="stock-opnames.index"
        title="Stock Opname"
    />

</x-sidebar-dashboard>
