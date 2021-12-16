<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    //
    protected $fillable = [
        'nik',
        'nm_dosen',
        'fakultas',
        'status',
        'jabatan'
    ];

    public function bimbingan()
    {
        return $this->hasMany(Bimbingan::class);
    }
}
