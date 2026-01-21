<?php

include "../../../../config/koneksi.php";
include "../../../../config/fungsi_rupiah.php";
include "../../../../config/library.php";

session_start();

$login_hash=$_SESSION['login_hash'];
$en=$_SESSION['employee_number'];
$namauser=$_SESSION['namauser'];
$tujuan=$_GET['tujuan'];

$tgl_awal=$_GET['tgl_awal'];
$tgl_akhir=$_GET['tgl_akhir'];
$filter=$_GET['filter'];
$nilai=$_GET['nilai'];
$judul=$_GET['judul'];

$judulform="Rekap Penjualan ";

$data='lap_penjualan';
$rute='rekap_penjualan';
$aksi='aksi_rekap_penjualan';

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

if ($tujuan=='aplikasi') {
	$kondisi2='Aplikasi';
	$kondisi_group=' ,penjualan.kd_aplikasi';
}elseif($tujuan=='carabayar'){
	$kondisi2='Sub Alat Bayar';
	$kondisi_group=' ,penjualan.kdsub_alatbayar';
}elseif($tujuan=='alatbayar'){
	$kondisi2='Alat Bayar';
	$kondisi_group=' ,penjualan.kd_alatbayar';
}elseif($tujuan=='kasir'){
	$kondisi2='Kasir';
	$kondisi_group=' ,penjualan.oleh';
}elseif($tujuan=='outlet'){
	$kondisi2='Outlet';
	$kondisi_group=' ,penjualan.kd_cus';
}else{
	$kondisi2='';
	$kondisi_group='';
}


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

	<center><h3><?php echo $judul;?></h3>
		<?php echo $judul2;?>
		<br><?php echo $judul3;?></center> 
	</div><!-- /.container-fluid -->
</section>
<table id="example" class="table table-bordered table-striped" >
	<thead style="background-color:  lightgray;" class="elevation-2">
		<tr bgcolor="lightgrey">
			<th rowspan="2" style="text-align:center;vertical-align: middle;font-weight: 800;padding-top: 1px;width: 1%;">No.</th>
			<th colspan="2" style="text-align:center;font-weight: 800;padding-top: 1px">Outlet</th>
			<th colspan="2" style="text-align:center;font-weight: 800;padding-top: 1px">Kota</th>
			<?php
			if ($tujuan=='aplikasi') {
				?>
				<th colspan="2" style="text-align:center;font-weight: 800;padding-top: 1px">Aplikasi</th>
				<th rowspan="2" style="text-align:center;vertical-align: middle;font-weight: 800;padding-top: 1px">Penjualan</th>
				<?php 
			}elseif ($tujuan=='kasir') {
				?>
				<th rowspan="2" style="text-align:center;vertical-align: middle;font-weight: 800;padding-top: 1px">Kasir</th>
				<th rowspan="2" style="text-align:center;vertical-align: middle;font-weight: 800;padding-top: 1px">Penjualan</th>
				<?php
			}elseif($tujuan=='carabayar'){
				?>
				<th colspan="2" style="text-align:center;font-weight: 800;padding-top: 1px">Sub Alat Bayar</th>
				<?php
			}elseif($tujuan=='alatbayar'){
				?>
				<th colspan="2" style="text-align:center;font-weight: 800;padding-top: 1px">Alat Bayar</th>
				<?php
			}elseif ($tujuan=='outlet') {
				?>
				<th rowspan="2" style="text-align:center;vertical-align: middle;font-weight: 800;padding-top: 1px">Outlet</th>
				<th rowspan="2" style="text-align:center;vertical-align: middle;font-weight: 800;padding-top: 1px">Penjualan</th>
				<?php
			}
			?>

			<th colspan="3" style="text-align:center;font-weight: 800;padding-top: 1px">Pembayaran</th>
		</tr>

		<tr bgcolor="lightgrey">
			<th style="width:1%;padding-bottom:1px;">Kode</th>
			<th style="padding-bottom:1px;">Nama</th>
			<th style="width:1%;padding-bottom:1px;">Kode</th>
			<th style="padding-bottom:1px;">Nama</th>

			<?php
			if ($tujuan=='aplikasi') {
				?>
				<th style="width:1%;padding-bottom:1px;">Kode</th>
				<th style="padding-bottom:1px;">Nama</th>
				<th style="padding-bottom:1px;">Tunai</th>
				<th style="padding-bottom:1px;">Non Tunai</th>
				<th style="padding-bottom:1px;">Voucher</th>
				<?php 
			}elseif ($tujuan=='kasir') {
				?>
				<th style="padding-bottom:1px;">Tunai</th>
				<th style="padding-bottom:1px;">Non Tunai</th>
				<th style="padding-bottom:1px;">Voucher</th>
				<?php
			}elseif($tujuan=='carabayar'){
				?>
				<th style="width:1%;padding-bottom:1px;">Kode</th>
				<th style="padding-bottom:1px;">Nama</th>
				<th style="padding-bottom:1px;text-align: right;">Tunai</th>
				<th style="padding-bottom:1px;text-align: right;">Non Tunai</th>
				<th style="padding-bottom:1px;">Voucher</th>
				<?php
			}elseif($tujuan=='alatbayar'){
				?>
				<th style="width:1%;padding-bottom:1px;">Kode</th>
				<th style="padding-bottom:1px;">Nama</th>
				<th style="padding-bottom:1px;text-align: right;">Tunai</th>
				<th style="padding-bottom:1px;text-align: right;">Non Tunai</th>
				<th style="padding-bottom:1px;">Voucher</th>
				<?php
			}elseif ($tujuan=='outlet') {
				?>
				<th style="padding-bottom:1px;">Tunai</th>
				<th style="padding-bottom:1px;">Non Tunai</th>
				<th style="padding-bottom:1px;">Voucher</th>
				<?php
			}
			?>

		</tr>
	</thead>
	<tbody>
		<?php

		$query="SELECT penjualan.kd_cus,penjualan.kd_alatbayar ,penjualan.kdsub_alatbayar,penjualan.oleh,pelanggan.kd_kota, 
		pelanggan.nama as p_nama,kotabaru.nama as kb_nama ,jenis_transaksi.nama as jt_nama,alat_bayar.nama as ab_nama,subalat_bayar.nama as sab_nama,penjualan.kd_aplikasi as ka_kode,
		sum(penjualan.jumlah) as rekap_jumlah,
		sum(penjualan.byr_tunai) as rekap_tunai,
		sum(penjualan.byr_non_tunai) as rekap_non_tunai,
		sum(penjualan.byr_pocer) as rekap_pocer
		FROM penjualan 
		join pelanggan on pelanggan.kd_cus=penjualan.kd_cus
		join kotabaru on kotabaru.kode=pelanggan.kd_kota
		join jenis_transaksi on jenis_transaksi.kd_jenis=penjualan.kd_aplikasi
		join alat_bayar on alat_bayar.kd_alat=penjualan.kd_alatbayar
		join subalat_bayar on subalat_bayar.kdsub_alat=penjualan.kdsub_alatbayar
		WHERE tanggal>='$tgl_awal' AND tanggal <= '$tgl_akhir' +interval 1 day $kondisi
		GROUP By pelanggan.kd_kota,pelanggan.kd_cus $kondisi_group
		";

		$sql1=mysqli_query($koneksi,$query);
		$no=1;

		$tot_subjumlah=0;
		$tot_ppn=0;
		$tot_jumlah=0;

		$tot_penjualan=0;
		$tot_byr_tunai=0;
		$tot_byr_non_tunai=0;
		$tot_pocer=0;

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
				<td><?php echo $s1['kd_cus']; ?></td>
				<td><?php echo $s1['p_nama']; ?></td>
				<td><?php echo $s1['kd_kota']; ?></td>
				<td><?php echo $s1['kb_nama']; ?></td>

				<?php
				if ($tujuan=='aplikasi') {
					?>
					<td style="text-align: center;"><?php echo $s1['ka_kode']; ?></td>
					<td><?php echo $s1['jt_nama']; ?></td>
					<td style="text-align: right;"><?php echo ($s1['rekap_jumlah']);?></td>
					<td style="text-align: right;"><?php echo ($s1['rekap_tunai']);?></td>
					<td style="text-align: right;"><?php echo ($s1['rekap_non_tunai']);?></td>
					<td style="text-align: right;"><?php echo ($s1['rekap_pocer']);?></td>
					<?php 
				}elseif ($tujuan=='kasir') {
					?>
					<td><?php echo $s1['oleh']; ?></td>
					<td style="text-align: right;"><?php echo ($s1['rekap_jumlah']);?></td>
					<td style="text-align: right;"><?php echo ($s1['rekap_tunai']);?></td>
					<td style="text-align: right;"><?php echo ($s1['rekap_non_tunai']);?></td>
					<td style="text-align: right;"><?php echo ($s1['rekap_pocer']);?></td>
					<?php
				}elseif($tujuan=='carabayar'){
					?>
					<td style="text-align: center;"><?php echo $s1['kdsub_alatbayar']; ?></td>
					<td><?php echo $s1['sab_nama']; ?></td>
					<td style="text-align: right;"><?php echo ($s1['rekap_tunai']);?></td>
					<td style="text-align: right;"><?php echo ($s1['rekap_non_tunai']);?></td>
					<td style="text-align: right;"><?php echo ($s1['rekap_pocer']);?></td>
					<?php
				}elseif($tujuan=='alatbayar'){
					?>
					<td style="text-align: center;"><?php echo $s1['kd_alatbayar']; ?></td>
					<td><?php echo $s1['ab_nama']; ?></td>
					<td style="text-align: right;"><?php echo ($s1['rekap_tunai']);?></td>
					<td style="text-align: right;"><?php echo ($s1['rekap_non_tunai']);?></td>
					<td style="text-align: right;"><?php echo ($s1['rekap_pocer']);?></td>
					<?php
				}elseif ($tujuan=='outlet') {
					?>
					<td><?php echo $s1['p_nama']; ?></td>
					<td style="text-align: right;"><?php echo ($s1['rekap_jumlah']);?></td>
					<td style="text-align: right;"><?php echo ($s1['rekap_tunai']);?></td>
					<td style="text-align: right;"><?php echo ($s1['rekap_non_tunai']);?></td>
					<td style="text-align: right;"><?php echo ($s1['rekap_pocer']);?></td>
					<?php
				}
				?>

			</tr>
			<?php
			$no++;

		}
		?>
	</tbody>
			<!-- <tfoot>
				<tr style="font-weight:800">
					<td colspan="4" style="text-align:right;"> Total :</td>
					<td align="right" colspan="2"><?php echo format_rupiah($tot_jumlah);?></td>
				</tr>
			</tfoot> -->

		</table>

		<br>
		<?php 
		if ($tujuan=='aplikasi'){ ?>

			<div style="font-weight:600;font-size:115%">
				SUMMARY REPORT Per APLIKASI
			</div>

			<table id="example" class="table table-bordered table-striped" style="width:600px">
				<thead style="background-color:  lightgray;" class="elevation-2">
					<tr bgcolor="lightgrey">
						<th colspan="2">Uraian</th>
						<th>Penjualan</th>
						<th style="text-align:right;">Pembayaran<br>Tunai</th>
						<th style="text-align:right;">Pembayaran<br>non Tunai</th>
						<th style="text-align:right;">Pembayaran<br>Voucher</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$query="SELECT pelanggan.nama as p_nama,kotabaru.nama as kb_nama ,jenis_transaksi.nama as jt_nama,alat_bayar.nama as ab_nama,subalat_bayar.nama as sab_nama,penjualan.kd_aplikasi as ka_kode,
					sum(penjualan.jumlah) as rekap_jumlah,
					sum(penjualan.byr_tunai) as rekap_tunai,
					sum(penjualan.byr_non_tunai) as rekap_non_tunai,
					sum(penjualan.byr_pocer) as rekap_pocer
					FROM penjualan 
					join pelanggan on pelanggan.kd_cus=penjualan.kd_cus
					join kotabaru on kotabaru.kode=pelanggan.kd_kota
					join jenis_transaksi on jenis_transaksi.kd_jenis=penjualan.kd_aplikasi
					join alat_bayar on alat_bayar.kd_alat=penjualan.kd_alatbayar
					join subalat_bayar on subalat_bayar.kdsub_alat=penjualan.kdsub_alatbayar
					WHERE tanggal>='$tgl_awal' AND tanggal <= '$tgl_akhir' +interval 1 day $kondisi
					GROUP By penjualan.kd_aplikasi
					";

					$sql1=mysqli_query($koneksi,$query);

					$tot_rekap_jumlah=0;
					$tot_rekap_tunai=0;
					$tot_rekap_non_tunai=0;
					$tot_rekap_pocer=0;

					while($s1=mysqli_fetch_array($sql1))
					{
						$tot_rekap_jumlah=$tot_rekap_jumlah+$s1['rekap_jumlah'];
						$tot_rekap_tunai=$tot_rekap_tunai+$s1['rekap_tunai'];
						$tot_rekap_non_tunai=$tot_rekap_non_tunai+$s1['rekap_non_tunai'];
						$tot_rekap_pocer=$tot_rekap_pocer+$s1['rekap_pocer'];
						?>

						<tr>
							<td colspan="2" width="200px;"><?php echo $s1['jt_nama'];?></td>
							<td align="right"><?php echo ($s1['rekap_jumlah']);?></td>
							<td align="right"><?php echo ($s1['rekap_tunai']);?></td>
							<td align="right"><?php echo ($s1['rekap_non_tunai']);?></td>
							<td align="right"><?php echo ($s1['rekap_pocer']);?></td>
						</tr>

						<?php

					}

					?>
				</tbody>
				<tr style="font-weight:700">
					<td colspan="2" width="200px" >Total Rekap </td>
					<td align="right"><?php echo ($tot_rekap_jumlah);?></td>
					<td align="right"><?php echo ($tot_rekap_tunai);?></td>
					<td align="right"><?php echo ($tot_rekap_non_tunai);?></td>
					<td align="right"><?php echo ($tot_rekap_pocer);?></td>
				</tr>
			</table>
		<?php } ?>

		<br>

		<div style="font-weight:600;font-size:115%">
			SUMMARY REPORT SUB ALAT BAYAR
		</div>

		<table id="example" class="table table-bordered table-striped" style="width:600px">
			<thead style="background-color:  lightgray;" class="elevation-2">
				<tr bgcolor="lightgrey">
					<th colspan="2">Uraian</th>
					<th>Penjualan</th>
					<th style="text-align:right;">Pembayaran<br>Tunai</th>
					<th style="text-align:right;">Pembayaran<br>non Tunai</th>
					<th style="text-align:right;">Pembayaran<br>Voucher</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$query="SELECT pelanggan.nama as p_nama,kotabaru.nama as kb_nama ,jenis_transaksi.nama as jt_nama,alat_bayar.nama as ab_nama,subalat_bayar.nama as sab_nama,penjualan.kd_aplikasi as ka_kode,
				sum(penjualan.jumlah) as rekap_jumlah,
				sum(penjualan.byr_tunai) as rekap_tunai,
				sum(penjualan.byr_non_tunai) as rekap_non_tunai,
				sum(penjualan.byr_pocer) as rekap_pocer
				FROM penjualan 
				join pelanggan on pelanggan.kd_cus=penjualan.kd_cus
				join kotabaru on kotabaru.kode=pelanggan.kd_kota
				join jenis_transaksi on jenis_transaksi.kd_jenis=penjualan.kd_aplikasi
				join alat_bayar on alat_bayar.kd_alat=penjualan.kd_alatbayar
				join subalat_bayar on subalat_bayar.kdsub_alat=penjualan.kdsub_alatbayar
				WHERE tanggal>='$tgl_awal' AND tanggal <= '$tgl_akhir' +interval 1 day $kondisi
				GROUP By penjualan.kdsub_alatbayar
				";

				$sql1=mysqli_query($koneksi,$query);

				$tot_rekap_jumlah=0;
				$tot_rekap_tunai=0;
				$tot_rekap_non_tunai=0;
				$tot_rekap_pocer=0;

				while($s1=mysqli_fetch_array($sql1))
				{
					$tot_rekap_jumlah=$tot_rekap_jumlah+$s1['rekap_jumlah'];
					$tot_rekap_tunai=$tot_rekap_tunai+$s1['rekap_tunai'];
					$tot_rekap_non_tunai=$tot_rekap_non_tunai+$s1['rekap_non_tunai'];
					$tot_rekap_pocer=$tot_rekap_pocer+$s1['rekap_pocer'];
					?>

					<tr>
						<td colspan="2" width="200px"><?php echo $s1['sab_nama'];?></td>
						<td align="right"><?php echo ($s1['rekap_jumlah']);?></td>
						<td align="right"><?php echo ($s1['rekap_tunai']);?></td>
						<td align="right"><?php echo ($s1['rekap_non_tunai']);?></td>
						<td align="right"><?php echo ($s1['rekap_pocer']);?></td>
					</tr>

					<?php

				}

				?>
			</tbody>
			<tr style="font-weight:700;background-color:lightgreen;">
				<td colspan="2" width="200px" >Total Rekap </td>
				<td align="right"><?php echo ($tot_rekap_jumlah);?></td>
				<td align="right"><?php echo ($tot_rekap_tunai);?></td>
				<td align="right"><?php echo ($tot_rekap_non_tunai);?></td>
				<td align="right"><?php echo ($tot_rekap_pocer);?></td>
			</tr>
		</table>
		<br>

		<div style="font-weight:600;font-size:115%">
			SUMMARY REPORT ALAT BAYAR
		</div>

		<table id="example" class="table table-bordered table-striped" style="width:600px">
			<thead style="background-color:  lightgray;" class="elevation-2">
				<tr bgcolor="lightgrey">
					<th colspan="2">Uraian</th>
					<th>Penjualan</th>
					<th style="text-align:right;">Pembayaran<br>Tunai</th>
					<th style="text-align:right;">Pembayaran<br>non Tunai</th>
					<th style="text-align:right;">Pembayaran<br>Voucher</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$query="SELECT pelanggan.nama as p_nama,kotabaru.nama as kb_nama ,jenis_transaksi.nama as jt_nama,alat_bayar.nama as ab_nama,subalat_bayar.nama as sab_nama,penjualan.kd_aplikasi as ka_kode,
				sum(penjualan.jumlah) as rekap_jumlah,
				sum(penjualan.byr_tunai) as rekap_tunai,
				sum(penjualan.byr_non_tunai) as rekap_non_tunai,
				sum(penjualan.byr_pocer) as rekap_pocer
				FROM penjualan 
				join pelanggan on pelanggan.kd_cus=penjualan.kd_cus
				join kotabaru on kotabaru.kode=pelanggan.kd_kota
				join jenis_transaksi on jenis_transaksi.kd_jenis=penjualan.kd_aplikasi
				join alat_bayar on alat_bayar.kd_alat=penjualan.kd_alatbayar
				join subalat_bayar on subalat_bayar.kdsub_alat=penjualan.kdsub_alatbayar
				WHERE tanggal>='$tgl_awal' AND tanggal <= '$tgl_akhir' +interval 1 day $kondisi
				GROUP By penjualan.kd_alatbayar
				";

				$sql1=mysqli_query($koneksi,$query);

				$tot_rekap_jumlah=0;
				$tot_rekap_tunai=0;
				$tot_rekap_non_tunai=0;
				$tot_rekap_pocer=0;

				while($s1=mysqli_fetch_array($sql1))
				{
					$tot_rekap_jumlah=$tot_rekap_jumlah+$s1['rekap_jumlah'];
					$tot_rekap_tunai=$tot_rekap_tunai+$s1['rekap_tunai'];
					$tot_rekap_non_tunai=$tot_rekap_non_tunai+$s1['rekap_non_tunai'];
					$tot_rekap_pocer=$tot_rekap_pocer+$s1['rekap_pocer'];
					?>

					<tr>
						<td colspan="2" width="200px"><?php echo $s1['ab_nama'];?></td>
						<td align="right"><?php echo ($s1['rekap_jumlah']);?></td>
						<td align="right"><?php echo ($s1['rekap_tunai']);?></td>
						<td align="right"><?php echo ($s1['rekap_non_tunai']);?></td>
						<td align="right"><?php echo ($s1['rekap_pocer']);?></td>
					</tr>

					<?php

				}

				?>
			</tbody>
			<tr style="font-weight:700;background-color:lightgreen;">
				<td colspan="2" width="200px" >Total Rekap </td>
				<td align="right"><?php echo ($tot_rekap_jumlah);?></td>
				<td align="right"><?php echo ($tot_rekap_tunai);?></td>
				<td align="right"><?php echo ($tot_rekap_non_tunai);?></td>
				<td align="right"><?php echo ($tot_rekap_pocer);?></td>
			</tr>
		</table>
		<br>

		<!-- Main Footer -->
		<footer class="main-footer" style="padding:.3rem;font-size:.75rem;">
			

			<!-- Default to the left -->
			<strong>Copyright &copy; 2020-<?php echo $thn_sekarang." ".$perusahaan;?>.</strong>  by Develop. All rights Reserved.
			<!-- Default to the right -->
			<div class="float-right d-none d-sm-inline">
				<b>Version</b> <?php echo $ver;?>
			</div>

		</footer>

	</body>


	</html>

