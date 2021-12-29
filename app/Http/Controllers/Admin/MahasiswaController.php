<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\DosenException;
use App\Exceptions\MahasiswaException;
use App\Exceptions\UserException;
use App\Http\Requests\MahasiswaTambahRequest;
use App\Model\Mahasiswa;
use App\Model\Prodi;
use App\Service\Impl\MahasiswaServiceImpl;
use App\Service\MahasiswaService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MahasiswaController extends Controller
{
    //

    private MahasiswaService $mahasiswaService;

    public function __construct()
    {
        $this->mahasiswaService = new MahasiswaServiceImpl();
    }


    public function index(Request $request)
    {
        $q = $request->get('q');
        $prodi = Prodi::all();
        $mahasiswa = Mahasiswa::where('nama', 'LIKE','%'. $q.'%')->orderBy('nama')->paginate(5);
        // return view('admin.mahasiswa.index', compact('categories'));

        return view("admin.mahasiswa.index", [
            "title" => "Mahasiswa",
            "prodi" => $prodi,
            "mahasiswa" => $mahasiswa,
            compact($prodi, $mahasiswa)
        ]);
    }

    public function tambah(){
        $prodi = Prodi::all();
        return view("admin.mahasiswa.tambah", [
            "title" => "Tambah Data Mahasiswa",
            "prodi" => $prodi
        ]);
    }

    public function postTambah(MahasiswaTambahRequest $request)
    {
        try {
            $response = $this->mahasiswaService->tambah($request);
            return redirect()->route("admin.mahasiswa.index")->with("success", "Berhasil menmbah mahasiswa" . $response->mahasiswa->nama);
        }catch (MahasiswaException $exception){
            return back()->with("error", $exception->getMessage())->withInput($request->all());
        }
    }
}
