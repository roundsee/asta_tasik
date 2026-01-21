<?php
$dir="../../../../";

$tujuan="jualdetil";
$tabel="jualdetil";
$f1='jadi';
$f2='faktur';
$f3='tanggal';
$f4='kd_cus';
$f5='kd_aplikasi';
$f6='kd_promo';
$f7='kd_brg';
$f8='banyak';
$f9='harga';
$f10='diskon';
$f11='jumlah';
$f12='faktur_refund';
$f12='penyajian';

session_start();

echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>';

echo "<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>";

if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
	echo "<link href='style.css' rel='stylesheet' type='text/css'>
	<center>Untuk mengakses modul, Anda harus login <br>";
	echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
	include $dir."config/koneksi.php";
	
	$route=$_GET['route'];
	$act=$_GET['act'];

	//Hapus area
	if($route==$tujuan AND $act=='hapus')
	{
		mysqli_query($koneksi,"DELETE from $tabel where $f1 = '$_GET[id]'");

				echo "
		<script type='text/javascript'>
		setTimeout(function(){
			swal({
				title:'Hapus Berhasil',
				text: '',
				type: 'success',
				timer: 3000,
				showConfirmButton:true
				});
				},10);
				window.setTimeout(function(){
					history.go(-1);
				},100);</script>";


		// echo "<script>alert('Data berhasil dihapus ');</script>";
		// header('location:../../main.php?route='.$route.'&act');
	}

	//Update area
	elseif($route==$tujuan AND $act=='update')
	{
		$date=date('Y-m-d');
		$rs=mysqli_query($koneksi,"UPDATE $tabel set 
			$f2='$_POST[$f2]',$f3='$_POST[$f3]',$f4='$_POST[$f4]',$f5='$_POST[$f5]',$f6='$_POST[$f6]',$f7='$_POST[$f7]',$f8='$_POST[$f8]',$f9='$_POST[$f9]',$f10='$_POST[$f10]',$f11='$_POST[$f11]',$f12='$_POST[$f12]',$f13='$_POST[$f13]'
			where $f1 = '".$_POST['id']."'") or die(mysqli_error($koneksi));

		echo "
		<script type='text/javascript'>
		setTimeout(function(){
			swal({
				title:'UPDATE Berhasil',
				text: '',
				type: 'success',
				timer: 6000,
				showConfirmButton:true
				});
				},10);
				window.setTimeout(function(){
					history.go(-2);
				},100);</script>";

		//header('location:../../main.php?route='.$route.'&act');
			}

	//Tambah area
			elseif($route==$tujuan AND $act=='input')
			{
				$tgl=date('Y-m-d');
				$rs=mysqli_query($koneksi,"INSERT into $tabel (
					$f1,$f2,$f3,$f4,$f5,$f6,$f7,$f8,$f9,$f10,$f11,$f12) 
				values (
					'".$_POST[$f1]."',
					'".$_POST[$f2]."',
					'".$_POST[$f3]."',
					'".$_POST[$f4]."',
					'".$_POST[$f5]."',
					'".$_POST[$f6]."',
					'".$_POST[$f7]."',
					'".$_POST[$f8]."',
					'".$_POST[$f9]."',
					'".$_POST[$f10]."',
					'".$_POST[$f11]."',
					'".$_POST[$f12]."',
					'".$_POST[$f13]."'
				)") or die(mysqli_error($koneksi));

						echo "
		<script type='text/javascript'>
		setTimeout(function(){
			swal({
				title:'TAMBAH Berhasil',
				text: '',
				type: 'success',
				timer: 3000,
				showConfirmButton:true
				});
				},10);
				window.setTimeout(function(){
					history.go(-2);
				},100);</script>";
				
			}

		}
		?>
