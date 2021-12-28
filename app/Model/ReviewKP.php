<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ReviewKP extends Model
{
    protected $table = "review";
    protected $fillable = ["id", "pengajuankp_id", "dosen_id", "review"];
    protected $keyType = "string";
    public $incrementing = true;

    public function pengajuanKp()
    {
        return $this->belongsTo(PengajuanKP::class,"pengajuankp_id", "id");
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class,"dosen_id", "nip");
    }
}

