<footer class="p-4 my-6 mx-4 bg-white rounded-lg shadow dark:bg-gray-800">
    <div class="flex flex-col items-center justify-between gap-3 sm:flex-row">

        {{-- Kiri: Nama Aplikasi + Tagline --}}
        <div class="flex items-center gap-3">
            <img src="{{ asset('static/images/logo.svg') }}" class="h-6" alt="Stockify Logo" />
            <div>
                <p class="text-sm font-semibold text-gray-800 dark:text-white">
                    Stockify Warehouse Management System
                </p>
                <p class="text-xs text-gray-500 dark:text-gray-400">
                    Developed for Warehouse Inventory Management
                </p>
            </div>
        </div>

        {{-- Kanan: Copyright --}}
        <p class="text-xs text-gray-500 dark:text-gray-400">
            &copy; {{ date('Y') }} Stockify. All rights reserved.
        </p>

    </div>
</footer>
