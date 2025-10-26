<?php
namespace App\Livewire\Master;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class RoleCrud extends Component
{
    public $nama_role, $idrole, $isEdit = false;

    protected $rules = ['nama_role' => 'required|string|max:100'];

    public function render()
    {
        $data = DB::select('SELECT * FROM role ORDER BY idrole ASC');
        return view('livewire.master.role-crud', compact('data'));
    }

    public function resetForm()
    {
        $this->nama_role = '';
        $this->idrole = null;
        $this->isEdit = false;
    }

    public function store()
    {
        $this->validate();

        // pakai native SQL INSERT
        DB::insert('INSERT INTO role (nama_role) VALUES (?)', [$this->nama_role]);

        session()->flash('ok', 'Role ditambahkan');
        $this->resetForm();
    }

    public function edit($id)
    {
        // pakai native SQL SELECT WHERE
        $m = DB::select('SELECT * FROM role WHERE idrole = ? LIMIT 1', [$id]);

        if ($m) {
            $this->idrole = $m[0]->idrole;
            $this->nama_role = $m[0]->nama_role;
            $this->isEdit = true;
        }
    }

    public function update()
    {
        $this->validate();
        DB::update('UPDATE role SET nama_role = ? WHERE idrole = ?', [
            $this->nama_role,
            $this->idrole
        ]);

        session()->flash('ok', 'Role diupdate');
        $this->resetForm();
    }

    public function delete($id)
    {
        try {
            DB::delete('DELETE FROM role WHERE idrole = ?', [$id]);
            session()->flash('ok', 'Role dihapus');
        } catch (\Throwable $e) {
            session()->flash('err', 'Gagal hapus (dipakai data lain)');
        }
    }
}
