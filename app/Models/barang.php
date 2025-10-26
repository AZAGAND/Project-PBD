<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'idbarang';
    public $timestamps = 'false';
    protected $fillable = ['jenis','nama','idsatuan','harga','status'];

    public function satuan()
    {
        return $this->belongsTo(satuan::class, 'idsatuan','idsatuan');
    }
}
