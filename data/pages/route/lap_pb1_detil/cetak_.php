<?php

include '../../../../config/koneksi.php';
include '../../../../config/fungsi_rupiah.php';
include '../../../../config/library.php';

session_start();

$login_hash = $_SESSION['login_hash'];
$en = $_SESSION['employee_number'];

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

<body style='font-family:tahoma;' onload="javascript:window.print()">
	<?php

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

	if ($login_hash == '6' or $login_hash == '7') {
		$filter = 'Outlet';
		$query = mysqli_query($koneksi, "SELECT cabang_e FROM employee WHERE employee_number='$en' ");
		$q1 = mysqli_fetch_array($query);
		$nilai = $q1['cabang_e'];
		$kondisi = "AND penjualan.kd_cus='$nilai'";
		$query = mysqli_query($koneksi, "SELECT nama FROM pelanggan WHERE kd_cus='$nilai' ");
		$q1 = mysqli_fetch_array($query);
		$judul_nilai = $q1['nama'];
	}

	?>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<div class="container-fluid">
			<center>
				<h4>Laporan Omset dan PB1
					<br><?php echo $filter . " : " . $judul_nilai; ?>
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

										<table border="1" id="example1" class="table table-bordered table-striped">
											<thead style="background-color:  lightgray;" class="elevation-2">
												<tr>
													<th>No.</th>
													<th width="180px">Nama Outlet</th>
													<th width="150px">Nama Kota</th>
													<th width="180px"><?php echo $j2; ?></th>
													<th width="160px"><?php echo $j1; ?></th>
													<th>Ket Aplikasi</th>
													<th>Kode Aplikasi</th>
													<th width="140px">Nama Aplikasi</th>
													<th><?php echo $j7; ?></th>
													<th><?php echo $j8; ?></th>
													<th><?php echo $j9; ?></th>
												</tr>
											</thead>
											<tbody>
												<?php

												$query = "SELECT 
												faktur,tanggal,kd_aplikasi,subjumlah,ppn,jumlah,ket_aplikasi, pelanggan.nama as p_nama,kotabaru.nama as kb_nama ,jenis_transaksi.nama as jt_nama
												FROM penjualan 
												join pelanggan on pelanggan.kd_cus=penjualan.kd_cus
												join kotabaru on kotabaru.kode=pelanggan.kd_kota
												join jenis_transaksi on jenis_transaksi.kd_jenis=penjualan.kd_aplikasi
												WHERE tanggal>='$tgl_awal' AND tanggal <= '$tgl_akhir'  +interval 1 day $kondisi ";

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
														<td style="width: 140pt;"><?php echo $s1['p_nama']; ?></td>
														<td style="width: 140pt;"><?php echo $s1['kb_nama']; ?></td>
														<td style="width: 140pt;"><?php echo $s1['tanggal']; ?></td>
														<td style="width: 140pt;"><?php echo $s1['faktur']; ?></td>
														<td><?php echo $s1[$f20]; ?></td>
														<td style="text-align: center;"><?php echo $s1[$f4]; ?></td>
														<td style="width: 140pt;"><?php echo $s1['jt_nama']; ?></td>
														<td style="text-align: right;"><?php echo format_rupiah($s1['subjumlah']); ?></td>
														<!-- <td style="text-align: right;"><?php echo format_rupiah($s1['subjumlah'] * 0.1); ?></td>
															<td style="text-align: right;"><?php echo format_rupiah($s1['subjumlah'] * 1.1); ?></td> -->

														<td style="text-align: right;"><?php echo format_rupiah($s1['ppn']); ?></td>
														<td style="text-align: right;"><?php echo format_rupiah($s1['jumlah']); ?></td>

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
											<tr style="font-weight:800">
												<td colspan="8" style="text-align:right;"> Total :</td>
												<td style="text-align:right;width: 100pt;"><?php echo format_rupiah($tot_subjumlah); ?></td>
												<!-- <td style="text-align:right;width: 100pt;"><?php echo format_rupiah($tot_subjumlah * 0.1); ?></td>
													<td style="text-align:right;width: 100pt;"><?php echo format_rupiah($tot_subjumlah * 1.1); ?></td> -->

												<td style="text-align:right;width: 100pt;"><?php echo format_rupiah($tot_ppn); ?></td>
												<td style="text-align:right;width: 100pt;"><?php echo format_rupiah($tot_jumlah); ?></td>
											</tr>
										</table>

										<br />

										<div>
											SUMMARY REPORT
										</div>

										<table id="example" border="1" cellspacing="0" class="table table-bordered table-striped" style="width:600px">
											<thead style="background-color:  lightgray;" class="elevation-2">
												<th>Uraian</th>
												<th>Banyak</th>
												<th style="text-align:right;">Sub Jumlah</th>
												<th style="text-align:right;">Pajak</th>
												<th style="text-align:right;">Jumlah & Pajak</th>
											</thead>
											<tbody>
												<?php
												$query = "SELECT  
													pelanggan.nama as p_nama,kotabaru.nama as kb_nama ,jenis_transaksi.nama as jt_nama,
													sum(penjualan.jumlah) as pj_jumlah,
													count(penjualan.jumlah) as count_jumlah,
													sum(penjualan.subjumlah) as pj_subjumlah,
													sum(penjualan.ppn) as pj_ppn
													FROM penjualan 
													join pelanggan on pelanggan.kd_cus=penjualan.kd_cus
													join kotabaru on kotabaru.kode=pelanggan.kd_kota
													join jenis_transaksi on jenis_transaksi.kd_jenis=penjualan.kd_aplikasi
													WHERE (tanggal between '$tgl_awal' and '$tgl_akhir'  +interval 1 day) $kondisi 
													group by jenis_transaksi.kd_jenis
													";

												$sql1 = mysqli_query($koneksi, $query);
												$tot_rekap_ppn = 0;
												$tot_rekap_subjumlah = 0;
												$tot_rekap_jumlah = 0;
												$tot_line = 0;

												while ($s1 = mysqli_fetch_array($sql1)) {
												?>

													<tr>
														<td width="200px"><?php echo $s1['jt_nama']; ?></td>
														<td align="right"><?php echo format_rupiah($s1['count_jumlah']); ?></td>
														<td align="right"><?php echo format_rupiah($s1['pj_subjumlah']); ?></td>
														<!-- <td align="right"><?php echo format_rupiah($s1['pj_subjumlah'] * 0.1); ?></td>
															<td align="right"><?php echo format_rupiah($s1['pj_subjumlah'] * 1.1); ?></td> -->

														<td align="right"><?php echo format_rupiah($s1['pj_ppn']); ?></td>
														<td align="right"><?php echo format_rupiah($s1['pj_jumlah']); ?></td>
													</tr>

												<?php
													$tot_rekap_ppn = $tot_rekap_ppn + $s1['pj_ppn'];
													$tot_rekap_jumlah = $tot_rekap_jumlah + $s1['pj_jumlah'];

													$tot_line = $tot_line + $s1['count_jumlah'];
													$tot_rekap_subjumlah = $tot_rekap_subjumlah + $s1['pj_subjumlah'];
												}

												?>
											</tbody>
											<tr>
												<td width="200px">Total Rekap </td>
												<td align="right"><?php echo format_rupiah($tot_line); ?></td>
												<td align="right"><?php echo format_rupiah($tot_rekap_subjumlah); ?></td>
												<!-- <td align="right"><?php echo format_rupiah($tot_rekap_subjumlah * 0.1); ?></td>
													<td align="right"><?php echo format_rupiah($tot_rekap_subjumlah * 1.1); ?></td> -->

												<td align="right"><?php echo format_rupiah($tot_rekap_ppn); ?></td>
												<td align="right"><?php echo format_rupiah($tot_rekap_jumlah); ?></td>
											</tr>

										</table>
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

</html>