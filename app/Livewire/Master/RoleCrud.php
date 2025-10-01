<?php
namespace App\Livewire\Master;

use Livewire\Component;
use App\Models\Role;

class RoleCrud extends Component
{
    public $nama_role, $idrole, $isEdit = false;

    protected $rules = ['nama_role' => 'required|string|max:100'];

    public function render()
    {
        return view('livewire.master.role-crud', [
            'data' => Role::orderBy('idrole')->get()
        ]);
    }

    public function resetForm() { $this->nama_role=''; $this->idrole=null; $this->isEdit=false; }

    public function store()
    {
        $this->validate();
        Role::create(['nama_role' => $this->nama_role]);
        session()->flash('ok', 'Role ditambahkan');
        $this->resetForm();
    }

    public function edit($id)
    {
        $m = Role::findOrFail($id);
        $this->idrole = $m->idrole;
        $this->nama_role = $m->nama_role;
        $this->isEdit = true;
    }

    public function update()
    {
        $this->validate();
        Role::where('idrole',$this->idrole)->update(['nama_role'=>$this->nama_role]);
        session()->flash('ok', 'Role diupdate');
        $this->resetForm();
    }

    public function delete($id)
    {
        try { Role::destroy($id); session()->flash('ok','Role dihapus'); }
        catch (\Throwable $e) { session()->flash('err','Gagal hapus (dipakai data lain)'); }
    }
}
