<?php

namespace App\Service;

use App\Http\Requests\UserBuatAkunDosenRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Response\UserBuatAkunDosenResponse;
use App\Http\Response\UserLoginResponse;
use App\Http\Response\UserRegisterResponse;

interface UserService
{
    public function mahasiswaRegister(UserRegisterRequest $request): UserRegisterResponse;
    public function login(UserLoginRequest $request): UserLoginResponse;
    public function buatUserDosen(UserBuatAkunDosenRequest $request): UserBuatAkunDosenResponse;
}