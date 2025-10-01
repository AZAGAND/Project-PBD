<?php
namespace App\Livewire\Master;

use Livewire\Component;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserCrud extends Component
{
    public $username, $password, $idrole, $iduser, $isEdit=false;

    protected $rules = [
        'username' => 'required|string|max:45',
        'password' => 'nullable|string|min:6',
        'idrole'   => 'required|integer'
    ];

    public function render()
    {
        return view('livewire.master.user-crud', [
            'data'  => User::with('role')->orderBy('iduser')->get(),
            'roles' => Role::orderBy('nama_role')->get()
        ]);
    }

    public function resetForm(){
        $this->username=''; $this->password=''; $this->idrole=''; $this->iduser=null; $this->isEdit=false;
    }

    public function store()
    {
        $this->validate();
        User::create([
            'username' => $this->username,
            'password' => $this->password ? Hash::make($this->password) : null,
            'idrole'   => $this->idrole
        ]);
        session()->flash('ok','User ditambahkan');
        $this->resetForm();
    }

    public function edit($id)
    {
        $u = User::findOrFail($id);
        $this->iduser = $u->iduser;
        $this->username = $u->username;
        $this->password = '';
        $this->idrole = $u->idrole;
        $this->isEdit = true;
    }

    public function update()
    {
        $this->validate();
        $payload = ['username'=>$this->username,'idrole'=>$this->idrole];
        if ($this->password) { $payload['password'] = Hash::make($this->password); }
        User::where('iduser',$this->iduser)->update($payload);
        session()->flash('ok','User diupdate');
        $this->resetForm();
    }

    public function delete($id)
    {
        try { User::destroy($id); session()->flash('ok','User dihapus'); }
        catch (\Throwable $e) { session()->flash('err','Gagal hapus (dipakai data lain)'); }
    }
}
