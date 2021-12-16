<?php

namespace App\Service\Impl;

use App\Model\Dosen;
use App\Model\Mahasiswa;
use App\Model\Session;
use App\Model\Admin;
use App\Service\SessionService;

class SessionServiceImpl implements SessionService
{

    public static string $COOKIE_NAME = "X-SIKAPTA";

    public function create(string $userId): Session
    {
        $session = new Session();
        $session->id = uniqid("SESSION");
        $session->user_id = $userId;
        $session->save();

        setcookie(self::$COOKIE_NAME, $session->id, time() + (60 * 60 * 24 * 30), "/");

        return $session;
    }

    public function currentMahasiswa(): ?Mahasiswa
    {
        $sessionId = $_COOKIE[self::$COOKIE_NAME] ?? "";

        $session = Session::find($sessionId);

        if (!$session){
            return null;
        }
        $mahasiswa = Mahasiswa::where("user_id", $session->user_id)->first();
        return $mahasiswa;
    }

    public function destroy(): void
    {
        $sessionId = $_COOKIE[self::$COOKIE_NAME] ?? "";
        $session = Session::find($sessionId);
        if ($session  == null)
        {
            echo "300 bad request";die();
        }
        $session->delete();
        setcookie(self::$COOKIE_NAME, '', 1, "/");
    }

    public function currentDosen(): ?Dosen
    {
        $sessionId = $_COOKIE[self::$COOKIE_NAME] ?? "";

        $session = Session::find($sessionId);

        if (!$session){
            return null;
        }
        $dosen = Dosen::where("user_id", $session->user_id)->first();
        return $dosen;
    }

    public function currentAdmin(): ?Admin
    {
        $sessionId = $_COOKIE[self::$COOKIE_NAME] ?? "";

        $session = Session::find($sessionId);

        if (!$session){
            return null;
        }
        $admin = Admin::where("user_id", $session->user_id)->first();
        return $admin;
    }
}