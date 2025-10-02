<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UTS PBD App</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.1/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="flex items-center justify-center h-screen">
        <div class="text-center">
            <h1 class="text-4xl font-bold mb-4">Selamat Datang di Aplikasi UTS PBD 🎉</h1>
            <p class="text-lg text-gray-600 mb-6">Silakan pilih menu Master untuk mulai mengelola data.</p>
            <a href="{{ route('Login_dashboard') }}"
               class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
               Masuk ke Master Role
            </a>
        </div>
    </div>
</body>
</html>
