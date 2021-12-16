<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    //
    protected $table = "mahasiswa";
    protected $fillable = ['nim','nama','email','nomer_hp','kode_prodi','status', 'alamat', 'jenis_kelamin', 'foto', 'user_id'];
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

    public function sks()
    {
        return $this->hasOne(SKS::class);
    }

}
