<?php

include "../../../../config/koneksi.php";
include "../../../../config/fungsi_rupiah.php";
include "../../../../config/fungsi_indotgl.php";


$judulform="Daftar Voucher";

$data='lap_rekap';
$rute='daftar_vocuher';
$aksi='aksi_daftar_voucher';

$tabel="pocer";
$f1='no_pocer';
$f2='cakupan';
$f3='nilai';
$f4='harga_jual';
$f5='tgl_terbit';
$f6='tgl_daluarsa';
$f7='keterangan';

$j1='No Voucher';
$j2='Cakupan';
$j3='Nilai';
$j4='Harga Jual';
$j5='Tgl Terbit';
$j6='Tgl Daluarsa';
$j7='Keterangan';

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

if ($tujuan=='terbit') {
	$kondisi2=' Terbit';
	$kondisi_join='';
	$kondisi_voucher='';


}elseif($tujuan=='blm'){
	$kondisi2=' Belum di Gunakan';
	$kondisi_join='';
	$kondisi_voucher=' AND pocer.status = 0';

}elseif($tujuan=='sdh'){
	$kondisi2=' Sudah di Gunakan';
	$kondisi_join=' JOIN jualdetilpocer  ON jualdetilpocer.noseri_pocer= pocer.no_pocer 
	JOIN pelanggan ON pelanggan.kd_cus=jualdetilpocer.kd_cus';
	$kondisi_voucher=' AND pocer.status = 1';
	
}else{
	$kondisi2='';
	$kondisi_join='';
	$kondisi_voucher='';
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

$judul='Laporan Daftar Voucher '.$kondisi2;
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

			<center><h4><?php echo $judul;?>
			<h5><?php echo $judul2;?></h5>
			<?php echo $judul3;?></h4></center> 
		</div><!-- /.container-fluid -->
	</section>

	<table id="example" class="table table-bordered table-striped">
		<thead style="background-color:  lightgray;" class="elevation-2">
			<tr>
				<th style="width:20px;padding-bottom:1px;">No</th>
				<?php if($tujuan=='sdh'){ ?>
				<th style="width:220px;padding-bottom:1px;">No Invoice</th>
				<th style="width:220px;padding-bottom:1px;">Outlet</th>
				<th style="width:220px;padding-bottom:1px;">Tanggal</th>
			<?php }?>
				<th style="width:220px;padding-bottom:1px;">No Voucher</th>
				<th style="padding-bottom:1px;">Cakupan</th>
				<th style="width:1%;padding-bottom:1px;">Nilai</th>
				<th style="padding-bottom:1px;">Harga Jual</th>
				<th style="padding-bottom:1px;">Tgl Terbit</th>
				<th style="padding-bottom:1px;">Tgl Daluarsa</th>
				<th style="padding-bottom:1px;">Keterangan</th>
				<th style="padding-bottom:1px;">Status</th>
			</tr>
		</thead>
		<tbody>
			<?php


			// $query="SELECT * FROM pocer 
			// $kondisi_join
			// WHERE tgl_terbit>='$tgl_awal' AND tgl_daluarsa >= '$tgl_akhir' +interval 1 day  AND approve='1' $kondisi $kondisi_voucher
			// ";

			$query="SELECT * FROM pocer 
			$kondisi_join
			WHERE tgl_terbit>='$tgl_awal' AND tgl_daluarsa >= '$tgl_akhir' +interval 1 day  AND approve='1' $kondisi_voucher
			";


			$sql1=mysqli_query($koneksi,$query);
			$no=1;

			while($s1=mysqli_fetch_array($sql1))
			{
				if($s1['status']==0){
					$nilai_status='Belum';
				}else{
					$nilai_status='Sudah';
				}
				
				?>
				<tr align="left">
					<td><?php echo $no; ?></td>
				<?php if($tujuan=='sdh'){ ?>
					<td><?php echo $s1['faktur']; ?></td>
					<td><?php echo $s1['nama']; ?></td>
					<td><?php echo tgl_indo_short($s1['tanggal']); ?></td>
				<?php } ?>
					<td><?php echo $s1['no_pocer']; ?></td>
					<td><?php echo $s1['cakupan']; ?></td>
					<td align="right"><?php echo number_format($s1['nilai']); ?></td>
					<td align="right"><?php echo number_format($s1['harga_jual']); ?></td>
					<td><?php echo $s1['tgl_terbit']; ?></td>
					<td><?php echo $s1['tgl_daluarsa']; ?></td>
					<td><?php echo $s1['keterangan']; ?></td>
					<td><?php echo $nilai_status; ?></td>
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

	<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
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
	</script> -->

	<?php include '../footer_lap.php'; ?>
	
