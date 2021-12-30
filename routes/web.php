<?php

use Illuminate\Support\Facades\Route;


Route::get('/',"UserController@login")->name("login");

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
    //Menu mahasiswa
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
        Route::post("/export-excel", "SKSController@exportExcel")->name("post.export.excel");
    });
    //pembayaran
    Route::group(["prefix" => "pembayaran", "as" => "pembayaran."], function (){
        Route::get("/pembayaran-kp", "PembayaranController@pembayaranKP")->name("kp.index");
        Route::get("/pembayaran-ta", "PembayaranController@pembayaranTA")->name("ta.index");
        Route::get("/konfirmasi-pembayaran/{id}", "PembayaranController@konfirmasiPembayaran")->name("konfirmasi-pembayaran");
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
        Route::get("/detail/{id}", "PengajuanKPController@detail")->name("detail");
        Route::get("/surat-tugas", "PengajuanKPController@suratTugas")->name("surat-tugas");
    });
    //pengajuan TA
    Route::group(["prefix" => "pengajuan-ta", "as" => "pengajuan.ta."], function (){
        Route::get("/", "PengajuanTAController@index")->name("index");
        Route::get("/pengajuan", "PengajuanTAController@pengajuan")->name("pengajuan");
        Route::post("/pengajuan", "PengajuanTAController@postPengajuan")->name("post.pengajuan");
    });
    // Laporan
    Route::group(["prefix" => "laporan", "as" => "laporan."], function (){
        Route::get("/", "LaporanController@kerjaPraktek")->name("kerja-praktek");
        Route::get("/upload", "LaporanController@uploadKP")->name("upload-kp");
        Route::post("/laporan", "LaporanController@postUploadKP")->name("post.upload-kp");
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
        Route::get("/terima/{id}/{status}", "PengajuanKPController@terima")->name("terima");
        Route::post("/review/{id}", "PengajuanKPController@review")->name("review");
        Route::post("/pilih-dosbing", "PengajuanKPController@pilihDosbing")->name("pilih-dosbing");
    });

    //pengajuan TA
    Route::group(["prefix" => "pengajuan-ta", "as" => "pengajuan.ta."], function (){
        Route::get("/", "PengajuanTAController@index")->name("index");
        Route::get("/detail/{id}", "PengajuanTAController@detail")->name("detail");
        Route::get("/terima/{id}", "PengajuanTAController@terima")->name("terima");

    });

    // Kerja Praktek
    Route::group(["prefix" => "kerja-praktek", "as" => "kerja-praktek."], function (){
        Route::get("/", "KerjaPraktekController@index")->name("index");
        Route::get("/selesai/{id}", "KerjaPraktekController@selesai")->name("selesai");
    });


    // Tugas Akhir
    Route::group(["prefix" => "tugas-akhir", "as" => "tugas-akhir."], function (){
        Route::get("/", "TugasAkhirController@index")->name("index");
        Route::get("/selesai/{id}", "TugasAkhirController@selesai")->name("selesai");
    });

    //review Kp
    Route::group(["prefix" => "review-kp", "as" => "review.kp."], function (){
        Route::post("/", "ReviewKPController@save")->name("save");
    });


});

// Dosen
Route::group(["prefix" => "dosen", "as" => "dosen.", "namespace" => "Dosen"], function (){
    //
    Route::get("/dashboard", "HomeController@dashboard")->name("dashboard");

    // Kerja Praktek
    Route::group(["prefix" => "kerja-praktek", "as" => "kerja-praktek."], function (){
        Route::get("/", "KerjaPraktekController@index")->name("index");
        Route::get("/selesai/{id}", "KerjaPraktekController@selesai")->name("selesai");
    });

    // Tugas Akhir
    Route::group(["prefix" => "tugas-akhir", "as" => "tugas-akhir."], function (){
        Route::get("/", "TugasAkhirController@index")->name("index");
        Route::get("/selesai/{id}", "TugasAkhirController@selesai")->name("selesai");
    });

});

