<?php

namespace App\Livewire\Transaction;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class DetailPengadaan extends Component
{
    public $idpengadaan;

    public $pengadaan;
    public $detailPengadaan = [];
    public $barangList = [];

    public $idbarang, $jumlah, $harga_satuan, $iddetail;
    public $isEdit = false;

    public function mount($id)
    {
        $this->idpengadaan = $id;

        $this->pengadaan = DB::selectOne("
            SELECT p.*, v.nama_vendor, v.badan_hukum, u.username, r.nama_role
            FROM pengadaan p
            JOIN vendor v ON v.idvendor = p.vendor_idvendor
            JOIN user u   ON u.iduser = p.user_iduser
            JOIN role r   ON r.idrole = u.idrole
            WHERE p.idpengadaan = ?
            ", [$id]);


        $this->detailPengadaan = DB::select("
            SELECT d.*, b.nama AS nama_barang, b.harga AS harga_barang,
            s.nama_satuan
            FROM detail_pengadaan d
            JOIN barang b ON b.idbarang = d.idbarang
            JOIN satuan s ON s.idsatuan = b.idsatuan
            WHERE d.idpengadaan = ?
        ", [$id]);

        $this->barangList = DB::select("
            SELECT b.*, s.nama_satuan
            FROM barang b
            JOIN satuan s ON s.idsatuan = b.idsatuan
            ORDER BY b.nama ASC
        ");
    }

    public function updatedIdbarang($value)
    {
        $barang = DB::table('barang')->where('idbarang', $value)->first();
        $this->harga_satuan = $barang->harga ?? 0;
    }



    public function refreshDetail()
    {
        $this->detailPengadaan = DB::select("
            SELECT d.*, b.nama AS nama_barang, b.harga AS harga_barang,
                   s.nama_satuan
            FROM detail_pengadaan d
            JOIN barang b ON b.idbarang = d.idbarang
            JOIN satuan s ON s.idsatuan = b.idsatuan
            WHERE d.idpengadaan = ?
        ", [$this->idpengadaan]);

        // reload header hanya jika perlu
        $this->pengadaan = DB::selectOne("
            SELECT p.*, v.nama_vendor, u.username
            FROM pengadaan p
            JOIN vendor v ON v.idvendor = p.vendor_idvendor
            JOIN user u ON u.iduser = p.user_iduser
            WHERE p.idpengadaan = ?
        ", [$this->idpengadaan]);

    }

    public function store()
    {
        DB::insert("
            INSERT INTO detail_pengadaan(idpengadaan, idbarang, jumlah, harga_satuan, sub_total)
            VALUES (?, ?, ?, ?, ?)
        ", [
            $this->idpengadaan,
            $this->idbarang,
            $this->jumlah,
            $this->harga_satuan,
            $this->jumlah * $this->harga_satuan
        ]);

        $this->resetInputFields();
        $this->refreshDetail();
        $this->dispatch('close-modal');
        session()->flash('ok', 'Item berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $item = DB::selectOne("
            SELECT * FROM detail_pengadaan
            WHERE iddetail_pengadaan = ?
        ", [$id]);

        $this->iddetail = $item->iddetail_pengadaan;
        $this->idbarang = $item->idbarang;
        $this->jumlah = $item->jumlah;
        $this->harga_satuan = $item->harga_satuan;

        $this->isEdit = true;
        $this->dispatch('open-modal');
    }

    public function update()
    {
        DB::update("
            UPDATE detail_pengadaan
            SET idbarang = ?,
                jumlah = ?,
                harga_satuan = ?,
                sub_total = ?
            WHERE iddetail_pengadaan = ?
        ", [
            $this->idbarang,
            $this->jumlah,
            $this->harga_satuan,
            $this->jumlah * $this->harga_satuan,
            $this->iddetail
        ]);

        $this->resetInputFields();
        $this->refreshDetail();
        $this->dispatch('close-modal');
        session()->flash('ok', 'Item berhasil diperbarui!');
    }

    public function delete($id)
    {
        DB::delete("
            DELETE FROM detail_pengadaan
            WHERE iddetail_pengadaan = ?
        ", [$id]);

        DB::statement("CALL Global_Reset_Auto_Increment()");

        $this->refreshDetail();
        session()->flash('ok', 'Item berhasil dihapus!');
    }

    public function resetInputFields()
    {
        $this->idbarang = null;
        $this->jumlah = null;
        $this->harga_satuan = null;
        $this->iddetail = null;
        $this->isEdit = false;
    }

    public function render()
    {
        return view('livewire.transaction.detail-pengadaan');
    }
}
