<div class="space-y-4">
    @if (session()->has('ok')) <div class="bg-green-100 p-2">{{ session('ok') }}</div> @endif
    @if (session()->has('err')) <div class="bg-red-100 p-2">{{ session('err') }}</div> @endif

    <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}" class="space-x-2">
        <input type="text" wire:model.defer="nama_vendor" placeholder="Nama Vendor" class="border p-1">
        <select wire:model.defer="badan_hukum" class="border p-1">
            <option value="">-- Badan Hukum --</option>
            <option value="P">PT</option><option value="S">CV/UD</option><option value="U">Lainnya</option>
        </select>
        <select wire:model.defer="status" class="border p-1">
            <option value="1">Aktif</option><option value="0">Nonaktif</option>
        </select>
        <button class="bg-blue-600 text-white px-3 py-1">{{ $isEdit ? 'Update' : 'Simpan' }}</button>
        <button type="button" wire:click="resetForm" class="px-3 py-1 border">Reset</button>
    </form>

    <table class="w-full border">
        <thead><tr class="bg-gray-50">
            <th class="p-1 border">ID</th><th class="p-1 border">Nama</th><th class="p-1 border">Badan</th><th class="p-1 border">Status</th><th class="p-1 border">Aksi</th>
        </tr></thead>
        <tbody>
        @foreach($data as $v)
        <tr>
            <td class="border p-1">{{ $v->idvendor }}</td>
            <td class="border p-1">{{ $v->nama_vendor }}</td>
            <td class="border p-1">{{ $v->badan_hukum }}</td>
            <td class="border p-1">{{ $v->status ? 'Aktif':'Nonaktif' }}</td>
            <td class="border p-1">
                <button wire:click="edit({{ $v->idvendor }})" class="px-2 bg-yellow-400">Edit</button>
                <button wire:click="delete({{ $v->idvendor }})" class="px-2 bg-red-600 text-white">Hapus</button>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
