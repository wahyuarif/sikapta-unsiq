<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    //
    protected $table = "prodi";
    protected $fillable = ["prodi", "kode_prodi"];
    protected $keyType = "string";
    public $incrementing = false;

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, "prodi_id", "nim");
    }

}
