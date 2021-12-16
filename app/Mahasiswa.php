<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpKernel\Profiler\Profile;

class Mahasiswa extends Model
{
    //
    protected $fillable = [
        'nim',
        'nama',
        'no_hp',
        'prodi',
        'status'
    ];

    public function pengajuan()
    {
        return $this->hasOne(Profile::class);
    }
    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
