<x-layouts.app>
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Marketplace Pintar | RSHP</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-50 text-gray-900 flex flex-col min-h-screen">
        {{-- 🔹 Navbar --}}
        <nav class="bg-white shadow-md sticky top-0 z-50">
            <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-4">
                <div class="flex items-center gap-2">
                    <span class="text-2xl font-extrabold text-blue-700">🐾 RSHP</span>
                    <span class="text-gray-500 text-sm">Marketplace</span>
                </div>
                <div class="hidden md:flex items-center gap-6">
                    <a href="#features" class="hover:text-blue-700 transition">Fitur</a>
                    <a href="#categories" class="hover:text-blue-700 transition">Kategori</a>
                    <a href="#reviews" class="hover:text-blue-700 transition">Testimoni</a>
                    <a href="#contact" class="hover:text-blue-700 transition">Kontak</a>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('login') }}"
                        class="border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white font-semibold px-4 py-2 rounded-lg transition duration-200">
                        Masuk
                    </a>
                    <a href="#"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg transition duration-200">
                        Daftar
                    </a>
                </div>
            </div>
        </nav>
        {{-- 🔸 Hero Section --}}
        <section class="flex flex-col md:flex-row items-center justify-between max-w-7xl mx-auto px-6 py-16 gap-10">
            <div class="md:w-1/2 space-y-5">
                <h1 class="text-4xl md:text-5xl font-extrabold text-blue-800 leading-tight">
                    Temukan Segalanya untuk Hewan Peliharaanmu 🐕
                </h1>
                <p class="text-gray-600 text-lg">
                    Marketplace RSHP menghadirkan produk dan layanan terbaik dari klinik hewan, groomer, hingga toko
                    perlengkapan — semuanya dalam satu platform.
                </p>
                <div class="flex gap-4 pt-4">
                    <a href="#categories"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-xl shadow transition">
                        Jelajahi Sekarang
                    </a>
                    <a href="#features"
                        class="border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white font-semibold px-6 py-3 rounded-xl transition">
                        Lihat Fitur
                    </a>
                </div>
            </div>
            <div class="md:w-1/2">
                <img src="https://cdn-icons-png.flaticon.com/512/616/616408.png" alt="Marketplace Pet"
                    class="w-full max-w-md mx-auto drop-shadow-xl">
            </div>
        </section>
        {{-- 💼 Fitur Unggulan --}}
        <section id="features" class="bg-gradient-to-r from-blue-50 to-indigo-100 py-16">
            <div class="max-w-6xl mx-auto text-center">
                <h2 class="text-3xl font-bold text-blue-800 mb-10">Fitur Unggulan Kami</h2>
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="bg-white rounded-2xl shadow p-6 hover:-translate-y-2 transition">
                        <div class="text-blue-600 text-4xl mb-3">💳</div>
                        <h3 class="font-bold text-xl mb-2">Pembayaran Aman</h3>
                        <p class="text-gray-600 text-sm">Transaksi dijamin aman dengan berbagai metode pembayaran
                            terpercaya.</p>
                    </div>
                    <div class="bg-white rounded-2xl shadow p-6 hover:-translate-y-2 transition">
                        <div class="text-blue-600 text-4xl mb-3">🚚</div>
                        <h3 class="font-bold text-xl mb-2">Pengiriman Cepat</h3>
                        <p class="text-gray-600 text-sm">Nikmati layanan pengiriman cepat ke seluruh Indonesia.</p>
                    </div>
                    <div class="bg-white rounded-2xl shadow p-6 hover:-translate-y-2 transition">
                        <div class="text-blue-600 text-4xl mb-3">🐾</div>
                        <h3 class="font-bold text-xl mb-2">Produk Berkualitas</h3>
                        <p class="text-gray-600 text-sm">Semua produk sudah diverifikasi dan diseleksi oleh tim RSHP.
                        </p>
                    </div>
                </div>
            </div>
        </section>
        {{-- 🛍️ Kategori Populer --}}
        <section id="categories" class="max-w-7xl mx-auto py-16 px-6">
            <h2 class="text-3xl font-bold text-blue-800 text-center mb-10">Kategori Populer</h2>
            <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-8">
                <div class="bg-white shadow rounded-xl p-6 text-center hover:scale-105 transition">
                    <img src="https://cdn-icons-png.flaticon.com/512/616/616408.png" class="w-20 mx-auto mb-4"
                        alt="">
                    <h3 class="font-semibold text-lg">Makanan Hewan</h3>
                </div>
                <div class="bg-white shadow rounded-xl p-6 text-center hover:scale-105 transition">
                    <img src="https://cdn-icons-png.flaticon.com/512/616/616408.png" class="w-20 mx-auto mb-4"
                        alt="">
                    <h3 class="font-semibold text-lg">Aksesoris & Mainan</h3>
                </div>
                <div class="bg-white shadow rounded-xl p-6 text-center hover:scale-105 transition">
                    <img src="https://cdn-icons-png.flaticon.com/512/616/616408.png" class="w-20 mx-auto mb-4"
                        alt="">
                    <h3 class="font-semibold text-lg">Layanan Grooming</h3>
                </div>
                <div class="bg-white shadow rounded-xl p-6 text-center hover:scale-105 transition">
                    <img src="https://cdn-icons-png.flaticon.com/512/616/616408.png" class="w-20 mx-auto mb-4"
                        alt="">
                    <h3 class="font-semibold text-lg">Obat & Vitamin</h3>
                </div>
            </div>
        </section>
        {{-- ⭐ Testimoni --}}
        <section id="reviews" class="bg-blue-50 py-16">
            <div class="max-w-6xl mx-auto text-center">
                <h2 class="text-3xl font-bold text-blue-800 mb-10">Apa Kata Pengguna Kami</h2>
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="bg-white shadow-lg rounded-xl p-6">
                        <p class="text-gray-600 italic mb-3">"Marketplace ini ngebantu banget, produk lengkap dan
                            pengiriman cepat!"</p>
                        <h4 class="font-semibold text-blue-700">— Dinda, Surabaya</h4>
                    </div>
                    <div class="bg-white shadow-lg rounded-xl p-6">
                        <p class="text-gray-600 italic mb-3">"Barang selalu sampai tepat waktu, dan CS-nya responsif
                            banget!"</p>
                        <h4 class="font-semibold text-blue-700">— Bima, Jakarta</h4>
                    </div>
                    <div class="bg-white shadow-lg rounded-xl p-6">
                        <p class="text-gray-600 italic mb-3">"Tempat terbaik buat cari makanan dan vitamin hewan,
                            recommended!"</p>
                        <h4 class="font-semibold text-blue-700">— Rani, Malang</h4>
                    </div>
                </div>
            </div>
        </section>
        {{-- 📞 Footer --}}
        <footer id="contact" class="bg-blue-900 text-blue-100 text-center py-8 rounded-t-2xl">
            <p class="font-semibold text-lg mb-2">Hubungi Kami</p>
            <p>Email: support@rshp-marketplace.id | WA: +62 812-3456-7890</p>
            <p class="text-sm mt-4">&copy; {{ date('Y') }} RSHP Marketplace. All rights reserved.</p>
        </footer>
    </body>
    </html>
</x-layouts.app>
