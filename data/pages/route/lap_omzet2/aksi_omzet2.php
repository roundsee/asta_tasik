<?php 
include '../../../../config/koneksi.php';
include 'acak.php';

$route=$_GET['route'];
$act=$_GET['act'];


if($route=='daftar_omzet_sebelumnya' AND $act=='report')
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
	// header('location:../../route/lap_omzet/lap_1.php?filter='.$filter.'&nilai='.$nilai.'&tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir);

}