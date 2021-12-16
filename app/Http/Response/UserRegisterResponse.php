<?php

namespace App\Http\Response;

use App\Model\Mahasiswa;
use App\Model\User;

class UserRegisterResponse
{
    public User $user;
    public Mahasiswa $mahasiswa;
}