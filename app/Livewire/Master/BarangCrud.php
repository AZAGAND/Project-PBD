<?php
namespace App\Livewire\Master;
use Illuminate\Support\Facades\DB;

use Livewire\Component;
use App\Models\Barang;
use App\Models\Satuan;

class BarangCrud extends Component
{
    public $jenis, $nama, $idsatuan, $harga, $status = 1, $idbarang, $isEdit = false;

    protected $rules = [
        'jenis' => 'required|string|size:1',
        'nama' => 'required|string|max:45',
        'idsatuan' => 'required|integer',
        'harga' => 'required|integer|min:0',
        'status' => 'required|in:0,1'
    ];

    public function render()
    {
        // return view('livewire.master.barang-crud', [
        //     'data'    => Barang::with('satuan')->orderBy('idbarang')->get(),
        //     'satuans' => Satuan::orderBy('nama_satuan')->get()
        // ]);

        $Data = DB::select("Select * From view_barang_satuan");
        $Satuan = DB::select("Select * From satuan Order By nama_satuan");

        return view('livewire.master.barang-crud', [
            'data' => $Data,
            'satuan' => $Satuan
        ]);
    }

    public function resetForm()
    {
        $this->jenis = '';
        $this->nama = '';
        $this->idsatuan = '';
        $this->harga = '';
        $this->status = 1;
        $this->idbarang = null;
        $this->isEdit = false;
    }

    public function store()
    {
        $this->validate();

        DB::insert(
            "INSERT INTO barang (jenis, nama, idsatuan, harga, status) VALUES (?, ?, ?, ?, ?)",
            [$this->jenis, $this->nama, $this->idsatuan, $this->harga, $this->status]
        );

        session()->flash('ok', 'Barang berhasil ditambahkan!');
        $this->resetForm();
    }

    public function edit($id)
    {
        $barang = DB::selectOne("SELECT * FROM barang WHERE idbarang = ?", [$id]);

        if ($barang) {
            $this->idbarang = $barang->idbarang;
            $this->jenis = $barang->jenis;
            $this->nama = $barang->nama;
            $this->idsatuan = $barang->idsatuan;
            $this->harga = $barang->Harga;
            $this->status = $barang->status;
            $this->isEdit = true;
        } else {
            session()->flash('err', 'Data barang tidak ditemukan!');
        }
    }

    public function cancel()
    {
        $this->resetForm();
        $this->isEdit = false;
        session()->flash('info', 'Edit dibatalkan');
    }

    public function update()
    {
        $this->validate();

        DB::update(
            "UPDATE barang 
                SET jenis = ?, nama = ?, idsatuan = ?, harga = ?, status = ?
                WHERE idbarang = ?",
            [$this->jenis, $this->nama, $this->idsatuan, $this->harga, $this->status, $this->idbarang]
        );

        session()->flash('ok', 'Barang berhasil diupdate!');
        $this->resetForm();
    }

    public function delete($id)
    {
        try {
            DB::delete("DELETE FROM barang WHERE idbarang = ?", [$id]);
            session()->flash('ok', 'Barang berhasil dihapus!');
        } catch (\Throwable $e) {
            session()->flash('err', 'Gagal menghapus barang: ' . $e->getMessage());
        }
    }
}
