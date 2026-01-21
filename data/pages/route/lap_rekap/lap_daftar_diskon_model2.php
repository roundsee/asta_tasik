<?php

include "../../../../config/koneksi.php";
include "../../../../config/fungsi_rupiah.php";

$judulform="Daftar Diskon";

$data='lap_rekap';
$rute='daftar_diskon';
$aksi='aksi_daftar_diskon';

$tabel="tarif_diskon";
$f1='jadi';
$f2='kd_promo';
$f3='kd_jenis';
$f4='cakupan';
$f5='kd_kota';
$f6='kd_cus';
$f7='jenis_barang';
$f8='kd_brg';
$f9='diskon';
$f10='ket';
$f11='tgl_awal';
$f12='tgl_akhir';

$j1='Jadi';
$j2='Kode Promo';
$j3='Kode Jenis';
$j4='Cakupan';
$j5='Kode Kota';
$j6='Kode Outlet';
$j7='Jenis Barang';
$j8='Kode Barang';
$j9='Diskon';
$j10='Keterangan';
$j11='Tgl Awal';
$j12='Tgl Akhir';



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
}elseif($filter=='outlet'){
	$kondisi="AND tarif_diskon.kd_cus='$nilai'";
	$query=mysqli_query($koneksi,"SELECT * FROM pelanggan WHERE kd_cus='$nilai' ");
	$q1=mysqli_fetch_array($query);
	$judul_nilai= $q1['nama'];
}elseif($filter=='area'){
	$kondisi="AND kotabaru.kd_area='$nilai'";
	$query=mysqli_query($koneksi,"SELECT * FROM area WHERE kode='$nilai' ");
	$q1=mysqli_fetch_array($query);
	$judul_nilai= $q1['nama'];
}else{
	$kondisi="";
	$judul_nilai='All';
}

$judul='Laporan Daftar Diskon '.$kondisi2;
$judul2=$filter." : ".$judul_nilai ;
$judul3='Periode : '. $tgl_awal." s/d ".$tgl_akhir;

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
			<!-- <button class="btn btn-primary btn-sm elevation-2 " style="opacity: .7;" onclick="window.location='route/<?php echo $data;?>/cetak.php?tgl_awal=<?php echo $tgl_awal;?>&tgl_akhir=<?php echo $tgl_akhir;?>&filter=<?php echo $filter;?>&nilai=<?php echo $nilai;?>'"><i class="fa fa-plus";></i> Cetak PB1</button> -->

			<br><center><h4><?php echo $judul;?>
			<h5><?php echo $judul2;?></h5>
			<?php echo $judul3;?></h4></center> 
		</div><!-- /.container-fluid -->
	</section>

	<table id="example" class="table table-bordered table-striped">

		<thead style="background-color:  lightgray;" class="elevation-2">
			
			<tr>
				<th style="width:20px;padding-bottom:1px;">No</th>
				<th style="width:220px;padding-bottom:1px;">Jadi</th>
				<th style="padding-bottom:1px;">Kode Promo</th>
				<th style="width:1%;padding-bottom:1px;">Kode Jenis</th>
				<th style="padding-bottom:1px;">Cakupan</th>
				<th style="padding-bottom:1px;">Kode Kota</th>
				<th style="padding-bottom:1px;">Kode Outlet</th>
				<th style="padding-bottom:1px;">Jenis Barang</th>
				<th style="padding-bottom:1px;">Kode Barang</th>
				<th style="padding-bottom:1px;">Diskon</th>
				<th style="padding-bottom:1px;">Keterangan</th>
				<th style="padding-bottom:1px;">Tgl Awal</th>
				<th style="padding-bottom:1px;">Tgl Akhir</th>

			</tr>
		</thead>
		<tbody>
			<?php

			$query="SELECT * , pelanggan.nama as p_nama,kotabaru.nama as kb_nama
			FROM tarif_diskon 
			join pelanggan on pelanggan.kd_cus=tarif_diskon.kd_cus
			join kotabaru on kotabaru.kode=pelanggan.kd_kota
			WHERE tgl_awal>='$tgl_awal' AND tgl_akhir <= '$tgl_akhir' +interval 1 day $kondisi 
			";

			$sql1=mysqli_query($koneksi,$query);
			$no=1;

			while($s1=mysqli_fetch_array($sql1))
			{
				?>
				<tr align="left">
					<td><?php echo $no; ?></td>
					<td><?php echo $s1['jadi']; ?></td>
					<td><?php echo $s1['kd_promo']; ?></td>
					<td><?php echo $s1['kd_jenis']; ?></td>
					<td><?php echo $s1['cakupan']; ?></td>
					<td><?php echo $s1['kd_kota']; ?></td>
					<td><?php echo $s1['kd_cus']; ?></td>
					<td><?php echo $s1['jenis_barang']; ?></td>
					<td><?php echo $s1['kd_brg']; ?></td>
					<td align="right"><?php echo number_format($s1['diskon']); ?></td>
					<td><?php echo $s1['ket']; ?></td>
					<td><?php echo $s1['tgl_awal']; ?></td>
					<td><?php echo $s1['tgl_akhir']; ?></td>
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

	<?php include '../footer_lap.php'; ?>
	