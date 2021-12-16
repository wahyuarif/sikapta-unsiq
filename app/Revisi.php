<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Revisi extends Model
{
    //
    protected $fillable = [
        'file_revisi',
        'catatan'
    ];

    public function bimbingan()
    {
        return $this->belongsToMany(Bimbingan::class);
    }


}
