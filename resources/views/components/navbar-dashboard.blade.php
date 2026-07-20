<nav class="fixed z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">

            {{-- ===== KIRI: Hamburger + Logo + Search ===== --}}
            <div class="flex items-center justify-start">

                {{-- Hamburger mobile --}}
                <button id="toggleSidebarMobile" aria-expanded="true" aria-controls="sidebar"
                    class="p-2 text-gray-600 rounded cursor-pointer lg:hidden hover:text-gray-900 hover:bg-gray-100 focus:bg-gray-100 dark:focus:bg-gray-700 focus:ring-2 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    <svg id="toggleSidebarMobileHamburger" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <svg id="toggleSidebarMobileClose" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>

                {{-- Logo --}}
                <a href="{{ url('/') }}" class="flex ml-2 md:mr-24">
                    <img src="{{ asset('static/images/logo.svg') }}" class="h-8 mr-3" alt="Logo Stockify"/>
                    <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Stockify</span>
                </a>

                {{-- Search desktop --}}
                <form action="{{ route('products.index') }}" method="GET" class="hidden lg:block lg:pl-3.5">
                    <label for="topbar-search" class="sr-only">Cari produk atau supplier</label>
                    <div class="relative mt-1 lg:w-96">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <input
                            type="text"
                            name="search"
                            id="topbar-search"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Cari produk atau supplier..."
                            value="{{ request('search') }}"
                            autocomplete="off"
                        >
                    </div>
                </form>

            </div>

            {{-- ===== KANAN: Search mobile + Notif + Dark Mode + Profile ===== --}}
            <div class="flex items-center">

                {{-- Search icon mobile --}}
                <button id="toggleSidebarMobileSearch" type="button"
                    class="p-2 text-gray-500 rounded-lg lg:hidden hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    <span class="sr-only">Search</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/>
                    </svg>
                </button>

                {{-- ===== NOTIFICATION ===== --}}
                <div class="relative">
                    <button type="button" data-dropdown-toggle="notification-dropdown"
                        class="relative p-2 text-gray-500 rounded-lg hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700">
                        <span class="sr-only">Notifikasi</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"/>
                        </svg>
                        {{-- Badge count --}}
                        @if($navNotifCount > 0)
                            <span class="absolute top-1 right-1 flex h-4 w-4 items-center justify-center rounded-full bg-red-500 text-xs font-bold text-white leading-none">
                                {{ $navNotifCount > 9 ? '9+' : $navNotifCount }}
                            </span>
                        @endif
                    </button>

                    {{-- Notification Dropdown --}}
                    <div class="z-50 hidden w-80 my-4 overflow-hidden text-base list-none bg-white rounded-lg shadow-lg dark:bg-gray-700"
                        id="notification-dropdown">

                        <div class="flex items-center justify-between px-4 py-3 bg-gray-50 dark:bg-gray-700 border-b dark:border-gray-600">
                            <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">Notifikasi</span>
                            @if($navNotifCount > 0)
                                <span class="rounded-full bg-red-100 px-2 py-0.5 text-xs font-semibold text-red-700 dark:bg-red-900 dark:text-red-300">
                                    {{ $navNotifCount }} stok menipis
                                </span>
                            @endif
                        </div>

                        <div class="max-h-80 overflow-y-auto divide-y divide-gray-100 dark:divide-gray-600">

                            {{-- Stok Menipis --}}
                            @forelse($navLowStockProducts as $product)
                                <a href="{{ route('products.index') }}"
                                    class="flex items-start gap-3 px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <span class="mt-0.5 flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-yellow-100 dark:bg-yellow-900">
                                        <svg class="h-4 w-4 text-yellow-600 dark:text-yellow-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                                        </svg>
                                    </span>
                                    <div class="flex-1 min-w-0">
                                        <p class="truncate text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $product->name }}
                                        </p>
                                        <p class="text-xs text-yellow-600 dark:text-yellow-400">
                                            Stok menipis — sisa {{ $product->stock }} (min. {{ $product->minimum_stock }})
                                        </p>
                                    </div>
                                </a>
                            @empty
                            @endforelse

                            {{-- Aktivitas Terbaru --}}
                            @foreach($navRecentActivities as $activity)
                                <a href="{{ $activity['type'] === 'stock-in' ? route('stock-ins.index') : route('stock-outs.index') }}"
                                    class="flex items-start gap-3 px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <span class="mt-0.5 flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full {{ $activity['type'] === 'stock-in' ? 'bg-green-100 dark:bg-green-900' : 'bg-red-100 dark:bg-red-900' }}">
                                        @if($activity['type'] === 'stock-in')
                                            <svg class="h-4 w-4 text-green-600 dark:text-green-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                            </svg>
                                        @else
                                            <svg class="h-4 w-4 text-red-600 dark:text-red-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                            </svg>
                                        @endif
                                    </span>
                                    <div class="flex-1 min-w-0">
                                        <p class="truncate text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $activity['label'] }}
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ $activity['sub'] }} &mdash; {{ $activity['time_human'] }}
                                        </p>
                                    </div>
                                </a>
                            @endforeach

                            {{-- Empty state --}}
                            @if($navLowStockProducts->isEmpty() && $navRecentActivities->isEmpty())
                                <div class="px-4 py-6 text-center text-sm text-gray-400 dark:text-gray-500">
                                    Belum ada notifikasi.
                                </div>
                            @endif

                        </div>

                        {{-- Footer --}}
                        <a href="{{ route('reports.inventory') }}"
                            class="block py-2 text-sm font-medium text-center text-gray-700 bg-gray-50 hover:bg-gray-100 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600 border-t dark:border-gray-600">
                            Lihat laporan persediaan
                        </a>

                    </div>
                </div>

                {{-- ===== DARK MODE ===== --}}
                <button id="theme-toggle" data-tooltip-target="tooltip-toggle" type="button"
                    class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                    <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/>
                    </svg>
                    <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"/>
                    </svg>
                </button>
                <div id="tooltip-toggle" role="tooltip"
                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                    Toggle dark mode
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>

                {{-- ===== PROFILE ===== --}}
                <div class="flex items-center ml-3">
                    <button type="button"
                        class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                        id="user-menu-button-2"
                        aria-expanded="false"
                        data-dropdown-toggle="dropdown-2">
                        <span class="sr-only">Buka menu user</span>
                        <span class="flex h-8 w-8 items-center justify-center rounded-full bg-primary-700 font-semibold text-white text-sm">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </span>
                    </button>

                    {{-- Profile Dropdown --}}
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow-lg dark:bg-gray-700 dark:divide-gray-600"
                        id="dropdown-2">

                        {{-- Info User --}}
                        <div class="px-4 py-3">
                            <p class="text-sm font-semibold text-gray-900 dark:text-white truncate">
                                {{ auth()->user()->name }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 truncate mt-0.5">
                                {{ auth()->user()->email }}
                            </p>
                            <span class="mt-2 inline-block rounded-full bg-primary-100 px-2.5 py-0.5 text-xs font-medium text-primary-800 dark:bg-primary-900 dark:text-primary-300">
                                @switch(auth()->user()->role?->slug)
                                    @case('admin') Administrator @break
                                    @case('warehouse-manager') Manajer Gudang @break
                                    @case('warehouse-staff') Staff Gudang @break
                                    @default {{ auth()->user()->role?->name ?? 'User' }}
                                @endswitch
                            </span>
                        </div>

                        {{-- Menu --}}
                        <ul class="py-1">
                            <li>
                                <a href="{{ route('dashboard') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white">
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <span class="flex cursor-default items-center justify-between px-4 py-2 text-sm text-gray-400 dark:text-gray-500">
                                    Profil Saya
                                    <span class="rounded bg-gray-100 px-1.5 py-0.5 text-xs text-gray-500 dark:bg-gray-600 dark:text-gray-400">
                                        Segera Hadir
                                    </span>
                                </span>
                            </li>
                        </ul>

                        {{-- Logout --}}
                        <div class="py-1">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="block w-full px-4 py-2 text-left text-sm text-red-600 hover:bg-gray-100 dark:text-red-400 dark:hover:bg-gray-600">
                                    Keluar
                                </button>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</nav>
