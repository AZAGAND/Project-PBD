<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
    {{-- Header --}}
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 shadow-lg rounded-b-2xl mt-1">
        <div class="max-w-7xl mx-auto px-6 py-6">
            <div class="flex justify-between items-center">
                @auth
                <div>
                    <h1 class="text-3xl font-bold text-white mb-1">Selamat Datang di Menu Manajemen Role👋, {{ auth()->user()->username }}</h1>
                    <p class="text-blue-100 text-sm">Kelola role dan akses pengguna sistem</p>
                    <span class="text-white text-sm text-lg">Superadmin</span>
                </div class="flex items-center gap-4">                
                    <div class="flex flex-col text-right leading-tight">
                        
                    </div>
                @endauth
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 py-8">
        {{-- Flash Messages --}}
        @if (session()->has('ok'))
            <div
                class="mb-6 bg-white border-l-4 border-emerald-500 rounded-r-xl shadow-lg p-5 flex items-start space-x-4 animate-bounce">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="flex-1">
                    <h3 class="text-emerald-800 font-semibold">Berhasil!</h3>
                    <p class="text-emerald-700 text-sm mt-1">{{ session('ok') }}</p>
                </div>
            </div>
        @endif

        @if (session()->has('err'))
            <div class="mb-6 bg-white border-l-4 border-rose-500 rounded-r-xl shadow-lg p-5 flex items-start space-x-4">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-rose-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="flex-1">
                    <h3 class="text-rose-800 font-semibold">Terjadi Kesalahan!</h3>
                    <p class="text-rose-700 text-sm mt-1">{{ session('err') }}</p>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Form Section --}}
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-xl p-6 border-t-4 border-blue-600">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-800">{{ $isEdit ? 'Edit Role' : 'Tambah Role' }}</h2>
                            <p class="text-xs text-gray-500">{{ $isEdit ? 'Perbarui data role' : 'Buat role baru' }}</p>
                        </div>
                    </div>

                    <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}" class="space-y-5">
                        <div>
                            <label for="nama_role" class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama Role <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                </div>
                                <input type="text" id="nama_role" wire:model.defer="nama_role"
                                    placeholder="Contoh: Admin, User, Manager"
                                    class="w-full pl-10 pr-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 outline-none">
                            </div>
                            @error('nama_role')
                                <div class="mt-2 flex items-center space-x-2 text-rose-600 text-sm">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <div class="flex flex-col space-y-3 pt-2">
                            <button type="submit"
                                class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold px-6 py-3.5 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center space-x-2">
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
                                    class="w-full bg-white hover:bg-gray-50 text-gray-700 font-semibold px-6 py-3.5 rounded-xl border-2 border-gray-300 shadow-sm hover:shadow transition-all duration-200 flex items-center justify-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    <span>Batal Edit</span>
                                </button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            {{-- Table Section --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border-t-4 border-indigo-600">
                    <div class="bg-gradient-to-r from-indigo-50 to-blue-50 px-6 py-5 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-xl font-bold text-gray-800">Data Role</h2>
                                    <p class="text-xs text-gray-600">Total: <span
                                            class="font-semibold">{{ count($data) }}</span> role</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gradient-to-r from-gray-50 to-gray-100">
                                    <th
                                        class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider border-b-2 border-gray-200">
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-4 h-4 text-gray-500" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                                <path fill-rule="evenodd"
                                                    d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span>ID Role</span>
                                        </div>
                                    </th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider border-b-2 border-gray-200">
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-4 h-4 text-gray-500" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span>Nama Role</span>
                                        </div>
                                    </th>
                                    <th
                                        class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider border-b-2 border-gray-200">
                                        <div class="flex items-center justify-center space-x-2">
                                            <svg class="w-4 h-4 text-gray-500" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                            </svg>
                                            <span>Aksi</span>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($data as $index => $r)
                                    <tr
                                        class="hover:bg-blue-50 transition-colors duration-150 {{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-50' }}">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div
                                                    class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center">
                                                    <span
                                                        class="text-indigo-700 font-bold text-sm">{{ $r->idrole }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center space-x-3">
                                                <div
                                                    class="w-10 h-10 bg-gradient-to-br from-blue-400 to-indigo-500 rounded-full flex items-center justify-center shadow-md">
                                                    <span
                                                        class="text-white font-bold text-sm">{{ strtoupper(substr($r->nama_role, 0, 2)) }}</span>
                                                </div>
                                                <div>
                                                    <p class="text-sm font-semibold text-gray-900">{{ $r->nama_role }}
                                                    </p>
                                                    <p class="text-xs text-gray-500">Role ID: {{ $r->idrole }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center justify-center space-x-2">
                                                <button wire:click="edit({{ $r->idrole }})"
                                                    class="group relative inline-flex items-center px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white font-medium rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                    <span class="text-sm">Edit</span>
                                                </button>
                                                <button wire:click="delete({{ $r->idrole }})"
                                                    onclick="return confirm('⚠️ Apakah Anda yakin ingin menghapus role \"{{ $r->nama_role }}\"?\n\nData yang dihapus tidak dapat dikembalikan!')"
                                                    class="group relative inline-flex items-center px-4 py-2 bg-rose-600 hover:bg-rose-700 text-white font-medium rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    <span class="text-sm">Hapus</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-16">
                                            <div class="text-center">
                                                <div
                                                    class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                                                    <svg class="w-10 h-10 text-gray-400" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                                    </svg>
                                                </div>
                                                <h3 class="text-lg font-semibold text-gray-700 mb-1">Belum Ada Data
                                                </h3>
                                                <p class="text-sm text-gray-500">Silakan tambahkan role baru
                                                    menggunakan form di samping</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
