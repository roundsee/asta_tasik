<?php

include "../../../../config/koneksi.php";
include "../../../../config/fungsi_rupiah.php";
include "../../../../config/library.php";

session_start();

$login_hash=$_SESSION['login_hash'];
$en=$_SESSION['employee_number'];

$tgl_awal=$_GET['tgl_awal'];
$tgl_akhir=$_GET['tgl_akhir'];
$filter=$_GET['filter'];
$nilai=$_GET['nilai'];
$judul=$_GET['judul'];

$judulform="Payment POS";

$data='lap_pos';
$rute='payment_pos1';
$aksi='aksi_pos';

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
$j8='PPn';
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


if($filter=='kota'){
	$kondisi="AND pelanggan.kd_kota='$nilai'";
	$query=mysqli_query($koneksi,"SELECT nama FROM kotabaru WHERE kode='$nilai' ");
	$q1=mysqli_fetch_array($query);
	$judul_nilai= $q1['nama'];
}elseif($filter=='outlet'){
	$kondisi="AND penjualan.kd_cus='$nilai'";
	$query=mysqli_query($koneksi,"SELECT nama FROM pelanggan WHERE kd_cus='$nilai' ");
	$q1=mysqli_fetch_array($query);
	$judul_nilai= $q1['nama'];
}elseif($filter=='area'){
	$kondisi="AND kotabaru.kd_area='$nilai'";
	$query=mysqli_query($koneksi,"SELECT nama FROM area WHERE kode='$nilai' ");
	$q1=mysqli_fetch_array($query);
	$judul_nilai= $q1['nama'];
}elseif($filter=='kasir'){
	$kondisi="AND penjualan.oleh='$nilai'";
	$query=mysqli_query($koneksi,"SELECT name_e FROM employee WHERE employee_number='$nilai' ");
	$q1=mysqli_fetch_array($query);
	$judul_nilai= $q1['name_e'];
      
  $kondisi="AND penjualan.oleh='$judul_nilai' ";
}else{
	$kondisi="";
	$judul_nilai='';
}


if($login_hash=='6' OR $login_hash=='7'){
	$filter='Outlet';
	$query=mysqli_query($koneksi,"SELECT cabang_e FROM employee WHERE employee_number='$en' ");
	$q1=mysqli_fetch_array($query);
	$nilai= $q1['cabang_e'];
	$kondisi="AND penjualan.kd_cus='$nilai'";
	$query=mysqli_query($koneksi,"SELECT nama FROM pelanggan WHERE kd_cus='$nilai' ");
	$q1=mysqli_fetch_array($query);
	$judul_nilai= $q1['nama'];
}


$judul=$_GET['judul'];
$judul2=$filter." : ".$judul_nilai;
$judul3='Periode : '.$tgl_awal." s/d ".$tgl_akhir;


header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=".$judul."-".$judul_nilai."-".$tgl_awal."-".$tgl_akhir.".xls");//ganti nama sesuai keperluan
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
				<tr bgcolor="lightgrey">
					<th>No.</th>
					<th>Outlet</th>
					<th>Receipt Ref</th>
					<th>User</th>
					<th>Order Date</th>
					<th style="text-align: right">Jumlah</th>
				</tr>
			</thead>
			<tbody>
				<?php

				$query="SELECT penjualan.subjumlah,penjualan.tarif_pb1,penjualan.jumlah,penjualan.faktur,penjualan.oleh,penjualan.tanggal, 
				pelanggan.nama as p_nama,
				penjualan.jumlah as p_jumlah,
				kotabaru.nama as kb_nama ,
				jenis_transaksi.nama as jt_nama
				FROM penjualan 
				join pelanggan on pelanggan.kd_cus=penjualan.kd_cus
				join kotabaru on kotabaru.kode=pelanggan.kd_kota
				join jenis_transaksi on jenis_transaksi.kd_jenis=penjualan.kd_aplikasi
				WHERE penjualan.tanggal>='$tgl_awal' AND penjualan.tanggal <= '$tgl_akhir' +interval 1 day $kondisi ";


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
					$pb1=$s1['tarif_pb1'];
					$jumlah_pb1=$s1['subjumlah']+($s1['subjumlah']*($pb1/100));
					?>
					<tr align="left">
						<td><?php echo $no; ?></td>
						<td><?php echo $s1['p_nama']; ?></td>
						<td><?php echo $s1[$f1]; ?></td>
						<td><?php echo $s1[$f6]; ?></td>
						<td><?php echo $s1[$f2]; ?></td>
						<td style="text-align: right;"><?php echo ($s1[$f9]);?></td>
					</tr>
					<?php
					$no++;
					$tot_jumlah=$tot_jumlah+$s1[$f9];

				}
				?>
			</tbody>
			<tfoot>
				<tr style="font-weight:800">
					<td colspan="4" style="text-align:right;"> Total :</td>
					<td align="right" colspan="2"><?php echo ($tot_jumlah);?></td>
				</tr>
			</tfoot>

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

