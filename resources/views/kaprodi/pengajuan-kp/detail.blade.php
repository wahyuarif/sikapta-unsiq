@extends('layouts.kaprodi')

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
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    @isset($pengajuanKp->dosen->nama)
                    <div class="ms-2 me-auto">
                        <div class="font-weight-bold">Dosen Pembimbing</div>
                        {{ $pengajuanKp->dosen->nama }}
                    </div>
                    @endisset
                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModal">
                        Pilih Dosen Pembimbing
                    </button>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="font-weight-bold">Status Pengajuan</div>
                        <span class="badge badge-warning">{{ $pengajuanKp->status }}</span>
                    </div>
                </li>
                @if($pengajuanKp->status == "PENGAJUAN")
                <li class="list-group-item d-flex justify-content-center align-items-start">
                    <form method="post" action="{{ route('kaprodi.pengajuan.kp.review', ["id" => $pengajuanKp->id]) }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="status" value="DITERIMA DENGAN SYARAT">
                        <input type="hidden" name="pengajuankp_id" value="{{$pengajuanKp->id}}">
                        <textarea name="review" id="review"
                                  class="form-control {{ $errors->has('review') ? ' is-invalid' : '' }}"
                        ></textarea>
                        <br>
                        <a href="{{ route('kaprodi.pengajuan.kp.terima', ["id" => $pengajuanKp->id, "status" => "DITERIMA"]) }}" class="btn btn-success rounded-0">Terima Pengajuan</a>
                        <a href="{{ route('kaprodi.pengajuan.kp.terima', ["id" => $pengajuanKp->id, "status" => "DITOLAK"]) }}" class="btn btn-outline-danger rounded-0">Tolak</a>
                        <button class="btn btn-outline-warning rounded-0">Terima dengan syarat</button>
                    </form>
                </li>
                @endif
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



    <!-- Modal -->
    <form method="post" action="{{ route("kaprodi.pengajuan.kp.pilih-dosbing") }}">
        {{ csrf_field() }}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pilih Dosen Pembimbing</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" value="{{ $pengajuanKp->id }}">
                    <select name="nip" class="form-control">
                        <option value="">-- Dosen Pembimbing --</option>
                        @foreach($dosen as $value)
                        <option value="{{ $value->nip }}">{{ $value->kode_prodi }} - {{ $value->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    </form>
@endsection
