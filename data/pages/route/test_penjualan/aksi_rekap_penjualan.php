<?php 
include '../../../../config/koneksi.php';
// include 'acak.php';

$route=$_GET['route'];
$act=$_GET['act'];

if($route=='rek' AND $act=='report')
{

	$tgl_awal=$_POST['tgl_awal'];
	$tgl_akhir=$_POST['tgl_akhir'];
	// $filter=$_POST['filter'];
	$kota=$_POST['kota'];
	$outlet=$_POST['outlet'];
	$area=$_POST['area'];

	echo '<br/>'.$tgl_awal;
	echo '<br/>'.$tgl_akhir;
	// echo '<br/>'.$filter;
	echo '<br/>'.$kota;
	echo '<br/>'.$outlet;
	echo '<br/>'.$area;

	if($kota!=''){
		$filter='kota';
		$nilai=$kota;
	}elseif($outlet!=''){
		$filter='outlet';
		$nilai=$outlet;
	}elseif($area!=''){
		$filter='area';
		$nilai=$area;
	}else{
		$filter='semua';
		$nilai='semua';
	}

	header('location:../../main.php?route='.$route.'&act=report&filter='.$filter.'&nilai='.$nilai.'&tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir);
	// header('location:../../route/lap_rekap/lap_1.php?filter='.$filter.'&nilai='.$nilai.'&tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir);

}
elseif($route=='rekap' AND $act=='rekap_model2')
{
	$tujuan=$_GET['tujuan'];

	$tgl_awal=$_POST['tgl_awal'];
	$tgl_akhir=$_POST['tgl_akhir'];
	// $filter=$_POST['filter'];
	$kota=$_POST['kota'];
	$outlet=$_POST['outlet'];
	$area=$_POST['area'];

	echo '<br/>'.$tgl_awal;
	echo '<br/>'.$tgl_akhir;
	// echo '<br/>'.$filter;
	echo '<br/>'.$kota;
	echo '<br/>'.$outlet;
	echo '<br/>'.$area;

	if($kota!=''){
		$filter='kota';
		$nilai=$kota;
	}elseif($outlet!=''){
		$filter='outlet';
		$nilai=$outlet;
	}elseif($area!=''){
		$filter='area';
		$nilai=$area;
	}else{
		$filter='semua';
		$nilai='semua';
	}

	// header('location:../../main.php?route='.$route.'&act=report&filter='.$filter.'&nilai='.$nilai.'&tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir);
	header('location:../../route/test_penjualan/lap_rekap_penjualan_model2.php?filter='.$filter.'&nilai='.$nilai.'&tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir.'&tujuan='.$tujuan);

}
elseif($route=='rekap' AND $act=='rekap_detil_model2')
{
	$tujuan=$_GET['tujuan'];

	$tgl_awal=$_POST['tgl_awal'];
	$tgl_akhir=$_POST['tgl_akhir'];
	// $filter=$_POST['filter'];
	$kota=$_POST['kota'];
	$outlet=$_POST['outlet'];
	$area=$_POST['area'];

	echo '<br/>'.$tgl_awal;
	echo '<br/>'.$tgl_akhir;
	// echo '<br/>'.$filter;
	echo '<br/>'.$kota;
	echo '<br/>'.$outlet;
	echo '<br/>'.$area;

	if($kota!=''){
		$filter='kota';
		$nilai=$kota;
	}elseif($outlet!=''){
		$filter='outlet';
		$nilai=$outlet;
	}elseif($area!=''){
		$filter='area';
		$nilai=$area;
	}else{
		$filter='semua';
		$nilai='semua';
	}

	// header('location:../../main.php?route='.$route.'&act=report&filter='.$filter.'&nilai='.$nilai.'&tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir);
	header('location:../../route/test_penjualan/lap_rekap_penjualan_detil_model2.php?filter='.$filter.'&nilai='.$nilai.'&tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir.'&tujuan='.$tujuan);

}

