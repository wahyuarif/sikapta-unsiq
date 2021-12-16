<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    protected $table = "user";
    protected $fillable = ["id", "email", "password", "role"];
    protected $keyType = "string";
    public $incrementing = false;

}
