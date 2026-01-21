<?php
include '../../../../config/koneksi.php';

$route = $_GET['route'];
$act = $_GET['act'];

if ($route == 'export_pembelian' and $act == 'report') {

	$tgl_awal = $_POST['tgl_awal'];
	$tgl_akhir = $_POST['tgl_akhir'];
	// $filter=$_POST['filter'];
	$kota = $_POST['kota'];
	$outlet = $_POST['outlet'];
	$area = $_POST['area'];
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
	} else {
		$filter = 'semua';
		$nilai = 'semua';
	}

	$login_hash = $_POST['login_hash'];

	$tgl1 = new DateTime($tgl_awal);
	$tgl2 = new DateTime($tgl_akhir);
	$selisihtgl = $tgl2->diff($tgl1);
	$selisihtgl = $selisihtgl->days;
	header('location:../../main.php?route=' . $route . '&act=report&filter=' . $filter . '&nilai=' . $nilai . '&tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir);
}
else if ($route == 'export_pengiriman' and $act == 'report') {

	$tgl_awal = $_POST['tgl_awal'];
	$tgl_akhir = $_POST['tgl_akhir'];
	$kota = $_POST['kota'];
	$outlet = $_POST['outlet'];
	$area = $_POST['area'];
	if ($kota != '') {
		$filter = 'kota';
		$nilai = $kota;
	} elseif ($outlet != '') {
		$filter = 'outlet';
		$nilai = $outlet;
	} elseif ($area != '') {
		$filter = 'area';
		$nilai = $area;
	} else {
		$filter = 'semua';
		$nilai = 'semua';
	}

	$login_hash = $_POST['login_hash'];

	$tgl1 = new DateTime($tgl_awal);
	$tgl2 = new DateTime($tgl_akhir);
	$selisihtgl = $tgl2->diff($tgl1);
	$selisihtgl = $selisihtgl->days;
	header('location:../../main.php?route=' . $route . '&act=report&filter=' . $filter . '&nilai=' . $nilai . '&tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir);
}
else if ($route == 'export_pembelian_retur' and $act == 'report') {

	$tgl_awal = $_POST['tgl_awal'];
	$tgl_akhir = $_POST['tgl_akhir'];
	// $filter=$_POST['filter'];
	$kota = $_POST['kota'];
	$outlet = $_POST['outlet'];
	$area = $_POST['area'];
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
	} else {
		$filter = 'semua';
		$nilai = 'semua';
	}

	$login_hash = $_POST['login_hash'];

	$tgl1 = new DateTime($tgl_awal);
	$tgl2 = new DateTime($tgl_akhir);
	$selisihtgl = $tgl2->diff($tgl1);
	$selisihtgl = $selisihtgl->days;
	header('location:../../main.php?route=' . $route . '&act=report&filter=' . $filter . '&nilai=' . $nilai . '&tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir);
}
else if ($route == 'export_penjualan' and $act == 'report') {

	$tgl_awal = $_POST['tgl_awal'];
	$tgl_akhir = $_POST['tgl_akhir'];
	// $filter=$_POST['filter'];
	$kota = $_POST['kota'];
	$outlet = $_POST['outlet'];
	$area = $_POST['area'];
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
	} else {
		$filter = 'semua';
		$nilai = 'semua';
	}

	$login_hash = $_POST['login_hash'];

	$tgl1 = new DateTime($tgl_awal);
	$tgl2 = new DateTime($tgl_akhir);
	$selisihtgl = $tgl2->diff($tgl1);
	$selisihtgl = $selisihtgl->days;
	header('location:../../main.php?route=' . $route . '&act=report&filter=' . $filter . '&nilai=' . $nilai . '&tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir);
}
