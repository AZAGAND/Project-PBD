<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <title>Error {{ $code ?? 'Error' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body
    class="h-full bg-gradient-to-br from-slate-50 via-white to-slate-100 dark:from-slate-900 dark:via-slate-950 dark:to-slate-900 text-slate-800 dark:text-slate-100">

    <main class="min-h-screen grid place-items-center px-6 py-16">
        <div class="w-full max-w-2xl text-center">

            <!-- Badge -->
            <div
                class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white/70 px-3 py-1 text-xs font-medium text-slate-600 shadow-sm backdrop-blur dark:border-slate-800 dark:bg-slate-900/60 dark:text-slate-300">
                <span class="inline-block h-2 w-2 rounded-full bg-red-500 animate-pulse"></span>
                Error {{ $code ?? '' }}
            </div>

            <!-- Big code -->
            <h1 class="mt-6 text-7xl font-black tracking-tight text-slate-900 dark:text-white sm:text-8xl">
                {{ $code ?? '' }}
            </h1>

            <!-- Title -->
            <p class="mt-4 text-xl font-semibold text-slate-800 dark:text-slate-200">
                {{ $title ?? 'Terjadi kesalahan' }}
            </p>

            <!-- Description -->
            <p class="mt-2 text-slate-600 dark:text-slate-400">
                {{ $description ?? 'Ups, sepertinya terjadi kesalahan yang tidak diketahui.' }}
            </p>

            <!-- Quick Action Buttons -->
            <div class="mt-8 grid grid-cols-1 gap-3 sm:grid-cols-3">

                <a href="/"
                    class="group rounded-2xl border border-slate-200 bg-white/70 p-4 shadow-sm hover:shadow-md transition dark:border-slate-800 dark:bg-slate-900/60">
                    <div class="flex items-center gap-3">
                        <svg class="h-5 w-5 opacity-70 group-hover:opacity-100" fill="none" stroke="currentColor"
                            stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 12l9-9 9 9M4.5 10.5V21h15V10.5" />
                        </svg>
                        <span class="font-medium">Beranda</span>
                    </div>
                </a>

                <button onclick="history.back()"
                    class="group rounded-2xl border border-slate-200 bg-white/70 p-4 shadow-sm hover:shadow-md transition dark:border-slate-800 dark:bg-slate-900/60">
                    <div class="flex items-center gap-3">
                        <svg class="h-5 w-5 opacity-70 group-hover:opacity-100" fill="none" stroke="currentColor"
                            stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12l7.5-7.5M3 12h18" />
                        </svg>
                        <span class="font-medium">Kembali</span>
                    </div>
                </button>

                <a href="/kontak"
                    class="group rounded-2xl border border-slate-200 bg-white/70 p-4 shadow-sm hover:shadow-md transition dark:border-slate-800 dark:bg-slate-900/60">
                    <div class="flex items-center gap-3">
                        <svg class="h-5 w-5 opacity-70 group-hover:opacity-100" fill="none" stroke="currentColor"
                            stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 12a9 9 0 10-18 0 9 9 0 0018 0zM9 10h.01M15 10h.01M8 15a7 7 0 008 0" />
                        </svg>
                        <span class="font-medium">Laporkan</span>
                    </div>
                </a>
            </div>

            <!-- Footer -->
            <footer class="mt-14 text-xs text-slate-400 dark:text-slate-500">
                © {{ date('Y') }} Aplikasi Anda
            </footer>
        </div>
    </main>
</body>

</html>
