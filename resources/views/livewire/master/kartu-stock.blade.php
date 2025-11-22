<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 flex flex-col">

    {{-- ================= HEADER ================= --}}
    <header class="bg-gradient-to-r from-blue-600 to-indigo-700 shadow-lg rounded-b-2xl">
        <div class="max-w-6xl mx-auto px-6 py-6">
            <h1 class="text-3xl font-bold text-white">Kartu Stok 📦</h1>
            <p class="text-blue-100 mt-1 text-sm">Riwayat keluar–masuk barang secara lengkap</p>
        </div>
    </header>

    {{-- ================= MAIN ================= --}}
    <main class="flex-1">
        <div class="max-w-6xl mx-auto px-4 py-8">

            {{-- ========== FILTER ========== --}}
            <div class="bg-white/80 backdrop-blur-md shadow-lg rounded-xl border border-gray-100 p-5 mb-6">
                <div class="grid md:grid-cols-3 gap-4">

                    {{-- Cari Nama Barang --}}
                    <div>
                        <label class="text-sm font-medium text-gray-700">Nama Barang</label>
                        <input wire:model.live="searchNama"
                            type="text"
                            class="mt-1 w-full px-3 py-2 border rounded-lg bg-gray-50 focus:ring focus:ring-indigo-300 focus:outline-none">
                    </div>

                    {{-- Tombol Reset --}}
                    <div class="flex items-end">
                        <button wire:click="resetFilter"
                            class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-xl shadow">
                            Reset Filter
                        </button>
                    </div>
                </div>
            </div>

            {{-- ========== TABLE KARTU STOK ========== --}}
            <div class="bg-white/90 shadow-xl rounded-2xl border border-gray-100 overflow-hidden">

                <table class="min-w-full text-sm">
                    <thead class="bg-indigo-50 text-indigo-900 text-xs uppercase tracking-wide">
                        <tr>
                            <th class="px-4 py-3 text-left">Tanggal</th>
                            <th class="px-4 py-3 text-left">Keterangan</th>
                            <th class="px-4 py-3 text-center">Masuk</th>
                            <th class="px-4 py-3 text-center">Keluar</th>
                            <th class="px-4 py-3 text-center">Stok Akhir</th>
                            <th class="px-4 py-3 text-left">Barang</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @forelse ($kartuStock as $row)
                            <tr class="hover:bg-indigo-50/40 transition">

                                <td class="px-4 py-2 text-gray-700">
                                    {{ \Carbon\Carbon::parse($row->tanggal)->format('d M Y H:i') }}
                                </td>

                                <td class="px-4 py-2 font-medium text-gray-800">
                                    {{ $row->keterangan }}
                                </td>

                                <td class="px-4 py-2 text-center text-green-600 font-semibold">
                                    {{ $row->masuk > 0 ? number_format($row->masuk, 0, ',', '.') : '-' }}
                                </td>

                                <td class="px-4 py-2 text-center text-red-600 font-semibold">
                                    {{ $row->keluar > 0 ? number_format($row->keluar, 0, ',', '.') : '-' }}
                                </td>

                                <td class="px-4 py-2 text-center font-bold text-gray-900">
                                    {{ number_format($row->stok_akhir, 0, ',', '.') }}
                                </td>

                                <td class="px-4 py-2 text-left">
                                    <span class="font-semibold text-gray-800">{{ $row->nama_barang }}</span>
                                    <br>
                                    <span class="text-[11px] text-gray-500">
                                        ID: {{ $row->idbarang }} — {{ $row->nama_satuan }}
                                    </span>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="6"
                                    class="px-4 py-4 text-center text-gray-500 text-sm">
                                    Tidak ada data kartu stok untuk filter ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </main>
</div>
