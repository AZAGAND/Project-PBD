<x-layouts.app>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
    {{-- Header --}}
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 shadow-lg rounded-b-2xl mt-1">
        <div class="max-w-7xl mx-auto px-6 py-6">
            <div class="flex justify-between items-center">
                @auth
                <div>
                    <h1 class="text-3xl font-bold text-white mb-1">Selamat Datang di Dashsboard👋, {{ auth()->user()->username }}</h1>
                    <p class="text-blue-100 text-sm">Kelola menu Superadmin</p>
                    <span class="text-white text-sm text-lg">Superadmin</span>
                </div class="flex items-center gap-4">
                    <div class="flex flex-col text-right leading-tight">
                        <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="border border-blue-500 text-white hover:bg-blue-100 hover:border-blue-400 hover:text-blue-600 text-sm px-4 py-2 rounded-lg shadow-sm transition duration-200">
                        Logout
                    </button>
                </form>
                    </div>
                @endauth
            </div>
        </div>
    </div>

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
