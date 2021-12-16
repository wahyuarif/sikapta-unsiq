<?php

namespace App\Http\Response;

use App\Model\Dosen;
use App\Model\User;

class UserBuatAkunDosenResponse
{

    public User $user;
    public Dosen $dosen;

}