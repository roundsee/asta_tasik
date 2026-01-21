<?php
include '../../../../config/koneksi.php';

$tujuan = 'list_lap_baru';

$data = 'lap_baru';
$rute = 'list_lap_baru';
$aksi = 'aksi_list_lap_baru';

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
} elseif ($route == $tujuan and $act == 'vendor_aged') {

	$tipe_laporan = $_POST['tipe_laporan'];
	$supplier = $_POST['supplier']; // this is an array
	$supplier_string = implode(',', $supplier); // turn it into string like "SUP001,SUP002"

	$tgl_awal = $_POST['tgl_awal'];


	$filter = 'semua';
	$nilai = 'semua';
	header('location:../../route/' . $data . '/vendor_aged_model.php?filter=' . $filter . '&nilai=' . $nilai . '&supplier=' . $supplier_string . '&tipe_laporan=' . $tipe_laporan . '&tgl_awal=' . $tgl_awal);
} elseif ($route == $tujuan and $act == 'customer_aged') {

	$tipe_laporan = $_POST['tipe_laporan'];
	$supplier = $_POST['supplier']; // this is an array
	$supplier_string = implode(',', $supplier); // turn it into string like "SUP001,SUP002"

	$tgl_awal = $_POST['tgl_awal'];


	$filter = 'semua';
	$nilai = 'semua';
	header('location:../../route/' . $data . '/customer_aged_model.php?filter=' . $filter . '&nilai=' . $nilai . '&supplier=' . $supplier_string . '&tipe_laporan=' . $tipe_laporan . '&tgl_awal=' . $tgl_awal);
} elseif ($route == $tujuan and $act == 'vendor_purchase') {

	$tipe_laporan = $_POST['tipe_laporan'];
	$supplier = $_POST['supplier']; // this is an array
	$supplier_string = implode(',', $supplier); // turn it into string like "SUP001,SUP002"

	$tgl_awal = $_POST['tgl_awal'];
	$tgl_akhir = $_POST['tgl_akhir'];



	$filter = 'semua';
	$nilai = 'semua';
	header('location:../../route/' . $data . '/vendor_pruchases_model.php?filter=' . $filter . '&nilai=' . $nilai . '&supplier=' . $supplier_string . '&tipe_laporan=' . $tipe_laporan . '&tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir);
} elseif ($route == $tujuan and $act == 'customer_sales') {

	$tipe_laporan = $_POST['tipe_laporan'];
	$tipe_lokasi = $_POST['tipe_lokasi'];


	$supplier = $_POST['supplier']; // this is an array
	$supplier_string = implode(',', $supplier); // turn it into string like "SUP001,SUP002"

	$barangsearch = $_POST['barangsearch']; // this is an array
	$barangsearch_string = implode(',', $barangsearch); // turn it into string like "SUP001,SUP002"

	$tgl_awal = $_POST['tgl_awal'];
	$tgl_akhir = $_POST['tgl_akhir'];



	$filter = 'semua';
	$nilai = 'semua';
	header('location:../../route/' . $data . '/customer_sales_model.php?filter=' . $filter . '&nilai=' . $nilai . '&supplier=' . $supplier_string . '&tipe_laporan=' . $tipe_laporan . '&tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir . '&barangsearch=' . $barangsearch_string . '&tipe_lokasi=' . $tipe_lokasi);
} elseif ($route == $tujuan and $act == 'example_vendor_pending_vendor') {
	$supplier = $_POST['supplier']; // this is an array
	$supplier_string = implode(',', $supplier); // turn it into string like "SUP001,SUP002"

	$tgl_awal = $_POST['tgl_awal'];


	$filter = 'semua';
	$nilai = 'semua';
	header('location:../../route/' . $data . '/vendor_pending_purchases_vendor_model.php?filter=' . $filter . '&nilai=' . $nilai . '&supplier=' . $supplier_string . '&tgl_awal=' . $tgl_awal);
} elseif ($route == $tujuan and $act == 'example_vendor_pending_items') {
	$supplier = $_POST['supplier']; // this is an array
	$supplier_string = implode(',', $supplier); // turn it into string like "SUP001,SUP002"

	$tgl_awal = $_POST['tgl_awal'];


	$filter = 'semua';
	$nilai = 'semua';
	header('location:../../route/' . $data . '/vendor_pending_purchases_items_model.php?filter=' . $filter . '&nilai=' . $nilai . '&supplier=' . $supplier_string . '&tgl_awal=' . $tgl_awal);
} elseif ($route == $tujuan and $act == 'example_customer_category') {

	$tipe_laporan = $_POST['tipe_laporan'];


	$supplier = $_POST['supplier']; // this is an array
	$supplier_string = implode(',', $supplier); // turn it into string like "SUP001,SUP002"

	$tgl_awal = $_POST['tgl_awal'];
	$tgl_akhir = $_POST['tgl_akhir'];



	$filter = 'semua';
	$nilai = 'semua';
	header('location:../../route/' . $data . '/customer_category_sales_model.php?filter=' . $filter . '&nilai=' . $nilai . '&supplier=' . $supplier_string . '&tipe_laporan=' . $tipe_laporan . '&tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir);
} elseif ($route == $tujuan and $act == 'inventory_summary') {

	$tipe_lokasi = $_POST['tipe_lokasi'];
	$barangsearch = $_POST['barangsearch']; // this is an array
	$barangsearch_string = implode(',', $barangsearch); // turn it into string like "SUP001,SUP002"

	$tgl_awal = $_POST['tgl_awal'];



	$filter = 'semua';
	$nilai = 'semua';
	header('location:../../route/' . $data . '/inventory_summary_model.php?filter=' . $filter . '&nilai=' . $nilai . '&tgl_awal=' . $tgl_awal . '&barangsearch=' . $barangsearch_string . '&tipe_lokasi=' . $tipe_lokasi);
} elseif ($route == $tujuan and $act == 'inventory_sales') {

	$tipe_laporan = $_POST['tipe_laporan'];
	$tipe_lokasi = $_POST['tipe_lokasi'];

	$barangsearch = $_POST['barangsearch']; // this is an array
	$barangsearch_string = implode(',', $barangsearch); // turn it into string like "SUP001,SUP002"

	$tgl_awal = $_POST['tgl_awal'];
	$tgl_akhir = $_POST['tgl_akhir'];



	$filter = 'semua';
	$nilai = 'semua';
	header('location:../../route/' . $data . '/inventory_sales_model.php?filter=' . $filter . '&nilai=' . $nilai . '&tipe_laporan=' . $tipe_laporan . '&tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir . '&barangsearch=' . $barangsearch_string . '&tipe_lokasi=' . $tipe_lokasi);
} elseif ($route == $tujuan and $act == 'inventory_transaction') {

	$tipe_laporan = $_POST['tipe_laporan'];
	$barangsearch = $_POST['barangsearch']; // this is an array
	$barangsearch_string = implode(',', $barangsearch); // turn it into string like "SUP001,SUP002"
	$tgl_awal = $_POST['tgl_awal'];
	$tgl_akhir = $_POST['tgl_akhir'];



	$filter = 'semua';
	$nilai = 'semua';
	header('location:../../route/' . $data . '/inventory_transaksi_model.php?filter=' . $filter . '&nilai=' . $nilai . '&tipe_laporan=' . $tipe_laporan . '&tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir . '&barangsearch=' . $barangsearch_string);
}
