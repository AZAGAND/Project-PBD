<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class satuan extends Model
{
    protected $table = 'satuan';
    protected $primaryKey = 'idsatuan';
    public $timestamps = false;
    protected $fillable = ['nama_satuan', 'status'];

    public function barang()
    {
        return $this->hasMany(Barang::class, 'idsatuan', 'idsatuan');
    }
}
