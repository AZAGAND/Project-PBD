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

    public function edit($id)
    {
        $data=satuan::find($id);
        $this->idsatuan=$data->idsatuan;
        $this->nama_satuan=$data->nama_satuan;
        $this->status=$data->status;
        $this->isEdit=true;
    }

    public function update()
    {
        $this->validate();
        satuan::where('idsatuan', $this->idsatuan)->update(['nama_satuan'=>$this->nama_satuan,'status'=>$this->status]);
        session()->flash('Wuokehh',"satuan diupdate");
        $this->resetForm();
    }

    public function delete($id)
    {
        try {satuan::destroy($id); session()->flash('wuokehh', "satuan dihapus");}
        catch(\Throwable $e) {session()->flash('error', "satuan tidak bisa dihapus");}
    }

}
