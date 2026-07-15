<x-sidebar-dashboard>
    <x-sidebar-menu-dashboard
        routeName="dashboard"
        title="Dashboard"
    />

    @if (auth()->user()->hasRole(\App\Models\Role::ADMIN))
        <li class="px-2 pt-4 text-xs font-semibold uppercase tracking-wide text-gray-400">
            Administrasi
        </li>

        <x-sidebar-menu-dashboard
            routeName="categories.index"
            title="Kategori"
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