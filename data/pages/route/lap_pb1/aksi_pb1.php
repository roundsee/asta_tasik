<?php
include '../../../../config/koneksi.php';

$route = $_GET['route'];
$act = $_GET['act'];

if ($route == 'pb1' and $act == 'report') {

	$tgl_awal = $_POST['tgl_awal'];
	$tgl_akhir = $_POST['tgl_akhir'];
	// $filter=$_POST['filter'];
	$kota = $_POST['kota'];
	$outlet = $_POST['outlet'];
	$area = $_POST['area'];
	$kasir = $_POST['kasir'];
	$kategori_sub_alat_bayar = $_POST['kategori_sub_alat_bayar'];
	$kategori_retail_grosir = $_POST['kategori_retail_grosir'];



	// $area_e=$_POST['area_e'];

	// echo '<br/>'.$tgl_awal;
	// echo '<br/>'.$tgl_akhir;
	// echo '<br/>'.$filter;
	// echo '<br/>'.$kota;
	// echo '<br/>'.$outlet;
	// echo '<br/>'.$area;

	if ($kota != '') {
		$filter = 'kota';
		$nilai = $kota;
	} elseif ($outlet != '') {
		$filter = 'outlet';
		$nilai = $outlet;
	} elseif ($area != '') {
		$filter = 'area';
		$nilai = $area;
	} elseif ($kasir != '') {
		$filter = 'kasir';
		$nilai = $kasir;
	} else {
		$filter = 'semua';
		$nilai = 'semua';
	}

	$login_hash = $_POST['login_hash'];

	// $tgl1 = new DateTime($tgl_awal);
	// $tgl2 = new DateTime($tgl_akhir);
	// $selisihtgl = $tgl2->diff($tgl1);
	// $selisihtgl = $selisihtgl->days;
	header('location:../../main.php?route=' . $route . '&act=report&filter=' . $filter . '&nilai=' . $nilai . '&tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir . '&kategori_sub_alat_bayar=' . $kategori_sub_alat_bayar . '&kategori_retail_grosir=' . $kategori_retail_grosir . '&kasir=' . $kasir);

	// if (($login_hash == '6' or $login_hash == '7' or $login_hash == '8') and $selisihtgl >= 7) {
	// 	$tgl_akhir = date('Y-m-d', strtotime($tgl_awal . ' + 6 days'));

	// 	$pesantgl = 'Range Tanggal lebih dari 7 Hari';
	// 	echo "<script>alert('$pesantgl')</script>";
	// 	echo "<script>history.go(-1)</script>";
	// } elseif ($selisihtgl >= 31) {
	// 	$tgl_akhir = date('Y-m-d', strtotime($tgl_awal . ' + 30 days'));
	// 	$pesantgl = 'Range Tanggal lebih dari 31 Hari';
	// 	echo "<script>alert('$pesantgl')</script>";
	// 	echo "<script>history.go(-1)</script>";
	// } else {
	// 	header('location:../../main.php?route=' . $route . '&act=report&filter=' . $filter . '&nilai=' . $nilai . '&tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir . '&kategori_sub_alat_bayar=' . $kategori_sub_alat_bayar . '&kategori_retail_grosir=' . $kategori_retail_grosir);
	// }
}
