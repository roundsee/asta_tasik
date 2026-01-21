<?php
include '../../../../config/koneksi.php';

$route = $_GET['route'];
$act = $_GET['act'];

if ($route == 'pb1_barang_diskon' and $act == 'report') {

	$tgl_awal = $_POST['tgl_awal'];
	$tgl_akhir = $_POST['tgl_akhir'];
	$kota = $_POST['kota'];
	$outlet = $_POST['outlet'];
	$area = $_POST['area'];
	$kasir = $_POST['kasir'];

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
	header('location:../../main.php?route=' . $route . '&act=report&filter=' . $filter . '&nilai=' . $nilai . '&tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir . '&kasir=' . $kasir);
}
