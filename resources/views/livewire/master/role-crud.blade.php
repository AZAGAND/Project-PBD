<div class="space-y-4">
    @if (session()->has('ok')) <div class="bg-green-100 p-2">{{ session('ok') }}</div> @endif
    @if (session()->has('err')) <div class="bg-red-100 p-2">{{ session('err') }}</div> @endif

    <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}" class="space-x-2">
        <input type="text" wire:model.defer="nama_role" placeholder="Nama Role" class="border p-1">
        @error('nama_role') <span class="text-red-500">{{ $message }}</span> @enderror
        <button type="submit" class="bg-blue-600 text-white px-3 py-1">{{ $isEdit ? 'Update' : 'Simpan' }}</button>
        <button type="button" wire:click="resetForm" class="px-3 py-1 border">Reset</button>
    </form>

    <table class="w-full border">
        <thead><tr class="bg-gray-50">
            <th class="p-1 border">ID</th><th class="p-1 border">Nama Role</th><th class="p-1 border">Aksi</th>
        </tr></thead>
        <tbody>
        @foreach($data as $r)
        <tr>
            <td class="border p-1">{{ $r->idrole }}</td>
            <td class="border p-1">{{ $r->nama_role }}</td>
            <td class="border p-1">
                <button wire:click="edit({{ $r->idrole }})" class="px-2 bg-yellow-400">Edit</button>
                <button wire:click="delete({{ $r->idrole }})" class="px-2 bg-red-600 text-white">Hapus</button>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
