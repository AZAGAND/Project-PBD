<?php

namespace App\Livewire\Master;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;

class MarginPenjualan extends Component
{
    public $idmargin, $persen, $status = 1;
    public $isEdit = false;

    protected $rules = [
        'persen' => 'required|numeric|min:0|max:100',
        'status' => 'required|in:0,1',
    ];

    public function render()
    {
        $DataMargin = DB::select('SELECT * FROM views_margin_penjualan');
        return view('livewire.master.margin-penjualan', compact('DataMargin'));
    }

    public function resetForm()
    {
        $this->idmargin = null;
        $this->persen = null;
        $this->status = 1;
        $this->isEdit = false;
    }

    public function store()
    {
        $this->validate();

        DB::insert("
            INSERT INTO margin_penjualan (persen, status, iduser)
            VALUES (?, ?, ?)
        ", [
            $this->persen,
            $this->status,
            auth()->id(),
        ]);

        session()->flash('ok', 'Margin berhasil ditambahkan.');

        $this->resetForm();
        $this->dispatch('closeModal');
    }

    public function edit($id)
    {
        $m = DB::selectOne("SELECT * FROM margin_penjualan WHERE idmargin_penjualan = ?", [$id]);

        $this->idmargin = $m->idmargin_penjualan;
        $this->persen = $m->persen;
        $this->status = $m->status;
        $this->isEdit = true;

        $this->dispatch('openModal');
    }

    public function update()
    {
        $this->validate();

        DB::update("
            UPDATE margin_penjualan
            SET persen = ?, status = ?
            WHERE idmargin_penjualan = ?
        ", [
            $this->persen,
            $this->status,
            $this->idmargin,
        ]);

        session()->flash('ok', 'Margin berhasil diupdate.');

        $this->resetForm();
        $this->dispatch('closeModal');
    }

    #[On('deleteMargin')]
    public function delete($id)
    {
        try {
            DB::delete("DELETE FROM margin_penjualan WHERE idmargin_penjualan = ?", [$id]);
            DB::delete("CALL Global_Reset_Auto_Increment()");

            session()->flash('ok', 'Margin berhasil dihapus!');
        } catch (\Throwable $e) {
            session()->flash('err', 'Gagal menghapus margin: ' . $e->getMessage());
        }
    }
}
