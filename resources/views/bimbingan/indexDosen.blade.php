<?php

use App\Bimbingan;
use Illuminate\Support\Facades\Auth;


$bimbingan = Bimbingan::where([
    'dosen_id' => Auth::user()->id,
    'status' => 'Bimbingan'
])
->whereNotNull('file_bimbingan')
->count();

?>
@extends('layouts.dosen')

@section('content')
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-12">
                @if ($msg = Session::get('msg'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $msg }}</strong>
                </div>
                @endif

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Bimbingan Mahasiswa</h6>
                    </div>
                    <div class="card-body">
                        @foreach($bimbingans as $bimbingan)
                        <table class="table">
                        <thead class="thead-light">
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nim</th>
                            <th scope="col">Nama</th>
                            <th scope="col">KD Bimbingan</th>
                            <th scope="col">Judul KP</th>
                            <th scope="col">Lihat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <th scope="row">1</th>
                            <td>{{ $bimbingan->mahasiswa->nim }}</td>
                            <td>{{ $bimbingan->mahasiswa->nama }}</td>
                            <td>{{ $bimbingan->kd_bimbingan }}</td>
                            <td>{{ $bimbingan->pengajuan->judul }}</td>
                            <td>
                                <a 
                                href="{{ route('bimbingan.mahasiswa.show', [
                                    'mahasiswa_id' => $bimbingan->mahasiswa_id 
                                    ]) }}" 
                                class="btn btn-primary btn-sm">
                                Lihat Bimbingan
                            </a>
                            </td>
                            </tr>
                        </tbody>
                        </table>
                        @endforeach

                    </div>
                </div>
                    
            </div>
        </div>
    </div>
@endsection
