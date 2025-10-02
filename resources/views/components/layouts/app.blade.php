<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100 dark:bg-zinc-900 text-gray-900 dark:text-white min-h-screen">
    <nav class="bg-zinc-800 text-white p-4 flex justify-between">
        <div class="font-bold">UTS_PBD</div>
        <div>
            @auth
                <span class="mr-4">{{ auth()->user()->username }}</span>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-500 px-3 py-1 rounded hover:bg-red-600">Logout</button>
                </form>
            @endauth
        </div>
    </nav>

    <main class="p-6">
        {{ $slot }}
    </main>

    @livewireScripts
</body>
</html>
