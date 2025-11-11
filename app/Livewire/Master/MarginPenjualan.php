<?php

namespace App\Livewire\Master;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class MarginPenjualan extends Component
{
    public function render()
    {
        db::select('select * from views_margin_penjualan');
        return view('livewire.master.margin-penjualan');
    }
}
