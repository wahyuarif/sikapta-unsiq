@extends('layouts.app')

@section('content')
    <div class="row mt-3">
        <div class="col-md-10">
            <div class="card shadow-sm mb-4">
                <div class="card-header py-3">
{{--                    <a href="{{ route("mahasiswa.index") }}" class="btn btn-sm btn-success">Kembalii</a>--}}
                </div>
                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="{{ route('mahasiswa.laporan.post.upload-kp') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <input type="hidden" name="nim" value="{{ $mahasiswa->nim }}">

                        <div class="form-group">
                            <label for="nim" class="font-weight-bold">File PDF</label>
                            <input type="file" name="file_pdf" class="form-control" value="{{ old("file_pdf") }}" placeholder="File PDF">
                        </div>

                        <div class="form-group">
                            <label for="nama"  class="font-weight-bold">File DOC</label>
                            <input type="file" name="file_doc" class="form-control" value="{{ old("file_doc") }}" placeholder="File Document">
                        </div>

                        <button class="btn btn-sm btn-primary">Upload</button>

                    </form>
                </div>
            </div>
        </div>

@endsection
