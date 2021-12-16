<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Service\Impl\SessionServiceImpl;
use App\Service\SessionService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    private SessionService $sessionService;

    public function __construct()
    {
        $this->sessionService = new SessionServiceImpl();
    }


    public function dashboard()
    {
        $mahasiswa = $this->sessionService->currentMahasiswa();
        return view("mahasiswa.dashboard", [
            "title" => "Dashboard",
            "mahasiswa" => $mahasiswa
        ]);
    }
}
