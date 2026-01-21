<?php
include '../../../../config/koneksi.php';

$tujuan = 'list_mutasi';

$data = 'lap_mutasi';
$rute = 'list_mutasi';
$aksi = 'aksi_list_mutasi';

$route = $_GET['route'];
$act = $_GET['act'];

if ($route == $tujuan and $act == 'report') {

	$tgl_awal = $_POST['tgl_awal'];
	$tgl_akhir = $_POST['tgl_akhir'];
	// $filter=$_POST['filter'];
	$kota = $_POST['kota'];
	$outlet = $_POST['outlet'];
	$area = $_POST['area'];
	$divisi = $_POST['divisi'];
	$unitkerja = $_POST['unitkerja'];

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
		$filter = 'outlet';
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

	header('location:../../route/' . $data . '/lap_mutasi_model2.php?filter=' . $filter . '&nilai=' . $nilai . '&tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir);
} elseif ($route == $tujuan and $act == 'report-rekap_penjualan') {

	$tgl_awal = $_POST['tgl_awal'];
	$tgl_akhir = $_POST['tgl_akhir'];
	// $filter=$_POST['filter'];
	$kota = $_POST['kota'];
	$outlet = $_POST['outlet'];
	$area = $_POST['area'];
	$nasional = $_POST['nasional'];
	$divisi = $_POST['divisi'];
	$unitkerja = $_POST['unitkerja'];

	// echo '<br/>' . $tgl_awal;
	// echo '<br/>' . $tgl_akhir;
	// // echo '<br/>'.$filter;
	// echo '<br/>' . $kota;
	// echo '<br/>' . $outlet;
	// echo '<br/>' . $area;
	// echo '<br/>' . $divisi;
	// echo '<br/>' . $nasional;

	if ($kota != '') {
		$filter = 'kota';
		$nilai = $kota;
	} elseif ($outlet != '') {
		$filter = 'outlet';
		$nilai = $outlet;
	} elseif ($area != '') {
		$filter = 'area';
		$nilai = $area;
	} elseif ($divisi != '') {
		$filter = 'divisi';
		$nilai = $divisi;
	} elseif ($nasional != '') {
		$filter = 'nasional'; // Mengubah 'nasiona' menjadi 'nasional'
		$nilai = 'nasional';
	} elseif ($unitkerja != '') {
		$filter = 'unitkerja';
		$nilai = $unitkerja;
	} else {
		$filter = 'semua';
		$nilai = 'semua';
	}

	header('location:../../route/' . $data . '/lap_rekap_penjualan_model2.php?filter=' . $filter . '&nilai=' . $nilai . '&tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir);
} elseif ($route == $tujuan and $act == 'report-penerimaan') {

	$tgl_awal = $_POST['tgl_awal'];
	$tgl_akhir = $_POST['tgl_akhir'];
	// $filter=$_POST['filter'];
	$kota = $_POST['kota'];
	$outlet = $_POST['outlet'];
	$area = $_POST['area'];
	$divisi = $_POST['divisi'];
	$unitkerja = $_POST['unitkerja'];

	echo '<br/>' . $tgl_awal;
	echo '<br/>' . $tgl_akhir;
	// echo '<br/>'.$filter;
	echo '<br/>' . $kota;
	echo '<br/>' . $outlet;
	echo '<br/>' . $area;
	echo '<br/>' . $divisi;

	if ($kota != '') {
		$filter = 'kota';
		$nilai = $kota;
	} elseif ($outlet != '') {
		$filter = 'outlet';
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

	header('location:../../route/' . $data . '/lap_mutasi_penerimaan_model2.php?filter=' . $filter . '&nilai=' . $nilai . '&tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir);
} elseif ($route == $tujuan and $act == 'report-pengeluaran') {

	$tgl_awal = $_POST['tgl_awal'];
	$tgl_akhir = $_POST['tgl_akhir'];
	// $filter=$_POST['filter'];
	$kota = $_POST['kota'];
	$outlet = $_POST['outlet'];
	$area = $_POST['area'];
	$divisi = $_POST['divisi'];
	$unitkerja = $_POST['unitkerja'];

	echo '<br/>' . $tgl_awal;
	echo '<br/>' . $tgl_akhir;
	// echo '<br/>'.$filter;
	echo '<br/>' . $kota;
	echo '<br/>' . $outlet;
	echo '<br/>' . $area;
	echo '<br/>' . $divisi;

	if ($kota != '') {
		$filter = 'kota';
		$nilai = $kota;
	} elseif ($outlet != '') {
		$filter = 'outlet';
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

	header('location:../../route/' . $data . '/lap_mutasi_pengeluaran_model2.php?filter=' . $filter . '&nilai=' . $nilai . '&tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir);
} elseif ($route == $tujuan and $act == 'report-penerimaan_per_account') {

	$tgl_awal = $_POST['tgl_awal'];
	$tgl_akhir = $_POST['tgl_akhir'];
	// $filter=$_POST['filter'];
	$kota = $_POST['kota'];
	$outlet = $_POST['outlet'];
	$area = $_POST['area'];
	$divisi = $_POST['divisi'];
	$unitkerja = $_POST['unitkerja'];

	echo '<br/>' . $tgl_awal;
	echo '<br/>' . $tgl_akhir;
	// echo '<br/>'.$filter;
	echo '<br/>' . $kota;
	echo '<br/>' . $outlet;
	echo '<br/>' . $area;
	echo '<br/>' . $divisi;

	if ($kota != '') {
		$filter = 'kota';
		$nilai = $kota;
	} elseif ($outlet != '') {
		$filter = 'outlet';
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

	header('location:../../route/' . $data . '/lap_mutasi_penerimaan_per_account_model2.php?filter=' . $filter . '&nilai=' . $nilai . '&tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir);
} elseif ($route == $tujuan and $act == 'report-pengeluaran_per_account') {

	$tgl_awal = $_POST['tgl_awal'];
	$tgl_akhir = $_POST['tgl_akhir'];
	// $filter=$_POST['filter'];
	$kota = $_POST['kota'];
	$outlet = $_POST['outlet'];
	$area = $_POST['area'];
	$divisi = $_POST['divisi'];
	$unitkerja = $_POST['unitkerja'];

	echo '<br/>' . $tgl_awal;
	echo '<br/>' . $tgl_akhir;
	// echo '<br/>'.$filter;
	echo '<br/>' . $kota;
	echo '<br/>' . $outlet;
	echo '<br/>' . $area;
	echo '<br/>' . $divisi;

	if ($kota != '') {
		$filter = 'kota';
		$nilai = $kota;
	} elseif ($outlet != '') {
		$filter = 'outlet';
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

	header('location:../../route/' . $data . '/lap_mutasi_pengeluaran_per_account_model2.php?filter=' . $filter . '&nilai=' . $nilai . '&tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir);
} elseif ($route == $tujuan and $act == 'report-kirim_terima_per_akun') {

	$tgl_awal = $_POST['tgl_awal'];
	$tgl_akhir = $_POST['tgl_akhir'];
	// $filter=$_POST['filter'];
	$kota = $_POST['kota'];
	$outlet = $_POST['outlet'];
	$area = $_POST['area'];
	$divisi = $_POST['divisi'];
	$unitkerja = $_POST['unitkerja'];

	echo '<br/>' . $tgl_awal;
	echo '<br/>' . $tgl_akhir;
	// echo '<br/>'.$filter;
	echo '<br/>' . $kota;
	echo '<br/>' . $outlet;
	echo '<br/>' . $area;
	echo '<br/>' . $divisi;

	if ($kota != '') {
		$filter = 'kota';
		$nilai = $kota;
	} elseif ($outlet != '') {
		$filter = 'outlet';
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

	header('location:../../route/' . $data . '/lap_mutasi_kirim_terima_per_akun_model2.php?filter=' . $filter . '&nilai=' . $nilai . '&tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir);
} elseif ($route == $tujuan and $act == 'report-kirim') {

	$tgl_awal = $_POST['tgl_awal'];
	$tgl_akhir = $_POST['tgl_akhir'];
	// $filter=$_POST['filter'];
	$kota = $_POST['kota'];
	$outlet = $_POST['outlet'];
	$area = $_POST['area'];
	$divisi = $_POST['divisi'];
	$unitkerja = $_POST['unitkerja'];

	echo '<br/>' . $tgl_awal;
	echo '<br/>' . $tgl_akhir;
	// echo '<br/>'.$filter;
	echo '<br/>' . $kota;
	echo '<br/>' . $outlet;
	echo '<br/>' . $area;
	echo '<br/>' . $divisi;

	if ($kota != '') {
		$filter = 'kota';
		$nilai = $kota;
	} elseif ($outlet != '') {
		$filter = 'outlet';
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

	header('location:../../route/' . $data . '/lap_mutasi_kirim_model2.php?filter=' . $filter . '&nilai=' . $nilai . '&tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir);
} elseif ($route == $tujuan and $act == 'report-stok-per-outlet') {

	$tgl_awal = $_POST['tgl_awal'];
	$tgl_akhir = $_POST['tgl_akhir'];
	// $filter=$_POST['filter'];
	$kota = $_POST['kota'];
	$outlet = $_POST['outlet'];
	$area = $_POST['area'];
	$divisi = $_POST['divisi'];
	$unitkerja = $_POST['unitkerja'];

	echo '<br/>' . $tgl_awal;
	echo '<br/>' . $tgl_akhir;
	// echo '<br/>'.$filter;
	echo '<br/>' . $kota;
	echo '<br/>' . $outlet;
	echo '<br/>' . $area;
	echo '<br/>' . $divisi;

	if ($kota != '') {
		$filter = 'kota';
		$nilai = $kota;
	} elseif ($outlet != '') {
		$filter = 'outlet';
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

	header('location:../../route/' . $data . '/lap_mutasi_stok_per_outlet_model2.php?filter=' . $filter . '&nilai=' . $nilai . '&tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir);
} elseif ($route == $tujuan and $act == 'report-per-barang') {

	$tgl_awal = $_POST['tgl_awal'];
	$tgl_akhir = $_POST['tgl_akhir'];
	// $filter=$_POST['filter'];
	$kota = $_POST['kota'];
	$outlet = $_POST['outlet'];
	$area = $_POST['area'];
	$divisi = $_POST['divisi'];
	$unitkerja = $_POST['unitkerja'];

	echo '<br/>' . $tgl_awal;
	echo '<br/>' . $tgl_akhir;
	// echo '<br/>'.$filter;
	echo '<br/>' . $kota;
	echo '<br/>' . $outlet;
	echo '<br/>' . $area;
	echo '<br/>' . $divisi;

	if ($kota != '') {
		$filter = 'kota';
		$nilai = $kota;
	} elseif ($outlet != '') {
		$filter = 'outlet';
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

	header('location:../../route/' . $data . '/lap_mutasi_per_barang_model2.php?filter=' . $filter . '&nilai=' . $nilai . '&tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir);
} elseif ($route == $tujuan and $act == 'report-hpp-per-outlet') {

	$tgl_awal = $_POST['tgl_awal'];
	$tgl_akhir = $_POST['tgl_akhir'];
	// $filter=$_POST['filter'];
	$kota = $_POST['kota'];
	$outlet = $_POST['outlet'];
	$area = $_POST['area'];
	$divisi = $_POST['divisi'];
	$unitkerja = $_POST['unitkerja'];

	echo '<br/>' . $tgl_awal;
	echo '<br/>' . $tgl_akhir;
	// echo '<br/>'.$filter;
	echo '<br/>' . $kota;
	echo '<br/>' . $outlet;
	echo '<br/>' . $area;
	echo '<br/>' . $divisi;

	if ($kota != '') {
		$filter = 'kota';
		$nilai = $kota;
	} elseif ($outlet != '') {
		$filter = 'outlet';
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

	header('location:../../route/' . $data . '/lap_mutasi_hpp_per_outlet_model2.php?filter=' . $filter . '&nilai=' . $nilai . '&tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir);
} elseif ($route == $tujuan and $act == 'report-laba-penjualan') {

	$tgl_awal = $_POST['tgl_awal'];
	$tgl_akhir = $_POST['tgl_akhir'];
	// $filter=$_POST['filter'];
	$kota = $_POST['kota'];
	$outlet = $_POST['outlet'];
	$area = $_POST['area'];
	$divisi = $_POST['divisi'];
	$unitkerja = $_POST['unitkerja'];

	echo '<br/>' . $tgl_awal;
	echo '<br/>' . $tgl_akhir;
	// echo '<br/>'.$filter;
	echo '<br/>' . $kota;
	echo '<br/>' . $outlet;
	echo '<br/>' . $area;
	echo '<br/>' . $divisi;

	if ($kota != '') {
		$filter = 'kota';
		$nilai = $kota;
	} elseif ($outlet != '') {
		$filter = 'outlet';
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

	header('location:../../route/' . $data . '/lap_mutasi_laba_penjualan_model2.php?filter=' . $filter . '&nilai=' . $nilai . '&tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir);
} elseif ($route == $tujuan and $act == 'report-trend-penjualan') {

	$tgl_awal = $_POST['tgl_awal'];
	$tgl_akhir = $_POST['tgl_akhir'];
	// $filter=$_POST['filter'];
	$kota = $_POST['kota'];
	$outlet = $_POST['outlet'];
	$area = $_POST['area'];
	$divisi = $_POST['divisi'];
	$unitkerja = $_POST['unitkerja'];

	echo '<br/>' . $tgl_awal;
	echo '<br/>' . $tgl_akhir;
	// echo '<br/>'.$filter;
	echo '<br/>' . $kota;
	echo '<br/>' . $outlet;
	echo '<br/>' . $area;
	echo '<br/>' . $divisi;

	if ($kota != '') {
		$filter = 'kota';
		$nilai = $kota;
	} elseif ($outlet != '') {
		$filter = 'outlet';
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

	header('location:../../route/' . $data . '/lap_mutasi_trend_penjualan_model2.php?filter=' . $filter . '&nilai=' . $nilai . '&tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir);
} elseif ($route == $tujuan and $act == 'report-per-menu') {

	$tgl_awal = $_POST['tgl_awal'];
	$tgl_akhir = $_POST['tgl_akhir'];
	// $filter=$_POST['filter'];
	$kota = $_POST['kota'];
	$outlet = $_POST['outlet'];
	$area = $_POST['area'];
	$divisi = $_POST['divisi'];
	$unitkerja = $_POST['unitkerja'];

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
		$filter = 'outlet';
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

	header('location:../../route/' . $data . '/lap_mutasi_per_menu_model2.php?filter=' . $filter . '&nilai=' . $nilai . '&tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir);
} elseif ($route == $tujuan and $act == 'report-mutasi_per_hpp') {

	$tgl_awal = $_POST['tgl_awal'];
	$tgl_akhir = $_POST['tgl_akhir'];
	// $filter=$_POST['filter'];
	$kota = $_POST['kota'];
	$outlet = $_POST['outlet'];
	$area = $_POST['area'];
	$divisi = $_POST['divisi'];
	$unitkerja = $_POST['unitkerja'];

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
		$filter = 'outlet';
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

	header('location:../../route/' . $data . '/lap_mutasi_per_hpp_model2.php?filter=' . $filter . '&nilai=' . $nilai . '&tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir);
} elseif ($route == $tujuan and $act == 'report-laba-penjualan_retail') {

	$tgl_awal = $_POST['tgl_awal'];
	$tgl_akhir = $_POST['tgl_akhir'];
	// $filter=$_POST['filter'];
	$kota = $_POST['kota'];
	$outlet = $_POST['outlet'];
	$area = $_POST['area'];
	$divisi = $_POST['divisi'];
	$unitkerja = $_POST['unitkerja'];

	echo '<br/>' . $tgl_awal;
	echo '<br/>' . $tgl_akhir;
	// echo '<br/>'.$filter;
	echo '<br/>' . $kota;
	echo '<br/>' . $outlet;
	echo '<br/>' . $area;
	echo '<br/>' . $divisi;

	if ($kota != '') {
		$filter = 'kota';
		$nilai = $kota;
	} elseif ($outlet != '') {
		$filter = 'outlet';
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

	header('location:../../route/' . $data . '/lap_mutasi_laba_penjualan_model2_retail.php?filter=' . $filter . '&nilai=' . $nilai . '&tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir);
} elseif ($route == $tujuan and $act == 'report-laba-penjualan_grosir') {

	$tgl_awal = $_POST['tgl_awal'];
	$tgl_akhir = $_POST['tgl_akhir'];
	// $filter=$_POST['filter'];
	$kota = $_POST['kota'];
	$outlet = $_POST['outlet'];
	$area = $_POST['area'];
	$divisi = $_POST['divisi'];
	$unitkerja = $_POST['unitkerja'];

	echo '<br/>' . $tgl_awal;
	echo '<br/>' . $tgl_akhir;
	// echo '<br/>'.$filter;
	echo '<br/>' . $kota;
	echo '<br/>' . $outlet;
	echo '<br/>' . $area;
	echo '<br/>' . $divisi;

	if ($kota != '') {
		$filter = 'kota';
		$nilai = $kota;
	} elseif ($outlet != '') {
		$filter = 'outlet';
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

	header('location:../../route/' . $data . '/lap_mutasi_laba_penjualan_model2_grosir.php?filter=' . $filter . '&nilai=' . $nilai . '&tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir);
} elseif ($route == $tujuan and $act == 'stock-opname-tambah') {

	$tanggal = date('Y-m-d');
	$lokasi = isset($_POST['lokasi']) ? $_POST['lokasi'] : '';
	$barang = isset($_POST['barang']) ? $_POST['barang'] : '';
	$jumlah = isset($_POST['opname']) ? $_POST['opname'] : '';

	if ($lokasi == 1316) {
		$query_lock_barang = "UPDATE barang SET Pcs = 1 WHERE kd_brg = '$barang'";
		$result_lock_barang = mysqli_query($koneksi, $query_lock_barang);

		if (!$result_lock_barang) {
			die("Error Update Inventory: " . mysqli_error($koneksi));
		}
	} else {
		$query_lock_barang = "UPDATE barang SET Renteng = 1 WHERE kd_brg = '$barang'";
		$result_lock_barang = mysqli_query($koneksi, $query_lock_barang);

		if (!$result_lock_barang) {
			die("Error Update Inventory: " . mysqli_error($koneksi));
		}
	}

	$query_barang = "SELECT harga FROM barang WHERE kd_brg = '$barang'";
	$result_barang = mysqli_query($koneksi, $query_barang);

	if (mysqli_num_rows($result_barang) > 0) {
		$row = mysqli_fetch_assoc($result_barang);
		$harga = $row['harga'];
	}
	// $query_update = "UPDATE inventory SET stok = '$jumlah' WHERE kd_brg = '$barang' AND kd_cus = '$lokasi'";
	// $result_update = mysqli_query($koneksi, $query_update);

	// if (!$result_update) {
	// 	die("Error Update Inventory: " . mysqli_error($koneksi));
	// }
	// $updatestock = mysqli_query($koneksi, "UPDATE inventory SET stok = '$jumlah' WHERE kd_brg = '$barang' AND kd_cus = '$lokasi'");
	// if (mysqli_affected_rows($koneksi) == 0) {
	// 	$insertstock = mysqli_query($koneksi, "INSERT INTO inventory (kd_brg, kd_cus, stok,satuan) VALUES ('$barang', '$lokasi', '$jumlah','Pcs')");
	// }
	$check = mysqli_query($koneksi, "SELECT COUNT(*) as count FROM inventory WHERE kd_brg = '$barang' AND kd_cus = '$lokasi'");
	$row = mysqli_fetch_assoc($check);

	if ($row['count'] > 0) {
		// Record exists, update it
		$updatestock = mysqli_query($koneksi, "UPDATE inventory SET stok = '$jumlah' WHERE kd_brg = '$barang' AND kd_cus = '$lokasi'");
	} else {
		// Record doesn't exist, insert it
		$insertstock = mysqli_query($koneksi, "INSERT INTO inventory (kd_brg, kd_cus, stok, satuan) VALUES ('$barang', '$lokasi', '$jumlah', 'Pcs')");
	}

	$query_check = "SELECT kd_cus FROM mutasi_stok WHERE tgl = '$tanggal' AND kd_cus = '$lokasi' AND kd_brg = '$barang'";
	$result_check = mysqli_query($koneksi, $query_check);

	if (mysqli_num_rows($result_check) > 0) {

		$query_update = "UPDATE mutasi_stok SET 
    qt_opname_hari = qt_opname_hari + ($jumlah - qt_akhir),
    nilai_opname_hari = nilai_opname_hari + (($jumlah * $harga) - nilai_akhir),
    qt_akhir = qt_akhir + ($jumlah - qt_akhir),
    qt_tersedia = $jumlah,
    nilai_tersedia = $jumlah * $harga,
    harga_rata = CASE 
                 WHEN qt_tersedia > 0 THEN nilai_tersedia / qt_tersedia
                 ELSE $harga 
                 END,                          
    hpp_jual = CASE 
                 WHEN qt_tersedia > 0 THEN (nilai_tersedia / qt_tersedia) * qt_jual
                 ELSE $harga * qt_jual
                 END,
    nilai_akhir = CASE 
                 WHEN qt_tersedia > 0 THEN (nilai_tersedia / qt_tersedia) * qt_akhir
                 ELSE $harga * qt_akhir
                 END
    WHERE tgl = '$tanggal' AND kd_cus = '$lokasi' AND kd_brg = '$barang'";

		$resut_update = mysqli_query($koneksi, $query_update);
		if (!$resut_update) {
			die("Query update ke mutasi_semua gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
		}
	} else {

		// Query untuk mendapatkan nilai awal, qty awal, nilai beli sebelumnya, dan qty beli sebelumnya dari tanggal terbaru
		$query_awal = "SELECT
		tgl AS tgl_terakhir, 
		nilai_akhir AS nilai_awalakhir,
		qt_akhir AS qty_awalakhir,
		stok_opname, nilai_opname       
		FROM mutasi_stok 
		WHERE kd_cus = '$lokasi' AND kd_brg = '$barang' 
		ORDER BY 
		tgl_terakhir DESC 
		LIMIT 1";

		$result_awal = mysqli_query($koneksi, $query_awal);

		if (!$result_awal) {
			die("Query untuk mendapatkan nilai awal, qty awal, nilai beli sebelumnya, dan qty beli sebelumnya gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
		}

		if (mysqli_num_rows($result_awal) > 0) {
			$row_awal = mysqli_fetch_assoc($result_awal);
			$nilai_awal = $row_awal['nilai_awalakhir'];
			$qty_awal = $row_awal['qty_awalakhir'];
			$stok_opname = $row_awal['stok_opname'];
			$nilai_opname = $row_awal['nilai_opname'];
		} else {
			$nilai_awal = 0;
			$qty_awal = 0;
			$stok_opname = 0;
			$nilai_opname = 0;
		}

		// Tentukan nilai qty_awal
		$qty_awal = $stok_opname != 0 ? $stok_opname : $qty_awal;
		$nilai_awal = $nilai_opname != 0 ? $nilai_opname : $nilai_awal;
		$nilai_awal = is_numeric($nilai_awal) ? $nilai_awal : 0;
		$qty_awal = is_numeric($qty_awal) ? $qty_awal : 0;
		// $qt_tersedia = $qty_awal + $jumlah;
		// $nilai_tersedia = $nilai_awal + ($jumlah * $harga);
		$qt_tersedia = $jumlah;
		$nilai_tersedia = ($jumlah * $harga);
		$qty_opname = $jumlah - $qty_awal;
		$nilai_opname = $nilai_tersedia - $nilai_awal;

		if ($qt_tersedia > 0) {
			$harga_rata_sebelumnya = $nilai_tersedia / $qt_tersedia;
		} else {
			$harga_rata_sebelumnya = $harga;
		}
		// Insert data baru
		$query_insert = "INSERT INTO mutasi_stok 
		(tgl, qty_awal,nilai_awal,qt_opname_hari, nilai_opname_hari, qt_tersedia, nilai_tersedia,  
		harga_rata , kd_cus, kd_brg, satuan,
		qt_akhir, nilai_akhir) VALUES (
		'$tanggal',
		'$qty_awal',
		'$nilai_awal',
		'$qty_opname',
		'$nilai_opname',
		'$qt_tersedia',
		'$nilai_tersedia',
		'$harga_rata_sebelumnya',
		'$lokasi',
		'$barang',
		'Pcs',
		'$qt_tersedia',
		'$nilai_tersedia'
	)";
		$result_insert = mysqli_query($koneksi, $query_insert);
		if (!$result_insert) {
			die("Query insert ke mutasi_semua gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
		}
	}
	session_start();

	if (!isset($_SESSION['employee_number'])) {
		die('Employee not logged in!');
	}

	$employee_number = $_SESSION['employee_number'];
	$nilai = $jumlah * $harga;
	date_default_timezone_set('Asia/Jakarta');
	$created_at = date('Y-m-d H:i:s');
	$insertdetailopname = mysqli_query($koneksi, "INSERT INTO opname_detail (kd_cus, kd_brg, tgl, stok_opname, nilai_opname, user_input,waktu_buat) VALUES ('$lokasi', '$barang', '$tanggal', '$jumlah', '$nilai', '$employee_number', '$created_at')");


	$url = '../../main.php?route=opname_stock_mutasi&act&ide=' . urlencode($employee_number) . '&tujuan=mutasi';

	header('Location: ' . $url);
} elseif ($route == $tujuan and $act == 'report-opname-stock') {

	$tgl_awal = $_POST['tgl_awal'];
	$tgl_akhir = $_POST['tgl_akhir'];
	// $filter=$_POST['filter'];
	$kota = $_POST['kota'];
	$outlet = $_POST['outlet'];
	$area = $_POST['area'];
	$divisi = $_POST['divisi'];
	$unitkerja = $_POST['unitkerja'];
	$kategori_retail_grosir = $_POST['kategori_retail_grosir'];


	echo '<br/>' . $tgl_awal;
	echo '<br/>' . $tgl_akhir;
	// echo '<br/>'.$filter;
	echo '<br/>' . $kota;
	echo '<br/>' . $outlet;
	echo '<br/>' . $area;
	echo '<br/>' . $divisi;

	if ($kota != '') {
		$filter = 'kota';
		$nilai = $kota;
	} elseif ($outlet != '') {
		$filter = 'outlet';
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

	header('location:../../route/' . $data . '/lap_opname_stock_mutasi_model.php?filter=' . $filter . '&nilai=' . $nilai . '&tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir . '&kategori_retail_grosir=' . $kategori_retail_grosir);
} elseif ($route == $tujuan and $act == 'report-per-barang2') {

	$tgl_awal = $_POST['tgl_awal'];
	$tgl_akhir = $_POST['tgl_akhir'];
	$lokasi = $_POST['lokasi'];
	$barang = $_POST['barang'];
	// $filter=$_POST['filter'];
	$kota = $_POST['kota'];
	$outlet = $_POST['outlet'];
	$area = $_POST['area'];
	$divisi = $_POST['divisi'];
	$unitkerja = $_POST['unitkerja'];

	echo '<br/>' . $tgl_awal;
	echo '<br/>' . $tgl_akhir;
	// echo '<br/>'.$filter;
	echo '<br/>' . $kota;
	echo '<br/>' . $outlet;
	echo '<br/>' . $area;
	echo '<br/>' . $divisi;

	if ($kota != '') {
		$filter = 'kota';
		$nilai = $kota;
	} elseif ($outlet != '') {
		$filter = 'outlet';
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

	header('location:../../route/' . $data . '/lap_mutasi_per_barang_model22.php?filter=' . $filter . '&nilai=' . $nilai . '&tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir . '&lokasi=' . $lokasi . '&barang=' . $barang);
} elseif ($route == $tujuan and $act == 'report-per-barang_detail') {

	$tgl_awal = $_POST['tgl_awal'];
	$tgl_akhir = $_POST['tgl_akhir'];
	// $filter=$_POST['filter'];
	$kota = $_POST['kota'];
	$outlet = $_POST['outlet'];
	$area = $_POST['area'];
	$divisi = $_POST['divisi'];
	$unitkerja = $_POST['unitkerja'];

	echo '<br/>' . $tgl_awal;
	echo '<br/>' . $tgl_akhir;
	// echo '<br/>'.$filter;
	echo '<br/>' . $kota;
	echo '<br/>' . $outlet;
	echo '<br/>' . $area;
	echo '<br/>' . $divisi;

	if ($kota != '') {
		$filter = 'kota';
		$nilai = $kota;
	} elseif ($outlet != '') {
		$filter = 'outlet';
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

	header('location:../../route/' . $data . '/lap_mutasi_per_barang_model2_detail.php?filter=' . $filter . '&nilai=' . $nilai . '&tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir);
}
