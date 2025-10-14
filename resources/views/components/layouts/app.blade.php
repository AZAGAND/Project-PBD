<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100 dark:bg-zinc-900 text-gray-900 dark:text-white min-h-screen">

    <!-- 🔹 Header dengan styling baru -->
    <header class="bg-gradient-to-r from-blue-600 to-blue-300 text-white px-8 py-8 flex justify-between items-center shadow-md rounded-b-2xl">
        <!-- Kiri: Judul dan deskripsi -->
        <div>
            <h1 class="text-4xl font-bold">Menu Manajemen Role</h1>
            <p class="text-blue-100 mt-2 text-sm">Kelola role dan akses pengguna sistem</p>
        </div>

        <!-- Kanan: Info user + logout -->
        <div class="text-right">
            @auth
                <div class="flex items-center gap-3">
                    <span class="text-sm font-medium">{{ auth()->user()->username }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit"
                            class="bg-red-500 hover:bg-red-600 text-white text-sm px-4 py-1 rounded-md transition">
                            Logout
                        </button>
                    </form>
                </div>
            @endauth
        </div>
    </header>

    <!-- 🔸 Konten Utama -->
    <main class="p-6">
        {{ $slot }}
    </main>

    @livewireScripts
</body>
</html>
