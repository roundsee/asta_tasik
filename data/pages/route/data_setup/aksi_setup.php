<?php
$dir="../../../../";

$judulform="SETUP";

$data='data_setup';
$rute='setup';
$aksi='aksi_setup';

$tabel="setup";

$f1='nama';	
$f2='perusahaan';	
$f3='alamat';	
$f4='telp';	
$f5='email';	
$f6='web';	
$f7='naper_mini';	
$f8='naper1';	
$f9='naper2';	
$f10='ver';	
$f11='warna_primary_1';	
$f12='warna_primary_2';	
$f13='warna_primary_3';	
$f14='pesan1';	
$f15='pesan2';
$f16='photo';	

$j1='Nama User';	
$j2='Perusahaan';	
$j3='Alamat';	
$j4='No Telp';	
$j5='eMail';	
$j6='Web';	
$j7='naper_mini';	
$j8='naper1';	
$j9='naper2';	
$j10='ver';	
$j11='warna_primary_1';	
$j12='warna_primary_2';	
$j13='warna_primary_3';	
$j14='Pesan Struk';	
$j15='Pesan2';
$j16='photo';

session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
	echo "<link href='style.css' rel='stylesheet' type='text/css'>
	<center>Untuk mengakses modul, Anda harus login <br>";
	echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
	include $dir."config/koneksi.php";
	
	$route=$_GET['route'];
	$act=$_GET['act'];

	if($route=='setup' AND $act=='edit')
	{
		
		$query  = "UPDATE $tabel SET 
		$f1 = '$_POST[$f1]',
		$f2 = '$_POST[$f2]',
		$f3 = '$_POST[$f3]', 
		$f4 = '$_POST[$f4]',
		$f5 = '$_POST[$f5]',
		$f6 = '$_POST[$f6]',
		$f14 = '$_POST[$f14]'
		";
		$result = mysqli_query($koneksi, $query);

		if(!$result){
			die ("Query gagal dijalankan : ".mysqli_errno($koneksi).
				" - ".mysqli_error($koneksi));
		} else {
			// echo "<script>alert('Data berhasil diubah.')</script>";
			echo "<script>history.go(-2)</script>";
		}
	}

}
?>
