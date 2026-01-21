<?php

include "../../../../config/koneksi.php";
include "../../../../config/fungsi_rupiah.php";

$judulform="Rekap Beban Adm ";

$data='lap_rekap';
$rute='beban_adm';
$aksi='aksi_beban_adm';

$tabel="penjualan";
$f1='faktur';
$f2='tanggal';
$f3='kd_cus';
$f4='kd_aplikasi';
$f5='no_meja';
$f6='oleh';
$f7='subjumlah';
$f8='ppn';
$f9='jumlah';
$f10='byr_pocer';
$f11='byr_tunai';
$f12='byr_non_tunai';
$f13='kd_alatbayar';
$f14='no_urut';
$f15='tahun';
$f16='bulan';
$f17='jam';
$f18='kdsub_alatbayar';
$f19='subjumlah_offline';
$f20='ket_aplikasi';
$f21='dasar_fee';
$f22='acuan_fee';
$f23='tarif_fee';
$f24='b_packing';
$f25='no_online';
$f26='no_ofline';
$f27='tarif_pb1';
$f28='faktur_refund';
$f29='dasar_faktur';

$j1='Faktur';
$j2='Tanggal';
$j3='Kode Outlet';
$j4='kd_aplikasi';
$j5='no_meja';
$j6='oleh';
$j7='Sub jumlah';
$j8='PB1';
$j9='Jumlah';
$j10='byr_pocer';
$j11='byr_tunai';
$j12='byr_non_tunai';
$j13='kd_alatbayar';
$j14='no_urut';
$j15='tahun';
$j16='bulan';
$j17='jam';
$j18='kdsub_alatbayar';
$j19='subjumlah_offline';
$j20='ket_aplikasi';
$j21='dasar_fee';
$j22='acuan_fee';
$j23='tarif_fee';
$j24='b_packing';
$j25='no_online';
$j26='no_ofline';
$j27='tarif_pb1';
$j28='faktur_refund';
$j29='dasar_faktur';

$tabel2='kotabaru';
$ff1='kode';
$tabel3='pelanggan';
$gg1='kd_cus';

$tgl_awal=$_GET['tgl_awal'];
$tgl_akhir=$_GET['tgl_akhir'];
$filter=$_GET['filter'];
$nilai=$_GET['nilai'];

$tujuan=$_GET['tujuan'];

        // echo "<br/>".$tgl_awal;
        // echo "<br/>".$tgl_akhir;
        // echo "<br/>".$filter;
        // echo "<br/>".$nilai;
				// echo $tujuan;

if ($tujuan=='aplikasi') {
	$kondisi2='Aplikasi';
}elseif($tujuan=='carabayar'){
	$kondisi2='Cara Bayar';
}elseif($tujuan=='kasir'){
	$kondisi2='Kasir';
}else{
	$kondisi2='';

}

if($filter=='kota'){
	$kondisi="AND pelanggan.kd_kota='$nilai'";
	$query=mysqli_query($koneksi,"SELECT * FROM kotabaru WHERE kode='$nilai' ");
	$q1=mysqli_fetch_array($query);
	$judul_nilai= $q1['nama'];
	$kondisi_group=' pelanggan.kd_kota ';
}elseif($filter=='outlet'){
	$kondisi="AND penjualan.kd_cus='$nilai'";
	$query=mysqli_query($koneksi,"SELECT * FROM pelanggan WHERE kd_cus='$nilai' ");
	$q1=mysqli_fetch_array($query);
	$judul_nilai= $q1['nama'];
	$kondisi_group=' penjualan.kd_cus ';
}elseif($filter=='area'){
	$kondisi="AND kotabaru.kd_area='$nilai'";
	$query=mysqli_query($koneksi,"SELECT * FROM area WHERE kode='$nilai' ");
	$q1=mysqli_fetch_array($query);
	$judul_nilai= $q1['nama'];
	$kondisi_group=' area.kode ';
}else{
	$kondisi="";
	$judul_nilai='All';
	$kondisi_group='';
}

$judul='Laporan '.$judulform.$kondisi2;
$judul2=$filter." : ".$judul_nilai;
$judul3='Periode : '.$tgl_awal." s/d ".$tgl_akhir;

include '../header_lap.php';
?>

<link rel="stylesheet"  href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet"  href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
<!-- <div class="container"> -->

	<section class="content-header  wow fadeInDown" data-wow-duration=".3s" data-wow-delay=".3s" >
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="list-gds">
						<b><?php echo $judulform ;?></b> <small style="font-weight: 100;">report</small>
					</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="../../main.php?route=home">Beranda</a></li>
						<li class="breadcrumb-item active">Laporan</li>
						<li class="breadcrumb-item active"><?php echo $judulform ;?></li>
					</ol>
				</div>

			</div>

			<br><center><h4><?php echo $judul;?>
			<h5><?php echo $judul2;?></h5>
			<?php echo $judul3;?></h4></center> 
		</div><!-- /.container-fluid -->
	</section>

	<table id="example" class="table table-bordered table-striped">
		<thead style="background-color:  lightgray;" class="elevation-2">
			<tr>
				<th style="width:20px;padding-bottom:1px;">No</th>
				<th style="width:60px;padding-bottom:1px;">Kota</th>
				<th style="width:160px;padding-bottom:1px;">Outlet</th>
				<th style="padding-bottom:1px;">Alat Bayar</th>
				<th style="padding-bottom:1px;">Kode Sub Alat bayar</th>
				<!-- <th style="width:80px;padding-bottom:1px;">Kode Aplikasi</th> -->
				<th style="padding-bottom:1px;">Penjualan + PB1</th>
				<th style="padding-bottom:1px;">Byr Non Tunai</th>
				<!-- <th style="padding-bottom:1px;">Dasar Fee</th>
				<th style="padding-bottom:1px;">Acuan Fee</th>
				<th style="padding-bottom:1px;">Tarif Fee</th> -->
				<th style="padding-bottom:1px;">Nilai Adm</th>

			</tr>
		</thead>
		<tbody>
			<?php

			$query="SELECT * , 
			pelanggan.nama as pelanggan_nama ,
			subalat_bayar.nama as subalatbayar_nama ,
			kotabaru.nama as kotabaru_nama, 
			alat_bayar.nama as alatbayar_nama,
			sum(penjualan.jumlah) as rekap_jumlah , 
			sum(penjualan.byr_non_tunai) as rekap_non_tunai
			FROM penjualan
			Join pelanggan ON pelanggan.kd_cus=penjualan.kd_cus
			Join kotabaru ON kotabaru.kode=pelanggan.kd_kota
			Join area ON area.kode=kotabaru.kd_area
			Join alat_bayar ON alat_bayar.kd_alat=penjualan.kd_alatbayar
			Join subalat_bayar ON subalat_bayar.kdsub_alat=penjualan.kdsub_alatbayar
			WHERE tanggal>='$tgl_awal' AND tanggal <= '$tgl_akhir' +interval 1 day $kondisi
			Group by pelanggan.kd_kota , penjualan.kdsub_alatbayar
			 ";

			$sql1=mysqli_query($koneksi,$query);
			$no=1;

			while($s1=mysqli_fetch_array($sql1))
			{
				$rekap_beban_adm = $s1['rekap_non_tunai'] * ($s1['tarif_fee']/100); 
				?>
				<tr align="left">
					<td><?php echo $no; ?></td>
					<td><?php echo $s1['kotabaru_nama']; ?></td>
					<td><?php echo $s1['pelanggan_nama']; ?></td>
					<td><?php echo $s1['alatbayar_nama']; ?></td>
					<td><?php echo $s1['subalatbayar_nama']; ?></td>
					<!-- <td><?php echo $s1['kd_aplikasi']; ?></td> -->
					<td align="right"><?php echo number_format($s1['rekap_jumlah']); ?></td>
					<td align="right"><?php echo number_format($s1['rekap_non_tunai']); ?></td>
					<!-- <td><?php echo $s1['dasar_fee']; ?></td>
					<td><?php echo $s1['acuan_fee']; ?></td>
					<td><?php echo $s1['tarif_fee']; ?></td> -->
					<td align="right"><?php echo number_format($rekap_beban_adm); ?></td>
					<?php
					if ($tujuan=='aplikasi') {
						?>
						<td style="text-align: center;"><?php echo $s1['ka_kode']; ?></td>
						<td><?php echo $s1['jt_nama']; ?></td>
						<td style="text-align: right;"><?php echo number_format($s1['jumlah']);?></td>
						<td style="text-align: right;"><?php echo number_format($s1['byr_tunai']);?></td>
						<td style="text-align: right;"><?php echo number_format($s1['byr_non_tunai']);?></td>
						<td style="text-align: right;"><?php echo number_format($s1['byr_pocer']);?></td>
						<?php 
					}elseif ($tujuan=='kasir') {
						?>
						<td><?php echo $s1['oleh']; ?></td>
						<td style="text-align: right;"><?php echo number_format($s1['jumlah']);?></td>
						<td style="text-align: right;"><?php echo number_format($s1['byr_tunai']);?></td>
						<td style="text-align: right;"><?php echo number_format($s1['byr_non_tunai']);?></td>
						<td style="text-align: right;"><?php echo number_format($s1['byr_pocer']);?></td>
						<?php
					}elseif($tujuan=='carabayar'){
						?>
						<td style="text-align: center;"><?php echo $s1['kd_alatbayar']; ?></td>
						<td><?php echo $s1['ab_nama']; ?></td>
						<td style="text-align: right;"><?php echo number_format($s1['byr_non_tunai']);?></td>
						<?php
					}
					?>

				</tr>
				<?php
				$no++;
				
			}
			?>
		</tbody>

	</table>
	<hr>
	
	<!-- </div> -->

	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>

	<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>

	<script> 
		$(document).ready(function() {
			$('#example').DataTable( {
				dom: 'Bfrtip',
				buttons: [
					'copy', 'csv', 'excel', 'pdf', 'print'
					]
			} );
		} );
	</script>
	<!-- Main Footer -->
	<footer class="main-footer bg_primary_1"  style="padding:.3rem;font-size:.75rem">
		<!-- To the right -->
		<div class="float-right d-none d-sm-inline">
			Anything you want
		</div>
		<!-- Default to the left -->
		<strong>Copyright © 2014-2022 <a href="#">Waroeng Grup</a>.</strong> All rights reserved.
	</footer>

</body>


</html>

