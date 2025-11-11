<div>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 flex flex-col">

    {{-- ================= HEADER ================= --}}
    <header class="bg-gradient-to-r from-blue-600 to-indigo-700 shadow-lg rounded-b-2xl">
        <div class="max-w-6xl mx-auto px-6 py-6 flex justify-between items-center">
            @auth
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-white mb-1">
                        Margin Penjualan 📊 — {{ auth()->user()->username }}
                    </h1>
                    <p class="text-blue-100 text-sm">Lihat data margin penjualan yang berlaku</p>
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

            {{-- ========== INFO CARDS ========== --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Card: Total Margin --}}
                <div class="bg-white rounded-2xl shadow-xl p-6 border-t-4 border-indigo-600">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-600 uppercase">Total Margin</p>
                            <p class="text-2xl font-bold text-gray-900">{{ count($semuaMargin ?? []) }}</p>
                            <p class="text-xs text-gray-500 mt-1">Data margin</p>
                        </div>
                    </div>
                </div>

                {{-- Card: Margin Aktif --}}
                <div class="bg-white rounded-2xl shadow-xl p-6 border-t-4 border-emerald-600">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-600 uppercase">Margin Aktif</p>
                            <p class="text-2xl font-bold text-gray-900">{{ count(array_filter($semuaMargin ?? [], fn($m) => $m->status == 1)) }}</p>
                            <p class="text-xs text-gray-500 mt-1">Sedang berlaku</p>
                        </div>
                    </div>
                </div>

                {{-- Card: Margin Terbaru --}}
                <div class="bg-white rounded-2xl shadow-xl p-6 border-t-4 border-amber-600">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-600 uppercase">Margin Terbaru</p>
                            @php
                                $latest = collect($semuaMargin ?? [])->sortByDesc('created_at')->first();
                            @endphp
                            <p class="text-2xl font-bold text-gray-900">{{ $latest ? number_format($latest->persen, 1) : '0' }}%</p>
                            <p class="text-xs text-gray-500 mt-1">{{ $latest ? \Carbon\Carbon::parse($latest->created_at)->format('d/m/Y') : '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ========== Tabel Margin Penjualan ========== --}}
            <section class="bg-white rounded-2xl shadow-xl overflow-hidden border-t-4 border-indigo-600">
                <div class="bg-gradient-to-r from-indigo-50 to-blue-50 px-6 py-5 border-b border-gray-200 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-9 h-9 bg-indigo-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-800">Daftar Margin Penjualan</h2>
                            <p class="text-xs text-gray-600">Total: <span class="font-semibold">{{ count($semuaMargin ?? []) }}</span> data</p>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gradient-to-r from-gray-50 to-gray-100">
                                <th class="px-4 py-3 border-b-2 border-gray-200 text-left font-bold text-xs text-gray-700 uppercase">ID</th>
                                <th class="px-4 py-3 border-b-2 border-gray-200 text-left font-bold text-xs text-gray-700 uppercase">Tanggal Dibuat</th>
                                <th class="px-4 py-3 border-b-2 border-gray-200 text-center font-bold text-xs text-gray-700 uppercase">Persentase (%)</th>
                                <th class="px-4 py-3 border-b-2 border-gray-200 text-left font-bold text-xs text-gray-700 uppercase">Dibuat Oleh</th>
                                <th class="px-4 py-3 border-b-2 border-gray-200 text-left font-bold text-xs text-gray-700 uppercase">Terakhir Update</th>
                                <th class="px-4 py-3 border-b-2 border-gray-200 text-center font-bold text-xs text-gray-700 uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($semuaMargin ?? [] as $m)
                                <tr class="hover:bg-blue-50 transition">
                                    <td class="px-4 py-3 font-medium text-gray-800">{{ $m->idmargin_penjualan }}</td>
                                    <td class="px-4 py-3 text-gray-600">
                                        {{ \Carbon\Carbon::parse($m->created_at)->format('d/m/Y H:i') }}
                                        <span class="block text-xs text-gray-400 mt-0.5">
                                            {{ \Carbon\Carbon::parse($m->created_at)->diffForHumans() }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <span class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-indigo-50 to-blue-50 border-2 border-indigo-200 rounded-xl">
                                            <span class="text-2xl font-bold text-indigo-700">{{ number_format($m->persen, 1) }}%</span>
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div>
                                            <p class="font-medium text-gray-800">{{ $m->user->username ?? '-' }}</p>
                                            <p class="text-xs text-gray-500">{{ $m->user->role->nama_role ?? '-' }}</p>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-gray-600">
                                        {{ \Carbon\Carbon::parse($m->updated_at)->format('d/m/Y H:i') }}
                                        @if(\Carbon\Carbon::parse($m->updated_at)->ne(\Carbon\Carbon::parse($m->created_at)))
                                            <span class="block text-xs text-amber-600 mt-0.5">
                                                <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Diperbarui
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $m->status ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-700' }}">
                                            {{ $m->status ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center text-gray-500">
                                            <svg class="w-16 h-16 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                            </svg>
                                            <p class="font-medium text-sm">Tidak ada data margin penjualan</p>
                                            <p class="text-xs text-gray-400 mt-1">Belum ada margin yang terdaftar di sistem</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>

            {{-- ========== INFO BOX ========== --}}
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl shadow-lg p-6 border-l-4 border-blue-500">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-sm font-bold text-gray-800 mb-2">ℹ️ Informasi Margin Penjualan</h3>
                        <div class="text-xs text-gray-700 space-y-1">
                            <p>• <strong>Margin Penjualan</strong> adalah persentase keuntungan yang ditambahkan pada harga modal barang.</p>
                            <p>• Status <span class="px-2 py-0.5 bg-emerald-100 text-emerald-700 rounded-full font-semibold">Aktif</span> menunjukkan margin yang sedang digunakan untuk perhitungan harga jual.</p>
                            <p>• Status <span class="px-2 py-0.5 bg-gray-100 text-gray-700 rounded-full font-semibold">Nonaktif</span> menunjukkan margin yang sudah tidak digunakan (data historis).</p>
                            <p>• Data ini bersifat <strong>read-only</strong> dan hanya dapat dilihat, tidak dapat diubah atau dihapus dari halaman ini.</p>
                        </div>
                    </div>
                </div>
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

</div>

<style>
    /* Custom scrollbar untuk tabel */
    .overflow-x-auto::-webkit-scrollbar {
        height: 8px;
    }
    
    .overflow-x-auto::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 10px;
    }
    
    .overflow-x-auto::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }
    
    .overflow-x-auto::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>
</div>
