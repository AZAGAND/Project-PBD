<?php

namespace App\Livewire\Transaction;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Penerimaan extends Component
{

    // public $filterStatus = '';
    // public $Caridata = '';

    // public $penerimaanList = [];

        public function render()
    {
        $penerimaanList = DB::select("
            SELECT *
            FROM views_penerimaan
            ORDER BY idpenerimaan ASC
        ");

        return view('livewire.transaction.penerimaan', [
            'penerimaanList' => $penerimaanList,
        ]);
    }

    // public function mount()
    // {
    //     $this->loadData();
    // }

    // public function updatedFilterStatus()
    // {
    //     $this->loadData();
    // }

    // public function updatedCaridata()
    // {
    //     $this->loadData();
    // }

    // public function loadData()
    // {
    //     if ($this->Caridata !== '') {
    //         $this->penerimaanList = DB::select(
    //             "CALL SP_SearchPenerimaanByPengadaan(?)",
    //             [$this->Caridata]
    //         );
    //         return;
    //     }

    //     $this->penerimaanList = DB::select(
    //         "CALL SP_FilterPenerimaan(?)",
    //         [$this->filterStatus]
    //     );
    // }
    

    // public function delete($idpenerimaan)
    // {
    //     DB::beginTransaction();

    //     try {
    //         DB::delete("
    //             DELETE dr
    //             FROM detail_retur dr
    //             JOIN retur r ON r.idretur = dr.idretur
    //             WHERE r.idpenerimaan = ?
    //         ", [$idpenerimaan]);

    //         DB::delete("
    //             DELETE FROM retur
    //             WHERE idpenerimaan = ?
    //         ", [$idpenerimaan]);

    //         DB::delete("
    //             DELETE FROM kartu_stok
    //             WHERE jenis_transaksi = 'M'
    //             AND idtransaksi = ?
    //         ", [$idpenerimaan]);

    //         DB::delete("
    //             DELETE FROM detail_penerimaan
    //             WHERE idpenerimaan = ?
    //         ", [$idpenerimaan]);

    //         DB::delete("
    //             DELETE FROM penerimaan
    //             WHERE idpenerimaan = ?
    //         ", [$idpenerimaan]);

    //         DB::statement("CALL Global_Reset_Auto_Increment()");

    //         DB::commit();

    //         session()->flash('ok', 'Penerimaan berhasil dihapus beserta data terkait!');
    //     } catch (\Throwable $e) {
    //         DB::rollBack();
    //         session()->flash('err', 'Gagal menghapus penerimaan: ' . $e->getMessage());
    //     }
    // }
}
