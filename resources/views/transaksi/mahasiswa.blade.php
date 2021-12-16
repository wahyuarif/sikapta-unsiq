@extends('layouts.app')

@section('content')
<div class="row mt-2">
    <div class="col-12">
        <h4>Transaksi</h4>
        <hr>
    </div>
</div>

    <div class="row mt-3">
      
         {{-- notifikasi sukses --}}
        @if ($msg = Session::get('msg'))
        <div class="alert alert-warning alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button> 
            <strong>{{ $msg }}</strong>
        </div>
        @endif

        <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Konfirmasi Pembayaran</h6>
            </div>
            <div class="card-body">
            <form class="form-horizontal" method="POST" action="{{ route('transaksi.store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }} {{ method_field('POST') }}

                        <div class="form-group row">
                            <label for="jns_pembayaran" class="col-sm-4 col-form-label text-right">Jenis Pembayaran</label>

                            <div class="col-sm-8">
                                <input 
                                    id="jns_pembayaran" 
                                    type="text" 
                                    class="form-control {{ $errors->has('jns_pembayaran') ? ' is-invalid' : '' }}" name="jns_pembayaran" 
                                    value="{{ old('jns_pembayaran') }}">

                                @if ($errors->has('jns_pembayaran'))
                                    <div class="invalid-feedback ml-1">
                                        <strong> {{ $errors->first('jns_pembayaran') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="nm_instansi" class="col-sm-4 col-form-label text-right">Tanggal Bayar</label>

                            <div class="col-sm-8">
                                <input 
                                id="tanggal_bayar" 
                                type="date" 
                                class="form-control {{ $errors->has('tanggal_bayar') ? ' is-invalid' : '' }}" 
                                name="tanggal_bayar" 
                                value="{{ old('tanggal_bayar') }}">

                                @if ($errors->has('tanggal_bayar'))
                                    <span class="invalid-feedback ml-1">
                                        <strong>{{ $errors->first('tanggal_bayar') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="bukti_pembayaran" class="col-sm-4 col-form-label text-right">Bukti Pembayaran</label>

                            <div class="col-sm-8">
                                <input id="bukti_pembayaran" 
                                type="file" 
                                class="form-control{{ $errors->has('bukti_pembayaran') ? ' is-invalid' : '' }}" 
                                name="bukti_pembayaran">

                                @if ($errors->has('bukti_pembayaran'))
                                    <span class="invalid-feedback ml-1">
                                        <strong>{{ $errors->first('bukti_pembayaran') }}</strong>
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
