<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

// User
Route::group(["prefix" => "user", "as" => "user."], function (){
   Route::get("/mahasiswa-register", "UserController@mahasiswaRegister")->name("mahasiswa.register");
   Route::post("/mahasiswa-register", "UserController@postMahasiswaRegister")->name("post.mahasiswa.register");
   Route::get("/login", "UserController@login")->name("login");
   Route::post("/login", "UserController@postLogin")->name("post.login");
   Route::get("/logout", "UserController@logout")->name("logout");
});

// Admin
Route::group(["prefix" => "admin", "as" => "admin.", "namespace" => "Admin", "middleware" => "admin"], function (){
    Route::get("/dashboard", "HomeController@dashboard")->name("dashboard");
    //admin mahasiswa
    Route::group(["prefix" => "mahasiswa", "as" => "mahasiswa."], function (){
        Route::get("/", "MahasiswaController@index")->name("index");
        Route::get("/tambah", "MahasiswaController@tambah")->name("tambah");
        Route::post("/tambah", "MahasiswaController@postTambah")->name("post.tambah");
    });
    //admin dosen
    Route::group(["prefix" => "dosen", "as" => "dosen."], function (){
        Route::get("/", "DosenController@index")->name("index");
        Route::get("/tambah", "DosenController@tambah")->name("tambah");
        Route::post("/tambah", "DosenController@postTambah")->name("post.tambah");
        Route::get("/buat-akun-dosen/{nip}", "DosenController@buatAkunDosen")->name("buat-akun-dosen");
        Route::post("/buat-akun-dosen/{nip}", "DosenController@postBuatAkunDosen")->name("post.buat-akun-dosen");
    });
    //sks
    Route::group(["prefix" => "sks", "as" => "sks."], function (){
        Route::get("/", "SKSController@index")->name("index");
        Route::post("/import-excel", "SKSController@importExcel")->name("post.import.excel");
    });
});

// Mahasiswa
Route::group(["prefix" => "mahasiswa", "as" => "mahasiswa.","namespace" => "Mahasiswa", "middleware" => "mahasiswa"], function (){
    Route::get("/dashboard", "HomeController@dashboard")->name("dashboard");
    //pembayaran
    Route::group(["prefix" => "pembayaran", "as" => "pembayaran."], function (){
        Route::get("/bayar", "PembayaranController@bayar")->name("bayar");
        Route::post("/bayar", "PembayaranController@postBayar")->name("post.bayar");
    });
    //pengajuan Kp
    Route::group(["prefix" => "pengajuan-kp", "as" => "pengajuan.kp."], function (){
        Route::get("/", "PengajuanKPController@index")->name("index");
        Route::get("/pengajuan", "PengajuanKPController@pengajuan")->name("pengajuan");
        Route::post("/pengajuan", "PengajuanKPController@postPengajuan")->name("post.pengajuan");
    });
});

// Kaprodi
Route::group(["prefix" => "kaprodi", "as" => "kaprodi.", "namespace" => "Kaprodi"], function (){
    //
    Route::get("/dashboard", "HomeController@dashboard")->name("dashboard");
    //pengajuan Kp
    Route::group(["prefix" => "pengajuan-kp", "as" => "pengajuan.kp."], function (){
        Route::get("/", "PengajuanKPController@index")->name("index");
        Route::get("/detail/{id}", "PengajuanKPController@detail")->name("detail");
        Route::get("/terima/{id}", "PengajuanKPController@terima")->name("terima");
        Route::post("/pilih-dosbing", "PengajuanKPController@pilihDosbing")->name("pilih-dosbing");
    });
});

// Dosen
Route::group(["prefix" => "dosen", "as" => "dosen.", "namespace" => "Dosen"], function (){
    //
    Route::get("/dashboard", "HomeController@dashboard")->name("dashboard");

});

