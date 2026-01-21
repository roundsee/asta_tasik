<?php

include "../../../../config/koneksi.php";
include "../../../../config/fungsi_rupiah.php";

$judulform = "Tabel Penjualan ";

$data = 'test_penjualan';
$rute = 'rekap';
$aksi = 'aksi_rekap_penjualan';

$tabel = "daily_penjualan";
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
$f24 = 'b_paking';
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
$j33 = 'dibayar';
$j32 = 'no_ref';


$tabel2 = 'kotabaru';
$ff1 = 'kode';
$tabel3 = 'pelanggan';
$gg1 = 'kd_cus';

$tgl_awal = $_GET['tgl_awal'];
$tgl_akhir = $_GET['tgl_akhir'];
$filter = $_GET['filter'];
$nilai = $_GET['nilai'];

$tujuan = $_GET['tujuan'];
$tgl_akhir = $tgl_awal;

// echo "<br/>".$tgl_awal;
// echo "<br/>".$tgl_akhir;
// echo "<br/>".$filter;
// echo "<br/>".$nilai;
// echo $tujuan;

if ($tujuan == 'aplikasi') {
	$kondisi2 = 'Aplikasi';
	$kondisi_group = ' ,daily_penjualan.kd_aplikasi';
} elseif ($tujuan == 'carabayar') {
	$kondisi2 = 'Alat Bayar';
	$kondisi_group = ' ,daily_penjualan.kd_alatbayar';
} elseif ($tujuan == 'kasir') {
	$kondisi2 = 'Kasir';
	$kondisi_group = ' ,daily_penjualan.oleh';
} else {
	$kondisi2 = '';
	$kondisi_group = '';
}

if ($filter == 'kota') {
	$kondisi = "AND pelanggan.kd_kota='$nilai' ";
	$kondisi_order = " ORDER BY pelanggan.kd_kota ,  tanggal desc";
	$query = mysqli_query($koneksi, "SELECT * FROM kotabaru WHERE kode='$nilai' ");
	$q1 = mysqli_fetch_array($query);
	$judul_nilai = $q1['nama'];
} elseif ($filter == 'outlet') {
	$kondisi = "AND daily_penjualan.kd_cus='$nilai' ";
	$kondisi_order = " ORDER BY daily_penjualan.kd_cus, tanggal desc";
	$query = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE kd_cus='$nilai' ");
	$q1 = mysqli_fetch_array($query);
	$judul_nilai = $q1['nama'];
} elseif ($filter == 'area') {
	$kondisi = "AND kotabaru.kd_area='$nilai' ";
	$kondisi_order = "ORDER BY kotabaru.kd_area , tanggal desc";
	$query = mysqli_query($koneksi, "SELECT * FROM area WHERE kode='$nilai' ");
	$q1 = mysqli_fetch_array($query);
	$judul_nilai = $q1['nama'];
} else {
	$kondisi = '';
	$kondisi_order = "ORDER BY tanggal desc";
	$judul_nilai = '';
}

$judul = $judulform . $kondisi2;
$judul2 = $filter . " : " . $judul_nilai;
$judul3 = 'Periode : ' . $tgl_awal . " s/d " . $tgl_akhir;

include '../header_lap_1.php';
?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
<!-- <div class="container"> -->

<section class="content-header  wow fadeInDown" data-wow-duration=".3s" data-wow-delay=".3s">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="list-gds">
					<b><?php echo $judulform; ?></b> <small style="font-weight: 100;">report</small>
				</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="../../main.php?route=home">Beranda</a></li>
					<li class="breadcrumb-item active">Laporan</li>
					<li class="breadcrumb-item active"><?php echo $judulform; ?></li>
				</ol>
			</div>

		</div>

		<br>
		<center>
			<h4><?php echo $judul; ?>
				<h5><?php echo $judul2; ?></h5>
				<?php echo $judul3; ?>
			</h4>
		</center>
	</div><!-- /.container-fluid -->
</section>

<table id="example" class="table table-bordered table-striped table-responsive">

	<thead style="background-color:  lightgray;" class="elevation-2">

		<tr>

			<th style="">No</th>
			<th style="padding-right: 100px!important"><?php echo $f1; ?></th>
			<th style="padding-right: 80px!important"><?php echo $f2; ?></th>
			<th style=""><?php echo $f3; ?></th>
			<th style=""><?php echo $f4; ?></th>
			<th style=""><?php echo $f5; ?></th>
			<th style="padding-right: 90px!important"><?php echo $f6; ?></th>
			<th style=""><?php echo $f7; ?></th>
			<th style=""><?php echo $f8; ?></th>
			<th style=""><?php echo $f9; ?></th>
			<th style=""><?php echo $f10; ?></th>
			<th style=""><?php echo $f11; ?></th>
			<th style=""><?php echo $f12; ?></th>
			<th style=""><?php echo $f13; ?></th>
			<th style=""><?php echo $f14; ?></th>
			<th style=""><?php echo $f15; ?></th>
			<th style=""><?php echo $f16; ?></th>
			<th style=""><?php echo $f17; ?></th>
			<th style=""><?php echo $f18; ?></th>
			<th style=""><?php echo $f19; ?></th>
			<th style=""><?php echo $f20; ?></th>
			<th style=""><?php echo $f21; ?></th>
			<th style=""><?php echo $f22; ?></th>
			<th style=""><?php echo $f23; ?></th>
			<th style=""><?php echo $f24; ?></th>
			<th style=""><?php echo $f25; ?></th>
			<th style=""><?php echo $f26; ?></th>
			<th style=""><?php echo $f27; ?></th>
			<th style=""><?php echo $f28; ?></th>
			<th style=""><?php echo $f29; ?></th>
			<th style=""><?php echo $f30; ?></th>
			<th style=""><?php echo $f31; ?></th>
			<th style=""><?php echo $f32; ?></th>
		</tr>
	</thead>
	<tbody>
		<?php

		$query = "SELECT * 
			FROM penjualan 
			WHERE tanggal>='$tgl_awal' AND tanggal <= '$tgl_akhir' +interval 1 day 
			$kondisi
			 ";

		$sql1 = mysqli_query($koneksi, $query);
		$no = 1;

		while ($s1 = mysqli_fetch_array($sql1)) {
		?>
			<tr align="left">
				<td><?php echo $no; ?></td>
				<td style="width:1300px"><?php echo $s1[$f1]; ?></td>
				<td><?php echo $s1[$f2]; ?></td>
				<td><?php echo $s1[$f3]; ?></td>
				<td><?php echo $s1[$f4]; ?></td>
				<td><?php echo $s1[$f5]; ?></td>
				<td><?php echo $s1[$f6]; ?></td>
				<td style="text-align:right;"><?php echo number_format($s1[$f7]); ?></td>
				<td style="text-align:right;"><?php echo number_format($s1[$f8]); ?></td>
				<td style="text-align:right;"><?php echo number_format($s1[$f9]); ?></td>
				<td style="text-align:right;"><?php echo number_format($s1[$f10]); ?></td>
				<td style="text-align:right;"><?php echo number_format($s1[$f11]); ?></td>
				<td style="text-align:right;"><?php echo number_format($s1[$f12]); ?></td>
				<td><?php echo $s1[$f13]; ?></td>
				<td><?php echo $s1[$f14]; ?></td>
				<td><?php echo $s1[$f15]; ?></td>
				<td><?php echo $s1[$f16]; ?></td>
				<td><?php echo $s1[$f17]; ?></td>
				<td><?php echo $s1[$f18]; ?></td>
				<td style="text-align:right;"><?php echo number_format($s1[$f19]); ?></td>
				<td><?php echo $s1[$f20]; ?></td>
				<td style="text-align:right;"><?php echo number_format($s1[$f21]); ?></td>
				<td><?php echo $s1[$f22]; ?></td>
				<td><?php echo $s1[$f23]; ?></td>
				<td><?php echo $s1[$f24]; ?></td>
				<td><?php echo $s1[$f25]; ?></td>
				<td><?php echo $s1[$f26]; ?></td>
				<td><?php echo $s1[$f27]; ?></td>
				<td><?php echo $s1[$f28]; ?></td>
				<td><?php echo $s1[$f29]; ?></td>
				<td><?php echo $s1[$f30]; ?></td>
				<td style="text-align:right;"><?php echo number_format($s1[$f31]); ?></td>
				<td><?php echo $s1[$f32]; ?></td>

			</tr>
		<?php
			$no++;
		}
		?>
	</tbody>

</table>
<hr>


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>

<!-- <script> 
		$(document).ready(function() {
			$('#example').DataTable( {
				dom: 'Bfrtip',
				buttons: [
					'copy', 'csv', 'excel', 'pdf', 'print'
					]
			} );
		} );
	</script> -->

<?php include '../footer_lap_1.php'; ?>