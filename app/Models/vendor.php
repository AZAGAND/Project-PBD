<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class vendor extends Model
{
    protected $table = 'Vendor';
    protected $primaryKey = 'idvendor';
    protected $timestamps = 'false';
    protected $fillable = ['nama_vendor','badan_hukum','status'];
}
