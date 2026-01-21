<?php 
include '../../../../config/koneksi.php';

$route=$_GET['route'];
$act=$_GET['act'];

if($route=='pb1_strukprintulang' AND $act=='report')
{

	$tgl_awal=$_POST['tgl_awal'];
	$tgl_akhir=$_POST['tgl_akhir'];
	// $filter=$_POST['filter'];
	$kota=$_POST['kota'];
	$outlet=$_POST['outlet'];
	$area=$_POST['area'];
	// $area_e=$_POST['area_e'];

	// echo '<br/>'.$tgl_awal;
	// echo '<br/>'.$tgl_akhir;
	// echo '<br/>'.$filter;
	// echo '<br/>'.$kota;
	// echo '<br/>'.$outlet;
	// echo '<br/>'.$area;

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

	$login_hash=$_POST['login_hash'];

	$tgl1=new DateTime($tgl_awal);
	$tgl2=new DateTime($tgl_akhir);
	$selisihtgl= $tgl2->diff($tgl1);
	$selisihtgl=$selisihtgl->days;

	if(($login_hash=='6' OR $login_hash=='7' OR $login_hash=='8') AND $selisihtgl>=360){
			$tgl_akhir = date('Y-m-d', strtotime($tgl_awal. ' + 360 days'));

			$pesantgl='Range Tanggal lebih dari 7 Hari';
			echo "<script>alert('$pesantgl')</script>";
			echo "<script>history.go(-1)</script>";
	}elseif($selisihtgl>=360){
			$tgl_akhir = date('Y-m-d', strtotime($tgl_awal. ' + 360 days'));
			$pesantgl='Range Tanggal lebih dari 31 Hari';
			echo "<script>alert('$pesantgl')</script>";
			echo "<script>history.go(-1)</script>";
		
	}else{
			header('location:../../main.php?route='.$route.'&act=report&filter='.$filter.'&nilai='.$nilai.'&tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir);
	}

}