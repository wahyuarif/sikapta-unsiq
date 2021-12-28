<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? ""}} - SIKAPTA Unsiq</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- bootstrap -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body>

<div class="container text-center pt-5 px-5">
    <h4><u>SURAT TUGAS PEMBIMBING KERJA PRAKTEK</u></h4>
    <h6><u>No....../FASTIKOM-UNSIQ/{{ $bulan }}/{{$tahun}}</u></h6>

    <p class="text-left mt-5"><strong>Assalamu’alaikum Wr. Wb.</strong></p>
    <p class="text-left">
        Dekan Fakultas Teknik dan Ilmu Komputer (FASTIKOM) Universitas Sains Al Qur’an (UNSIQ) Jawa Tengah di Wonosobo memberikan tugas kepada :
    </p>
    <table>
        <tr>
            <td>Nama &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>:</td>
            <td><strong>Nasyiin Faqih, S.T.,M.T.</strong></td>
        </tr>
    </table>
    <p class="text-left mt-4">
        Untuk memberikan bimbingan Kerja Praktek (KP) kepada mahasiswa tersebut di bawah ini :
    </p>

    <table class="text-left">
        <tr>
            <td>Nama &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>:</td>
            <td><strong>{{ $mahasiswa->nama }}</strong></td>
        </tr>
        <tr>
            <td>NIM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>:</td>
            <td><strong>{{ $mahasiswa->nim }}</strong></td>
        </tr>
        <tr>
            <td>Prodi &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>:</td>
            <td><strong>{{ $mahasiswa->prodi->prodi }}</strong></td>
        </tr>
    </table>
    <p class="text-left mt-4">
        Selama melakukan pembimbingan, harus dailaksanakan dengan sungguh-sungguh dan tidak menyimpang dari kaidah keilmuannya. Pembimbing Kerja Praktek (KP)  maksimal dilakukuan selama 6 bulan . Jika sampai batas waktu yang telah ditentukan mahasiswa tersebut di atas belum menyelesaikan KP, maka KP tersebut dianggap gugur dan mahasiswa harus mengambil judul KP yang baru.
    </p>
    <p class="text-left mt-3">Demikian agar dilaksanakan sebagaimana mestinya.</p>

    <p class="text-left mt-5"><strong>Assalamu’alaikum Wr. Wb.</strong></p>

</div>



<!-- Bootstrap core JavaScript-->
{{-- <script src="{{ asset('js/app.js') }}"></script> --}}
<!-- Bootstrap core JavaScript-->
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('js/sb-admin-2.min.js')}}"></script>

</body>

</html>
