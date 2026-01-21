<?php

include "../../../../config/koneksi.php";
include "../../../../config/fungsi_rupiah.php";
include "../../../../config/library.php";

session_start();

$login_hash=$_SESSION['login_hash'];
$en=$_SESSION['employee_number'];
$tujuan=$_GET['tujuan'];

$judulform="Daftar Diskon";

$data='lap_daftar_diskon';
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
	$kondisi="AND penjualan.kd_cus='$nilai'";
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
	$judul_nilai='';
}

$judul='Daftar Diskon dan Promosi';
$judul2=$filter." : ".$judul_nilai;
$judul3='Periode : '.$tgl_awal." s/d ".$tgl_akhir;

$namafile=$judul."-".$judul_nilai."-".$tgl_awal."-sd-".$tgl_akhir;

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=".$namafile.".xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Cetak Laporan</title>
	<style type="text/css">  
		/* CSS untuk memformat halaman */  
		body {
			
			padding-top: 20px;
			padding-bottom: 40px;

		}
		table {
			border-collapse: collapse;
			font-family:Arial, Helvetica, sans-serif;
			font-size:14px;
		}

		td {
			font-size:12px;
		}

		table, td, th {
			border: 1px solid black;
		}
	</style>
</head>
<body>
	<!-- <link rel="stylesheet"  href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
	<link rel="stylesheet"  href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css"> -->
	<!-- <div class="container"> -->

		<center><h3><?php echo $judul;?></h3>
			<?php echo $judul2;?>
			<br><?php echo $judul3;?></center> 
		</div><!-- /.container-fluid -->
	</section>
	<table id="example" class="table table-bordered table-striped" >
		<thead style="background-color:  gray;" >
			<tr>
				<th>No.</th>
				<th style="width:200px"><?php echo $j1; ?></th>
				<th><?php echo $j3; ?></th>
				<th>Nama Outlet</th>
				<th>Kode Kota</th>
				<th>Nama Kota</th>
				<th><?php echo $j2; ?></th>
				<th>Ket Aplikasi</th>
				<th>Cakupan</th>
				<th>Nama Aplikasi</th>
				<th><?php echo $j7; ?></th>
				<th><?php echo $j8; ?></th>
				<th><?php echo $j9; ?></th>
			</tr>
		</thead>
		<tbody>
			<?php


			$query="SELECT * , pelanggan.nama as p_nama,kotabaru.nama as kb_nama ,jenis_transaksi.nama as jt_nama
			FROM penjualan 
			join pelanggan on pelanggan.kd_cus=penjualan.kd_cus
			join kotabaru on kotabaru.kode=pelanggan.kd_kota
			join jenis_transaksi on jenis_transaksi.kd_jenis=penjualan.kd_aplikasi
			WHERE tanggal>='$tgl_awal' AND tanggal <= '$tgl_akhir' $kondisi ";

			$query="SELECT * , pelanggan.nama as p_nama,kotabaru.nama as kb_nama,jenis_transaksi.nama as jt_nama
			FROM tarif_diskon 
			join pelanggan on pelanggan.kd_cus=tarif_diskon.kd_cus
			join kotabaru on kotabaru.kode=pelanggan.kd_kota
			join jenis_transaksi on jenis_transaksi.kd_jenis=tarif_diskon.kd_jenis
			WHERE tgl_awal>='$tgl_awal' AND tgl_akhir <= '$tgl_akhir' +interval 1 day $kondisi 
			";



			$sql1=mysqli_query($koneksi,$query);
			$no=1;

			$tot_subjumlah=0;
			$tot_ppn=0;
			$tot_jumlah=0;

			$tot_11=0;
			$tot_22=0;
			$tot_33=0;
			$tot_44=0;

			$tot_ofline=0;
			$tot_online=0;


			while($s1=mysqli_fetch_array($sql1))
			{
				?>
				<tr align="left">
					<td><?php echo $no; ?></td>
					<td><?php echo $s1[$f1]; ?></td>
					<td><?php echo $s1[$f3]; ?></td>
					<td><?php echo $s1['p_nama']; ?></td>
					<td><?php echo $s1['kd_kota']; ?></td>
					<td><?php echo $s1['kb_nama']; ?></td>
					<td><?php echo $s1[$f2]; ?></td>
					<td><?php echo $s1[$f10]; ?></td>
					<td style="text-align: center;"><?php echo $s1[$f4]; ?></td>
					<td><?php echo $s1['jt_nama']; ?></td>
					<td style="text-align: right;"><?php echo ($s1[$f7]);?></td>
					<td style="text-align: right;"><?php echo ($s1[$f8]);?></td>
					<td style="text-align: right;"><?php echo ($s1[$f9]);?></td>

				</tr>
				<?php
				$no++;
                              // $tot_subjumlah=$tot_subjumlah+$s1[$f7];
                              // $tot_ppn=$tot_ppn+$s1[$f8];
				$tot_jumlah=$tot_jumlah+$s1[$f9];

				if($s1[$f4]=='11'){
					$tot_11++;
				}
				if($s1[$f4]=='22'){
					$tot_22++;
				}
				if($s1[$f4]=='33'){
					$tot_33++;
				}
				if($s1[$f4]=='44'){
					$tot_44++;
				}

				$tot_online=$tot_22+$tot_33+$tot_44;
				$tot_ofline=$tot_11;

			}
			?>
		</tbody>


	</table>
	<!-- Main Footer -->
		<footer class="main-footer bg_primary_1"  style="padding:.3rem;font-size:.75rem">

			<!-- Default to the left -->
			<strong>Copyright &copy; 2020-<?php echo $thn_sekarang." ".$perusahaan;?>.</strong>  by Develop. All rights Reserved.
			<!-- Default to the right -->
			<div class="float-right d-none d-sm-inline">
				<b>Version</b> <?php echo $ver;?>
			</div>
		</footer>

</body>


</html>

