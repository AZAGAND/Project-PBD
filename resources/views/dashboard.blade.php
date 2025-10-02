<x-layouts.app>
    <div class="p-6 space-y-6">
        <!-- Heading -->
        <h1 class="text-2xl font-bold text-zinc-900 dark:text-zinc-100">
            Selamat Datang, {{ auth()->user()?->username ?? 'Guest' }} 👋
        </h1>

        <!-- Card Navigasi -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <a href="{{ route('master.role') }}"
                class="p-6 rounded-xl bg-zinc-100 dark:bg-zinc-800 shadow hover:bg-zinc-200 dark:hover:bg-zinc-700 transition">
                <h2 class="text-lg font-semibold mb-2">📌 Role</h2>
                <p class="text-sm text-zinc-600 dark:text-zinc-400">
                    Kelola data role pengguna.
                </p>
            </a>

            <a href="{{ route('master.user') }}"
                class="p-6 rounded-xl bg-zinc-100 dark:bg-zinc-800 shadow hover:bg-zinc-200 dark:hover:bg-zinc-700 transition">
                <h2 class="text-lg font-semibold mb-2">👤 User</h2>
                <p class="text-sm text-zinc-600 dark:text-zinc-400">
                    Kelola data user sistem.
                </p>
            </a>

            <a href="{{ route('master.barang') }}"
               class="p-6 rounded-xl bg-zinc-100 dark:bg-zinc-800 shadow hover:bg-zinc-200 dark:hover:bg-zinc-700 transition">
                <h2 class="text-lg font-semibold mb-2">📦 Barang</h2>
                <p class="text-sm text-zinc-600 dark:text-zinc-400">
                    Kelola data barang.
                </p>
            </a>

            <a href="{{ route('master.satuan') }}"
               class="p-6 rounded-xl bg-zinc-100 dark:bg-zinc-800 shadow hover:bg-zinc-200 dark:hover:bg-zinc-700 transition">
                <h2 class="text-lg font-semibold mb-2">⚖️ Satuan</h2>
                <p class="text-sm text-zinc-600 dark:text-zinc-400">
                    Kelola data satuan barang.
                </p>
            </a>

            <a href="{{ route('master.vendor') }}"
               class="p-6 rounded-xl bg-zinc-100 dark:bg-zinc-800 shadow hover:bg-zinc-200 dark:hover:bg-zinc-700 transition">
                <h2 class="text-lg font-semibold mb-2">🏢 Vendor</h2>
                <p class="text-sm text-zinc-600 dark:text-zinc-400">
                    Kelola data vendor / supplier.
                </p>
            </a>
        </div>
    </div>
</x-layouts.app>
