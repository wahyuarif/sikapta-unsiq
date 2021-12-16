<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    //
    protected $table = "admin";
    protected $fillable = ['id', "nama", "email","nomer_hp", "alamat", "jenis_kelamin", "user_id"];
    protected $keyType = "string";
    public $incrementing = false;
}
