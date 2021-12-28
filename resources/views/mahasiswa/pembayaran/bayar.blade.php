@extends('layouts.app')

@section('content')
    <div class="row mt-3">
        <div class="col-md-10">
            <div class="card shadow-sm mb-4">

                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="{{ route('mahasiswa.pembayaran.post.bayar') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="jenis_pengajuan" class="font-weight-bold">Pengajuan</label>
                            <select name="jenis_pengajuan" class="form-control" id="jenis_pengajuan">
                               <option value="">Pengajuan</option>
                               <option value="KP">Pengajuan Kerja Praktek</option>
                               <option value="TA">Pengajuan Tugas Akhir</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="bukti_pembayaran"  class="font-weight-bold">Bukti Pembayaran</label>
                            <input type="file" name="bukti_pembayaran" class="form-control" value="{{ old("bukti_pembayaran") }}" placeholder="Bukti Pembayran">
                        </div>

                        <button class="btn btn-sm btn-primary">Submit</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
