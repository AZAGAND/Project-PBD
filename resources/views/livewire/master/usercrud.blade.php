<div>
    {{-- The best athlete wants his opponent at his best. --}}
</div>
<div class="space-y-4">
    @if (session()->has('ok')) <div class="bg-green-100 p-2">{{ session('ok') }}</div> @endif
    @if (session()->has('err')) <div class="bg-red-100 p-2">{{ session('err') }}</div> @endif

    <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}" class="space-x-2">
        <input type="text" wire:model.defer="username" placeholder="Username" class="border p-1">
        <input type="password" wire:model.defer="password" placeholder="Password (kosongkan jika tidak ganti)" class="border p-1">
        <select wire:model.defer="idrole" class="border p-1">
            <option value="">-- Pilih Role --</option>
            @foreach($roles as $r) <option value="{{ $r->idrole }}">{{ $r->nama_role }}</option> @endforeach
        </select>
        <button class="bg-blue-600 text-white px-3 py-1">{{ $isEdit ? 'Update' : 'Simpan' }}</button>
        <button type="button" wire:click="resetForm" class="px-3 py-1 border">Reset</button>
    </form>

    <table class="w-full border">
        <thead><tr class="bg-gray-50">
            <th class="p-1 border">ID</th><th class="p-1 border">Username</th><th class="p-1 border">Role</th><th class="p-1 border">Aksi</th>
        </tr></thead>
        <tbody>
        @foreach($data as $u)
        <tr>
            <td class="border p-1">{{ $u->iduser }}</td>
            <td class="border p-1">{{ $u->username }}</td>
            <td class="border p-1">{{ $u->role->nama_role ?? '-' }}</td>
            <td class="border p-1">
                <button wire:click="edit({{ $u->iduser }})" class="px-2 bg-yellow-400">Edit</button>
                <button wire:click="delete({{ $u->iduser }})" class="px-2 bg-red-600 text-white">Hapus</button>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
