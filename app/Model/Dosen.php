<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = "dosen";
    protected $fillable = ['nik', "email","nama", "kode_prodi", "status", "jabatan"];
    protected $keyType = "string";
    public $incrementing = false;

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'kode_prodi',"kode_prodi");
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
