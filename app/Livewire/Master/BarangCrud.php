<?php

namespace App\Livewire\Master;

use Livewire\Component;

class BarangCrud extends Component
{
    public $jenis, $nama, $idsatuan, $harga, $status=1, $idbarang, $isEdit=false;

    protected $rules = [
        'jenis' => 'required|string|size:1',
        'nama' => 'required|string|max:45',
        'idsatuan' => 'required|integer',
        'harga' => 'required|integer|min:0',
        'status' => 'required|in:0,1'
    ];

    public function render()
    {
        return view('livewire.master.barang-crud', [
            'data' => Barang::with('satuan')->orderBy('idbarang')->get(),
            'satuans' => Satuan::orderBy('nama_satuan')->get()
        ]);
    }

    public function resetForm() {
        $this->jenis=''; $this->nama=''; $this->idsatuan=null; $this->harga=0; $this->status=1; $this->idbarang=null; $this->isEdit=false;
    }

    public function store()
    {
        $this->validate();
        Barang::create([
            'jenis'=>$this->jenis,
            'nama'=>$this->nama,
            'idsatuan'=>$this->idsatuan,
            'harga'=>$this->harga,
            'status'=>$this->status
        ]);
        session()->flash('Wuokehh',"barang ditambahkan");
        $this->resetForm();
    }

    public function edit($id)
    {
        $data=Barang::findOrFail($id);
        $this->idbarang=$data->idbarang;
        $this->jenis=$data->jenis;
        $this->nama=$data->nama;
        $this->idsatuan=$data->idsatuan;
        $this->harga=$data->harga;
        $this->status=$data->status;
        $this->isEdit=true;
    }

    public function update()
    {
        $this->validate();
        Barang::where('idbarang', $this->idbarang)->update([
            'jenis'=>$this->jenis,
            'nama'=>$this->nama,
            'idsatuan'=>$this->idsatuan,
            'harga'=>$this->harga,
            'status'=>$this->status
        ]);
        session()->flash('Wuokehh',"barang diupdate");
        $this->resetForm();
    }

    public function delete($id)
    {
        try {Barang::destroy($id); session()->flash('wuokehh', "barang dihapus");}
        catch(\Throwable $e) {session()->flash('error', "barang tidak bisa dihapus");}
    }
}
