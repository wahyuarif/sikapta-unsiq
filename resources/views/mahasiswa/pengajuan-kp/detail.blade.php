@extends('layouts.app')

@section('content')

    <div class="row mt-3">
        <div class="col-md-7">
            <div class="card shadow-sm mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Detail Instansi KP - {{ $pengajuanKp->judul }}</h6>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped">
                        <tbody>
                        <tr>
                            <th scope="row">Nama Instansi</th>
                            <td>:</td>
                            <td>{{ $pengajuanKp->nama_instansi }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Lokasi</th>
                            <td>:</td>
                            <td>{{ $pengajuanKp->lokasi }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Alamat Instansi</th>
                            <td>:</td>
                            <td>{{ $pengajuanKp->alamat }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Bidang Pekerjaan</th>
                            <td>:</td>
                            <td>{{ $pengajuanKp->bidang_pekerjaan }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Jumlah Pegawai</th>
                            <td>:</td>
                            <td>{{ $pengajuanKp->jumlah_pegawai }} orang</td>
                        </tr>
                        </tbody>
                    </table>
                    <strong> Deskripsi singkat </strong>
                    <p>{{ $pengajuanKp->deskripsi_pekerjaan }} </p>
                </div>

            </div>
        </div>
        <div class="col-md-5">
            <ol class="list-group list-group-numbered shadow-sm">
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="font-weight-bold">Judul</div>
                        {{ $pengajuanKp->judul }}
                    </div>
                    <span class="badge bg-primary rounded-pill">14</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="font-weight-bold">ID Pengajuan</div>
                        {{ $pengajuanKp->id }}
                    </div>
                    <span class="badge bg-primary rounded-pill">14</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="font-weight-bold">Tanggal Pengajuan</div>
                        {{ $pengajuanKp->created_at }}
                    </div>
                    <span class="badge bg-primary rounded-pill">14</span>
                </li>
                @if($pengajuanKp->status != 'PENGAJUAN' && $pengajuanKp->status != 'DITOLAK')
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="font-weight-bold">Dosen Pembimbing</div>
                            {{ $pengajuanKp->dosen->nama }}
                    </div>

                </li>
                @endif
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="font-weight-bold">Status Pengajuan</div>
                        <span class="badge badge-warning">{{ $pengajuanKp->status }}</span>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="font-weight-bold">Cetak Surat Tugas</div>
                        <a href="{{ route('mahasiswa.pengajuan.kp.surat-tugas') }}" class="btn btn-sm btn-info">Cetak</a>
                    </div>
                </li>
            </ol>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card shadow-sm mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Kerangka Pikir</h6>
                </div>
                <div class="card-body table-responsive">
                    <embed src="{{ asset('storage/kerangka_pikir/'.$pengajuanKp->kerangka_pikir)}}" width="100%" height="800px" />
                </div>
            </div>
        </div>
    </div>
@endsection
