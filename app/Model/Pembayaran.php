<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = "pembayaran";
    protected $fillable = ["id", "jenis_pengajuan", "bukti_pembayaran", "tanggal_bayar","nim", "status_pembayaran" ];
    protected $keyType = "string";
    public $incrementing = false;
}
