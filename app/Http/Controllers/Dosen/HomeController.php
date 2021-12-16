<?php

namespace App\Http\Controllers\Dosen;

use App\Service\Impl\SessionServiceImpl;
use App\Service\SessionService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    //
    private SessionService $sessionService;

    public function __construct()
    {
        $this->sessionService = new SessionServiceImpl();
    }


    public function dashboard()
    {
        $dosen = $this->sessionService->currentDosen();

        return view("dosen.dashboard", [
            "title" => "Dashboard",
            "dosen" => $dosen
        ]);

    }
}
