<?php

namespace App\Livewire\Master;

use Livewire\Component;

class VendorCrud extends Component
{
    public $nama_vendor, $status=1, $idvendor, $isEdit=false;

    protected $rules = [
        'nama_vendor' => 'required|string|max:100',
        'badan_hukum' => 'required|in:P,S,U',
        'status' => 'required|in:0,1'
    ];
    
    public function render()
    {
        return view('livewire.master.vendor-crud', [
            'data' => Vendor::orderBy('idvendor')->get()
        ]);
    }

    public function resetForm() {
        $this->nama_vendor=''; $this->status=1; $this->idvendor=null; $this->isEdit=false;
    }

    public function store()
    {
        $this->validate();
        Vendor::create([
        'nama_vendor'=>$this->nama_vendor,
        'badan_hukum'=>$this->badan_hukum,
        'status'=>$this->status]);
        session()->flash('Wuokehh',"vendor ditambahkan");
        $this->resetForm();
    }

    public function edit($id)
    {
        $data=Vendor::findOrFail($id);
        $this->idvendor=$data->idvendor;
        $this->nama_vendor=$data->nama_vendor;
        $this->badan_hukum=$data->badan_hukum;
        $this->status=$data->status;
        $this->isEdit=true;
    }

    public function update()
    {
        $this->validate();
        Vendor::where('idvendor', $this->idvendor)->update([
        'nama_vendor'=>$this->nama_vendor,
        'badan_hukum'=>$this->badan_hukum,
        'status'=>$this->status]);
        session()->flash('Wuokehh',"vendor diupdate");
        $this->resetForm();
    }

    public function delete($id)
    {
        try {Vendor::destroy($id); session()->flash('wuokehh', "vendor dihapus");}
        catch(\Throwable $e) {session()->flash('error', "vendor tidak bisa dihapus");}
    }
}
