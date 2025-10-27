<div class="max-w-7xl mx-auto p-6 space-y-6">

    {{-- Flash Messages --}}
    @if (session()->has('ok'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg shadow-sm">
            ✅ {{ session('ok') }}
        </div>
    @endif
    @if (session()->has('err'))
        <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg shadow-sm">
            ❌ {{ session('err') }}
        </div>
    @endif

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

    {{-- Tabel Daftar Barang --}}
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">Daftar Barang</h2>

            <!-- Tombol tambah barang -->
            <button 
                type="button"
                wire:click="resetForm"
                @click="$wire.resetForm().then(() => openModal())"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none 
                       focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition-all">
                <span class="inline-flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Barang
                </span>
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">ID</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Jenis</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Nama</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Satuan</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Harga</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Status</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-600 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($data as $b)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-sm text-gray-900">{{ $b->idbarang }}</td>
                            <td class="px-4 py-3 text-sm text-gray-900">{{ $b->jenis }}</td>
                            <td class="px-4 py-3 text-sm text-gray-900">{{ $b->nama }}</td>
                            <td class="px-4 py-3 text-sm text-gray-600">{{ $b->nama_satuan ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-900">Rp {{ number_format($b->Harga, 0, ',', '.') }}</td>
                            <td class="px-4 py-3 text-sm">
                                @if ($b->status)
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Nonaktif</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm text-center">
                                <div class="flex justify-center gap-2">
                                    <!-- Tombol Edit -->
                                    <button 
                                        type="button"
                                        wire:click="edit({{ $b->idbarang }})"
                                        @click="$wire.edit({{ $b->idbarang }}).then(() => openModal())"
                                        class="bg-amber-500 hover:bg-amber-600 text-white px-3 py-1 rounded-md text-xs font-medium transition-all">
                                        <span class="inline-flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                            Edit
                                        </span>
                                    </button>
                                    <!-- Tombol Hapus -->
                                    <button 
                                        onclick="confirmDelete({{ $b->idbarang }}, '{{ $b->nama }}')"
                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md text-xs font-medium transition-all">
                                        <span class="inline-flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Hapus
                                        </span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                    </svg>
                                    <p class="font-medium">Tidak ada data barang</p>
                                    <p class="text-sm text-gray-400">Klik tombol "Tambah Barang" untuk menambahkan data</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Form Tambah/Edit Barang --}}
    <div id="modalBackdrop" 
         wire:ignore
         style="backdrop-filter: blur(4px);" 
         class="fixed inset-0 bg-black bg-opacity-50 hidden z-40 transition-opacity duration-300 opacity-0"></div>

    <div id="modalContainer" wire:ignore.self class="fixed inset-0 flex justify-center items-center hidden z-50 p-4">
        <div id="modalContent"
             class="bg-white rounded-xl shadow-2xl w-full max-w-2xl p-6 transform transition-all duration-300 scale-95 opacity-0"
             onclick="event.stopPropagation()">

            <!-- Header -->
            <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200">
                <h3 class="text-xl font-bold text-gray-900 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                    </svg>
                    {{ $isEdit ? 'Edit Barang' : 'Tambah Barang Baru' }}
                </h3>
                <button type="button" onclick="closeModal()"
                    class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg p-2 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Form -->
            <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Barang</label>
                        <input type="text" wire:model.defer="jenis" id="focusJenis" placeholder="Contoh: A, B, C"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                        @error('jenis') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Barang</label>
                        <input type="text" wire:model.defer="nama" placeholder="Masukkan nama barang"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                        @error('nama') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Satuan</label>
                        <select wire:model.defer="idsatuan"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                            <option value="">-- Pilih Satuan --</option>
                            @foreach ($satuan as $s)
                                <option value="{{ $s->idsatuan }}">{{ $s->nama_satuan }}</option>
                            @endforeach
                        </select>
                        @error('idsatuan') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Harga (Rp)</label>
                        <input type="number" wire:model.defer="harga" placeholder="0" min="0"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                        @error('harga') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select wire:model.defer="status"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                            <option value="1">Aktif</option>
                            <option value="0">Nonaktif</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-6 border-t border-gray-200 mt-6">
                    <button type="button" onclick="closeModal()"
                        class="px-6 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg border border-gray-300 transition-all">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-6 py-2.5 bg-blue-700 hover:bg-blue-800 text-white font-medium rounded-lg transition-all shadow-lg hover:shadow-xl">
                        <span class="inline-flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ $isEdit ? 'Update Barang' : 'Simpan Barang' }}
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Konfirmasi Hapus --}}
    <div id="deleteModalBackdrop" 
         wire:ignore
         style="backdrop-filter: blur(4px);" 
         class="fixed inset-0 bg-black bg-opacity-50 hidden z-40 transition-opacity duration-300 opacity-0"></div>

    <div id="deleteModalContainer" wire:ignore.self class="fixed inset-0 flex justify-center items-center hidden z-50 p-4">
        <div id="deleteModalContent"
             class="bg-white rounded-xl shadow-2xl w-full max-w-md p-6 transform transition-all duration-300 scale-95 opacity-0"
             onclick="event.stopPropagation()">
            
            <!-- Icon Warning -->
            <div class="flex justify-center mb-4">
                <div class="bg-red-100 rounded-full p-3">
                    <svg class="w-12 h-12 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
            </div>

            <!-- Content -->
            <h3 class="text-xl font-bold text-gray-900 text-center mb-2">Konfirmasi Hapus</h3>
            <p class="text-gray-600 text-center mb-6">
                Apakah Anda yakin ingin menghapus barang <br>
                <span id="deleteItemName" class="font-bold text-gray-900"></span>?
            </p>
            <p class="text-sm text-red-600 text-center mb-6">
                ⚠️ Data yang sudah dihapus tidak dapat dikembalikan!
            </p>

            <!-- Buttons -->
            <div class="flex gap-3">
                <button type="button" onclick="closeDeleteModal()"
                    class="flex-1 px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg border border-gray-300 transition-all">
                    Batal
                </button>
                <button type="button" id="confirmDeleteBtn"
                    class="flex-1 px-4 py-2.5 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-all shadow-lg hover:shadow-xl">
                    <span class="inline-flex items-center justify-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Ya, Hapus
                    </span>
                </button>
            </div>
        </div>
    </div>

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

<script>
    // Modal Form Functions
    function openModal() {
        const backdrop = document.getElementById('modalBackdrop');
        const container = document.getElementById('modalContainer');
        const content = document.getElementById('modalContent');
        
        if (!backdrop || !container || !content) return;
        
        // Show elements
        backdrop.classList.remove('hidden');
        container.classList.remove('hidden');
        
        // Force reflow
        void backdrop.offsetWidth;
        
        // Trigger animation after a brief delay
        requestAnimationFrame(() => {
            backdrop.classList.add('opacity-100');
            backdrop.classList.remove('opacity-0');
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
            
            // Auto focus pada input pertama
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
        
        // Animate out
        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');
        backdrop.classList.remove('opacity-100');
        backdrop.classList.add('opacity-0');
        
        // Hide after animation
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
        
        // Show elements
        backdrop.classList.remove('hidden');
        container.classList.remove('hidden');
        
        // Force reflow
        void backdrop.offsetWidth;
        
        // Trigger animation after a brief delay
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
        
        // Animate out
        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');
        backdrop.classList.remove('opacity-100');
        backdrop.classList.add('opacity-0');
        
        // Hide after animation
        setTimeout(() => {
            backdrop.classList.add('hidden');
            container.classList.add('hidden');
            deleteItemId = null;
        }, 300);
    }

    // Initialize when DOM is ready
    document.addEventListener('DOMContentLoaded', function() {
        
        // Confirm delete button handler
        const confirmBtn = document.getElementById('confirmDeleteBtn');
        if (confirmBtn) {
            confirmBtn.addEventListener('click', function() {
                if (deleteItemId) {
                    // Call Livewire delete method
                    const component = window.Livewire?.find(document.querySelector('[wire\\:id]')?.getAttribute('wire:id'));
                    if (component) {
                        component.call('delete', deleteItemId);
                    }
                    closeDeleteModal();
                }
            });
        }

        // Close modal on backdrop click (tapi bukan content)
        const modalBackdrop = document.getElementById('modalBackdrop');
        const deleteBackdrop = document.getElementById('deleteModalBackdrop');
        
        if (modalBackdrop) {
            modalBackdrop.addEventListener('click', function(e) {
                if (e.target === modalBackdrop) {
                    closeModal();
                }
            });
        }
        
        if (deleteBackdrop) {
            deleteBackdrop.addEventListener('click', function(e) {
                if (e.target === deleteBackdrop) {
                    closeDeleteModal();
                }
            });
        }

        // Close modal on ESC key
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

    // Listen for Livewire events - Versi kompatibel untuk Livewire 2 & 3
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
        document.addEventListener('livewire:load', function () {
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