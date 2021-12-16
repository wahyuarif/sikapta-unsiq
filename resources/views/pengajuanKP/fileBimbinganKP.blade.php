<!DOCTYPE html>
<html>
<head>
	<title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="header">
        <img src="img/kop.png" alt="" class="img-fluid" width="100%">
    </div>

	<div class="container">
        <center>
            <h3 class="mx-auto">FORMULIR NILAI AKHIR KERJA PRAKTEK</h3>
        </center>

        <table width="13%">
            <tr>
                <td>Nama</td>
                <td>:</td>
            </tr>
            <tr>
                <td>Nim</td>
                <td>:</td>
            </tr>
            <tr>
                <td>Prodi</td>
                <td>:</td>
            </tr>
            <tr>
                <td>Lokasi KP</td>
                <td>:</td>
            </tr>
            <tr>
                <td>Judul KP</td>
                <td>:</td>
            </tr>
          </table>
	
		<table class='mt-5 table table-bordered'>
			<thead>
				<tr>
                    <th>No</th>
                    <th>Komponen Penilaian</th>
                    <th>Bobot</th>
                    <th>Nilai</th>
                    <th>Bobot x Nilai</th>
                    <th>Tanda Tangan & Stempel</th>
                </tr>             
			</thead>
			<tbody>
				<tr>
                    <th>1</th>
                    <th>Pembimbing</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th>2</th>
                    <th>Penguji</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th>3</th>
                    <th>Perusahaan</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="4">NILAI AKHIR</td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    
                </tr>
			</tbody>
		</table>

	</div>

</body>
</html>