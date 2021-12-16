@extends('layouts.app')

@section('content')
<div class="row mt-2">
    <div class="col-12">
        <p>Dashborad</p>
        <h4>Selamat Datang, {{ Auth::user()->mahasiswa->nama }}</h4>
        <hr>
    </div>
</div>

<!--Top-->
<div class="row">
<!-- Task -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Progress
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                            </div>
                            <div class="col">
                                <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-info" role="progressbar"
                                        style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4 mb-4">
        <div class="card shadow mb-2">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Profile</h6>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <img class="rounded-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="120" height="120">
                </div>
                <p class="mb-4">
                    <div class="row">
                        <div class="col">
                            NAMA
                        </div>
                        <div class="col-7">
                            {{ Auth::user()->mahasiswa->nama }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            SKS LULUS
                        </div>
                        <div class="col-7">
                            140
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            Tagihan
                        </div>
                        <div class="col-7">
                            <b>Terbayar</b>
                        </div>
                    </div>
                </p>
                
                <div class="mt-4 text-center small">
                    <span class="mr-2">
                        <i class="fas fa-circle text-success"></i> Memenuhi Syarat
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-danger"></i> Belum Memenuhi
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8 mb-4">
        <div class="card shadow mb-2">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">ALUR SIKAPTA</h6>
            </div>
            <div class="card-body">
                <p>
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Kerja Praktek</div>
                </p>
                <p class="mb-4">
                    <div class="row">
                        <div class="col-auto">
                            1
                        </div>
                        <div class="col-11">
                            Mahasiswa telah lulus matakuliah
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-auto">
                            2
                        </div>
                        <div class="col-11">
                            Mahasiswa telah lulus matakuliah
                        </div>
                    </div>
                </p>
                
                <p>
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Tugas Akhir</div>
                </p>

                <div class="mt-4 text-center small">
                    <span class="mr-2">
                        <i class="fas fa-circle text-success"></i> Memenuhi Syarat
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-danger"></i> Belum Memenuhi
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="row mt-2">
    <div class="col-sm-3 col-sm-6 mt-3">
        <a href="{{ route('persyaratan') }}" class="btn">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <img src="{{ asset('icon/svg/accept.svg') }}" alt="" class="img-fluid" width="100">
                        </div>
                        <div class="col-6 d-flex-row ">
                        <h4 class="text-left font-weight-bold text-primary">Alur Pengajuan KP dan TA</h4>
                            <p class="text-left">With supporting text below as a natural lead-in to additional content.</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-3 col-sm-6 mt-3">
        <a href="{{ route('pengajuanKP.formPengajuan') }}" class="btn">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <img src="{{ asset('icon/svg/creative-idea.svg') }}" alt="" class="img-fluid" width="100">
                        </div>
                        <div class="col-6 d-flex-row ">
                        <h4 class="text-left font-weight-bold text-primary">Kerja Praktek</h4>
                            <p class="text-left">With supporting text below as a natural lead-in to additional content.</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-3 col-sm-6 mt-3">
        <a href="{{ route('bimbingan.mahasiswa') }}" class="btn">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <img src="{{ asset('icon/svg/calendar.svg') }}" alt="" class="img-fluid" width="100">
                        </div>
                        <div class="col-6 d-flex-row ">
                        <h4 class="text-left font-weight-bold text-primary">Bimbingan</h4>
                            <p class="text-left">With supporting text below as a natural lead-in to additional content.</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-3 col-sm-6 mt-3">
        <a href="{{route('pengajuanTA.formPengajuan')}}" class="btn">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <img src="{{ asset('icon/svg/database.svg') }}" alt="" class="img-fluid" width="100">
                        </div>
                        <div class="col-6 d-flex-row ">
                        <h4 class="text-left font-weight-bold text-primary">Tugas Akhir</h4>
                            <p class="text-left">With supporting text below as a natural lead-in to additional content.</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection
