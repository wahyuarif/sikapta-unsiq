<?php

namespace App\Http\Controllers;

use App\Bimbingan;
use App\Mahasiswa;
use App\Pengajuan;
use App\Sks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $id = Auth::user()->mahasiswa->id;
        $nim = Auth::user()->mahasiswa->nim;
        $sks = Sks::where('nim', $nim)->first();
        $pengajuan = Pengajuan::where('mahasiswa_id', $id)->count();

        if ($pengajuan == null) {
            if ( $sks['jml_sks'] >= 20 ) {
                return view('user.home');
            }else{
                return view('user.homeElse');
            }
        }else{
            return view('user.home');
        }
    }

    public function persyaratan()
    {
        return view('user.persyaratan');
    }

    public function tolak()
    {
        return view('user.tolak');
    }
}
