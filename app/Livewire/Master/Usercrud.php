<?php

namespace App\Livewire\Master;

use Livewire\Component;

class Usercrud extends Component
{
    public $username, $password, $idrole, $status=1, $iduser, $isEdit=false;

    protected $rules = [
        'username' => 'required|string|max:45',
        'password' => 'required|string|min:6',
        'idrole' => 'required|integer',
        'status' => 'required|in:0,1'
    ];
    
    public function render()
    {
        return view('livewire.master.usercrud', [
            'data' => User::with('role')->orderBy('iduser')->get(),
            'roles' => Role::orderBy('idrole')->get()
        ]);
    }

    public function resetForm() {
        $this->username=''; $this->password=''; $this->idrole=null; $this->status=1; $this->iduser=null; $this->isEdit=false;
    }

    public function store()
    {
        $this->validate();
        User::create([
        'username'=>$this->username,
        'password'=>bcrypt($this->password),
        'idrole'=>$this->idrole,
        'status'=>$this->status]);
        session()->flash('Wuokehh',"user ditambahkan");
        $this->resetForm();
    }

    public function edit($id)
    {
        $data=User::findOrFail($id);
        $this->iduser=$data->iduser;
        $this->username=$data->username;
        $this->password='';
        $this->idrole=$data->idrole;
        $this->status=$data->status;
        $this->isEdit=true;
    }

    public function update()
    {
        $this->validate();
        $payload = [
            'username'=>$this->username,
            'idrole'=>$this->idrole,
        ];
        if ($this->password) {
            $payload['password'] = bcrypt($this->password);
        }
        User::where('iduser', $this->iduser)->update($payload);
        session()->flash('Wuokehh',"user diupdate");
        $this->resetForm();
    }

    public function delete($id)
    {
        try {User::destroy($id); session()->flash('wuokehh', "user dihapus");}
        catch(\Throwable $e) {session()->flash('error', "user tidak bisa dihapus");}
    }
}
