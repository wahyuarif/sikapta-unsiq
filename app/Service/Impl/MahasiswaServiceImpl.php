<?php

namespace App\Service\Impl;

use App\Exceptions\MahasiswaException;
use App\Exceptions\UserException;
use App\Http\Requests\MahasiswaTambahRequest;
use App\Http\Response\MahasiswaTambahResponse;
use App\Model\Mahasiswa;
use App\Service\MahasiswaService;
use Illuminate\Support\Facades\DB;
use League\Flysystem\Exception;

class MahasiswaServiceImpl implements MahasiswaService
{

    public function tambah(MahasiswaTambahRequest $request): MahasiswaTambahResponse
    {

        try {
            DB::beginTransaction();
            $mahasiswa = new Mahasiswa();
            $mahasiswa->nim = $request->nim;
            $mahasiswa->nama = $request->nama;
            $mahasiswa->kode_prodi = $request->prodi;
            $mahasiswa->user_id = null;
            $mahasiswa->save();
            DB::commit();
        }catch (Exception $exception){
            DB::rollback();
            echo $exception->getMessage();
        }//

        $response = new MahasiswaTambahResponse();
        $response->mahasiswa = $mahasiswa;

        return $response;
    }

    private function vallidasiMahasiswaTambah(MahasiswaTambahRequest $request)
    {
        $mahasiswa = Mahasiswa::where("nim" , $request->nim)->first();
        if ($mahasiswa != null){
            throw new MahasiswaException("Nim sudah terdaftar");
        }
    }
}