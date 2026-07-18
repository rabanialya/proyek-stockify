<x-sidebar-dashboard>

    <x-sidebar-menu-dashboard
        routeName="dashboard"
        title="Dashboard"
    />

    <li class="px-2 pt-4 text-xs font-semibold uppercase tracking-wide text-gray-400">
        Operasional Gudang
    </li>

    <x-sidebar-menu-dashboard
        routeName="stock-ins.index"
        title="Stok Masuk"
    />

    <x-sidebar-menu-dashboard
        routeName="stock-outs.index"
        title="Stok Keluar"
    />

</x-sidebar-dashboard>