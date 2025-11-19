<?php

namespace App\Livewire\Transaction;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class FormPenerimaan extends Component
{
    public $showModal = false;
    public $idpengadaan;
    public $header = [];
    public $items = [];
    public $input = [];


    public function render()
    {
        $pengadaanList = DB::select("
        SELECT *
        FROM view_pengadaan
        ORDER BY idpengadaan ASC
    ");

        return view('livewire.transaction.form-penerimaan', [
            'pengadaanList' => $pengadaanList
        ]);
    }

    public function open($idpengadaan)
    {
        $this->idpengadaan = $idpengadaan;

        // header pengadaan
        $this->header = DB::selectOne("
            SELECT *
            FROM view_pengadaan
            WHERE idpengadaan = ?
        ", [$idpengadaan]);

        $this->loadItems();

        $this->showModal = true;
    }

    public function loadItems()
    {
        $this->items = DB::select("
            SELECT *
            FROM views_sisa_pengadaan
            WHERE idpengadaan = ?
            ORDER BY iddetail_pengadaan ASC
        ", [$this->idpengadaan]);

        $this->input = [];
        foreach ($this->items as $item) {
            $this->input[$item->iddetail_pengadaan] = [
                'harga' => $item->harga_satuan,
                'jumlah' => 0,
            ];
        }
    }

    public function submit()
    {
        DB::beginTransaction();

        try {
            // cari header penerimaan
            $cek = DB::selectOne("
                SELECT idpenerimaan
                FROM penerimaan
                WHERE idpengadaan = ?
                LIMIT 1
            ", [$this->idpengadaan]);

            if ($cek) {
                $idpenerimaan = $cek->idpenerimaan;
            } else {
                DB::insert("
                    INSERT INTO penerimaan (idpengadaan, iduser, status, created_at)
                    VALUES (?, ?, 'P', NOW())
                ", [$this->idpengadaan, auth()->user()->iduser]);

                $idpenerimaan = DB::getPdo()->lastInsertId();
            }

            foreach ($this->items as $barang) {
                $id_dp = $barang->iddetail_pengadaan;
                $jumlah = (int) $this->input[$id_dp]['jumlah'];
                $harga = (int) $this->input[$id_dp]['harga'];

                if ($jumlah > 0) {
                    DB::insert("
                        INSERT INTO detail_penerimaan 
                        (idpenerimaan, barang_idbarang, jumlah_terima, harga_satuan_terima)
                        VALUES (?, ?, ?, ?)
                    ", [
                        $idpenerimaan,
                        $barang->idbarang,
                        $jumlah,
                        $harga
                    ]);
                }
            }

            // cek apakah masih ada sisa barang
            $cekSisa = DB::selectOne("
                SELECT COUNT(*) AS total
                FROM views_sisa_pengadaan
                WHERE idpengadaan = ?
            ", [$this->idpengadaan]);

            if ($cekSisa->total == 0) {
                DB::update("
                    UPDATE pengadaan
                    SET status = 'S'
                    WHERE idpengadaan = ?
                ", [$this->idpengadaan]);
            }

            DB::commit();

            $this->showModal = false;
            session()->flash('ok', 'Penerimaan berhasil!');

            return redirect()->route('detail-penerimaan', $idpenerimaan);

        } catch (\Throwable $e) {
            DB::rollback();
            session()->flash('err', $e->getMessage());
        }
    }

}
