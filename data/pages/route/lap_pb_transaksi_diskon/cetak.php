<?php

include '../../../../config/koneksi.php';
include '../../../../config/fungsi_rupiah.php';
include '../../../../config/library.php';

session_start();


$login_hash = $_SESSION['login_hash'];
$en = $_SESSION['employee_number'];
$to = $_SESSION['to'];
$area_e = $_SESSION['area_e'];
$area_nama = $_SESSION['area_nama'];
$view = 'lap_pb1_detil_view';


$judulform = "Daftar Penjualan";

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


?>

<html>

<head>
	<title>Cetak Lap PB1</title>

	<link rel="stylesheet" type="text/css" href="../style_cetak.css">

</head>

<body style='font-family:tahoma;' onload="javascript:window.printOut()">
	<?php
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

	?>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<div class="container-fluid">
			<center>
				<h4>Laporan Barang Diskon
					<br />Periode : <?php echo $tgl_awal . " s/d " . $tgl_akhir; ?>
				</h4>
			</center>
			<br>tgl cetak : <?php echo $tgl_sekarang; ?>
			<br>
		</div><!-- /.container-fluid -->

		<!-- Main content -->
		<div class="container-fluid">
			<div class="card card-default">
				<!-- /.card-header -->
				<div class="card-body">
					<!-- Main row -->
					<div class="row">
						<!-- Left col -->
						<section class="col-lg-12 connectedSortable">
							<!-- Custom tabs (Charts with tabs)-->
							<div class="box">
								<div class="box-body">
									<div class="table-responsive">
										<div class="table-responsive">

											<div style="margin:10px"></div>

											<?php if ($login_hash == 6 or $login_hash == 7 or $login_hash == 2 or $login_hash == 0) {
												include 'pb_kasirmanager.php';
											} elseif ($login_hash == 8) {
												include 'pb_mr.php';
											} else {
												include 'pb_admin.php';
											} ?>

										</div>

									</div>
								</div><!-- /.box-body -->
							</div><!-- /.box -->
						</section><!-- /.Left col -->
					</div><!-- /.row (main row) -->
				</div>
			</div>
		</div>
		<!-- </section>/.content -->
	</div><!-- /.content-wrapper -->
	<br />

	<?php
	include '../footer_cetak.php';
	?>

</body>
<script>
	var lama = 2000;
	t = null;

	function printOut() {
		window.print();
		t = setTimeout("history.go(-1)", lama);
	}
</script>

</html>