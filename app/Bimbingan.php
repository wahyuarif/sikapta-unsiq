<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;


class Bimbingan extends Model
{
    //
    protected $fillable = [
        'kd_bimbingan',
        'pengajuan_id',
        'mahasiswa_id',
        'dosen_id',
        'bab',
        'revisi_id',
        'status'
    ];

    public function getCreatedAttribute() 
    {
        return Carbon::parse($this->attribute['created_at'])
                        ->translatedFormat('l, d F Y');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }

    public function revisi()
    {
        return $this->belongsToMany(Revisi::class);
    }
}
