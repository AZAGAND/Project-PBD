<?php
namespace App\Livewire\Master;

use Livewire\Component;
use App\Models\Satuan;

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

    public function resetForm(){ $this->nama_satuan=''; $this->status=1; $this->idsatuan=null; $this->isEdit=false; }

    public function store()
    {
        $this->validate();
        Satuan::create(['nama_satuan'=>$this->nama_satuan,'status'=>$this->status]);
        session()->flash('ok','Satuan ditambahkan');
        $this->resetForm();
    }

    public function edit($id)
    {
        $m=Satuan::findOrFail($id);
        $this->idsatuan=$m->idsatuan;
        $this->nama_satuan=$m->nama_satuan;
        $this->status=$m->status;
        $this->isEdit=true;
    }

    public function update()
    {
        $this->validate();
        Satuan::where('idsatuan',$this->idsatuan)->update([
            'nama_satuan'=>$this->nama_satuan,'status'=>$this->status
        ]);
        session()->flash('ok','Satuan diupdate');
        $this->resetForm();
    }

    public function delete($id)
    {
        try { Satuan::destroy($id); session()->flash('ok','Satuan dihapus'); }
        catch (\Throwable $e) { session()->flash('err','Gagal hapus (dipakai di barang)'); }
    }
}
