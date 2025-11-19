<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 flex flex-col">

    {{-- HEADER --}}
    <header class="bg-gradient-to-r from-blue-600 to-indigo-700 shadow-lg rounded-b-2xl">
        <div class="max-w-6xl mx-auto px-6 py-6">
            <h1 class="text-2xl md:text-3xl font-bold text-white mb-1">
                Penerimaan Barang dari Pengadaan 📥
            </h1>
            <p class="text-blue-200 text-sm">Pilih pengadaan lalu proses barang yang diterima</p>
        </div>
    </header>

    {{-- MAIN --}}
    <main class="flex-1">
        <div class="max-w-6xl mx-auto px-4 py-6 space-y-6">

            {{-- Alert --}}
            @if (session('ok'))
                <div class="bg-green-100 text-green-800 px-4 py-3 rounded-xl border border-green-200">
                    {{ session('ok') }}
                </div>
            @endif

            @if (session('err'))
                <div class="bg-red-100 text-red-800 px-4 py-3 rounded-xl border border-red-200">
                    {{ session('err') }}
                </div>
            @endif


            {{-- ================== LIST CARD PENGADAAN ================== --}}
            <h2 class="text-xl font-bold text-gray-800">Daftar Pengadaan</h2>

            <div class="grid md:grid-cols-2 gap-4">
                @foreach ($pengadaanList as $pg)
                    <div class="bg-white/80 border shadow-lg rounded-2xl p-5">

                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-lg font-bold text-indigo-700">
                                    Pengadaan #{{ $pg->idpengadaan }}
                                </h3>
                                <p class="text-gray-600 text-sm">{{ $pg->nama_vendor }}</p>
                                <p class="font-semibold mt-1 text-gray-800">
                                    Total: Rp {{ number_format($pg->total_nilai, 0, ',', '.') }}
                                </p>
                            </div>

                            <span class="px-3 py-1 rounded-lg text-white text-sm 
                                {{ $pg->status == 'S' ? 'bg-green-500' : 'bg-blue-500' }}">
                                {{ $pg->status == 'S' ? 'SELESAI' : 'PROSES' }}
                            </span>
                        </div>

                        <button wire:click="open({{ $pg->idpengadaan }})"
                            class="w-full mt-4 px-4 py-2 bg-blue-600 text-white rounded-xl font-semibold hover:bg-blue-700">
                            Proses Penerimaan
                        </button>
                    </div>
                @endforeach
            </div>



            {{-- ================== MODAL ================== --}}
            @if ($showModal)
                <div class="fixed inset-0 bg-black/40 backdrop-blur-sm flex justify-center items-center z-50">
                    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-3xl p-6">

                        {{-- MODAL HEADER --}}
                        <h2 class="text-xl font-bold mb-1">
                            Penerimaan Pengadaan #{{ $idpengadaan }}
                        </h2>
                        <p class="text-gray-600 mb-4">Vendor: {{ $header->nama_vendor }}</p>

                        {{-- TABLE BARANG --}}
                        <table class="min-w-full text-sm">
                            <thead>
                                <tr class="bg-indigo-50 text-indigo-900 text-xs uppercase">
                                    <th class="px-3 py-2 text-left">Barang</th>
                                    <th class="px-3 py-2 text-right">Sisa</th>
                                    <th class="px-3 py-2 text-right">Harga DP</th>
                                    <th class="px-3 py-2 text-right">Harga Terima</th>
                                    <th class="px-3 py-2 text-right">Jumlah</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100">
                                @foreach ($items as $brg)
                                    <tr>
                                        <td class="px-3 py-2">
                                            {{ $brg->nama_barang }}
                                            <p class="text-[11px] text-gray-500">ID Detail: {{ $brg->iddetail_pengadaan }}</p>
                                        </td>

                                        <td class="px-3 py-2 text-right font-semibold">
                                            {{ $brg->sisa }}
                                        </td>

                                        <td class="px-3 py-2 text-right">
                                            Rp {{ number_format($brg->harga_satuan, 0, ',', '.') }}
                                        </td>

                                        <td class="px-3 py-2 text-right">
                                            <input type="number"
                                                wire:model="input.{{ $brg->iddetail_pengadaan }}.harga"
                                                class="w-24 px-2 py-1 border rounded-lg text-right">
                                        </td>

                                        <td class="px-3 py-2 text-right">
                                            <input type="number"
                                                wire:model="input.{{ $brg->iddetail_pengadaan }}.jumlah"
                                                max="{{ $brg->sisa }}"
                                                class="w-16 px-2 py-1 border rounded-lg text-right">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{-- FOOTER BUTTON --}}
                        <div class="flex justify-end gap-3 mt-6">
                            <button wire:click="$set('showModal', false)"
                                class="px-4 py-2 bg-gray-200 rounded-xl font-semibold">
                                Batal
                            </button>

                            <button wire:click="submit"
                                class="px-5 py-2 bg-indigo-600 text-white rounded-xl font-semibold hover:bg-indigo-700">
                                Simpan
                            </button>
                        </div>

                    </div>
                </div>
            @endif

        </div>
        {{-- ================= BACK BUTTON ================= --}}
            <div class="text-center">
                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-xl shadow hover:shadow-lg transform hover:-translate-y-0.5 transition-all">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali ke Dashboard
                </a>
            </div>
    </main>

</div>
