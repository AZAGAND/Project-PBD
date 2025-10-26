<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 flex flex-col">

    {{-- ================= HEADER ================= --}}
    <header class="bg-gradient-to-r from-blue-600 to-indigo-700 shadow-lg w-full">
        <div class="w-full max-w-[1600px] mx-auto px-6 md:px-12 lg:px-16 py-5 flex flex-col md:flex-row md:items-start md:justify-between">
            @auth
                <div class="mb-4 md:mb-0">
                    <h1 class="text-xl md:text-2xl font-bold text-white mb-1">
                        Selamat Datang di Menu Manajemen User 👋, {{ auth()->user()->username }}
                    </h1>
                    <p class="text-blue-100 text-sm">Kelola user dan akses sistem</p>
                </div>

                <div class="flex items-start md:items-end space-x-4">
                    <div class="text-right">
                        <p class="text-white font-semibold text-sm leading-tight">
                            {{ auth()->user()->role->nama_role ?? 'User' }}
                        </p>
                        <p class="text-blue-200 text-[11px] leading-tight">{{ now()->format('d M Y') }}</p>
                    </div>
                </div>
            @endauth
        </div>
    </header>

    {{-- ================= MAIN WRAPPER ================= --}}
    <main class="flex-1 w-full">
        <div class="w-full max-w-[1600px] mx-auto px-6 md:px-12 lg:px-16 py-8">

            {{-- ========== FLASH MESSAGES ========== --}}
            @if (session()->has('ok'))
                <div class="mb-4 bg-white border-l-4 border-emerald-500 rounded-r-xl shadow-md p-4 flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-emerald-800 font-semibold text-sm">Berhasil!</h3>
                        <p class="text-emerald-700 text-xs mt-0.5">{{ session('ok') }}</p>
                    </div>
                </div>
            @endif

            @if (session()->has('err'))
                <div class="mb-4 bg-white border-l-4 border-rose-500 rounded-r-xl shadow-md p-4 flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-rose-100 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-rose-800 font-semibold text-sm">Terjadi Kesalahan!</h3>
                        <p class="text-rose-700 text-xs mt-0.5">{{ session('err') }}</p>
                    </div>
                </div>
            @endif

            {{-- ========== GRID LAYOUT (FORM + TABLE) ========== --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

                {{-- ================= FORM SECTION ================= --}}
                <section class="lg:col-span-4">
                    <div class="bg-white rounded-2xl shadow-xl border-t-4 border-blue-600 p-6">
                        {{-- Form header --}}
                        <div class="flex items-start space-x-3 mb-5">
                            <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-gray-800">
                                    {{ $isEdit ? 'Edit User' : 'Tambah User' }}
                                </h2>
                                <p class="text-xs text-gray-500">
                                    {{ $isEdit ? 'Perbarui data user' : 'Buat user baru' }}
                                </p>
                            </div>
                        </div>

                        {{-- ==== FORM START ==== --}}
                        <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}" class="space-y-5">

                            {{-- Username --}}
                            <div>
                                <label for="username" class="block text-sm font-semibold text-gray-700 mb-1.5">
                                    Username <span class="text-rose-500">*</span>
                                </label>
                                <div class="relative flex items-center">
                                    <div class="absolute left-2.5 inset-y-0 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <input id="username" wire:model.defer="username" type="text"
                                        placeholder="Masukkan username"
                                        class="w-full pl-9 pr-4 py-3 text-[15px] bg-gray-50 border-2 border-gray-200 rounded-xl
                                               focus:border-blue-500 focus:ring-4 focus:ring-blue-100
                                               transition-all duration-200 outline-none">
                                </div>

                                @error('username')
                                    <p class="mt-1.5 text-xs text-rose-600 flex items-center space-x-1.5">
                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span>{{ $message }}</span>
                                    </p>
                                @enderror
                            </div>

                            {{-- Password --}}
                            <div>
                                <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">
                                    Password {{ $isEdit ? '' : '*' }}
                                </label>
                                <div class="relative flex items-center">
                                    <div class="absolute left-2.5 inset-y-0 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                    </div>
                                    <input id="password" wire:model.defer="password" type="password"
                                        placeholder="{{ $isEdit ? 'Kosongkan jika tidak ganti' : 'Masukkan password' }}"
                                        class="w-full pl-9 pr-4 py-3 text-[15px] bg-gray-50 border-2 border-gray-200 rounded-xl
                                               focus:border-blue-500 focus:ring-4 focus:ring-blue-100
                                               transition-all duration-200 outline-none">
                                </div>

                                @if ($isEdit)
                                    <p class="mt-1.5 text-[11px] text-gray-500 flex items-center space-x-1">
                                        <svg class="w-3.5 h-3.5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span>Kosongkan jika tidak ingin mengubah</span>
                                    </p>
                                @endif

                                @error('password')
                                    <p class="mt-1.5 text-xs text-rose-600 flex items-center space-x-1.5">
                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span>{{ $message }}</span>
                                    </p>
                                @enderror
                            </div>

                            {{-- Role --}}
                            <div>
                                <label for="idrole" class="block text-sm font-semibold text-gray-700 mb-1.5">
                                    Role <span class="text-rose-500">*</span>
                                </label>
                                <div class="relative flex items-center">
                                    <div class="absolute left-2.5 inset-y-0 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                    </div>

                                    <select id="idrole" wire:model.defer="idrole"
                                        class="w-full pl-9 pr-9 py-3 text-[15px] bg-gray-50 border-2 border-gray-200 rounded-xl
                                               focus:border-blue-500 focus:ring-4 focus:ring-blue-100
                                               transition-all duration-200 outline-none appearance-none">
                                        <option value="">-- Pilih Role --</option>
                                        @foreach ($roles as $r)
                                            <option value="{{ $r->idrole }}">{{ $r->nama_role }}</option>
                                        @endforeach
                                    </select>

                                    <div class="absolute right-2.5 inset-y-0 flex items-center pointer-events-none">
                                        <svg class="h-[18px] w-[18px] text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>
                                </div>

                                @error('idrole')
                                    <p class="mt-1.5 text-xs text-rose-600 flex items-center space-x-1.5">
                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span>{{ $message }}</span>
                                    </p>
                                @enderror
                            </div>

                            {{-- Action buttons --}}
                            <div class="space-y-2 pt-2">
                                <button type="submit"
                                    class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700
                                           text-white font-semibold px-6 py-3 text-sm md:text-base rounded-xl shadow-lg hover:shadow-xl
                                           transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        @if ($isEdit)
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                        @else
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        @endif
                                    </svg>
                                    <span class="tracking-wide">{{ $isEdit ? 'Update Data' : 'Simpan Data' }}</span>
                                </button>

                                @if ($isEdit)
                                    <button type="button" wire:click="resetForm"
                                        class="w-full bg-white hover:bg-gray-50 text-gray-700 font-semibold px-5 py-2.5 text-sm rounded-xl border-2 border-gray-300 shadow-sm hover:shadow transition-all duration-200 flex items-center justify-center space-x-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        <span>Batal Edit</span>
                                    </button>
                                @endif
                            </div>
                        </form>
                        {{-- ==== FORM END ==== --}}
                    </div>
                </section>

                {{-- ================= TABLE SECTION ================= --}}
                <section class="lg:col-span-8">
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border-t-4 border-indigo-600">
                        {{-- Table header --}}
                        <div class="bg-gradient-to-r from-indigo-50 to-blue-50 px-6 py-4 border-b border-gray-200">
                            <div class="flex items-start space-x-3">
                                <div class="w-9 h-9 bg-indigo-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-lg font-bold text-gray-800">Data User</h2>
                                    <p class="text-xs text-gray-600">
                                        Total: <span class="font-semibold">{{ count($data) }}</span> user
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Table content --}}
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead>
                                    <tr class="bg-gradient-to-r from-gray-50 to-gray-100">
                                        <th class="px-4 py-3 text-left text-[11px] font-bold text-gray-700 uppercase tracking-wider border-b-2 border-gray-200">
                                            ID User
                                        </th>
                                        <th class="px-4 py-3 text-left text-[11px] font-bold text-gray-700 uppercase tracking-wider border-b-2 border-gray-200">
                                            Username
                                        </th>
                                        <th class="px-4 py-3 text-left text-[11px] font-bold text-gray-700 uppercase tracking-wider border-b-2 border-gray-200">
                                            Role
                                        </th>
                                        <th class="px-4 py-3 text-center text-[11px] font-bold text-gray-700 uppercase tracking-wider border-b-2 border-gray-200">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-200">
                                    @forelse($data as $index => $u)
                                        <tr class="transition-colors duration-150 {{ $index % 2 == 0 ? 'bg-white hover:bg-blue-50' : 'bg-gray-50 hover:bg-blue-50' }}">
                                            {{-- ID --}}
                                            <td class="px-4 py-3 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center">
                                                        <span class="text-indigo-700 font-bold text-sm">
                                                            {{ $u->iduser }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>

                                            {{-- Username --}}
                                            <td class="px-4 py-3">
                                                <div class="flex items-center space-x-2.5">
                                                    <div class="w-9 h-9 bg-gradient-to-br from-blue-400 to-indigo-500 rounded-full flex items-center justify-center shadow-md flex-shrink-0">
                                                        <span class="text-white font-bold text-[11px]">
                                                            {{ strtoupper(substr($u->username, 0, 2)) }}
                                                        </span>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-semibold text-gray-900 leading-tight">
                                                            {{ $u->username }}
                                                        </p>
                                                        <p class="text-[11px] text-gray-500 leading-tight">
                                                            User ID: {{ $u->iduser }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>

                                            {{-- Role --}}
                                            <td class="px-4 py-3">
                                                @if ($u->nama_role && $u->nama_role)
                                                    <span class="inline-flex items-center px-2.5 py-1 text-[11px] font-semibold rounded-full bg-purple-100 text-purple-800">
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        {{ $u->nama_role }}
                                                    </span>
                                                @else
                                                    <span class="text-gray-400 text-sm">-</span>
                                                @endif
                                            </td>

                                            {{-- Aksi --}}
                                            <td class="px-4 py-3 whitespace-nowrap">
                                                <div class="flex flex-wrap items-center justify-center gap-2">
                                                    <button wire:click="edit({{ $u->iduser }})"
                                                        class="inline-flex items-center px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-white font-medium text-[11px] rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                        Edit
                                                    </button>

                                                    <button wire:click="delete({{ $u->iduser }})"
                                                        onclick="return confirm('⚠️ Apakah Anda yakin ingin menghapus user \"{{ $u->username }}\"?\n\nData yang dihapus tidak dapat dikembalikan!')"
                                                        class="inline-flex items-center px-3 py-1.5 bg-rose-600 hover:bg-rose-700 text-white font-medium text-[11px] rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                        Hapus
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-4 py-12">
                                                <div class="text-center">
                                                    <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-3">
                                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                                        </svg>
                                                    </div>
                                                    <h3 class="text-base font-semibold text-gray-700 mb-1">
                                                        Belum Ada Data
                                                    </h3>
                                                    <p class="text-sm text-gray-500">
                                                        Silakan tambahkan user baru menggunakan form di samping
                                                    </p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

            </div> {{-- end grid --}}

            {{-- ================= BACK BUTTON ================= --}}
            <div class="mt-8">
                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center px-5 py-2.5 bg-white hover:bg-gray-50 text-gray-700 font-semibold text-sm rounded-xl border-2 border-gray-300 shadow-sm hover:shadow transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span>Kembali ke Dashboard</span>
                </a>
            </div>

        </div> {{-- /container --}}
    </main>

</div>
