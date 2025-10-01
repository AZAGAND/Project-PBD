<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    protected $table = 'role';
    protected $promarykey = 'idrole';
    public $timestamps = false;
    protected $fillable = ['nama_role'];

    public function users()
    {
        return $this->hasMany(User::class, 'idrole', 'idrole');
    }
}
