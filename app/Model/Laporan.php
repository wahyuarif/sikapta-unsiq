<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = "laporan";
    protected $fillable = ['id', "nim","jenis_pengajuan", "file_pdf", "file_doc"];


    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

}
