<?php 
include '../../../../config/koneksi.php';

$route=$_GET['route'];
$act=$_GET['act'];

if($route=='lap_beban_fee' AND $act=='report')
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

	header('location:../../main.php?route='.$route.'&act=report&filter='.$filter.'&nilai='.$nilai.'&tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir.'&tujuan');
	// header('location:../../route/lap_beban_adm/menu_lap_beban_adm.php?route=report&filter='.$filter.'&nilai='.$nilai.'&tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir.'&tujuan='.$tujuan);

}
elseif($route=='rekap_beban_fee' AND $act=='report')
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

	header('location:../../main.php?route='.$route.'&act=report&filter='.$filter.'&nilai='.$nilai.'&tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir.'&tujuan='.$tujuan);
	// header('location:../../route/lap_rekap/rekap_beban_adm_model2.php?filter='.$filter.'&nilai='.$nilai.'&tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir.'&tujuan='.$tujuan);

}

