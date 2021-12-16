<?php

namespace App\Service\Impl;


use App\Exceptions\DosenException;
use App\Http\Requests\DosenTambahRequest;
use App\Http\Response\DosenTambahResponse;
use App\Model\Dosen;
use App\Service\DosenService;
use Illuminate\Support\Facades\DB;
use League\Flysystem\Exception;

class DosenServiceImpl implements DosenService
{

    public function tambah(DosenTambahRequest $request): DosenTambahResponse
    {
        $dosen = Dosen::where("nip" , $request->nim)->first();
        if ($dosen != null){
            throw new DosenException("Dosen sudah terdaftar");
        }

        try {
            DB::beginTransaction();
            $dosen = new Dosen();
            $dosen->nip = $request->nip;
            $dosen->nama = $request->nama;
            $dosen->kode_prodi = $request->prodi;
            $dosen->user_id = null;
            $dosen->jabatan = $request->jabatan;
            $dosen->save();
            DB::commit();
        }catch (Exception $exception){
            DB::rollback();
            echo $exception->getMessage();
        }

        $response = new DosenTambahResponse();
        $response->dosen = $dosen;

        return $response;

    }
}