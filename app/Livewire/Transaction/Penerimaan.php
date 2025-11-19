<?php

namespace App\Livewire\Transaction;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Penerimaan extends Component
{
    public function render()
    {
        // Ambil data dari views_penerimaan (sudah kamu buat di DB)
        $penerimaanList = DB::select("
            SELECT *
            FROM views_penerimaan
            ORDER BY idpenerimaan DESC
        ");

        return view('livewire.transaction.penerimaan', [
            'penerimaanList' => $penerimaanList,
        ]);
    }

    public function delete($idpenerimaan)
    {
        DB::beginTransaction();

        try {
            // --- 1. Hapus detail_retur & retur yang terkait penerimaan ini (jika ada) ---
            DB::delete("
                DELETE dr
                FROM detail_retur dr
                JOIN retur r ON r.idretur = dr.idretur
                WHERE r.idpenerimaan = ?
            ", [$idpenerimaan]);

            DB::delete("
                DELETE FROM retur
                WHERE idpenerimaan = ?
            ", [$idpenerimaan]);

            // --- 2. Hapus kartu_stok untuk transaksi penerimaan ini (jenis M) ---
            DB::delete("
                DELETE FROM kartu_stok
                WHERE jenis_transaksi = 'M'
                AND idtransaksi = ?
            ", [$idpenerimaan]);

            // --- 3. Hapus detail_penerimaan ---
            DB::delete("
                DELETE FROM detail_penerimaan
                WHERE idpenerimaan = ?
            ", [$idpenerimaan]);

            // --- 4. Terakhir, hapus header penerimaan ---
            DB::delete("
                DELETE FROM penerimaan
                WHERE idpenerimaan = ?
            ", [$idpenerimaan]);

            // Kalau kamu mau hapus pengadaan juga, bisa tambah logic di sini
            // TAPI hati-hati sama relasi ke tabel lain.
            // Untuk keamanan, sementara TIDAK kita hapus pengadaan-nya.

            // Opsional: reset auto increment (punyamu sudah ada prosedurnya)
            DB::statement("CALL Global_Reset_Auto_Increment()");

            DB::commit();

            session()->flash('ok', 'Penerimaan berhasil dihapus beserta data terkait!');
        } catch (\Throwable $e) {
            DB::rollBack();
            session()->flash('err', 'Gagal menghapus penerimaan: ' . $e->getMessage());
        }
    }
}
