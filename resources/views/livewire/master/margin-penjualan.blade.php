<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 flex flex-col">

    {{-- ================= HEADER ================= --}}
    <header class="bg-gradient-to-r from-blue-600 to-indigo-700 shadow-lg rounded-b-2xl">
        <div class="max-w-6xl mx-auto px-6 py-6 flex justify-between items-center">
            @auth
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-white mb-1">
                        Margin Penjualan 📊 — {{ auth()->user()->username }}
                    </h1>
                    <p class="text-blue-100 text-sm">Kelola data margin penjualan yang berlaku</p>
                    <span class="text-white text-sm font-semibold">
                        {{ auth()->user()->role->nama_role ?? 'User' }}
                    </span>
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

            {{-- ================= FLASH MESSAGE ================= --}}
            @if (session()->has('ok'))
                <div
                    class="bg-emerald-50 border-l-4 border-emerald-500 rounded-xl p-4 shadow-sm flex items-start space-x-3">
                    <div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-emerald-700">Berhasil!</p>
                        <p class="text-sm text-emerald-600">{{ session('ok') }}</p>
                    </div>
                </div>
            @endif

            @if (session()->has('err'))
                <div class="bg-rose-50 border-l-4 border-rose-500 rounded-xl p-4 shadow-sm flex items-start space-x-3">
                    <div class="w-8 h-8 bg-rose-100 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-rose-700">Terjadi Kesalahan!</p>
                        <p class="text-sm text-rose-600">{{ session('err') }}</p>
                    </div>
                </div>
            @endif

            {{-- ================= INFO CARDS ================= --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- Card Total --}}
                <div class="bg-white rounded-2xl shadow-xl p-6 border-t-4 border-indigo-600">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-600 uppercase">Total Margin</p>
                            <p class="text-2xl font-bold text-gray-900">{{ count($DataMargin ?? []) }}</p>
                            <p class="text-xs text-gray-500 mt-1">Data margin</p>
                        </div>
                    </div>
                </div>

                {{-- Card Aktif --}}
                <div class="bg-white rounded-2xl shadow-xl p-6 border-t-4 border-emerald-600">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-600 uppercase">Margin Aktif</p>
                            <p class="text-2xl font-bold text-gray-900">
                                {{ count(array_filter($DataMargin ?? [], fn($m) => $m->status == 1)) }}
                            </p>
                            <p class="text-xs text-gray-500 mt-1">Sedang berlaku</p>
                        </div>
                    </div>
                </div>

                {{-- Card Terbaru --}}
                @php
                    $latest = collect($DataMargin ?? [])
                        ->sortByDesc('created_at')
                        ->first();
                @endphp
                <div class="bg-white rounded-2xl shadow-xl p-6 border-t-4 border-amber-600">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-600 uppercase">Margin Terbaru</p>
                            <p class="text-2xl font-bold text-gray-900">
                                {{ $latest ? number_format($latest->persen, 1) : '0' }}%
                            </p>
                            <p class="text-xs text-gray-500 mt-1">
                                {{ $latest ? \Carbon\Carbon::parse($latest->created_at)->format('d/m/Y') : '-' }}
                            </p>
                        </div>
                    </div>
                </div>

            </div>

            {{-- ================= TABEL MARGIN AKTIF ================= --}}
            <section class="bg-white rounded-2xl shadow-xl overflow-hidden border-t-4 border-indigo-600">

                <div
                    class="bg-gradient-to-r from-indigo-50 to-blue-50 px-6 py-5 border-b flex justify-between items-center">
                    <div class="flex items-center space-x-3">
                        <div class="w-9 h-9 bg-indigo-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-800">Daftar Margin Aktif</h2>
                            <p class="text-xs text-gray-600">Total:
                                <span class="font-semibold">{{ count($DataMargin ?? []) }}</span> data
                            </p>
                        </div>
                    </div>

                    <button type="button" wire:click="resetForm" @click="$wire.resetForm().then(() => openModal())"
                        class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold px-5 py-2.5 rounded-xl shadow hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                        <span class="inline-flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Margin
                        </span>
                    </button>
                </div>

                {{-- TABEL AKTIF --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gradient-to-r from-gray-50 to-gray-100">
                                <th class="px-4 py-3 border-b-2 font-bold text-xs uppercase text-gray-700 text-left">ID
                                </th>
                                <th class="px-4 py-3 border-b-2 font-bold text-xs uppercase text-gray-700 text-left">
                                    Tanggal Dibuat</th>
                                <th class="px-4 py-3 border-b-2 font-bold text-xs uppercase text-gray-700 text-center">
                                    Persentase (%)</th>
                                <th class="px-4 py-3 border-b-2 font-bold text-xs uppercase text-gray-700 text-left">
                                    Dibuat Oleh</th>
                                <th class="px-4 py-3 border-b-2 font-bold text-xs uppercase text-gray-700 text-left">
                                    Update</th>
                                <th class="px-4 py-3 border-b-2 font-bold text-xs uppercase text-gray-700 text-center">
                                    Status</th>
                                <th class="px-4 py-3 border-b-2 font-bold text-xs uppercase text-gray-700 text-center">
                                    Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            @forelse ($DataMargin ?? [] as $m)
                                <tr class="hover:bg-blue-50 transition">

                                    <td class="px-4 py-3 text-gray-800 font-medium">
                                        {{ $m->idmargin_penjualan }}
                                    </td>

                                    <td class="px-4 py-3 text-gray-600">
                                        {{ \Carbon\Carbon::parse($m->created_at)->format('d/m/Y H:i') }}
                                        <span class="block text-xs text-gray-400">
                                            {{ \Carbon\Carbon::parse($m->created_at)->diffForHumans() }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-3 text-center">
                                        <span
                                            class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-indigo-50 to-blue-50 border-2 border-indigo-200 rounded-xl">
                                            <span class="text-2xl font-bold text-indigo-700">
                                                {{ number_format($m->persen, 1) }}%
                                            </span>
                                        </span>
                                    </td>

                                    <td class="px-4 py-3 text-gray-800 font-medium">
                                        {{ $m->username ?? '-' }}
                                    </td>

                                    <td class="px-4 py-3 text-gray-600">
                                        {{ \Carbon\Carbon::parse($m->updated_at)->format('d/m/Y H:i') }}
                                        @if (!\Carbon\Carbon::parse($m->updated_at)->eq(\Carbon\Carbon::parse($m->created_at)))
                                            <span class="block text-xs text-amber-600">
                                                <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Diperbarui
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-4 py-3 text-center">
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-semibold
                                            {{ $m->status ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-700' }}">
                                            {{ $m->status ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-3 text-center">
                                        <div class="flex justify-center gap-2">
                                            <button type="button"
                                                @click="$wire.edit({{ $m->idmargin_penjualan }}).then(() => openModal())"
                                                class="px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-white text-xs font-semibold rounded-lg shadow transition">
                                                ✏️ Edit
                                            </button>

                                            <button
                                                onclick="confirmDelete({{ $m->idmargin_penjualan }}, '{{ number_format($m->persen, 1) }}%')"
                                                class="px-3 py-1.5 bg-rose-600 hover:bg-rose-700 text-white text-xs font-semibold rounded-lg shadow transition">
                                                🗑️ Hapus
                                            </button>
                                        </div>
                                    </td>

                                </tr>

                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-12 text-center text-gray-500">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-16 h-16 text-gray-300 mb-3" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                            </svg>
                                            <p class="font-medium text-sm">Tidak ada data margin aktif</p>
                                            <p class="text-xs text-gray-400 mt-1">Klik tombol "Tambah Margin" untuk
                                                menambahkan data</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </section>

            {{-- ================= TABEL SEMUA MARGIN ================= --}}
            <section class="bg-white rounded-2xl shadow-xl overflow-hidden border-t-4 border-indigo-600">

                <div class="bg-gradient-to-r from-indigo-50 to-blue-50 px-6 py-5 border-b flex items-center space-x-3">
                    <div class="w-9 h-9 bg-indigo-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-gray-800">Daftar Semua Margin</h2>
                        <p class="text-xs text-gray-600">Total:
                            <span class="font-semibold">{{ count($DataMargin ?? []) }}</span> data
                        </p>
                    </div>
                </div>

                {{-- TABEL SEMUA --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gradient-to-r from-gray-50 to-gray-100">
                                <th class="px-4 py-3 border-b-2 font-bold text-xs uppercase text-gray-700 text-left">ID
                                </th>
                                <th class="px-4 py-3 border-b-2 font-bold text-xs uppercase text-gray-700 text-left">
                                    Tanggal Dibuat</th>
                                <th class="px-4 py-3 border-b-2 font-bold text-xs uppercase text-gray-700 text-center">
                                    Persentase (%)</th>
                                <th class="px-4 py-3 border-b-2 font-bold text-xs uppercase text-gray-700 text-left">
                                    Dibuat Oleh</th>
                                <th class="px-4 py-3 border-b-2 font-bold text-xs uppercase text-gray-700 text-left">
                                    Update</th>
                                <th class="px-4 py-3 border-b-2 font-bold text-xs uppercase text-gray-700 text-center">
                                    Status</th>
                                <th class="px-4 py-3 border-b-2 font-bold text-xs uppercase text-gray-700 text-center">
                                    Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            @forelse ($DataMargin ?? [] as $m)
                                <tr class="hover:bg-blue-50 transition">

                                    <td class="px-4 py-3 text-gray-800 font-medium">
                                        {{ $m->idmargin_penjualan }}
                                    </td>

                                    <td class="px-4 py-3 text-gray-600">
                                        {{ \Carbon\Carbon::parse($m->created_at)->format('d/m/Y H:i') }}
                                        <span class="block text-xs text-gray-400">
                                            {{ \Carbon\Carbon::parse($m->created_at)->diffForHumans() }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-3 text-center">
                                        <span
                                            class="inline-flex px-4 py-2 bg-gradient-to-r from-indigo-50 to-blue-50 border-2 border-indigo-200 rounded-xl">
                                            <span class="text-2xl font-bold text-indigo-700">
                                                {{ number_format($m->persen, 1) }}%
                                            </span>
                                        </span>
                                    </td>

                                    <td class="px-4 py-3 text-gray-800 font-medium">
                                        {{ $m->username ?? '-' }}
                                    </td>

                                    <td class="px-4 py-3 text-gray-600">
                                        {{ \Carbon\Carbon::parse($m->updated_at)->format('d/m/Y H:i') }}
                                        @if (!\Carbon\Carbon::parse($m->updated_at)->eq(\Carbon\Carbon::parse($m->created_at)))
                                            <span class="block text-xs text-amber-600">
                                                <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Diperbarui
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-4 py-3 text-center">
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-semibold
                                            {{ $m->status ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-700' }}">
                                            {{ $m->status ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-3 text-center">
                                        <div class="flex justify-center gap-2">
                                            <button
                                                @click="$wire.edit({{ $m->idmargin_penjualan }}).then(() => openModal())"
                                                class="px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-white text-xs font-semibold rounded-lg shadow transition">
                                                ✏️ Edit
                                            </button>

                                            <button
                                                onclick="confirmDelete({{ $m->idmargin_penjualan }}, '{{ number_format($m->persen, 1) }}%')"
                                                class="px-3 py-1.5 bg-rose-600 hover:bg-rose-700 text-white text-xs font-semibold rounded-lg shadow transition">
                                                🗑️ Hapus
                                            </button>
                                        </div>
                                    </td>

                                </tr>

                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-12 text-center text-gray-500">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-16 h-16 text-gray-300 mb-3" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                            </svg>
                                            <p class="font-medium text-sm">Tidak ada data margin</p>
                                            <p class="text-xs text-gray-400 mt-1">Klik tombol "Tambah Margin" untuk
                                                menambahkan data</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </section>

            {{-- ================= INFO BOX ================= --}}
            <div
                class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl shadow-lg p-6 border-l-4 border-blue-500">
                <div class="flex items-start space-x-4">

                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>

                    <div class="flex-1 text-xs text-gray-700 space-y-1">
                        <h3 class="text-sm font-bold text-gray-800 mb-2">ℹ️ Informasi Margin Penjualan</h3>
                        <p>• <strong>Margin Penjualan</strong> adalah persentase keuntungan dari harga modal barang.</p>
                        <p>• <span
                                class="px-2 py-0.5 bg-emerald-100 text-emerald-700 rounded-full font-semibold">Aktif</span>
                            berarti margin sedang digunakan.</p>
                        <p>• <span
                                class="px-2 py-0.5 bg-gray-100 text-gray-700 rounded-full font-semibold">Nonaktif</span>
                            adalah data historis.</p>
                        <p>• Anda dapat menambah, mengedit, dan menghapus margin kapan saja.</p>
                    </div>

                </div>
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

        </div>
    </main>
    {{-- ================= MODAL FORM (TAMBAH / EDIT) ================= --}}
    <div id="modalBackdrop" wire:ignore
        class="fixed inset-0 hidden z-40 bg-black/40 backdrop-blur-sm opacity-0 transition-opacity duration-300">
    </div>

    <div id="modalContainer" class="fixed inset-0 hidden z-50 p-4 flex justify-center items-center">

        <div id="modalContent"
            class="bg-white rounded-2xl shadow-2xl w-full max-w-lg transform transition-all duration-300
                scale-95 opacity-0 border-t-4 border-blue-600"
            onclick="event.stopPropagation()">

            <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}" class="p-6 space-y-4">

                <h2 class="text-lg font-bold text-gray-800">
                    {{ $isEdit ? 'Edit Margin Penjualan' : 'Tambah Margin Penjualan' }}
                </h2>

                {{-- Input Persen --}}
                <div>
                    <label class="text-xs font-semibold text-gray-600">Persentase Margin (%)</label>
                    <input type="number" step="0.1" wire:model="persen"
                        class="w-full mt-1 px-3 py-2 bg-gray-50 border-2 border-gray-200 rounded-xl
                            focus:border-blue-500 focus:bg-white transition">

                    @error('persen')
                        <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Input Status --}}
                <div>
                    <label class="text-xs font-semibold text-gray-600">Status</label>
                    <select wire:model="status"
                        class="w-full mt-1 px-3 py-2 bg-gray-50 border-2 border-gray-200 rounded-xl
                            focus:border-blue-500 focus:bg-white transition">
                        <option value="">-- Pilih Status --</option>
                        <option value="1">Aktif</option>
                        <option value="0">Nonaktif</option>
                    </select>

                    @error('status')
                        <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Buttons --}}
                <div class="flex justify-end space-x-2 pt-2">
                    <button type="button" onclick="closeModal()"
                        class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-xl text-sm font-semibold transition">
                        Batal
                    </button>

                    <button type="submit"
                        class="px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-xl
                            shadow hover:from-blue-700 hover:to-indigo-700 hover:shadow-lg transform hover:-translate-y-0.5 transition">
                        {{ $isEdit ? 'Update' : 'Simpan' }}
                    </button>
                </div>

            </form>
        </div>

    </div>

    {{-- ================= MODAL DELETE ================= --}}
    <div id="deleteModalBackdrop" wire:ignore
        class="fixed inset-0 bg-black/40 backdrop-blur-sm hidden z-40 opacity-0 transition-opacity duration-300">
    </div>

    <div id="deleteModalContainer" wire:ignore.self
        class="fixed inset-0 hidden z-50 p-4 flex justify-center items-center">

        <div id="deleteModalContent"
            class="bg-white rounded-2xl shadow-2xl w-full max-w-md transform transition-all duration-300
                scale-95 opacity-0 border-t-4 border-rose-600"
            onclick="event.stopPropagation()">

            <div class="p-6">

                <div class="flex justify-center mb-4">
                    <div class="w-16 h-16 bg-rose-100 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                </div>

                <h3 class="text-xl font-bold text-gray-900 text-center mb-2">Konfirmasi Hapus</h3>
                <p class="text-gray-600 text-center mb-2">
                    Apakah Anda yakin ingin menghapus margin <br>
                    <span id="deleteItemName" class="font-bold text-gray-900"></span>?
                </p>

                <div class="bg-rose-50 border-l-4 border-rose-500 rounded-lg p-3 mb-6">
                    <p class="text-sm text-rose-700 text-center">⚠️ Data yang sudah dihapus tidak dapat dikembalikan!
                    </p>
                </div>

                <div class="flex gap-3">
                    <button type="button" onclick="closeDeleteModal()"
                        class="flex-1 px-4 py-2.5 bg-white border-2 border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition">
                        Batal
                    </button>

                    <button type="button" onclick="deleteNow()"
                        class="flex-1 px-4 py-2.5 bg-rose-600 hover:bg-rose-700 text-white font-semibold rounded-xl shadow hover:shadow-lg transform hover:-translate-y-0.5 transition">
                        Ya, Hapus
                    </button>
                </div>

            </div>
        </div>
    </div>


</div>

{{-- ================= SCRIPT ================= --}}
<script>
    const backdrop = document.getElementById("modalBackdrop");
    const container = document.getElementById("modalContainer");
    const content = document.getElementById("modalContent");

    function openModal() {
        backdrop.classList.remove("hidden");
        container.classList.remove("hidden");

        setTimeout(() => {
            backdrop.classList.add("opacity-100");
            content.classList.remove("scale-95", "opacity-0");
            content.classList.add("scale-100", "opacity-100");
        }, 15);
    }

    function closeModal() {
        backdrop.classList.remove("opacity-100");
        content.classList.remove("scale-100", "opacity-100");
        content.classList.add("scale-95", "opacity-0");

        setTimeout(() => {
            backdrop.classList.add("hidden");
            container.classList.add("hidden");
        }, 180);
    }

    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape") {
            closeModal();
            closeDeleteModal();
        }
    });

    let deleteItemId = null;

    function confirmDelete(id, name) {
        deleteItemId = id;
        document.getElementById('deleteItemName').textContent = name;

        const dBack = document.getElementById("deleteModalBackdrop");
        const dContainer = document.getElementById("deleteModalContainer");
        const dContent = document.getElementById("deleteModalContent");

        dBack.classList.remove("hidden");
        dContainer.classList.remove("hidden");

        requestAnimationFrame(() => {
            dBack.classList.add("opacity-100");
            dContent.classList.remove("scale-95", "opacity-0");
            dContent.classList.add("scale-100", "opacity-100");
        });
    }

    function closeDeleteModal() {
        const dBack = document.getElementById("deleteModalBackdrop");
        const dContainer = document.getElementById("deleteModalContainer");
        const dContent = document.getElementById("deleteModalContent");

        dBack.classList.remove("opacity-100");
        dContent.classList.remove("scale-100", "opacity-100");
        dContent.classList.add("scale-95", "opacity-0");

        setTimeout(() => {
            dBack.classList.add("hidden");
            dContainer.classList.add("hidden");
        }, 180);
    }

    function deleteNow() {
        if (!deleteItemId) return;

        Livewire.dispatch("deleteMargin", {
            id: deleteItemId
        });
        closeDeleteModal();
    }

    window.openModal = openModal;
    window.closeModal = closeModal;
    window.confirmDelete = confirmDelete;
    window.closeDeleteModal = closeDeleteModal;
    window.deleteNow = deleteNow;

    document.addEventListener("openModal", () => {
        openModal();
    });

    document.addEventListener("closeModal", () => {
        closeModal();
        closeDeleteModal();
    });
</script>
