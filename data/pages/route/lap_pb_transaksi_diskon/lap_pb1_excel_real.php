<?php

include "../../../../config/koneksi.php";
include "../../../../config/fungsi_rupiah.php";
include "../../../../config/library.php";

session_start();

$login_hash = $_SESSION['login_hash'];
$en = $_SESSION['employee_number'];
$to = $_SESSION['to'];
$area_e = $_SESSION['area_e'];
$area_nama = $_SESSION['area_nama'];
$view = 'lap_pb1_detil_view';


$judulform = "Daftar tarif PB1";

$data = 'lap_pb1';
$rute = 'pb1';
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
$f30 = 'faktur_void';
$f31 = 'dibayar';
$f32 = 'no_ref';

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
$j30 = 'faktur_void';
$j31 = 'dibayar';
$j32 = 'no_ref';


$tabel2 = 'kotabaru';
$ff1 = 'kode';
$tabel3 = 'pelanggan';
$gg1 = 'kd_cus';

$tgl_awal = $_GET['tgl_awal'];
$tgl_akhir = $_GET['tgl_akhir'];
$filter = $_GET['filter'];
$nilai = $_GET['nilai'];

if ($login_hash == 8) {
	$judul_area = $area_nama;
} else {
	$judul_area = "";
}

if ($filter == 'kota') {
	$kondisi = "AND pelanggan.kd_kota='$nilai'";
	$query = mysqli_query($koneksi, "SELECT nama FROM kotabaru WHERE kode='$nilai' ");
	$q1 = mysqli_fetch_array($query);
	$judul_nilai = $q1['nama'];
} elseif ($filter == 'outlet') {
	$kondisi = "AND penjualan.kd_cus='$nilai'";
	$query = mysqli_query($koneksi, "SELECT nama FROM pelanggan WHERE kd_cus='$nilai' ");
	$q1 = mysqli_fetch_array($query);
	$judul_nilai = $q1['nama'];
} elseif ($filter == 'area') {
	$kondisi = "AND kotabaru.kd_area='$nilai'";
	$query = mysqli_query($koneksi, "SELECT nama FROM area WHERE kode='$nilai' ");
	$q1 = mysqli_fetch_array($query);
	$judul_nilai = $q1['nama'];
} else {
	$kondisi = "";
	$judul_nilai = '';
}


if ($login_hash == '6' or $login_hash == '7' or $login_hash == '2' or $login_hash == '0') {
	$kondisiJoin = "";

	$query = mysqli_query($koneksi, "SELECT cabang_e,name_e FROM employee WHERE employee_number='$en' ");
	$q1 = mysqli_fetch_array($query);
	$tes = $nilai;
	$nilai = $q1['cabang_e'];
	if ($login_hash == '2' or $login_hash == '0') {
		$nilai = 1316;
	}
	$kondisi = "";
	$query = mysqli_query($koneksi, "SELECT nama FROM pelanggan WHERE kd_cus='$nilai' ");
	$q1 = mysqli_fetch_array($query);
	$judul_nilai = $q1['nama'];
}



$judul = 'Laporan Penjualan Barang Diskon';
$judul3 = 'Periode : ' . $tgl_awal . " s/d " . $tgl_akhir;


$judul = $_GET['judul'];
$judul2 = $filter . " : " . $judul_nilai . $judul_area;
$judul3 = 'Periode : ' . $tgl_awal . " s/d " . $tgl_akhir;


$namafile = $judul . "-" . $tgl_awal . "-sd-" . $tgl_akhir;

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=" . $namafile . ".xls"); //ganti nama sesuai keperluan
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
</head>

<body>
	<!-- <link rel="stylesheet"  href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
		<link rel="stylesheet"  href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css"> -->
	<!-- <div class="container"> -->

	<center>
		<h3><?php echo $judul; ?></h3>
		<br><?php echo $judul3; ?>
	</center>

	<?php if ($login_hash == 6 or $login_hash == 7 or $login_hash == 2 or $login_hash == 0) {
		include 'pb_kasirmanager.php';
	} elseif ($login_hash == 8) {
		include 'pb_mr.php';
	} else {
		include 'pb_admin.php';
	} ?>
	<br>

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
	<!-- Main Footer -->
	<footer class="main-footer bg_primary_1" style="padding:.3rem;font-size:.75rem">

		<!-- Default to the left -->
		<strong>Copyright &copy; 2020-<?php echo $thn_sekarang . " " . $perusahaan; ?>.</strong> by Develop. All rights Reserved.
		<!-- Default to the right -->
		<div class="float-right d-none d-sm-inline">
			<b>Version</b> <?php echo $ver; ?>
		</div>
	</footer>

</body>


</html>