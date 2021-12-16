@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-4">
        <div class="col-md-12">

        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Mohon Maaf</h4>
            <p>anda belum memenuhi syarat untuk mengajukan Kerja Praktek atau Tugas Akhir , silahkan cek cek kembali <a href="{{ route('pengajuanKP.formPengajuan') }}"> syarat-syarat dan ketentuan.</a></p>
            <hr>
            <p class="mb-0">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repudiandae illum rem minus deserunt totam eveniet ipsum quaerat voluptate corporis recusandae impedit doloribus, veniam, natus tempora voluptas inventore expedita aut ea?</p>
        </div>

        </div>
    </div>
</div>
@endsection
