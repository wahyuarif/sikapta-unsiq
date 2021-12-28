@extends('layouts.app')

@section('content')
       <div class="row mt-3">

        <div class="col-md-12">
            <div class="card shadow-sm mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Pengajuan Kerja Praktek</h6>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="{{ route('mahasiswa.pengajuan.ta.post.pengajuan') }}" enctype="multipart/form-data">
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
                            <label for="proposal" class="col-sm-4 col-form-label text-right">Poposal</label>

                            <div class="col-sm-8">
                                <input id="proposal"
                                       type="file"
                                       class="form-control{{ $errors->has('proposal') ? ' is-invalid' : '' }}"
                                       name="proposal">

                                @if ($errors->has('proposal'))
                                    <span class="invalid-feedback ml-1">
                                        <strong>{{ $errors->first('proposal') }}</strong>
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

