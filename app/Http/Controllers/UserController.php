<?php

namespace App\Http\Controllers;

use App\Exceptions\UserException;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Service\Impl\SessionServiceImpl;
use App\Service\Impl\UserServiceImpl;
use App\Service\SessionService;
use App\Service\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    private UserService $userService;
    private SessionService $sessionService;

    public function __construct()
    {
        $this->userService = new UserServiceImpl();
        $this->sessionService = new SessionServiceImpl();
    }

    public function mahasiswaRegister()
    {
        return view("user/mahasiswa-register");
    }

    public function postMahasiswaRegister(UserRegisterRequest $request)
    {
        try {
            $response = $this->userService->mahasiswaRegister($request);

            return redirect()->route("user.login")
                ->with("success", "Berhasil mendaftar akun sikapta, silahkan login");
        }catch (UserException $exception){
            return back()->with("error", $exception->getMessage())->withInput($request->all());
        }
    }

    public function login()
    {
        return view("user.login");
    }

    public function postLogin(UserLoginRequest $request)
    {
        try {
            $response = $this->userService->login($request);
            $this->sessionService->create($response->user->id);

            if ($response->user->role == "mahasiswa") { // mahasiswa
                return redirect()->route("mahasiswa.dashboard")
                    ->with("success", "Berhasil login");
            }else if ($response->user->role == "dosen"){ // dosen
                return redirect()->route("dosen.dashboard")
                    ->with("success", "Berhasil login");
            }else if ($response->user->role == "kaprodi"){ // kaprodi
                return redirect()->route("kaprodi.dashboard")
                    ->with("success", "Berhasil login");
            }else if ($response->user->role == "admin"){ // admin
                return redirect()->route("admin.dashboard")
                    ->with("success", "Berhasil login");
            } else{
                return back()->with("error", "Gagal Login")->withInput($request->all());
            }
        }catch (UserException $exception) {
            return back()->with("error", $exception->getMessage())->withInput($request->all());
        }
    }

    public function logout()
    {
        $this->sessionService->destroy();
        return redirect()->route("user.login");
    }

}
