@extends('layouts.app')

@section('content')
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="alert alert-light" role="alert">
        <h4 class="alert-heading">Jika membutuhkan surat ijin survey silahkan download</h4>
        <hr>
        <a href="" class="btn btn-success btn-sm">
            <i class="fas fa-download"></i> Download Surat Ijin Survey
        </a>

    </div>

    <div class="row mt-3">

        <div class="col-md-12">
            <div class="card shadow-sm mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Pengajuan Kerja Praktek</h6>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="{{ route('mahasiswa.pengajuan.kp.post.pengajuan') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <input type="hidden" name="nim" value="{{ $mahasiswa->nim }}">

                        <div class="form-group row">
                            <label for="judul" class="col-sm-4 col-form-label text-right">Judul</label>

                            <div class="col-sm-8">
                                <input
                                        id="judul"
                                        type="text"
                                        class="form-control {{ $errors->has('judul') ? ' is-invalid' : '' }}" name="judul"
                                        value="{{ old('judul') }}">

                                @if ($errors->has('judul'))
                                    <div class="invalid-feedback ml-1">
                                        <strong> {{ $errors->first('judul') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="bidang_pekerjaan" class="col-sm-4 col-form-label text-right">Bidang Pekerjaan</label>

                            <div class="col-sm-8">
                                <input id="bidang_pekerjaan" type="text"
                                       class="form-control {{ $errors->has('bidang_pekerjaan') ? ' is-invalid' : '' }}"
                                       name="bidang_pekerjaan"
                                       value="{{ old('bidang_pekerjaan') }}"
                                       autofocus>

                                @if ($errors->has('bidang_pekerjaan'))
                                    <span class="invalid-feedback ml-1">
                                        <strong>{{ $errors->first('bidang_pekerjaan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="deskripsi_pekerjaan" class="col-sm-4 col-form-label text-right">Deskripsi</label>

                            <div class="col-sm-8">
                            <textarea
                                    name="deskripsi_pekerjaan"
                                    class="form-control {{ $errors->has('deskripsi_pekerjaan') ? ' is-invalid' : '' }}"
                                    id="validationTextarea"
                                    value="{{ old('deskripsi_pekerjaan') }}" >
                            </textarea>

                                @if ($errors->has('deskripsi_pekerjaan'))
                                    <span class="invalid-feedback ml-1">
                                    <strong>{{ $errors->first('deskripsi_pekerjaan') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jumlah_pegawai" class="col-sm-4 col-form-label text-right">Jumlah Pegawai</label>

                            <div class="col-sm-8">
                                <input
                                        id="jumlah_pegawai"
                                        type="number"
                                        class="form-control {{ $errors->has('jumlah_pegawai') ? ' is-invalid' : '' }}"
                                        name="jumlah_pegawai"
                                        value="{{ old('jumlah_pegawai') }}">

                                @if ($errors->has('jumlah_pegawai'))
                                    <span class="invalid-feedback ml-1">
                                    <strong>{{ $errors->first('jumlah_pegawai') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lokasi" class="col-sm-4 col-form-label text-right">Lokasi</label>

                            <div class="col-sm-8">
                                <input id="lokasi"
                                       type="text"
                                       class="form-control{{ $errors->has('lokasi') ? ' is-invalid' : '' }}"
                                       name="lokasi"
                                       value="{{ old('lokasi') }}">

                                @if ($errors->has('lokasi'))
                                    <span class="invalid-feedback ml-1">
                                        <strong>{{ $errors->first('lokasi') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama_instansi" class="col-sm-4 col-form-label text-right">Nama Instansi</label>

                            <div class="col-sm-8">
                                <input
                                        id="nama_instansi"
                                        type="text"
                                        class="form-control {{ $errors->has('nama_instansi') ? ' is-invalid' : '' }}"
                                        name="nama_instansi"
                                        value="{{ old('nama_instansi') }}">

                                @if ($errors->has('nama_instansi'))
                                    <span class="invalid-feedback ml-1">
                                        <strong>{{ $errors->first('nama_instansi') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="alamat" class="col-sm-4 col-form-label text-right">Alamat Instansi</label>

                            <div class="col-sm-8">
                                <input
                                        id="alamat"
                                        type="text"
                                        class="form-control {{ $errors->has('alamat') ? ' is-invalid' : '' }}"
                                        name="alamat"
                                        value="{{ old('alamat') }}">

                                @if ($errors->has('alamat'))
                                    <span class="invalid-feedback ml-1">
                                        <strong>{{ $errors->first('alamat') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kerangka_pikir" class="col-sm-4 col-form-label text-right">kerangka Pikir</label>

                            <div class="col-sm-8">
                                <input id="kerangka_pikir"
                                       type="file"
                                       class="form-control{{ $errors->has('kerangka_pikir') ? ' is-invalid' : '' }}"
                                       name="kerangka_pikir">

                                @if ($errors->has('kerangka_pikir'))
                                    <span class="invalid-feedback ml-1">
                                        <strong>{{ $errors->first('kerangka_pikir') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-sm-10 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Ajukan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

@endsection

