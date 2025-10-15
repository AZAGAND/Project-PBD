<div class="bg-gradient-to-br from-blue-900 via-blue-800 to-blue-600 min-h-screen flex items-center justify-center px-4">
    {{-- 🔹 Container utama --}}
    <div class="w-full max-w-md mx-auto">

        {{-- 🧩 Logo & Header Section --}}
        <div class="text-center mb-8">
            <div class="flex items-center justify-center gap-3 bg-white rounded-full shadow-lg px-6 py-2 w-fit mx-auto mb-4">
                <img src="https://cdn-icons-png.flaticon.com/512/2966/2966487.png" alt="RSHP Logo" class="h-12 w-12 object-contain">
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">Universitas Airlangga Marketplace</h1>
            <p class="text-blue-200">Slogan dah</p>
        </div>

        {{-- 🧾 Login Card --}}
        <div class="bg-white rounded-2xl shadow-2xl p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Masuk ke Sistem</h2>

            {{-- Error Message --}}
            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 text-red-900 p-4 mb-6 rounded-lg">
                    <div class="flex items-center gap-2">
                        <span class="text-xl">⚠️</span>
                        <div>
                            @foreach ($errors->all() as $error)
                                <p class="font-medium">{{ $error }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            {{-- Login Form --}}
            <form wire:submit.prevent="login" class="space-y-6">

                {{-- Username Field --}}
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-2">
                        Username <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-400">📧</span>
                        </div>
                        <input id="username" wire:model="username" type="text"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('username') border-red-500 @enderror"
                            placeholder="Mediun Example" required>
                    </div>
                    @error('username')
                        <p class="text-red-500 text-xs mt-2 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Password Field --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Password <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-400">🔒</span>
                        </div>
                        <input id="password" wire:model="password" type="password"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('password') border-red-500 @enderror"
                            placeholder="Masukkan password" required>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-xs mt-2 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Remember Me & Forgot Password --}}
                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center">
                        <input id="remember" wire:model="remember" type="checkbox"
                            class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <span class="ml-2 text-gray-600">Ingat saya</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="text-blue-600 hover:text-blue-800 font-medium">Lupa password?</a>
                </div>

                {{-- Login Button --}}
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition-colors duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center justify-center gap-2"
                    wire:loading.attr="disabled">
                    <span wire:loading.remove>🔐 Masuk</span>
                    <span wire:loading class="flex items-center gap-2">
                        <i class="fas fa-spinner fa-spin"></i> Memproses...
                    </span>
                </button>
            </form>

            {{-- Divider --}}
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-4 bg-white text-gray-500">atau</span>
                </div>
            </div>

            {{-- Register Link --}}
            <div class="text-center">
                <p class="text-gray-600">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 font-semibold hover:underline">
                        Daftar di sini
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>