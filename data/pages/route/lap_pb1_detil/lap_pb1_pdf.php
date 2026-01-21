<?php ob_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Cetak Laporan Transaksi Akupuntur</title>
	<link rel="shortcut icon" href="../img/laporan.png">
	<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link rel="stylesheet" type="text/css" href="../css/laporan.css">


</head>
<style type="text/css">
	/* CSS untuk memformat halaman */
	body {

		padding-top: 20px;
		padding-bottom: 40px;

	}

	table {
		border-collapse: collapse;
		font-family: Arial, Helvetica, sans-serif;
		font-size: 14px;
	}

	td {
		font-size: 12px;
	}

	table,
	td,
	th {
		border: 1px solid black;
	}
</style>

<body>
	<?php

	// start_session();
	$dir = "../../../../";
	include $dir . "config/koneksi.php";
	include $dir . "config/library.php";
	include $dir . "config/fungsi_indotgl.php";
	include $dir . "config/fungsi_rupiah.php";

	$judulform = "Daftar tarif PB1";

	$data = 'lap_pb1_detil';
	$rute = 'pb1_detil';
	$aksi = 'aksi_pb1';

	$tabel = "penjualan";
	$f1 = 'faktur';
	$f2 = 'tanggal';
	$f3 = 'kd_cus';
	$f4 = 'kd_aplikasi';
	$f5 = 'no_meja';
	$f6 = 'oleh';
	$f7 = 'subjumlah';
	$f8 = 'ppn';
	$f9 = 'jumlah';
	$f10 = 'byr_pocer';
	$f11 = 'byr_tunai';
	$f12 = 'byr_non_tunai';
	$f13 = 'kd_alatbayar';
	$f14 = 'no_urut';
	$f15 = 'tahun';
	$f16 = 'bulan';
	$f17 = 'jam';
	$f18 = 'kdsub_alatbayar';
	$f19 = 'subjumlah_offline';
	$f20 = 'ket_aplikasi';
	$f21 = 'dasar_fee';
	$f22 = 'acuan_fee';
	$f23 = 'tarif_fee';
	$f24 = 'b_packing';
	$f25 = 'no_online';
	$f26 = 'no_ofline';
	$f27 = 'tarif_pb1';
	$f28 = 'faktur_refund';
	$f29 = 'dasar_faktur';

	$j1 = 'Faktur';
	$j2 = 'Tanggal';
	$j3 = 'Kode Outlet';
	$j4 = 'kd_aplikasi';
	$j5 = 'no_meja';
	$j6 = 'oleh';
	$j7 = 'Sub jumlah';
	$j8 = 'PB1';
	$j9 = 'Jumlah';
	$j10 = 'byr_pocer';
	$j11 = 'byr_tunai';
	$j12 = 'byr_non_tunai';
	$j13 = 'kd_alatbayar';
	$j14 = 'no_urut';
	$j15 = 'tahun';
	$j16 = 'bulan';
	$j17 = 'jam';
	$j18 = 'kdsub_alatbayar';
	$j19 = 'subjumlah_offline';
	$j20 = 'ket_aplikasi';
	$j21 = 'dasar_fee';
	$j22 = 'acuan_fee';
	$j23 = 'tarif_fee';
	$j24 = 'b_packing';
	$j25 = 'no_online';
	$j26 = 'no_ofline';
	$j27 = 'tarif_pb1';
	$j28 = 'faktur_refund';
	$j29 = 'dasar_faktur';


	$tabel2 = 'kotabaru';
	$ff1 = 'kode';
	$tabel3 = 'pelanggan';
	$gg1 = 'kd_cus';

	$tgl_awal = $_GET['tgl_awal'];
	$tgl_akhir = $_GET['tgl_akhir'];
	$filter = $_GET['filter'];
	$nilai = $_GET['nilai'];

	// echo "<br/>".$tgl_awal;
	// echo "<br/>".$tgl_akhir;
	// echo "<br/>".$filter;
	// echo "<br/>".$nilai;

	if ($filter == 'kota') {
		$kondisi = "AND pelanggan.kd_kota='$nilai'";
		$query = mysqli_query($koneksi, "SELECT * FROM kotabaru WHERE kode='$nilai' ");
		$q1 = mysqli_fetch_array($query);
		$judul_nilai = $q1['nama'];
	} elseif ($filter == 'outlet') {
		$kondisi = "AND penjualan.kd_cus='$nilai'";
		$query = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE kd_cus='$nilai' ");
		$q1 = mysqli_fetch_array($query);
		$judul_nilai = $q1['nama'];
	} elseif ($filter == 'area') {
		$kondisi = "AND kotabaru.kd_area='$nilai'";
		$query = mysqli_query($koneksi, "SELECT * FROM area WHERE kode='$nilai' ");
		$q1 = mysqli_fetch_array($query);
		$judul_nilai = $q1['nama'];
	} else {
		$kondisi = "";
		$judul_nilai = '';
	}

	// include '../header_lap.php';
	?>

	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
	<!-- <div class="container"> -->

	<section class="content-header  wow fadeInDown" data-wow-duration=".3s" data-wow-delay=".3s">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="list-gds">
						<b><?php echo $judulform; ?></b> <small>report</small>

					</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="main.php?route=home">Beranda</a></li>
						<li class="breadcrumb-item active">Laporan</li>
						<li class="breadcrumb-item active"><?php echo $judulform; ?></li>
					</ol>
				</div>

			</div>
			<!-- <button class="btn btn-primary btn-sm elevation-2 " style="opacity: .7;" onclick="window.location='route/<?php echo $data; ?>/cetak.php?tgl_awal=<?php echo $tgl_awal; ?>&tgl_akhir=<?php echo $tgl_akhir; ?>&filter=<?php echo $filter; ?>&nilai=<?php echo $nilai; ?>'"><i class="fa fa-plus";></i> Cetak PB1</button> -->

			<br>
			<center>
				<h4>Laporan Omset dan PB1
					<h5><?php echo $filter . " : " . $judul_nilai; ?></h5>
					Periode : <?php echo $tgl_awal . " s/d " . $tgl_akhir; ?>
				</h4>
			</center>
		</div><!-- /.container-fluid -->
	</section>
	<table id="example" class="table table-bordered table-striped">
		<thead style="background-color:  lightgray;" class="elevation-2">
			<tr>
				<th>No.</th>
				<th><?php echo $j3; ?></th>
				<th>Nama Outlet</th>
				<th>Kode Kota</th>
				<th>Nama Kota</th>
				<th><?php echo $j2; ?></th>
				<th><?php echo $j1; ?></th>
				<th>Ket Aplikasi</th>
				<th>Kode Aplikasi</th>
				<th>Nama Aplikasi</th>
				<th><?php echo $j7; ?></th>
				<th><?php echo $j8; ?></th>
				<th><?php echo $j9; ?></th>
			</tr>
		</thead>
		<tbody>
			<?php


			$query = "SELECT * , pelanggan.nama as p_nama,kotabaru.nama as kb_nama ,jenis_transaksi.nama as jt_nama
					FROM penjualan 
					join pelanggan on pelanggan.kd_cus=penjualan.kd_cus
					join kotabaru on kotabaru.kode=pelanggan.kd_kota
					join jenis_transaksi on jenis_transaksi.kd_jenis=penjualan.kd_aplikasi
					WHERE tanggal>='$tgl_awal' AND tanggal <= '$tgl_akhir' +interval 1 day $kondisi ";



			$sql1 = mysqli_query($koneksi, $query);
			$no = 1;

			$tot_subjumlah = 0;
			$tot_ppn = 0;
			$tot_jumlah = 0;

			$tot_11 = 0;
			$tot_22 = 0;
			$tot_33 = 0;
			$tot_44 = 0;

			$tot_ofline = 0;
			$tot_online = 0;


			while ($s1 = mysqli_fetch_array($sql1)) {
			?>
				<tr align="left">
					<td><?php echo $no; ?></td>
					<td><?php echo $s1[$f3]; ?></td>
					<td><?php echo $s1['p_nama']; ?></td>
					<td><?php echo $s1['kd_kota']; ?></td>
					<td><?php echo $s1['kb_nama']; ?></td>
					<td><?php echo $s1[$f2]; ?></td>
					<td><?php echo $s1[$f1]; ?></td>
					<td><?php echo $s1[$f20]; ?></td>
					<td style="text-align: center;"><?php echo $s1[$f4]; ?></td>
					<td><?php echo $s1['jt_nama']; ?></td>
					<td style="text-align: right;"><?php echo number_format($s1[$f7]); ?></td>
					<td style="text-align: right;"><?php echo number_format($s1[$f8]); ?></td>
					<td style="text-align: right;"><?php echo number_format($s1[$f9]); ?></td>

				</tr>
			<?php
				$no++;
				$tot_subjumlah = $tot_subjumlah + $s1[$f7];
				$tot_ppn = $tot_ppn + $s1[$f8];
				$tot_jumlah = $tot_jumlah + $s1[$f9];

				if ($s1[$f4] == '11') {
					$tot_11++;
				}
				if ($s1[$f4] == '22') {
					$tot_22++;
				}
				if ($s1[$f4] == '33') {
					$tot_33++;
				}
				if ($s1[$f4] == '44') {
					$tot_44++;
				}

				$tot_online = $tot_22 + $tot_33 + $tot_44;
				$tot_ofline = $tot_11;
			}
			?>
		</tbody>
		<tfoot>
			<tr style="font-weight:800">
				<td colspan="10" style="text-align:right;"> Total :</td>
				<td><?php echo number_format($tot_subjumlah); ?></td>
				<td><?php echo number_format($tot_ppn); ?></td>
				<td><?php echo number_format($tot_jumlah); ?></td>
			</tr>
		</tfoot>

	</table>
	<hr>
	<div>
		SUMMARY REPORT
	</div>
	<table style="background-color:beige;font-weight:700">
		<tr>
			<td style="width:200px"> Total</td>
			<td style="width:30px">:</td>
			<td style="text-align:right;"><?php echo number_format($tot_subjumlah); ?></td>
		</tr>
		<tr>
			<td> Total PB1</td>
			<td>:</td>
			<td style="text-align:right;"><?php echo number_format($tot_ppn); ?></td>
		</tr>

		<tr>
			<td> Total setelah Pajak</td>
			<td>:</td>
			<td style="text-align:right;"><?php echo number_format($tot_jumlah); ?></td>
		</tr>

		<tr>
			<td>.</td>
		</tr>

		<tr>
			<td>Total OFF Line </td>
			<td>:</td>
			<td><?php echo $tot_ofline; ?></td>
		</tr>
		<tr>
			<td>Total ON Line </td>
			<td>:</td>
			<td><?php echo $tot_online; ?></td>
		</tr>
		<tr>
			<td>.</td>
		</tr>
		<tr>
			<td>Total Dine In</td>
			<td>:</td>
			<td><?php echo $tot_11; ?></td>
		</tr>
		<tr>
			<td>Total Aplikasi Shoppe</td>
			<td>:</td>
			<td><?php echo $tot_22; ?></td>
		</tr>
		<tr>
			<td>Total Aplikasi Grab</td>
			<td>:</td>
			<td><?php echo $tot_33; ?></td>
		</tr>
		<tr>
			<td>Total Aplikasi GoJek</td>
			<td>:</td>
			<td><?php echo $tot_44; ?></td>
		</tr>


	</table>
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
			$('#example').DataTable({
				dom: 'Bfrtip',
				buttons: [
					'copy', 'csv', 'excel', 'pdf', 'print'
				]
			});
		});
	</script>


</body>


</html>


<?php
$html = ob_get_contents();
ob_end_clean();
$date = date('d-m-Y H:i:s');
require_once('../../../../assets/pdf/html2pdf.class.php');
$pdf = new HTML2PDF('L', 'A4', 'en');
$pdf->WriteHTML($html);
$pdf->Output("lap-trans-Acu-detail-" . $tgl_awal . "-" . $tgl_akhir . "-" . ".pdf", "D");
?>