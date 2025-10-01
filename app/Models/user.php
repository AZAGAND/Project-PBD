<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class user extends Model
{
    protected $table = 'User';
    protected $primaryKey = 'iduser';
    protected $timestamps = 'false';
    protected $fillable = ['username','password','idrole'];

    public function role()
    {
        return $this->belongsTo(role::class, 'idrole','idrole');
    }
}
