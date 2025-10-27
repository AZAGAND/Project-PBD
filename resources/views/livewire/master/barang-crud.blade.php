<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 flex flex-col">

    {{-- ================= HEADER ================= --}}
    <header class="bg-gradient-to-r from-blue-600 to-indigo-700 shadow-lg rounded-b-2xl">
        <div class="max-w-6xl mx-auto px-6 py-6 flex justify-between items-center">
            @auth
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-white mb-1">
                        Manajemen Barang 📦 — {{ auth()->user()->username }}
                    </h1>
                    <p class="text-blue-100 text-sm">Kelola data barang di sistem</p>
                    <span class="text-white text-sm font-semibold">{{ auth()->user()->role->nama_role ?? 'User' }}</span>
                </div>
                <div class="text-right">
                    <p class="text-blue-200 text-sm">{{ now()->format('d M Y') }}</p>
                </div>
            @endauth
        </div>
    </header>

    {{-- ================= MAIN ================= --}}
    <main class="flex-1 w-full">
        <div class="max-w-7xl mx-auto px-6 py-8 space-y-8">

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

            {{-- ========== TABLE ========== --}}
            <section class="bg-white rounded-2xl shadow-xl overflow-hidden border-t-4 border-indigo-600">
                <div class="bg-gradient-to-r from-indigo-50 to-blue-50 px-6 py-5 border-b border-gray-200 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-9 h-9 bg-indigo-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-800">Daftar Barang</h2>
                            <p class="text-xs text-gray-600">Total: <span class="font-semibold">{{ count($data) }}</span> data</p>
                        </div>
                    </div>

                    <button type="button" wire:click="resetForm" @click="$wire.resetForm().then(() => openModal())"
                        class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold px-5 py-2.5 rounded-xl shadow hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                        <span class="inline-flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Barang
                        </span>
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gradient-to-r from-gray-50 to-gray-100">
                                <th class="px-4 py-3 border-b-2 border-gray-200 text-left font-bold text-xs text-gray-700 uppercase">ID</th>
                                <th class="px-4 py-3 border-b-2 border-gray-200 text-left font-bold text-xs text-gray-700 uppercase">Jenis</th>
                                <th class="px-4 py-3 border-b-2 border-gray-200 text-left font-bold text-xs text-gray-700 uppercase">Nama</th>
                                <th class="px-4 py-3 border-b-2 border-gray-200 text-left font-bold text-xs text-gray-700 uppercase">Satuan</th>
                                <th class="px-4 py-3 border-b-2 border-gray-200 text-left font-bold text-xs text-gray-700 uppercase">Harga</th>
                                <th class="px-4 py-3 border-b-2 border-gray-200 text-center font-bold text-xs text-gray-700 uppercase">Status</th>
                                <th class="px-4 py-3 border-b-2 border-gray-200 text-center font-bold text-xs text-gray-700 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($data as $b)
                                <tr class="hover:bg-blue-50 transition">
                                    <td class="px-4 py-3">{{ $b->idbarang }}</td>
                                    <td class="px-4 py-3 font-medium text-gray-800">{{ $b->jenis }}</td>
                                    <td class="px-4 py-3 font-medium text-gray-800">{{ $b->nama }}</td>
                                    <td class="px-4 py-3 text-gray-600">{{ $b->nama_satuan ?? '-' }}</td>
                                    <td class="px-4 py-3 font-medium text-gray-800">Rp {{ number_format($b->Harga, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 text-center">
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $b->status ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }}">
                                            {{ $b->status ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="flex justify-center gap-2">
                                            <button type="button" wire:click="edit({{ $b->idbarang }})"
                                                @click="$wire.edit({{ $b->idbarang }}).then(() => openModal())"
                                                class="px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-white text-xs font-semibold rounded-lg shadow transition">
                                                ✏️ Edit
                                            </button>
                                            <button onclick="confirmDelete({{ $b->idbarang }}, '{{ $b->nama }}')"
                                                class="px-3 py-1.5 bg-rose-600 hover:bg-rose-700 text-white text-xs font-semibold rounded-lg shadow transition">
                                                🗑️ Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center text-gray-500">
                                            <svg class="w-16 h-16 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                            </svg>
                                            <p class="font-medium text-sm">Tidak ada data barang</p>
                                            <p class="text-xs text-gray-400 mt-1">Klik tombol "Tambah Barang" untuk menambahkan data</p>
                                        </div>
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

    {{-- ================= MODAL FORM TAMBAH/EDIT ================= --}}
    <div id="modalBackdrop" wire:ignore class="fixed inset-0 hidden z-40 transition-opacity duration-300 opacity-0"
        style="background-color: rgba(0, 0, 0, 0.3); backdrop-filter: blur(6px);">
    </div>
    
    <div id="modalContainer" wire:ignore.self class="fixed inset-0 flex justify-center items-center hidden z-50 p-4">
        <div id="modalContent"
            class="bg-white rounded-2xl shadow-2xl w-full max-w-3xl transform transition-all duration-300 scale-95 opacity-0 border-t-4 border-blue-600"
            onclick="event.stopPropagation()">

            {{-- Header Modal --}}
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-5 border-b border-gray-200 rounded-t-2xl flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">{{ $isEdit ? 'Edit Barang' : 'Tambah Barang' }}</h3>
                        <p class="text-xs text-gray-500">{{ $isEdit ? 'Perbarui data barang' : 'Tambah barang baru' }}</p>
                    </div>
                </div>
                <button type="button" onclick="closeModal()"
                    class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg p-2 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Form Content --}}
            <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}" class="p-6 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    {{-- Jenis Barang --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Jenis Barang <span class="text-rose-500">*</span></label>
                        <input type="text" wire:model.defer="jenis" id="focusJenis" placeholder="Contoh: A, B, C"
                            class="w-full px-3 py-2 bg-gray-50 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 outline-none transition">
                        @error('jenis')
                            <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Nama Barang --}}
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Barang <span class="text-rose-500">*</span></label>
                        <input type="text" wire:model.defer="nama" placeholder="Masukkan nama barang"
                            class="w-full px-3 py-2 bg-gray-50 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 outline-none transition">
                        @error('nama')
                            <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Satuan --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Satuan <span class="text-rose-500">*</span></label>
                        <select wire:model.defer="idsatuan"
                            class="w-full px-3 py-2 bg-gray-50 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 outline-none transition">
                            <option value="">-- Pilih Satuan --</option>
                            @foreach ($satuan as $s)
                                <option value="{{ $s->idsatuan }}">{{ $s->nama_satuan }}</option>
                            @endforeach
                        </select>
                        @error('idsatuan')
                            <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Harga --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Harga (Rp) <span class="text-rose-500">*</span></label>
                        <input type="number" wire:model.defer="harga" placeholder="0" min="0"
                            class="w-full px-3 py-2 bg-gray-50 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 outline-none transition">
                        @error('harga')
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
                </div>

                {{-- Action Buttons --}}
                <div class="flex justify-end gap-3 pt-6 border-t border-gray-200 mt-6">
                    <button type="button" onclick="closeModal()"
                        class="px-5 py-2.5 bg-white border-2 border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold px-5 py-2.5 rounded-xl shadow hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                        <span class="inline-flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ $isEdit ? 'Update Barang' : 'Simpan Barang' }}
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ================= MODAL KONFIRMASI HAPUS ================= --}}
    <div id="deleteModalBackdrop" wire:ignore class="fixed inset-0 bg-black bg-opacity-50 hidden z-40 transition-opacity duration-300 opacity-0"
        style="background-color: rgba(0, 0, 0, 0.3); backdrop-filter: blur(6px);">
    </div>

    <div id="deleteModalContainer" wire:ignore.self class="fixed inset-0 flex justify-center items-center hidden z-50 p-4">
        <div id="deleteModalContent"
            class="bg-white rounded-2xl shadow-2xl w-full max-w-md transform transition-all duration-300 scale-95 opacity-0 border-t-4 border-rose-600"
            onclick="event.stopPropagation()">

            <div class="p-6">
                {{-- Icon Warning --}}
                <div class="flex justify-center mb-4">
                    <div class="w-16 h-16 bg-rose-100 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                </div>

                {{-- Content --}}
                <h3 class="text-xl font-bold text-gray-900 text-center mb-2">Konfirmasi Hapus</h3>
                <p class="text-gray-600 text-center mb-2">
                    Apakah Anda yakin ingin menghapus barang <br>
                    <span id="deleteItemName" class="font-bold text-gray-900"></span>?
                </p>
                <div class="bg-rose-50 border-l-4 border-rose-500 rounded-lg p-3 mb-6">
                    <p class="text-sm text-rose-700 text-center">
                        ⚠️ Data yang sudah dihapus tidak dapat dikembalikan!
                    </p>
                </div>

                {{-- Buttons --}}
                <div class="flex gap-3">
                    <button type="button" onclick="closeDeleteModal()"
                        class="flex-1 px-4 py-2.5 bg-white border-2 border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition">
                        Batal
                    </button>
                    <button type="button" id="confirmDeleteBtn"
                        class="flex-1 px-4 py-2.5 bg-rose-600 hover:bg-rose-700 text-white font-semibold rounded-xl shadow hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                        <span class="inline-flex items-center justify-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Ya, Hapus
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    // Modal Form Functions
    function openModal() {
        const backdrop = document.getElementById('modalBackdrop');
        const container = document.getElementById('modalContainer');
        const content = document.getElementById('modalContent');

        if (!backdrop || !container || !content) return;

        backdrop.classList.remove('hidden');
        container.classList.remove('hidden');
        void backdrop.offsetWidth;

        requestAnimationFrame(() => {
            backdrop.classList.add('opacity-100');
            backdrop.classList.remove('opacity-0');
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');

            setTimeout(() => {
                const firstInput = document.getElementById('focusJenis');
                if (firstInput) firstInput.focus();
            }, 100);
        });
    }

    function closeModal() {
        const backdrop = document.getElementById('modalBackdrop');
        const container = document.getElementById('modalContainer');
        const content = document.getElementById('modalContent');

        if (!backdrop || !container || !content) return;
        if (container.classList.contains('hidden')) return;

        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');
        backdrop.classList.remove('opacity-100');
        backdrop.classList.add('opacity-0');

        setTimeout(() => {
            backdrop.classList.add('hidden');
            container.classList.add('hidden');
        }, 300);
    }

    // Modal Delete Functions
    let deleteItemId = null;

    function confirmDelete(id, name) {
        deleteItemId = id;
        const deleteNameEl = document.getElementById('deleteItemName');
        if (deleteNameEl) deleteNameEl.textContent = name;

        const backdrop = document.getElementById('deleteModalBackdrop');
        const container = document.getElementById('deleteModalContainer');
        const content = document.getElementById('deleteModalContent');

        if (!backdrop || !container || !content) return;

        backdrop.classList.remove('hidden');
        container.classList.remove('hidden');
        void backdrop.offsetWidth;

        requestAnimationFrame(() => {
            backdrop.classList.add('opacity-100');
            backdrop.classList.remove('opacity-0');
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
        });
    }

    function closeDeleteModal() {
        const backdrop = document.getElementById('deleteModalBackdrop');
        const container = document.getElementById('deleteModalContainer');
        const content = document.getElementById('deleteModalContent');

        if (!backdrop || !container || !content) return;
        if (container.classList.contains('hidden')) return;

        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');
        backdrop.classList.remove('opacity-100');
        backdrop.classList.add('opacity-0');

        setTimeout(() => {
            backdrop.classList.add('hidden');
            container.classList.add('hidden');
            deleteItemId = null;
        }, 300);
    }

    // Initialize when DOM is ready
    document.addEventListener('DOMContentLoaded', function() {
        const confirmBtn = document.getElementById('confirmDeleteBtn');
        if (confirmBtn) {
            confirmBtn.addEventListener('click', function() {
                if (deleteItemId) {
                    const component = window.Livewire?.find(document.querySelector('[wire\\:id]')?.getAttribute('wire:id'));
                    if (component) {
                        component.call('delete', deleteItemId);
                    }
                    closeDeleteModal();
                }
            });
        }

        const modalBackdrop = document.getElementById('modalBackdrop');
        const deleteBackdrop = document.getElementById('deleteModalBackdrop');

        if (modalBackdrop) {
            modalBackdrop.addEventListener('click', function(e) {
                if (e.target === modalBackdrop) closeModal();
            });
        }

        if (deleteBackdrop) {
            deleteBackdrop.addEventListener('click', function(e) {
                if (e.target === deleteBackdrop) closeDeleteModal();
            });
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const modalContainer = document.getElementById('modalContainer');
                const deleteModalContainer = document.getElementById('deleteModalContainer');

                const modalShown = modalContainer && !modalContainer.classList.contains('hidden');
                const deleteModalShown = deleteModalContainer && !deleteModalContainer.classList.contains('hidden');

                if (modalShown) closeModal();
                if (deleteModalShown) closeDeleteModal();
            }
        });
    });

    // Listen for Livewire events - Compatible with Livewire 2 & 3
    if (window.Livewire) {
        // Livewire 3
        if (typeof Livewire.on === 'function') {
            Livewire.on('close-modal', () => {
                closeModal();
            });

            Livewire.on('open-modal', () => {
                openModal();
            });
        }

        // Livewire 2
        document.addEventListener('livewire:load', function() {
            window.livewire.on('close-modal', () => {
                closeModal();
            });

            window.livewire.on('open-modal', () => {
                openModal();
            });
        });
    }

    // Also listen via window events
    window.addEventListener('close-modal', () => {
        closeModal();
    });

    window.addEventListener('open-modal', () => {
        openModal();
    });
</script>