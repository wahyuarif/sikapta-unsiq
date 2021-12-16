<?php

use Illuminate\Database\Seeder;

use App\Model\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        // mahasiswa user
        $mahasiswa = new User();
        $mahasiswa->id = uniqid("user-");
        $mahasiswa->email = "mahasiswa@mail.com";
        $mahasiswa->password = \Illuminate\Support\Facades\Hash::make("password");
        $mahasiswa->role = "mahasiswa";
        $mahasiswa->save();
        // dosen user
        $dosen = new User();
        $dosen->id = uniqid("user-");
        $dosen->email = "dosen@mail.com";
        $dosen->password = \Illuminate\Support\Facades\Hash::make("password");
        $dosen->role = "dosen";
        $dosen->save();


        //admin

        $userAdmin = new User();
        $userAdmin->id = uniqid("user-");
        $userAdmin->email = "admin@mail.com";
        $userAdmin->password = \Illuminate\Support\Facades\Hash::make("password");
        $userAdmin->role = "admin";
        $userAdmin->save();

        $admin = new \App\Model\Admin();
        $admin->id = uniqid();
        $admin->nama = "Ahmad Rifai";
        $admin->nomer_hp = "085548558449";
        $admin->alamat = "Rejosari";
        $admin->jenis_kelamin = "L";
        $admin->user_id = $userAdmin->id;
        $admin->save();


    }
}
