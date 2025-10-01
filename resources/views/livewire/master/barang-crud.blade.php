<div class="space-y-4">
    @if (session()->has('ok')) <div class="bg-green-100 p-2">{{ session('ok') }}</div> @endif
    @if (session()->has('err')) <div class="bg-red-100 p-2">{{ session('err') }}</div> @endif

    <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}" class="space-x-2">
        <input type="text" wire:model.defer="jenis" placeholder="Jenis (A/B/C...)" class="border p-1">
        <input type="text" wire:model.defer="nama" placeholder="Nama Barang" class="border p-1">
        <select wire:model.defer="idsatuan" class="border p-1">
            <option value="">-- Pilih Satuan --</option>
            @foreach($satuans as $s) <option value="{{ $s->idsatuan }}">{{ $s->nama_satuan }}</option> @endforeach
        </select>
        <input type="number" wire:model.defer="harga" placeholder="Harga" class="border p-1">
        <select wire:model.defer="status" class="border p-1">
            <option value="1">Aktif</option><option value="0">Nonaktif</option>
        </select>
        <button class="bg-blue-600 text-white px-3 py-1">{{ $isEdit ? 'Update' : 'Simpan' }}</button>
        <button type="button" wire:click="resetForm" class="px-3 py-1 border">Reset</button>
    </form>

    <table class="w-full border">
        <thead><tr class="bg-gray-50">
            <th class="p-1 border">ID</th><th class="p-1 border">Jenis</th><th class="p-1 border">Nama</th>
            <th class="p-1 border">Satuan</th><th class="p-1 border">Harga</th><th class="p-1 border">Status</th><th class="p-1 border">Aksi</th>
        </tr></thead>
        <tbody>
        @foreach($data as $b)
        <tr>
            <td class="border p-1">{{ $b->idbarang }}</td>
            <td class="border p-1">{{ $b->jenis }}</td>
            <td class="border p-1">{{ $b->nama }}</td>
            <td class="border p-1">{{ $b->satuan->nama_satuan ?? '-' }}</td>
            <td class="border p-1">{{ $b->Harga }}</td>
            <td class="border p-1">{{ $b->status ? 'Aktif':'Nonaktif' }}</td>
            <td class="border p-1">
                <button wire:click="edit({{ $b->idbarang }})" class="px-2 bg-yellow-400">Edit</button>
                <button wire:click="delete({{ $b->idbarang }})" class="px-2 bg-red-600 text-white">Hapus</button>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
