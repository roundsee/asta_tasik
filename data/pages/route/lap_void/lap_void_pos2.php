<?php

include "../../../../config/koneksi.php";
include "../../../../config/fungsi_rupiah.php";

session_start();

$login_hash = $_SESSION['login_hash'];
$en = $_SESSION['employee_number'];

$judulform = "VOID POS Detail";

$data = 'lap_void';
$rute = 'void_pos';
$aksi = 'aksi_void';

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
$j8 = 'PPn';
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
	$query = mysqli_query($koneksi, "SELECT nama FROM kotabaru WHERE kode='$nilai' ");
	$q1 = mysqli_fetch_array($query);
	$judul_nilai = $q1['nama'];
} elseif ($filter == 'outlet') {
	$kondisi = "AND batal_penjualan.kd_cus='$nilai'";
	$query = mysqli_query($koneksi, "SELECT nama FROM pelanggan WHERE kd_cus='$nilai' ");
	$q1 = mysqli_fetch_array($query);
	$judul_nilai = $q1['nama'];
} elseif ($filter == 'area') {
	$kondisi = "AND kotabaru.kd_area='$nilai'";
	$query = mysqli_query($koneksi, "SELECT nama FROM area WHERE kode='$nilai' ");
	$q1 = mysqli_fetch_array($query);
	$judul_nilai = $q1['nama'];
} elseif ($filter == 'kasir') {

	$query = mysqli_query($koneksi, "SELECT name_e FROM employee WHERE employee_number='$nilai' ");
	$q1 = mysqli_fetch_array($query);
	$judul_nilai = $q1['name_e'];
	$kondisi = "AND batal_penjualan.oleh='$judul_nilai'";
} else {
	$kondisi = "";
	$judul_nilai = '';
}


if ($login_hash == '6' or $login_hash == '7') {
	$filter = 'Outlet';
	$query = mysqli_query($koneksi, "SELECT cabang_e FROM employee WHERE employee_number='$en' ");
	$q1 = mysqli_fetch_array($query);
	$nilai = $q1['cabang_e'];
	$kondisi = "AND batal_penjualan.kd_cus='$nilai'";
	$query = mysqli_query($koneksi, "SELECT nama FROM pelanggan WHERE kd_cus='$nilai' ");
	$q1 = mysqli_fetch_array($query);
	$judul_nilai = $q1['nama'];
	// $tgl_akhir=$tgl_awal;
}
$tgl1 = new DateTime($tgl_awal);
$tgl2 = new DateTime($tgl_akhir);
$selisihtgl = $tgl2->diff($tgl1);
$selisihtgl = $selisihtgl->days;

if ($login_hash == '6' or $login_hash == '7' or $login_hash == '8') {
	if ($selisihtgl >= 7) {
		$tgl_akhir = date('Y-m-d', strtotime($tgl_awal . ' + 6 days'));
		$pesantgl = 'Range Tanggal lebih dari 7 Hari';
	}
} else {
	if ($selisihtgl >= 31) {
		$tgl_akhir = date('Y-m-d', strtotime($tgl_awal . ' + 30 days'));
		$pesantgl = 'Range Tanggal lebih dari 31 Hari';
	}
}

$judul = 'Laporan VOID POS';
$judul2 = $filter . " : " . $judul_nilai;
$judul3 = 'Periode : ' . $tgl_awal . " s/d " . $tgl_akhir;

include '../header_lap_2.php';
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

<?php if ($login_hash == 6 or $login_hash == 7 or $filter == 'outlet') { ?>

	<table id="example" class="table table-bordered table-striped">
		<thead style="background-color:  lightgray;" class="elevation-2">
			<tr>
				<th>No.</th>
				<th>Receipt Ref</th>
				<th>User</th>
				<th>VOID Date</th>
				<th>Kode</th>
				<th>Nama Barang</th>
				<th style="text-align: center;">banyak</th>
				<th style="text-align: right">Harga</th>
				<th style="text-align: right">Diskon</th>
				<th style="text-align: right">Jumlah</th>
			</tr>
		</thead>
		<tbody>
			<?php

			$query = "SELECT batal_penjualan.faktur,batal_penjualan.tanggal,batal_penjualan.oleh,batal_penjualan.jumlah,batal_jualdetil.banyak,batal_jualdetil.diskon,
				batal_jualdetil.kd_brg as jd_kd_brg,
				batal_jualdetil.harga as jd_harga,
				barang.nama as b_nama,
				jenis_transaksi.nama as jt_nama
				FROM batal_penjualan 
				join batal_jualdetil on batal_jualdetil.faktur=batal_penjualan.faktur
				join barang on barang.kd_brg=batal_jualdetil.kd_brg
				join jenis_transaksi on jenis_transaksi.kd_jenis=batal_penjualan.kd_aplikasi
				WHERE 
				batal_penjualan.tanggal>='$tgl_awal' AND 
				batal_penjualan.tanggal <= '$tgl_akhir' +interval 1 day
				$kondisi ";

			$sql1 = mysqli_query($koneksi, $query);
			$no = 1;

			$tot_jumlah = 0;

			while ($s1 = mysqli_fetch_array($sql1)) {
			?>
				<tr align="left">
					<td style="width:30px"><?php echo $no; ?></td>
					<td><?php echo $s1[$f1]; ?></td>
					<td><?php echo $s1[$f6]; ?></td>
					<td><?php echo $s1[$f2]; ?></td>
					<td><?php echo $s1['jd_kd_brg']; ?></td>
					<td><?php echo $s1['b_nama']; ?></td>
					<td style="text-align: center;width:30px;"><?php echo $s1['banyak']; ?></td>
					<td style="text-align: right;width:50px;"><?php echo number_format($s1['jd_harga']); ?></td>
					<td style="text-align: right;width:50px;"><?php echo number_format($s1['diskon']); ?></td>
					<td style="text-align: right;width:70px;"><?php echo number_format($s1['banyak'] * $s1['jd_harga']); ?></td>

				</tr>
			<?php
				$no++;

				$tot_jumlah = $tot_jumlah + ($s1['banyak'] * $s1['jd_harga']);
			}
			?>
		</tbody>
		<tfoot>
			<tr style="font-weight:800">
				<td colspan="9" style="text-align:right;"> Total :</td>
				<td align="right"><?php echo number_format($tot_jumlah); ?></td>
			</tr>
		</tfoot>

	</table>
<?php } elseif ($filter == 'kota') { ?>
	<table id="example" class="table table-bordered table-striped">
		<thead style="background-color:  lightgray;" class="elevation-2">
			<tr>
				<th>No.</th>
				<th>Outlet</th>
				<th>User</th>
				<th>VOID Date</th>
				<th>Kode</th>
				<th>Nama Barang</th>
				<th style="text-align: center;">banyak</th>
				<th style="text-align: right">Harga</th>
				<th style="text-align: right">Diskon</th>
				<th style="text-align: right">Jumlah</th>
			</tr>
		</thead>
		<tbody>
			<?php

			$query = "SELECT batal_penjualan.faktur,batal_penjualan.tanggal,batal_penjualan.oleh,batal_penjualan.jumlah,batal_jualdetil.banyak,batal_jualdetil.diskon,
				batal_jualdetil.kd_brg as jd_kd_brg,
				batal_jualdetil.harga as jd_harga,
				barang.nama as b_nama,
				jenis_transaksi.nama as jt_nama
				FROM batal_penjualan 
				join batal_jualdetil on batal_jualdetil.faktur=batal_penjualan.faktur
				join barang on barang.kd_brg=batal_jualdetil.kd_brg
				join jenis_transaksi on jenis_transaksi.kd_jenis=batal_penjualan.kd_aplikasi
				WHERE 
				batal_penjualan.tanggal>='$tgl_awal' AND 
				batal_penjualan.tanggal <= '$tgl_akhir' +interval 1 day
				$kondisi ";

			$sql1 = mysqli_query($koneksi, $query);
			$no = 1;

			$tot_jumlah = 0;

			while ($s1 = mysqli_fetch_array($sql1)) {
			?>
				<tr align="left">
					<td style="width:30px"><?php echo $no; ?></td>
					<td><?php echo $s1[$f1]; ?></td>
					<td><?php echo $s1[$f6]; ?></td>
					<td><?php echo $s1[$f2]; ?></td>
					<td><?php echo $s1['jd_kd_brg']; ?></td>
					<td><?php echo $s1['b_nama']; ?></td>
					<td style="text-align: center;width:30px;"><?php echo $s1['banyak']; ?></td>
					<td style="text-align: right;width:50px;"><?php echo number_format($s1['jd_harga']); ?></td>
					<td style="text-align: right;width:50px;"><?php echo number_format($s1['diskon']); ?></td>
					<td style="text-align: right;width:70px;"><?php echo number_format($s1['banyak'] * $s1['jd_harga']); ?></td>

				</tr>
			<?php
				$no++;

				$tot_jumlah = $tot_jumlah + ($s1['banyak'] * $s1['jd_harga']);
			}
			?>
		</tbody>
		<tfoot>
			<tr style="font-weight:800">
				<td colspan="9" style="text-align:right;"> Total :</td>
				<td align="right"><?php echo number_format($tot_jumlah); ?></td>
			</tr>
		</tfoot>

	</table>


<?php } elseif ($filter == 'outlet') { ?>

<?php } elseif ($filter == 'area') { ?>

<?php } ?>


<hr>
<div>

	<?php include '../footer_lap.php'; ?>