<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 flex flex-col">

    {{-- ============== HEADER ============== --}}
    <header class="bg-gradient-to-r from-blue-600 to-indigo-700 shadow-lg rounded-b-2xl">
        <div class="max-w-6xl mx-auto px-6 py-6 flex justify-between items-center">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-white mb-1">
                    Detail Penerimaan 📋
                </h1>
                @if ($header)
                    <p class="text-blue-100 text-sm">
                        ID Penerimaan: <span class="font-semibold">#{{ $header->idpenerimaan }}</span> —
                        Pengadaan: <span class="font-semibold">#{{ $header->idpengadaan }}</span>
                    </p>
                    <p class="text-blue-100 text-xs">
                        Vendor: {{ $header->nama_vendor }} • User: {{ $header->username }}
                    </p>
                @else
                    <p class="text-blue-100 text-sm">Data penerimaan tidak ditemukan.</p>
                @endif
            </div>
            <div class="text-right">
                <p class="text-blue-200 text-sm">{{ now()->format('d M Y') }}</p>
                <a href="{{ route('transaction.Penerimaan') }}"
                    class="inline-flex items-center mt-2 px-3 py-1.5 rounded-xl text-xs font-semibold bg-white/10 text-white border border-white/30 hover:bg-white/20 transition">
                    ← Kembali ke daftar
                </a>
            </div>
        </div>
    </header>

    {{-- ============== MAIN ============== --}}
    <main class="flex-1">
        <div class="max-w-6xl mx-auto px-4 py-6 space-y-4">

            @if (!$header)
                <div
                    class="px-4 py-3 rounded-xl bg-red-50 border border-red-200 text-sm text-red-700 flex items-start space-x-2">
                    <span class="mt-0.5">⚠️</span>
                    <span>Data header penerimaan tidak ditemukan.</span>
                </div>
            @else
                {{-- Info ringkas header --}}
                <div class="grid md:grid-cols-3 gap-4">
                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow border border-indigo-50 p-4">
                        <p class="text-xs text-gray-500 mb-1">Tanggal Penerimaan</p>
                        <p class="text-sm font-semibold text-gray-800">
                            {{ \Carbon\Carbon::parse($header->created_at)->format('d M Y H:i') }}
                        </p>
                    </div>
                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow border border-indigo-50 p-4">
                        <p class="text-xs text-gray-500 mb-1">Total Nilai Pengadaan</p>
                        <p class="text-sm font-semibold text-gray-800">
                            Rp {{ number_format($header->total_nilai ?? 0, 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow border border-indigo-50 p-4">
                        <p class="text-xs text-gray-500 mb-1">PPN</p>
                        <p class="text-sm font-semibold text-gray-800">
                            {{ $header->ppn }}%
                        </p>
                    </div>
                </div>

                {{-- Tabel detail penerimaan (READ ONLY) --}}
                <div class="bg-white/80 backdrop-blur-sm shadow-xl rounded-2xl border border-indigo-50 mt-4">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-9 h-9 bg-indigo-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 7h18M3 12h18M3 17h18" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-gray-800">Detail Barang Diterima</h2>
                                <p class="text-xs text-gray-500">Data diambil dari views_detail_penerimaan (read only)
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="p-4 overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead>
                                <tr class="bg-indigo-50 text-indigo-900 text-xs uppercase tracking-wide">
                                    <th class="px-3 py-2 text-left rounded-l-lg">Barang</th>
                                    <th class="px-3 py-2 text-left">Satuan</th>
                                    <th class="px-3 py-2 text-right">Jumlah Terima</th>
                                    <th class="px-3 py-2 text-right">Harga Satuan</th>
                                    <th class="px-3 py-2 text-right rounded-r-lg">Subtotal</th>
                                    <th class="px-3 py-2">Nomor Pengiriman</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse ($details as $row)
                                    <tr class="hover:bg-indigo-50/40">
                                        <td class="px-3 py-2 text-gray-800">
                                            {{ $row->nama_barang }}<br>
                                            <span class="text-[11px] text-gray-500">
                                                ID Barang: {{ $row->barang_idbarang }} • Detail ID:
                                                {{ $row->iddetail_penerimaan }}
                                            </span>
                                        </td>
                                        <td class="px-3 py-2  text-gray-700">
                                            {{ $row->nama_satuan }}
                                        </td>
                                        <td class="px-3 py-2 text-gray-800 text-center pl-10">
                                            {{ number_format($row->jumlah_terima, 0, ',', '.') }}
                                        </td>
                                        <td class="px-3 py-2 text-right text-gray-800">
                                            Rp {{ number_format($row->harga_satuan_terima, 0, ',', '.') }}
                                        </td>
                                        <td class="px-3 py-2 text-right font-semibold text-gray-900">
                                            Rp {{ number_format($row->sub_total_terima, 0, ',', '.') }}
                                        </td>
                                        <td class="px-3 py-2">
                                            <div class="flex justify-center">
                                                <span
                                                    class="px-3 py-1 bg-blue-50 text-blue-700 rounded-lg text-xs font-semibold">
                                                    #{{ $row->pengiriman_ke }}
                                                </span>
                                            </div>
                                        </td>


                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-3 py-4 text-center text-gray-500 text-sm">
                                            Belum ada detail penerimaan untuk transaksi ini.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

        </div>
    </main>

</div>
