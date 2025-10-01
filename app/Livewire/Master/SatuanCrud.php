<?php

namespace App\Livewire\Master;

use Livewire\Component;

class SatuanCrud extends Component
{
    public $nama_satuan, $status=1, $idsatuan, $isEdit=false;

    protected $rules = [
        'nama_satuan' => 'required|string|max:45',
        'status' => 'required|in:0,1'
    ];
    
    public function render()
    {
        return view('livewire.master.satuan-crud', [
            'data' => Satuan::orderBy('idsatuan')->get()
        ]);
    }

    public function resetForm() {
        $this->nama_satuan=''; $this->status=1; $this->idsatuan=null; $this->isEdit=false;
    }

    public function store()
    {
        $this->validate();
        satuan::create(['nama_satuan'=>$this->nama_satuan,'status'=>$this->status]);
        session()->flash('Wuokehh',"satuan ditambahkan");
        $this->resetForm();
    }
}
