<?php
include '../../../../config/koneksi.php';
// include 'acak.php';

$route = $_GET['route'];
$act = $_GET['act'];

if ($route == 'rekap_sales_report' and $act == 'report') {

	$tgl_awal = $_POST['tgl_awal'];
	$tgl_akhir = $_POST['tgl_akhir'];
	// $filter=$_POST['filter'];
	$kota = $_POST['kota'];
	$outlet = $_POST['outlet'];
	$area = $_POST['area'];
	$kasir = $_POST['kasir'];
	$kategori_sub_alat_bayar = $_POST['kategori_sub_alat_bayar'];
	$kategori_retail_grosir = $_POST['kategori_retail_grosir'];


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
	// 	header('location:../../main.php?route=' . $route . '&act=report&filter=' . $filter . '&nilai=' . $nilai . '&tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir . '&tujuan=' . $tujuan);
	// }
	header('location:../../main.php?route=' . $route . '&act=report&filter=' . $filter . '&nilai=' . $nilai . '&tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir . '&tujuan=' . $tujuan . '&kategori_sub_alat_bayar=' . $kategori_sub_alat_bayar . '&kategori_retail_grosir=' . $kategori_retail_grosir . '&kasir=' . $kasir);

	// header('location:../../main.php?route='.$route.'&act=report&filter='.$filter.'&nilai='.$nilai.'&tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir.'&tujuan='.$tujuan);

} elseif ($route == 'rekap_sales_report2' and $act == 'report') {

	$tgl_awal = $_POST['tgl_awal'];
	$tgl_akhir = $_POST['tgl_akhir'];
	// $filter=$_POST['filter'];
	$kota = $_POST['kota'];
	$outlet = $_POST['outlet'];
	$area = $_POST['area'];
	$kasir = $_POST['kasir'];
	$kategori_sub_alat_bayar = $_POST['kategori_sub_alat_bayar'];
	$kategori_retail_grosir = $_POST['kategori_retail_grosir'];


	echo '<br/>' . $tgl_awal;
	echo '<br/>' . $tgl_akhir;
	// echo '<br/>'.$filter;
	echo '<br/>' . $kota;
	echo '<br/>' . $outlet;
	echo '<br/>' . $area;

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

	header('location:../../main.php?route=' . $route . '&act=report&filter=' . $filter . '&nilai=' . $nilai . '&tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir . '&tujuan=' . $tujuan . '&kategori_sub_alat_bayar=' . $kategori_sub_alat_bayar . '&kategori_retail_grosir=' . $kategori_retail_grosir . '&kasir=' . $kasir);
}
