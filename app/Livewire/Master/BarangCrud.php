<?php
namespace App\Livewire\Master;

use Livewire\Component;
use App\Models\Barang;
use App\Models\Satuan;

class BarangCrud extends Component
{
    public $jenis, $nama, $idsatuan, $harga, $status=1, $idbarang, $isEdit=false;

    protected $rules = [
        'jenis'    => 'required|string|size:1',
        'nama'     => 'required|string|max:45',
        'idsatuan' => 'required|integer',
        'harga'    => 'required|integer|min:0',
        'status'   => 'required|in:0,1'
    ];

    public function render()
    {
        return view('livewire.master.barang-crud', [
            'data'    => Barang::with('satuan')->orderBy('idbarang')->get(),
            'satuans' => Satuan::orderBy('nama_satuan')->get()
        ]);
    }

    public function resetForm(){
        $this->jenis=''; $this->nama=''; $this->idsatuan=''; $this->harga=''; $this->status=1; $this->idbarang=null; $this->isEdit=false;
    }

    public function store()
    {
        $this->validate();
        Barang::create([
            'jenis' => $this->jenis,
            'nama'  => $this->nama,
            'idsatuan' => $this->idsatuan,
            'Harga' => $this->harga, // kolom H besar di DB
            'status' => $this->status
        ]);
        session()->flash('ok','Barang ditambahkan');
        $this->resetForm();
    }

    public function edit($id)
    {
        $b = Barang::findOrFail($id);
        $this->idbarang = $b->idbarang;
        $this->jenis    = $b->jenis;
        $this->nama     = $b->nama;
        $this->idsatuan = $b->idsatuan;
        $this->harga    = $b->Harga; // baca dari kolom Harga
        $this->status   = $b->status;
        $this->isEdit   = true;
    }

    public function update()
    {
        $this->validate();
        Barang::where('idbarang',$this->idbarang)->update([
            'jenis'=>$this->jenis,
            'nama'=>$this->nama,
            'idsatuan'=>$this->idsatuan,
            'Harga'=>$this->harga,
            'status'=>$this->status
        ]);
        session()->flash('ok','Barang diupdate');
        $this->resetForm();
    }

    public function delete($id)
    {
        try { Barang::destroy($id); session()->flash('ok','Barang dihapus'); }
        catch (\Throwable $e) { session()->flash('err','Gagal hapus'); }
    }
}
