<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\DosenException;
use App\Exceptions\UserException;
use App\Http\Requests\DosenTambahRequest;
use App\Http\Requests\UserBuatAkunDosenRequest;
use App\Http\Requests\UserBuatUserDosenRequest;
use App\Http\Response\DosenTambahResponse;
use App\Model\Prodi;
use App\Model\Dosen;
use App\Service\DosenService;
use App\Service\Impl\DosenServiceImpl;
use App\Service\Impl\UserServiceImpl;
use App\Service\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DosenController extends Controller
{

    private DosenService $dosenService;
    private UserService $userService;

    public function __construct()
    {
        $this->dosenService = new DosenServiceImpl();
        $this->userService = new UserServiceImpl();
    }

    public function index(Request $request)
    {
        $prodi = Prodi::all();
        $dosen = Dosen::paginate();

        return view("admin.dosen.index", [
            "title" => "Dosen",
            "prodi" => $prodi,
            "dosen" => $dosen
        ]);
    }

    public function tambah()
    {
        $prodi = Prodi::all();
        return view("admin.dosen.tambah", [
            "title" => "Tambah Data Dosen",
            "prodi" => $prodi
        ]);
    }

    public function postTambah(DosenTambahRequest $request)
    {
        try {
            $response = $this->dosenService->tambah($request);
            return redirect()->route("admin.dosen.index")->with("success", "Berhasil menmbah dosen " . $response->dosen->nama);
        }catch (DosenException $exception){
            return back()->with("error", $exception->getMessage())->withInput($request->all());
        }
    }

    public function buatAkunDosen($nip){
        $dosen = Dosen::where("nip" ,$nip)->first();
        return view("admin.dosen.buat-akun-dosen", [
            "title" => "Buat Akun Dosen",
            "dosen" => $dosen
        ]);
    }

    public function postBuatAkunDosen(UserBuatAkunDosenRequest $request){
        try {
            $response = $this->userService->buatUserDosen($request);
            return back()->with("success", "Berhasil membautkan akun dosen");
        }catch (UserException $exception){
            return back()->with("error", $exception->getMessage())->withInput($request->all());
        }
    }
}
