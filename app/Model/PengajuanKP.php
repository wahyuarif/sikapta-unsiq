<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PengajuanKP extends Model
{
    protected $table = "pengajuankp";
    protected $fillable = ["id", "nim", "nik", "judul", "lokasi", "nama_instansi", "alamat", "jumlah_pegawai", "bidang_pekerjaan", "status", "selesai"];
    protected $keyType = "string";
    public $incrementing = false;

    public function dosen()
    {
        return $this->belongsTo(Dosen::class,"nip", "nip");
    }
}

