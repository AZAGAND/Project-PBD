<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 flex flex-col">

    {{-- ================= HEADER ================= --}}
    <header class="bg-gradient-to-r from-blue-600 to-indigo-700 shadow-lg rounded-b-2xl">
        <div class="max-w-6xl mx-auto px-6 py-6 flex justify-between items-center">
            @auth
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-white mb-1">
                        Manajemen Satuan ⚖️ — {{ auth()->user()->username }}
                    </h1>
                    <p class="text-blue-100 text-sm">Kelola data satuan barang di sistem</p>
                    <span class="text-white text-sm font-semibold">Superadmin</span>
                </div>
            @endauth
        </div>
    </header>

    {{-- ================= MAIN ================= --}}
    <main class="flex-1 w-full">
        <div class="max-w-5xl mx-auto px-6 py-8 space-y-8">

            {{-- ========== FLASH MESSAGE ========== --}}
            @if (session()->has('ok'))
                <div class="bg-emerald-50 border-l-4 border-emerald-500 rounded-xl p-4 shadow-sm flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-emerald-700">Berhasil!</p>
                        <p class="text-sm text-emerald-600">{{ session('ok') }}</p>
                    </div>
                </div>
            @endif

            @if (session()->has('err'))
                <div class="bg-rose-50 border-l-4 border-rose-500 rounded-xl p-4 shadow-sm flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-rose-100 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-rose-700">Terjadi Kesalahan!</p>
                        <p class="text-sm text-rose-600">{{ session('err') }}</p>
                    </div>
                </div>
            @endif

            {{-- ========== FORM ========== --}}
            <section class="bg-white rounded-2xl shadow-xl border-t-4 border-blue-600 p-6">
                <div class="flex items-center space-x-3 mb-5">
                    <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-gray-800">{{ $isEdit ? 'Edit Satuan' : 'Tambah Satuan' }}</h2>
                        <p class="text-xs text-gray-500">{{ $isEdit ? 'Perbarui data satuan' : 'Tambah satuan baru' }}</p>
                    </div>
                </div>

                <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    {{-- Nama Satuan --}}
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Satuan <span class="text-rose-500">*</span></label>
                        <input type="text" wire:model.defer="nama_satuan" placeholder="Masukkan nama satuan"
                            class="w-full px-3 py-2 bg-gray-50 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 outline-none transition">
                        @error('nama_satuan')
                            <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Status</label>
                        <select wire:model.defer="status"
                            class="w-full px-3 py-2 bg-gray-50 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 outline-none transition">
                            <option value="1">Aktif</option>
                            <option value="0">Nonaktif</option>
                        </select>
                    </div>

                    {{-- Tombol --}}
                    <div class="md:col-span-3 flex flex-wrap gap-3 pt-2">
                        <button type="submit"
                            class="flex-1 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold px-5 py-2.5 rounded-xl shadow hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                            {{ $isEdit ? 'Update Data' : 'Simpan Data' }}
                        </button>
                        <button type="button" wire:click="resetForm"
                            class="flex-1 bg-white border-2 border-gray-300 text-gray-700 font-semibold px-5 py-2.5 rounded-xl hover:bg-gray-50 transition">
                            Reset Form
                        </button>
                    </div>
                </form>
            </section>

            {{-- ========== TABLE ========== --}}
            <section class="bg-white rounded-2xl shadow-xl overflow-hidden border-t-4 border-indigo-600">
                <div class="bg-gradient-to-r from-indigo-50 to-blue-50 px-6 py-5 border-b border-gray-200 flex items-center space-x-3">
                    <div class="w-9 h-9 bg-indigo-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-gray-800">Data Satuan</h2>
                        <p class="text-xs text-gray-600">Total: <span class="font-semibold">{{ count($data) }}</span> data</p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gradient-to-r from-gray-50 to-gray-100">
                                <th class="px-4 py-3 border-b-2 border-gray-200 text-left font-bold text-xs text-gray-700 uppercase">ID</th>
                                <th class="px-4 py-3 border-b-2 border-gray-200 text-left font-bold text-xs text-gray-700 uppercase">Nama</th>
                                <th class="px-4 py-3 border-b-2 border-gray-200 text-center font-bold text-xs text-gray-700 uppercase">Status</th>
                                <th class="px-4 py-3 border-b-2 border-gray-200 text-center font-bold text-xs text-gray-700 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($data as $s)
                                <tr class="hover:bg-blue-50 transition">
                                    <td class="px-4 py-3">{{ $s->idsatuan }}</td>
                                    <td class="px-4 py-3 font-medium text-gray-800">{{ $s->nama_satuan }}</td>
                                    <td class="px-4 py-3 text-center">
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-semibold {{ $s->status ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }}">
                                            {{ $s->status ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="flex justify-center gap-2">
                                            <button wire:click="edit({{ $s->idsatuan }})"
                                                class="px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-white text-xs font-semibold rounded-lg shadow transition">
                                                ✏️ Edit
                                            </button>
                                            <button wire:click="delete({{ $s->idsatuan }})"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus satuan ini?')"
                                                class="px-3 py-1.5 bg-rose-600 hover:bg-rose-700 text-white text-xs font-semibold rounded-lg shadow transition">
                                                🗑️ Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-12 text-center text-gray-500 text-sm">
                                        Belum ada data satuan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>

            {{-- ========== BACK BUTTON ========== --}}
            <div class="text-center">
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
