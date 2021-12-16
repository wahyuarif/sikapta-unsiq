<?php

namespace App\Service\Impl;

use App\Exceptions\UserException;
use App\Http\Requests\UserBuatAkunDosenRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Response\UserBuatAkunDosenResponse;
use App\Http\Response\UserLoginResponse;
use App\Http\Response\UserRegisterResponse;
use App\Model\Dosen;
use App\Model\Mahasiswa;
use App\Model\User;
use App\Service\UserService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserServiceImpl implements UserService
{

    public function mahasiswaRegister(UserRegisterRequest $request): UserRegisterResponse
    {
        // cek nim mahasiswa sudah terdaftar belum
        $mahasiswa = Mahasiswa::where("nim", $request->nim)->first();

        if ($mahasiswa == null){
            throw new UserException("Maaf nim anda belum terdaftar");
        }

        if ($mahasiswa->user_id != null){
            throw new UserException("Nim sudah terdaftar");
        }

        try {
            DB::beginTransaction();

            $user = new User();
            $user->id = uniqid("user-");
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = "mahasiswa";
            $user->save();

            Mahasiswa::where("nim", $mahasiswa->nim)
                ->update(["user_id" => $user->id]);
            DB::commit();

        }catch (\Exception $exception){
            DB::rollback();
            echo $exception->getMessage();
        }

        $response = new UserRegisterResponse();
        $response->user = $user;
        $response->mahasiswa = $mahasiswa;

        return $response;
    }

    public function login(UserLoginRequest $request): UserLoginResponse
    {
        $user = User::where("email", $request->email)->first();
        if ($user == null){
            throw new UserException("Email atau password salah");
        }
        if (Hash::check($request->password, $user->password)){
            $response = new UserLoginResponse();
            $response->user = $user;
            return $response;
        }else{
            throw new UserException("Email atau password salah");
        }
    }

    public function buatUserDosen(UserBuatAkunDosenRequest $request): UserBuatAkunDosenResponse
    {
        $this->validasiBuatUserDosen($request);

        $dosen = Dosen::where("nip",$request->nip)->first();
        try {
            DB::beginTransaction();
            $user = new User();
            $user->id = uniqid("user-");
            $user->email = $request->email;
            $user->password = Hash::make($dosen->nip);
            $user->role = $dosen->jabatan;
            $user->save();

            Dosen::where("nip", $dosen->nip)
                ->update(["user_id" => $user->id]);

            DB::commit();
        }catch (\Exception $exception){
            DB::rollback();
            echo $exception->getMessage();
        }

        $response = new UserBuatAkunDosenResponse();
        $response->user = $user;
        $response->dosen = $dosen;

        return $response;
    }

    private function validasiBuatUserDosen(UserBuatAkunDosenRequest $request)
    {
        // cek apakah sudah memiliki user
        $dosen = Dosen::where("nip",$request->nip)->first();
        if ($dosen->user_id != null)
        {
            throw new UserException("User sudah dibuat");
        }
    }

}