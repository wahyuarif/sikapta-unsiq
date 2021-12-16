<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SKS extends Model
{
    protected $table = "sks";
    protected $fillable = ['id', "nim", 'nama', 'jumlah_sks'];
    protected $keyType = "string";
    public $incrementing = false;

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, "nim", "nim");
    }
}
