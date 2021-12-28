@extends('layouts.kaprodi')

@section('content')

    @if($laporan == null)
        <div class="alert alert-danger">
            Belum upload laporan
        </div>

        <a href="{{ route('mahasiswa.laporan.upload-kp') }}" class="btn btn-primary btn-sm mt-4">Upload Laporan</a>

    @else
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card shadow-sm mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Laporan Kerja Praktek</h6>
                    </div>
                    <div class="card-body table-responsive">

                        <embed src="{{ asset('storage/laporan/pdf/'. $laporan->file_pdf)}}" width="100%" height="800px" />
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection
