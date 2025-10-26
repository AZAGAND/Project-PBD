<?php
namespace App\Livewire\Master;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserCrud extends Component
{
    public $username, $password, $idrole, $iduser, $isEdit = false;

    protected $rules = [
        'username' => 'required|string|max:45',
        'password' => 'nullable|string|min:6',
        'idrole'   => 'required|integer'
    ];

    public function render()
    {
        // Ambil semua data user beserta role-nya
        $data = DB::select("
            SELECT u.*, r.nama_role 
            FROM user u 
            JOIN role r ON u.idrole = r.idrole 
            ORDER BY u.iduser ASC
        ");

        // Ambil daftar role untuk select option
        $roles = DB::select('SELECT * FROM role ORDER BY nama_role ASC');

        return view('livewire.master.user-crud', compact('data', 'roles'));
    }

    public function resetForm()
    {
        $this->username = '';
        $this->password = '';
        $this->idrole   = '';
        $this->iduser   = null;
        $this->isEdit   = false;
    }

    public function store()
    {
        $this->validate();

        // Hash password jika diisi
        $hashedPassword = $this->password ? Hash::make($this->password) : null;

        // Insert user baru
        DB::insert('INSERT INTO user (username, password, idrole) VALUES (?, ?, ?)', [
            $this->username,
            $hashedPassword,
            $this->idrole
        ]);

        session()->flash('ok', 'User ditambahkan');
        $this->resetForm();
    }

    public function edit($id)
    {
        // Ambil data user berdasarkan id
        $u = DB::select('SELECT * FROM user WHERE iduser = ? LIMIT 1', [$id]);

        if ($u) {
            $this->iduser   = $u[0]->iduser;
            $this->username = $u[0]->username;
            $this->password = ''; // tidak diisi ulang untuk keamanan
            $this->idrole   = $u[0]->idrole;
            $this->isEdit   = true;
        }
    }

    public function update()
    {
        $this->validate();

        // Siapkan payload update
        $params = [$this->username, $this->idrole, $this->iduser];
        $query  = 'UPDATE user SET username = ?, idrole = ?';

        if ($this->password) {
            $hashed = Hash::make($this->password);
            $query  = 'UPDATE user SET username = ?, idrole = ?, password = ? WHERE iduser = ?';
            $params = [$this->username, $this->idrole, $hashed, $this->iduser];
        } else {
            $query .= ' WHERE iduser = ?';
        }

        // Eksekusi update
        DB::update($query, $params);

        session()->flash('ok', 'User diupdate');
        $this->resetForm();
    }

    public function delete($id)
    {
        try {
            // Hapus data user berdasarkan ID
            DB::delete('DELETE FROM user WHERE iduser = ?', [$id]);
            session()->flash('ok', 'User dihapus');
        } catch (\Throwable $e) {
            session()->flash('err', 'Gagal hapus (dipakai data lain)');
        }
    }
}
