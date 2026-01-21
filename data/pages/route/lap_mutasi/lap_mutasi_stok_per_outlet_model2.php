<?php

include "../../../../config/koneksi.php";
include "../../../../config/fungsi_rupiah.php";
include "../../../../config/library.php";
include "../../../../config/fungsi_indotgl.php";


session_start();

$login_hash = $_SESSION['login_hash'];
$en = $_SESSION['employee_number'];

$judulform = "Mutasi Stok (NILAI)";

$data = 'lap_mutasi';
$rute = 'list_mutasi';
$aksi = 'aksi_list_mutasi';

$tabel = 'mutasi_stok';
$f1 = 'tgl';
$f2 = 'kd_cus';
$f3 = 'kd_brg';
$f4 = 'satuan';
$f5 = 'qty_awal';
$f6 = 'nilai_awal';
$f7 = 'qty_beli';
$f8 = 'nilai_beli';
$f9 = 'qty_beli_retur';
$f10 = 'nilai_beli_retur';
$f11 = 'qt_tersedia';
$f12 = 'nilai_tersedia';
$f13 = 'harga_rata';
$f14 = 'qt_jual';
$f15 = 'nilai_jual';
$f16 = 'hpp_jual';
$f17 = 'qt_akhir';
$f18 = 'nilai_akhir';
$f19 = 'stok_opname';
$f20 = 'nilai_opname';

$j1 = 'Tanggal';
$j2 = 'Kode Customer';
$j3 = 'Kode Barang';
$j4 = 'Satuan';
$j5 = 'Qty Awal';
$j6 = 'Nilai Awal';
$j7 = 'Qty Beli';
$j8 = 'Nilai Beli';
$j9 = 'Qty Beli Retur';
$j10 = 'Nilai Beli Retur';
$j11 = 'Qty Tersedia';
$j12 = 'Nilai Tersedia';
$j13 = 'Harga Rata-Rata';
$j14 = 'Qty Jual';
$j15 = 'Nilai Jual';
$j16 = 'HPP Jual';
$j17 = 'Qty Akhir';
$j18 = 'Nilai Akhir';
$j19 = 'Stok Opname';
$j20 = 'Nilai Opname';

$tgl_awal = $_GET['tgl_awal'];
$tgl_akhir = $_GET['tgl_akhir'];
$filter = $_GET['filter'];
$nilai = $_GET['nilai'];
// $tgl_terakhir=$tgl_akhir+interval 1 day;

// echo '<br/><br/><br/>';

// echo "<br/>".$tgl_awal;
// echo "<br/>".$tgl_akhir;
// echo "<br/>".$filter;
// echo "<br/>".$nilai;

if ($filter == 'kota') {
	$newnilai = sprintf("%02s", $nilai);
	$kondisi = "AND p.kd_kota='$newnilai'";
	$query = mysqli_query($koneksi, "SELECT * FROM kotabaru WHERE kode='$nilai' ");
	$q1 = mysqli_fetch_array($query);
	$judul_nilai = $q1['nama'];
	$kondisi_join = 'JOIN pelanggan p ON p.kd_cus=pengajuan.unit';
} elseif ($filter == 'outlet') {
	$kondisi = "AND kd_unit ='$nilai'";
	$query = mysqli_query($koneksi, "SELECT * FROM unit_kerja WHERE kd_cus='$nilai' ");
	$q1 = mysqli_fetch_array($query);
	$judul_nilai = $q1['nama'];
	$kondisi_join = '';
} elseif ($filter == 'area') {
	$newnilai = sprintf("%02s", $nilai);
	$kondisi = "AND pelanggan.kd_cus='$nilai'";
	$query = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE kd_cus='$nilai' ");
	$q1 = mysqli_fetch_array($query);
	$judul_nilai = $q1['nama'];
	$kondisi_join = '';
} elseif ($filter == 'divisi') {
	$newnilai = $nilai;
	$kondisi = "AND pengajuan.kode_pengaju='$newnilai'";
	$query = mysqli_query($koneksi, "SELECT * FROM pengaju WHERE kode_pengaju='$nilai' ");
	$q1 = mysqli_fetch_array($query);
	$judul_nilai = $q1['nama_unit'];
	$kondisi_join = 'JOIN pengaju p ON p.kode_pengaju=pengajuan.kode_pengaju';
} elseif ($filter == 'unitkerja') {
	$kondisi = "AND kd_unit='$nilai'";
	$query = mysqli_query($koneksi, "SELECT * FROM unit_kerja WHERE kd_cus='$nilai' ");
	$q1 = mysqli_fetch_array($query);
	$judul_nilai = $q1['nama'];
	$kondisi_join = '';
} else {
	$kondisi = "";
	$judul_nilai = '';
	$kondisi_join = '';
	$kondisi_group = '';
}


$judul = $judulform;
$judul2 = $filter . " : " . $judul_nilai;
$judul3 = 'Periode : ' . $tgl_awal . " s/d " . $tgl_akhir;

// echo '<br> kondisi :'.$kondisi;
// echo '<br> judul Nilai :'.$judul_nilai;
// echo '<br> kondisi Join :'.$kondisi_join;


include '../header_lap_mutasi.php';
?>

<style type="text/css">
	div.dataTables_wrapper div.dataTables_length select {
		width: 50;
	}

	div.dt-buttons {
		padding-left: 20;
	}

	div.dt-container {
		width: 800px;
		margin: 0 auto;
	}

	/* CSS for loading spinner */
#loading-bar {
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background: rgba(255, 255, 255, 0.8);
    z-index: 9999;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.spinner-container {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100px;
    height: 100px;
		/* border: 10px solid; */
}

.spinner {
    width: 100px;
    height: 100px;
    border: 16px solid #f3f3f3;
    border-top: 8px solid #f8f850;
    border-radius: 50%;
    animation: spin 1.5s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.loading-text {
    margin-top: 5px;
    font-size: 1.5rem; /* Increased font size */
    font-family: Arial, sans-serif;
    color: #333;
    font-weight: bold; /* Added font weight */
}

.dot {
    font-size: 2rem; /* Match dot size to text */
    animation: blink 1.4s infinite both;
}

.dot:nth-child(2) {
    animation-delay: 0.2s;
		animation: blink 1.4s infinite both;
}

.dot:nth-child(3) {
    animation-delay: 0.4s;
		animation: blink 1.4s infinite both;
}

.dot:nth-child(4) {
    animation-delay: 0.4s;
		animation: blink 1.4s infinite both;
}

.dot:nth-child(5) {
    animation-delay: 0.4s;
		animation: blink 1.4s infinite both;
}

@keyframes blink {
    0%, 20%, 50%, 80%, 100% {
        opacity: 1;
    }
    40% {
        opacity: 0;
    }
    60% {
        opacity: 0;
    }
}

</style>
<!-- <div id="loading-bar">
    <div class="spinner-container">
        <div class="spinner"></div>
    </div>
    <div class="loading-text">
        Proses<span class="dot">.</span><span class="dot">.</span><span class="dot">.</span><span class="dot">.</span><span class="dot">.</span>
    </div>
</div> -->

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
<!-- <div class="table-responsive"> -->
<table id="example4" class="table table-bordered table-striped">
    <thead style="background-color: lightgray;" class="elevation-2">
        <tr>
            <th width="20">No.</th>
            <th width="55">Kode Lokasi</th>
            <th width="55">Nama Lokasi</th>
            <th width="55" style="text-align:right">Nilai Awal</th>
            <th width="55" style="text-align:right">Total Penerimaan</th>
            <th width="55" style="text-align:right">Total Pengeluaran</th>
            <th width="55" style="text-align:right">Nilai Akhir</th>
        </tr>
    </thead>
    <tbody>
        <?php
		$query = "SELECT *,sum(nilai_awal) as sum_nilai_awal,sum(nilai_beli) as sum_nilai_beli, sum(nilai_terima_int) as sum_nilai_terima_internal, sum(nilai_kirim_int) as sum_nilai_kirim_internal, sum(nilai_pake) as sum_nilai_pake, pelanggan.nama AS nama_pelanggan
			      FROM $tabel
                  JOIN barang ON barang.kd_brg = $tabel.kd_brg
                  JOIN pelanggan ON pelanggan.kd_cus = $tabel.kd_cus
                  WHERE tgl >= '$tgl_awal' AND tgl <= '$tgl_akhir'
                  $kondisi
                  GROUP BY $tabel.kd_cus";

        $sql1 = mysqli_query($koneksi, $query);
        $no = 1;

        if (!$sql1) {
            die("query error " . mysqli_error($koneksi));
        }

        // Variabel untuk menghitung total
        $total_nilai_awal = 0;
        $total_penerimaan = 0;
        $total_pengeluaran = 0;
        $total_nilai_akhir = 0;

        while ($s1 = mysqli_fetch_array($sql1)) {
            $sum_nilai_awal = $s1['sum_nilai_awal'];
			$sum_nilai_beli = $s1['sum_nilai_beli'];
			$sum_nilai_terima_internal = $s1['sum_nilai_terima_internal'];
			$sum_nilai_kirim_internal = $s1['sum_nilai_kirim_internal'];
			$sum_nilai_pake = $s1['sum_nilai_pake'];
			$total_penerimaan_row = $sum_nilai_beli + $sum_nilai_terima_internal;
			$total_pengeluaran_row = $sum_nilai_kirim_internal + $sum_nilai_pake;
			$nilai_akhir = $sum_nilai_awal + $total_penerimaan_row - $total_pengeluaran_row;

			// Tambahkan ke total
			$total_nilai_awal += $sum_nilai_awal;
			$total_penerimaan += $total_penerimaan_row;
			$total_pengeluaran += $total_pengeluaran_row;
			$total_nilai_akhir += $nilai_akhir;
            $satuan = 'Pcs';
        ?>
            <tr align="left">
                <td><?php echo $no; ?></td>
                <td><?php echo $s1['kd_cus']; ?></td>
                <td><?php echo $s1['nama_pelanggan']; ?></td>
                <td style="text-align: right;"><?php echo number_format($sum_nilai_awal, 2); ?></td>
                <td style="text-align: right;"><?php echo number_format($total_penerimaan_row, 2); ?></td>
                <td style="text-align: right;"><?php echo number_format($total_pengeluaran_row, 2); ?></td>
                <td style="text-align: right;"><?php echo number_format($nilai_akhir, 2); ?></td>
            </tr>
        <?php
            $no++;
        }
        ?>
    </tbody>
    <!-- Menambahkan tfoot untuk menghitung jumlahnya -->
    <?php if ($filter !== "unitkerja") { ?>
        <tfoot>
            <tr style="background-color: lightgray;">
                <td colspan="1" style="text-align:right">Total:</td>
                <td style="text-align:right"><?php echo number_format($total_nilai_awal, 2); ?></td>
                <td style="text-align:right"><?php echo number_format($total_penerimaan, 2); ?></td>
                <td style="text-align:right"><?php echo number_format($total_pengeluaran, 2); ?></td>
                <td style="text-align:right"><?php echo number_format($total_nilai_akhir, 2); ?></td>
            </tr>
        </tfoot>
    <?php } ?>
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
			scrollX: true,
			buttons: [
				'copy', 'csv', 'excel', 'pdf', 'print'
			]
		});
	});
</script>

<script>
$(document).ready(function() {
    // Menghilangkan loading bar setelah halaman siap
    $("#loading-bar").hide();

		
	});
	
</script>
<?php include '../footer_lap_mutasi.php'; ?>