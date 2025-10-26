<div class="max-w-7xl mx-auto p-6 space-y-6">
    {{-- Flash Messages --}}
    @if (session()->has('ok'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg shadow-sm">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                {{ session('ok') }}
            </div>
        </div>
    @endif
    
    @if (session()->has('err'))
        <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg shadow-sm">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                {{ session('err') }}
            </div>
        </div>
    @endif

    {{-- Form Section --}}
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">
            {{ $isEdit ? 'Edit Barang' : 'Tambah Barang Baru' }}
        </h2>
        
        <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis</label>
                    <input type="text" 
                            wire:model.defer="jenis" 
                            placeholder="A/B/C..." 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                </div>
                
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Barang</label>
                    <input type="text" 
                            wire:model.defer="nama" 
                            placeholder="Nama Barang" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Satuan</label>
                    <select wire:model.defer="idsatuan" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                        <option value="">-- Pilih Satuan --</option>
                        @foreach ($satuan as $s)
                            <option value="{{ $s->idsatuan }}">{{ $s->nama_satuan }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                    <input type="number" 
                            wire:model.defer="harga" 
                            placeholder="0" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select wire:model.defer="status" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                        <option value="1">Aktif</option>
                        <option value="0">Nonaktif</option>
                    </select>
                </div>
            </div>
            
            <div class="flex gap-3 pt-2">
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2 rounded-lg transition duration-200 shadow-sm hover:shadow-md">
                    {{ $isEdit ? 'Update' : 'Simpan' }}
                </button>
                <button type="button"
                wire:click="cancel"
                class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2 rounded-lg transition duration-200 shadow-sm hover:shadow-md">
                Cancel
                </button>
                <button type="button" 
                        wire:click="resetForm" 
                        class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium px-6 py-2 rounded-lg transition duration-200 border border-gray-300">
                    Reset
                </button>
            </div>
        </form>
    </div>

    {{-- Table Section --}}
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">Daftar Barang</h2>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider border-b">ID</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider border-b">Jenis</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider border-b">Nama</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider border-b">Satuan</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider border-b">Harga</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider border-b">Status</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-600 uppercase tracking-wider border-b">Aksi</th>
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
                                @if($b->status)
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                        Nonaktif
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm text-center">
                                <div class="flex justify-center gap-2">
                                    <button wire:click="edit({{ $b->idbarang }})" 
                                            class="bg-amber-500 hover:bg-amber-600 text-white px-3 py-1 rounded-md text-xs font-medium transition duration-200">
                                        Edit
                                    </button>
                                    <button wire:click="delete({{ $b->idbarang }})" 
                                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md text-xs font-medium transition duration-200">
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                                <svg class="mx-auto h-12 w-12 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                </svg>
                                Tidak ada data barang
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div>
        <a href="{{ route('dashboard') }}">Kembali</a>
    </div>
</div>