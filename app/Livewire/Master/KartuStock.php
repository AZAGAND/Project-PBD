<?php

namespace App\Livewire\Master;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class KartuStock extends Component
{

    public $searchId = '';
    public $searchNama = '';

    public function resetFilter()
    {
        $this->searchId = '';
        $this->searchNama = '';
    }

    public function render()
    {

        $KartuStock = DB::select("SELECT * FROM views_kartu_stock");
        return view('livewire.master.kartu-stock', [
            'kartuStock' => $KartuStock
        ]);

        
    }

    // public function searchByNama()
    // {
    //     if ($this->searchNama === '') {
    //         return;
    //     }

    //     $nama = "%{$this->searchNama}%";

    //     $this->kartuStock = DB::select("
    //         SELECT *
    //         FROM views_kartu_stock
    //         WHERE nama_barang LIKE ?
    //     ", [$nama]);
    // }
}
