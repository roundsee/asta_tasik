<?php
include '../../../../config/koneksi.php';


$tujuan = 'lap_pembelian_invoice';

$data = 'lap_pembelian_invoice';
$rute = 'lap_pembelian_invoice';
$aksi = 'aksi_list_pembelian_invoice';



$route = $_GET['route'];
$act = $_GET['act'];

// if ($route == 'outstanding_utang' and $act == 'report') {
//     // $tgl_awal = $_POST['tgl_awal'];
//     // $tgl_akhir = $_POST['tgl_akhir'];
//     $asuransi = $_POST['asuransi'];
//     $outlet = $_POST['outlet'];
//     $area = $_POST['area'];

//     // echo '<br/>' . $tgl_awal;
//     // echo '<br/>' . $tgl_akhir;
//     // echo '<br/>' . $kota;
//     // echo '<br/>' . $outlet;
//     // echo '<br/>' . $area;

//     if ($asuransi != '') {
//         $filter = 'asuransi';
//         $nilai = $asuransi;
//     } elseif ($outlet != '') {
//         $filter = 'outlet';
//         $nilai = $outlet;
//     } elseif ($area != '') {
//         $filter = 'area';
//         $nilai = $area;
//     } else {
//         $filter = 'semua';
//         $nilai = 'semua';
//     }

//     header('location:../../main.php?route=' . $route . '&act=report&filter=' . $filter . '&nilai=' . $nilai . '&tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir);
// }


if ($route == 'lap_pembelian_invoice' and $act == 'report') {

	$tgl_awal = $_POST['tgl_awal'];
	$tgl_akhir = $_POST['tgl_akhir'];
	// $filter=$_POST['filter'];
	$kota = $_POST['kota'];
	$outlet = $_POST['supplier'];
	$area = $_POST['area'];
	$divisi = $_POST['divisi'];
	$unitkerja = $_POST['unitkerja'];

	// echo "APAKAH keditek" .$outlet;

	// die();

	// echo '<br/>'.$tgl_awal;
	// echo '<br/>'.$tgl_akhir;
	// echo '<br/>'.$filter;
	// echo '<br/>'.$kota;
	// echo '<br/>'.$outlet;
	// echo '<br/>'.$area;
	// echo '<br/>'.$divisi;

	if ($kota != '') {
		$filter = 'kota';
		$nilai = $kota;
	} elseif ($outlet != '') {
		$filter = 'supplier';
		$nilai = $outlet;
	} elseif ($area != '') {
		$filter = 'area';
		$nilai = $area;
	} elseif ($divisi != '') {
		$filter = 'divisi';
		$nilai = $divisi;
	} elseif ($unitkerja != '') {
		$filter = 'unitkerja';
		$nilai = $unitkerja;
	} else {
		$filter = 'semua';
		$nilai = 'semua';
	}

	header('location:../../route/' . $data . '/lap_pembelian_invoice_model2.php?filter=' . $filter . '&nilai=' . $nilai . '&tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir);
} elseif ($route == 'lap_pembelian_invoice' and $act == 'hapus-invoice') {
	// Ambil daftar no_invoice dari pembelian_invoice yang sesuai dengan kd_po
	$query = mysqli_query($koneksi, "SELECT no_invoice FROM pembelian_invoice WHERE kd_po='$_GET[id]'");

	while ($row = mysqli_fetch_assoc($query)) {
		$no_invoice = $row['no_invoice'];

		// Cek apakah no_invoice ada di tabel payment
		$cek_payment = mysqli_query($koneksi, "SELECT no_invoice FROM payment WHERE no_invoice='$no_invoice'");

		if (mysqli_num_rows($cek_payment) > 0) {
			// Jika ada, hapus dari tabel payment
			mysqli_query($koneksi, "DELETE FROM payment WHERE no_invoice='$no_invoice'");
		}
	}

	// Lanjutkan proses hapus seperti biasa
	mysqli_query($koneksi, "DELETE from pembelian where kd_po = '$_GET[id]'");
	mysqli_query($koneksi, "DELETE from pembelian_detail where kd_po = '$_GET[id]'");
	mysqli_query($koneksi, "DELETE FROM penerimaan_barang WHERE kd_po='$_GET[id]'");
	mysqli_query($koneksi, "DELETE FROM pembelian_invoice WHERE kd_po='$_GET[id]'");

	echo "<script>alert('Data berhasil dihapus');</script>";
	echo "<script>history.go(-1)</script>";
}
