<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $table = "session";
    protected $fillable = ['id', "user_id"];
    protected $keyType = "string";
    public $incrementing = false;
}
