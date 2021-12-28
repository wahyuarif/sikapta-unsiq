<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PengajuanTA extends Model
{
    protected $table = "pengajuanta";
    protected $fillable = ["id", "nim", "judul", "nip","status", "selesai", "proposal"];
    protected $keyType = "string";
    public $incrementing = false;

    public function dosen()
    {
        return $this->belongsTo(Dosen::class,"nip", "nip");
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class,"nim", "nim");
    }
}
