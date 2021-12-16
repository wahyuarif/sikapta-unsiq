<?php

namespace App\Http\Middleware;

use App\Service\Impl\SessionServiceImpl;
use App\Service\SessionService;
use Closure;

class LoginMahasiswa
{
    private SessionService $sessionService;

    public function __construct()
    {
        $this->sessionService = new SessionServiceImpl();
    }


    public function handle($request, Closure $next)
    {
        $mahasiswa = $this->sessionService->currentMahasiswa();

        if (!$mahasiswa){
            return redirect()->route("user.login");
        }

        return $next($request);
    }
}
