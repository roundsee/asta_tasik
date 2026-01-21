<?php
include '../../../../config/koneksi.php';


$tujuan='lap_pembelian';
$judulform = "Biaya";

$data = 'lap_biaya';
$rute = 'lap_biaya';
$aksi = 'aksi_list_biaya';


$tabel = 'biaya';

$f1 = 'no_account';
$f2 = 'nomor_bukti';
$f3 = 'tanggal';
$f4 = 'nama_biaya';
$f5 = 'keterangan';
$f6 = 'jumlah';


$j1 = 'Nomor Account';
$j2 = 'Nomor Bukti';
$j3 = 'Tanggal Bayar';
$j4 = 'Keterangan Biaya';
$j5 = 'Nama / Keterangan';
$j6 = 'Jumlah';



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


if ($route == 'lap_biaya' and $act == 'report') {
    
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
	
	header('location:../../route/'.$data.'/lap_biaya_model2.php?filter='.$filter.'&nilai='.$nilai.'&tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir);

}