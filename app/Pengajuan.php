<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    //
    protected $fillable = [
        'dosen_id',
        'mahasiswa_id',
        'no_pengajuan',
        'judul',
        'bidang_pekerjaan',
        'deskripsi',
        'jml_pegawai',
        'jns_pengajuan',
        'kompleksitas_pekerjaan',
        'lokasi',
        'nm_instansi',
        'phone',
        'kerangka_pikir',
        'status',
        'syarat',
        'selesai'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
