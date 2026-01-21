<?php 
include '../../../../config/koneksi.php';

$route=$_GET['route'];
$act=$_GET['act'];

if($route=='payment_pos1' AND $act=='report')
{

	$tgl_awal=$_POST['tgl_awal'];
	$tgl_akhir=$_POST['tgl_akhir'];
	// $filter=$_POST['filter'];
	$kota=$_POST['kota'];
	$outlet=$_POST['outlet'];
	$area=$_POST['area'];
	$kasir=$_POST['kasir'];

	echo '<br/>'.$tgl_awal;
	echo '<br/>'.$tgl_akhir;
	// echo '<br/>'.$filter;
	echo '<br/>'.$kota;
	echo '<br/>'.$outlet;
	echo '<br/>'.$area;
	echo '<br/>'.$kasir;

	if($kota!=''){
		$filter='kota';
		$nilai=$kota;
	}elseif($outlet!=''){
		$filter='outlet';
		$nilai=$outlet;
	}elseif($area!=''){
		$filter='area';
		$nilai=$area;
	}elseif($kasir!=''){
		$filter='kasir';
		$nilai=$kasir;
	}else{
		$filter='semua';
		$nilai='semua';
	}

	header('location:../../main.php?route='.$route.'&act=report&filter='.$filter.'&nilai='.$nilai.'&tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir);
	// header('location:../../route/lap_pb1/lap_1.php?filter='.$filter.'&nilai='.$nilai.'&tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir);

}elseif($route=='payment_pos2' AND $act=='report')
{

	$tgl_awal=$_POST['tgl_awal'];
	$tgl_akhir=$_POST['tgl_akhir'];
	// $filter=$_POST['filter'];
	$kota=$_POST['kota'];
	$outlet=$_POST['outlet'];
	$area=$_POST['area'];
	$kasir=$_POST['kasir'];

	echo '<br/>'.$tgl_awal;
	echo '<br/>'.$tgl_akhir;
	// echo '<br/>'.$filter;
	echo '<br/>'.$kota;
	echo '<br/>'.$outlet;
	echo '<br/>'.$area;
	echo '<br/>'.$kasir;

	if($kota!=''){
		$filter='kota';
		$nilai=$kota;
	}elseif($outlet!=''){
		$filter='outlet';
		$nilai=$outlet;
	}elseif($area!=''){
		$filter='area';
		$nilai=$area;
	}elseif($kasir!=''){
		$filter='kasir';
		$nilai=$kasir;
	}else{
		$filter='semua';
		$nilai='semua';
	}

	header('location:../../main.php?route='.$route.'&act=report&filter='.$filter.'&nilai='.$nilai.'&tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir);
	// header('location:../../route/lap_pb1/lap_1.php?filter='.$filter.'&nilai='.$nilai.'&tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir);

}elseif($route=='payment_pos2b' AND $act=='report')
{

	$tgl_awal=$_POST['tgl_awal'];
	$tgl_akhir=$_POST['tgl_akhir'];
	// $filter=$_POST['filter'];
	$kota=$_POST['kota'];
	$outlet=$_POST['outlet'];
	$area=$_POST['area'];
	$kasir=$_POST['kasir'];

	echo '<br/>'.$tgl_awal;
	echo '<br/>'.$tgl_akhir;
	// echo '<br/>'.$filter;
	echo '<br/>'.$kota;
	echo '<br/>'.$outlet;
	echo '<br/>'.$area;
	echo '<br/>'.$kasir;

	if($kota!=''){
		$filter='kota';
		$nilai=$kota;
	}elseif($outlet!=''){
		$filter='outlet';
		$nilai=$outlet;
	}elseif($area!=''){
		$filter='area';
		$nilai=$area;
	}elseif($kasir!=''){
		$filter='kasir';
		$nilai=$kasir;
	}else{
		$filter='semua';
		$nilai='semua';
	}

	header('location:../../main.php?route='.$route.'&act=report&filter='.$filter.'&nilai='.$nilai.'&tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir);
	// header('location:../../route/lap_pb1/lap_1.php?filter='.$filter.'&nilai='.$nilai.'&tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir);

}
