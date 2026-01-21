<?php
session_start();

$tabel = 'member';

$f1 = 'id';
$f2 = 'kd_member';
$f3 = 'nama';
$f4 = 'telp';
$f5 = 'alamat';
$f6 = 'kelurahan';
$f7 = 'kecamatan';
$f8 = 'kabupaten';
$f9 = 'provinsi';

if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
	echo "<link href='style.css' rel='stylesheet' type='text/css'>
 	<center>Untuk mengakses modul, Anda harus login <br>";
	echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else {
	include "../../../../config/koneksi.php";
	include "../../../../config/fungsi_kode_otomatis.php";

	$route = $_GET['route'];
	$act = $_GET['act'];

	//Hapus Staff
	if ($route == 'member' and $act == 'hapus') {
		//habpus staff di tebel employee
		mysqli_query($koneksi, "DELETE from member where kd_member = '$_GET[id]'");
		//hapus user di tabel user
		// mysqli_query($koneksi,"DELETE from user_login where employee_number='$_GET[ids]'");
		header('location:../../main.php?route=' . $route . '&act&asal=' . $asal);
	}

	//Update Staff
	elseif ($route == 'member' and $act == 'edit') {
		// echo $_GET['ids'];
		// echo '<br> :' . $_POST[$f3];

		$simpan = mysqli_query($koneksi, "UPDATE member set 
		$f3 = '$_POST[$f3]', 
		$f4 = '$_POST[$f4]', 
		$f5 = '$_POST[$f5]', 
		$f6 = '$_POST[$f6]', 
		$f7 = '$_POST[$f7]', 
		$f8 = '$_POST[$f8]', 
		$f9 = '$_POST[$f9]' 
		WHERE kd_member = '$_POST[$f2]' ");


		header('location:../../main.php?route=' . $route . '&act&asal=' . $asal);
	}

	//Tambah Staff
	elseif ($route == 'member' and $act == 'input') {
		$asal = $_POST['asal'];
		echo $asal;

		$simpan = mysqli_query($koneksi, "INSERT into member 
									(kd_member,
									nama,
									telp,
									alamat,
									kelurahan,
									kecamatan,
									kabupaten,
									provinsi) 
								values 
									('$_POST[$f2]',
									'$_POST[$f3]',
									'$_POST[$f4]',
									'$_POST[$f5]',
									'$_POST[$f6]',
									'$_POST[$f7]',
									'$_POST[$f8]',
									'$_POST[$f9]'
								)");

		// $simpan=mysql_query("INSERT INTO staff 
		// 							(nama_staff,jabatan,telp,email) 
		// 		values ('$_POST[nama]','$_POST[jabatan]','$_POST[telpon]','$_POST[email]')");

		header('location:../../main.php?route=' . $route . '&act&asal=' . $asal);
	}
}
