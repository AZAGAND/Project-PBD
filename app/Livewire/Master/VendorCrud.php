<?php
namespace App\Livewire\Master;

use Livewire\Component;
use App\Models\Vendor;

class VendorCrud extends Component
{
    public $nama_vendor, $badan_hukum, $status=1, $idvendor, $isEdit=false;

    protected $rules = [
        'nama_vendor' => 'required|string|max:100',
        'badan_hukum' => 'required|in:P,S,U', // contoh: P=PT, S=CV/UD dll.
        'status' => 'required|in:0,1'
    ];

    public function render()
    {
        return view('livewire.master.vendor-crud', [
            'data' => Vendor::orderBy('idvendor')->get()
        ]);
    }

    public function resetForm(){
        $this->nama_vendor=''; $this->badan_hukum=''; $this->status=1; $this->idvendor=null; $this->isEdit=false;
    }

    public function store()
    {
        $this->validate();
        Vendor::create([
            'nama_vendor'=>$this->nama_vendor,
            'badan_hukum'=>$this->badan_hukum,
            'status'=>$this->status
        ]);
        session()->flash('ok','Vendor ditambahkan');
        $this->resetForm();
    }

    public function edit($id)
    {
        $m=Vendor::findOrFail($id);
        $this->idvendor=$m->idvendor;
        $this->nama_vendor=$m->nama_vendor;
        $this->badan_hukum=$m->badan_hukum;
        $this->status=$m->status;
        $this->isEdit=true;
    }

    public function update()
    {
        $this->validate();
        Vendor::where('idvendor',$this->idvendor)->update([
            'nama_vendor'=>$this->nama_vendor,
            'badan_hukum'=>$this->badan_hukum,
            'status'=>$this->status
        ]);
        session()->flash('ok','Vendor diupdate');
        $this->resetForm();
    }

    public function delete($id)
    {
        try { Vendor::destroy($id); session()->flash('ok','Vendor dihapus'); }
        catch (\Throwable $e) { session()->flash('err','Gagal hapus'); }
    }
}
