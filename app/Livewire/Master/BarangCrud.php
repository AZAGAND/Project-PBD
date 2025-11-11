<?php
namespace App\Livewire\Master;
use Illuminate\Support\Facades\DB;

use Livewire\Component;

class BarangCrud extends Component
{
    protected $listeners = ['edit', 'resetForm'];

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

        $Data = DB::select("Select * From viewsbrg_aktif");
        $semuaData = DB::select("Select * from view_barang_satuan");
        $Satuan = DB::select("Select * From satuan Order By nama_satuan");

        return view('livewire.master.barang-crud', [
            'data' => $Data,
            'semuaData' => $semuaData,
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

        $this->dispatch('show-modal');
    }

    public function store()
    {
        $this->validate();

        DB::insert(
            "INSERT INTO barang (jenis, nama, idsatuan, harga, status) VALUES (?, ?, ?, ?, ?)",
            [$this->jenis, $this->nama, $this->idsatuan, $this->harga, $this->status]

        // DB::statement("CALL sp_insert_barang(?, ?, ?, ?, ?)", [
        //     $this->jenis,
        //     $this->nama,
        //     $this->idsatuan,
        //     $this->harga,
        //     $this->status
        // ]
        );

        session()->flash('ok', 'Barang berhasil ditambahkan!');
        $this->resetForm();

        $this->dispatch('close-modal');
    }

        public function edit($id)
        {
            $barang = DB::selectOne("SELECT * FROM barang WHERE idbarang = ?", [$id]);

            if ($barang) {
                $this->idbarang = $barang->idbarang;
                $this->jenis = $barang->jenis;
                $this->nama = $barang->nama;
                $this->idsatuan = $barang->idsatuan;
                $this->harga = $barang->harga;
                $this->status = $barang->status;
                $this->isEdit = true;

                $this->dispatch('show-modal');
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

            // DB::statement("CALL sp_update_barang(?, ?, ?, ?, ?, ?)", [
            //     $this->idbarang,
            //     $this->jenis,
            //     $this->nama,
            //     $this->idsatuan,
            //     $this->harga,
            //     $this->status
            // ]
        );

        session()->flash('ok', 'Barang berhasil diupdate!');
        $this->resetForm();

        $this->dispatch('close-modal');
    }

    public function delete($id)
    {
        try {
            DB::delete("DELETE FROM barang WHERE idbarang = ?", [$id]);
            db::delete("CALL `Global_Reset_Auto_Increment`()");
            session()->flash('ok', 'Barang berhasil dihapus!');
        } catch (\Throwable $e) {
            session()->flash('err', 'Gagal menghapus barang: ' . $e->getMessage());
        }
    }
}
