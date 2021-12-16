<?php

namespace App\Service;

use App\Model\Dosen;
use App\Model\Mahasiswa;
use App\Model\Session;
use App\Model\Admin;

interface SessionService
{
    public function create(string $userId): Session;
    public function currentMahasiswa(): ?Mahasiswa;
    public function destroy(): void;
    public function currentDosen() : ?Dosen;
    public function currentAdmin() : ?Admin;
}