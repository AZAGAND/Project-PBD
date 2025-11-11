<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 flex flex-col">

    {{-- HEADER --}}
    <header class="bg-gradient-to-r from-blue-600 to-indigo-700 shadow-lg rounded-b-2xl">
        <div class="max-w-6xl mx-auto px-6 py-6 flex justify-between items-center">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-white">
                    Manajemen Pengadaan 📋 — {{ auth()->user()->username }}
                </h1>
                <p class="text-blue-100 text-sm">Kelola data pengadaan</p>
            </div>
            <p class="text-blue-200 text-sm">{{ now()->format('d M Y') }}</p>
        </div>
    </header>

    {{-- BODY --}}
    <main class="flex-1 w-full">
        <div class="max-w-7xl mx-auto px-6 py-8 space-y-8">

            {{-- FLASH --}}
            @if (session()->has('ok'))
                <div class="bg-emerald-50 border-l-4 border-emerald-500 px-4 py-3 rounded">
                    <p class="text-emerald-700">{{ session('ok') }}</p>
                </div>
            @endif

            @if (session()->has('err'))
                <div class="bg-rose-50 border-l-4 border-rose-500 px-4 py-3 rounded">
                    <p class="text-rose-700">{{ session('err') }}</p>
                </div>
            @endif

            {{-- Tombol Tambah --}}
            <div class="flex justify-end">
                <button onclick="openModal()"
                    class="px-5 py-2.5 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">
                    + Tambah Pengadaan
                </button>
            </div>

            {{-- TABLE --}}
            <div class="bg-white rounded-xl shadow overflow-hidden">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">Tanggal</th>
                            <th class="px-4 py-2">Vendor</th>
                            <th class="px-4 py-2">User</th>
                            <th class="px-4 py-2 text-right">Subtotal</th>
                            <th class="px-4 py-2 text-center">PPN</th>
                            <th class="px-4 py-2 text-right">Total</th>
                            <th class="px-4 py-2 text-center">Status</th>
                            <th class="px-4 py-2 text-center">Detail</th>
                            <th class="px-4 py-2 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($data as $p)
                            <tr class="hover:bg-blue-50">
                                <td class="px-4 py-3">{{ $p->idpengadaan }}</td>
                                <td class="px-4 py-3">{{ \Carbon\Carbon::parse($p->timestamp)->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-4 py-3">{{ $p->nama_vendor }}</td>
                                <td class="px-4 py-3">{{ $p->username }}</td>
                                <td class="px-4 py-3 text-right">Rp
                                    {{ number_format($p->subtotal_nilai ?? 0, 0, ',', '.') }}</td>
                                <td class="px-4 py-3 text-center">{{ $p->ppn }}%</td>
                                <td class="px-4 py-3 text-right">Rp
                                    {{ number_format($p->total_nilai ?? 0, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3 text-center">
                                    @php
                                        $badge = [
                                            'A' => ['Pending', 'bg-yellow-100 text-yellow-700'],
                                            'B' => ['Disetujui', 'bg-green-100 text-green-700'],
                                            'C' => ['Ditolak', 'bg-red-100 text-red-700'],
                                        ];
                                    @endphp
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-semibold {{ $badge[$p->status][1] ?? '' }}">
                                        {{ $badge[$p->status][0] }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <a href="{{ route('transaction.pengadaan.detail', $p->idpengadaan) }}"
                                        class="px-3 py-1.5 bg-blue-500 text-white rounded text-xs hover:bg-blue-600">
                                        Detail
                                    </a>
                                </td>

                                <td class="px-4 py-3 text-center">
                                    <button onclick="confirmDelete({{ $p->idpengadaan }}, '{{ $p->nama_vendor }}')"
                                        class="px-3 py-1.5 bg-red-600 text-white rounded text-xs">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-6 text-gray-500">Belum ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
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

    {{-- ================= MODAL TAMBAH ================= --}}
    <div id="modalBackdrop" class="fixed inset-0 bg-black/30 hidden opacity-0 transition"></div>
    <div id="modalContainer" class="fixed inset-0 flex hidden justify-center items-center z-50">
        <div id="modalContent"
            class="bg-white rounded-xl shadow-xl w-full max-w-lg p-6 transform scale-95 opacity-0 transition">
            <h3 class="text-lg font-bold mb-4">Tambah Pengadaan</h3>
            <form wire:submit.prevent="store">

                <div class="mb-4">
                    <label class="text-sm font-semibold">Vendor</label>
                    <select wire:model.defer="vendor_idvendor" class="w-full border rounded px-3 py-2">
                        <option value="">-- Pilih Vendor --</option>
                        @foreach ($vendors as $v)
                            <option value="{{ $v->idvendor }}">{{ $v->nama_vendor }} ({{ $v->badan_hukum }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="text-sm font-semibold">PPN (%)</label>
                    <input type="number" wire:model.defer="ppn" class="w-full border rounded px-3 py-2" min="0"
                        max="100">
                </div>

                <div class="mb-4">
                    <label class="text-sm font-semibold">Status</label>
                    <select wire:model.defer="status" class="w-full border rounded px-3 py-2">
                        <option value="A">Pending</option>
                        <option value="B">Disetujui</option>
                        <option value="C">Ditolak</option>
                    </select>
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 border rounded">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
                </div>

            </form>
        </div>
    </div>

    {{-- ================= MODAL HAPUS ================= --}}
    <div id="deleteModalBackdrop" class="fixed inset-0 bg-black/40 hidden opacity-0 transition"></div>

    <div id="deleteModalContainer" class="fixed inset-0 hidden justify-center items-center z-50">
        <div id="deleteModalContent"
            class="bg-white rounded-xl shadow-xl w-full max-w-md p-6 transform scale-95 opacity-0 transition">

            <h3 class="text-lg font-bold text-center mb-2">Konfirmasi Hapus</h3>
            <p class="text-center mb-4">
                Yakin ingin menghapus pengadaan dari <br>
                <span id="deleteItemName" class="font-bold"></span>?
            </p>

            <div class="flex gap-2">
                <button onclick="closeDeleteModal()" class="flex-1 px-4 py-2 border rounded">Batal</button>
                <button id="confirmDeleteBtn" class="flex-1 px-4 py-2 bg-red-600 text-white rounded">Hapus</button>
            </div>

        </div>
    </div>
</div>

{{-- ================= SCRIPT ================= --}}
<script>
    // Modal tambah
    const modalBackdrop = document.getElementById('modalBackdrop');
    const modalContainer = document.getElementById('modalContainer');
    const modalContent = document.getElementById('modalContent');

    function openModal() {
        modalBackdrop.classList.remove('hidden');
        modalContainer.classList.remove('hidden');

        requestAnimationFrame(() => {
            modalBackdrop.classList.add('opacity-100');
            modalContent.classList.add('opacity-100');
            modalContent.classList.remove('scale-95');
        });
    }

    function closeModal() {
        modalBackdrop.classList.remove('opacity-100');
        modalContent.classList.remove('opacity-100');
        modalContent.classList.add('scale-95');

        setTimeout(() => {
            modalBackdrop.classList.add('hidden');
            modalContainer.classList.add('hidden');
        }, 200);
    }

    // Modal hapus
    const deleteModalBackdrop = document.getElementById('deleteModalBackdrop');
    const deleteModalContainer = document.getElementById('deleteModalContainer');
    const deleteModalContent = document.getElementById('deleteModalContent');

    let deleteID = null;

    function confirmDelete(id, name) {
        deleteID = id;
        document.getElementById('deleteItemName').textContent = name;

        deleteModalBackdrop.classList.remove('hidden');
        deleteModalContainer.classList.remove('hidden');

        requestAnimationFrame(() => {
            deleteModalBackdrop.classList.add('opacity-100');
            deleteModalContent.classList.add('opacity-100');
            deleteModalContent.classList.remove('scale-95');
        });
    }

    function closeDeleteModal() {
        deleteModalBackdrop.classList.remove('opacity-100');
        deleteModalContent.classList.remove('opacity-100');
        deleteModalContent.classList.add('scale-95');

        setTimeout(() => {
            deleteModalBackdrop.classList.add('hidden');
            deleteModalContainer.classList.add('hidden');
        }, 200);
    }

    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        if (deleteID) {
            @this.call('delete', deleteID);
            closeDeleteModal();
        }
    });
</script>
