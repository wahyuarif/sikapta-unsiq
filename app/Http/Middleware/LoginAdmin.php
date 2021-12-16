<?php

namespace App\Http\Middleware;

use App\Service\Impl\SessionServiceImpl;
use App\Service\SessionService;
use Closure;

class LoginAdmin
{
    private SessionService $sessionService;

    public function __construct()
    {
        $this->sessionService = new SessionServiceImpl();
    }


    public function handle($request, Closure $next)
    {
        $admin = $this->sessionService->currentAdmin();

        if (!$admin){
            return redirect()->route("user.login");
        }

        return $next($request);
    }
}
