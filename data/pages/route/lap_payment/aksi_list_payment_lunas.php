<?php
include '../../../../config/koneksi.php';


$tujuan='lap_payment_lunas';


$data = 'lap_payment';
$rute = 'lap_payment_lunas';
$aksi = 'aksi_list_payment_lunas';;



$route = $_GET['route'];
$act = $_GET['act'];


if ($route == 'lap_payment_lunas' and $act == 'report') {
    
	$tgl_awal=$_POST['tgl_awal'];
	$tgl_akhir=$_POST['tgl_akhir'];
	// $filter=$_POST['filter'];
	$kota=$_POST['kota'];
	$outlet=$_POST['supplier'];
	$area=$_POST['area'];
	$divisi=$_POST['divisi'];
	$unitkerja=$_POST['unitkerja'];

	// echo "APAKAH keditek" .$outlet;

	// die();

	// echo '<br/>'.$tgl_awal;
	// echo '<br/>'.$tgl_akhir;
	// echo '<br/>'.$filter;
	// echo '<br/>'.$kota;
	// echo '<br/>'.$outlet;
	// echo '<br/>'.$area;
	// echo '<br/>'.$divisi;

	if($kota!=''){
		$filter='kota';
		$nilai=$kota;
	}elseif($outlet!=''){
		$filter='supplier';
		$nilai=$outlet;
	}elseif($area!=''){
		$filter='area';
		$nilai=$area;
	}elseif($divisi!=''){
		$filter='divisi';
		$nilai=$divisi;
	}elseif($unitkerja!=''){
		$filter='unitkerja';
		$nilai=$unitkerja;
	}else{
		$filter='semua';
		$nilai='semua';
	}

	header('location:../../route/'.$data.'/lap_payment_lunas_model2.php?filter='.$filter.'&nilai='.$nilai.'&tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir);

}