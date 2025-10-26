<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 flex flex-col">

    {{-- ================= HEADER ================= --}}
    <header class="bg-gradient-to-r from-blue-600 to-indigo-700 shadow-lg rounded-b-2xl">
        <div class="max-w-7xl mx-auto px-6 py-6 flex justify-between items-center">
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

    {{-- ================= MAIN CONTENT ================= --}}
    <main class="flex-1 w-full">
        <div class="max-w-5xl mx-auto px-6 py-8">

            {{-- ========== FLASH MESSAGES ========== --}}
            @if (session()->has('ok'))
                <div class="mb-6 bg-white border-l-4 border-emerald-500 rounded-r-xl shadow-md p-4 flex items-start space-x-3 animate-fade-in">
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
                <div class="mb-6 bg-white border-l-4 border-rose-500 rounded-r-xl shadow-md p-4 flex items-start space-x-3">
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

            {{-- ================= FORM ================= --}}
            <section class="bg-white rounded-2xl shadow-xl border-t-4 border-blue-600 p-6 mb-8">
                <div class="flex items-center space-x-3 mb-5">
                    <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-gray-800">{{ $isEdit ? 'Edit Role' : 'Tambah Role' }}</h2>
                        <p class="text-xs text-gray-500">{{ $isEdit ? 'Perbarui data role' : 'Buat role baru' }}</p>
                    </div>
                </div>

                <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}" class="space-y-5">
                    {{-- Nama Role --}}
                    <div>
                        <label for="nama_role" class="block text-sm font-semibold text-gray-700 mb-1.5">
                            Nama Role <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative flex items-center">
                            <div class="absolute left-2.5 inset-y-0 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                            </div>
                            <input id="nama_role" wire:model.defer="nama_role" type="text"
                                placeholder="Contoh: Admin, User, Manager"
                                class="w-full pl-9 pr-4 py-3 text-[15px] bg-gray-50 border-2 border-gray-200 rounded-xl
                                       focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 outline-none">
                        </div>
                        @error('nama_role')
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

                    {{-- Tombol --}}
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
                            <span>{{ $isEdit ? 'Update Data' : 'Simpan Data' }}</span>
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
            </section>

            {{-- ================= TABLE ================= --}}
            <section class="bg-white rounded-2xl shadow-xl overflow-hidden border-t-4 border-indigo-600">
                <div class="bg-gradient-to-r from-indigo-50 to-blue-50 px-6 py-5 border-b border-gray-200">
                    <div class="flex items-start space-x-3">
                        <div class="w-9 h-9 bg-indigo-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-800">Data Role</h2>
                            <p class="text-xs text-gray-600">
                                Total: <span class="font-semibold">{{ count($data) }}</span> role
                            </p>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gradient-to-r from-gray-50 to-gray-100">
                                <th class="px-4 py-3 text-left text-[11px] font-bold text-gray-700 uppercase border-b-2 border-gray-200">ID Role</th>
                                <th class="px-4 py-3 text-left text-[11px] font-bold text-gray-700 uppercase border-b-2 border-gray-200">Nama Role</th>
                                <th class="px-4 py-3 text-center text-[11px] font-bold text-gray-700 uppercase border-b-2 border-gray-200">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($data as $index => $r)
                                <tr class="transition duration-150 {{ $index % 2 == 0 ? 'bg-white hover:bg-blue-50' : 'bg-gray-50 hover:bg-blue-50' }}">
                                    <td class="px-4 py-3 font-semibold text-gray-700">{{ $r->idrole }}</td>
                                    <td class="px-4 py-3 font-medium text-gray-900">{{ $r->nama_role }}</td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="flex justify-center gap-2">
                                            <button wire:click="edit({{ $r->idrole }})"
                                                class="px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-white text-xs font-semibold rounded-lg shadow transition">
                                                ✏️ Edit
                                            </button>
                                            <button wire:click="delete({{ $r->idrole }})"
                                                onclick="return confirm('⚠️ Apakah Anda yakin ingin menghapus role \"{{ $r->nama_role }}\"? Data tidak dapat dikembalikan!')"
                                                class="px-3 py-1.5 bg-rose-600 hover:bg-rose-700 text-white text-xs font-semibold rounded-lg shadow transition">
                                                🗑️ Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-12 text-center text-gray-500 text-sm">
                                        Belum ada data role.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>

            {{-- ================= BACK BUTTON ================= --}}
            <div class="mt-8 text-center">
                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center px-5 py-2.5 bg-white hover:bg-gray-50 text-gray-700 font-semibold text-sm rounded-xl border-2 border-gray-300 shadow-sm hover:shadow transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span>Kembali ke Dashboard</span>
                </a>
            </div>

        </div>
    </main>
</div>
