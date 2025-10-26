<?php
namespace App\Livewire\Master;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class SatuanCrud extends Component
{
    public $nama_satuan, $status = 1, $idsatuan, $isEdit = false;

    protected $rules = [
        'nama_satuan' => 'required|string|max:45',
        'status' => 'required|in:0,1'
    ];

    public function render()
    {
        // Ambil semua data satuan
        $data = DB::select('SELECT * FROM satuan ORDER BY idsatuan ASC');
        return view('livewire.master.satuan-crud', compact('data'));
    }

    public function resetForm()
    {
        $this->nama_satuan = '';
        $this->status = 1;
        $this->idsatuan = null;
        $this->isEdit = false;
    }

    public function store()
    {
        $this->validate();

        // Tambah data baru
        DB::insert('INSERT INTO satuan (nama_satuan, status) VALUES (?, ?)', [
            $this->nama_satuan,
            $this->status
        ]);

        session()->flash('ok', 'Satuan ditambahkan');
        $this->resetForm();
    }

    public function edit($id)
    {
        // Ambil data berdasarkan id
        $m = DB::select('SELECT * FROM satuan WHERE idsatuan = ? LIMIT 1', [$id]);

        if ($m) {
            $this->idsatuan = $m[0]->idsatuan;
            $this->nama_satuan = $m[0]->nama_satuan;
            $this->status = $m[0]->status;
            $this->isEdit = true;
        }
    }

    public function update()
    {
        $this->validate();

        // Update data
        DB::update('UPDATE satuan SET nama_satuan = ?, status = ? WHERE idsatuan = ?', [
            $this->nama_satuan,
            $this->status,
            $this->idsatuan
        ]);

        session()->flash('ok', 'Satuan diupdate');
        $this->resetForm();
    }

    public function delete($id)
    {
        try {
            // Hapus data
            DB::delete('DELETE FROM satuan WHERE idsatuan = ?', [$id]);
            session()->flash('ok', 'Satuan dihapus');
        } catch (\Throwable $e) {
            session()->flash('err', 'Gagal hapus (dipakai di barang)');
        }
    }
}
