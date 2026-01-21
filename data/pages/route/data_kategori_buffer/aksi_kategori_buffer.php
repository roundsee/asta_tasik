<?php
session_start();

$tabel = 'kategori_buffer';

$f1 = 'kd_kat';
$f2 = 'nilai';

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
	if ($route == 'kategori_buffer' and $act == 'hapus') {
		//habpus staff di tebel employee
		$hapus = mysqli_query($koneksi, "DELETE from kategori_buffer where kd_kat = '$_GET[id]'");
		if($hapus){
			echo "<script>alert('Data berhasil Di Hapus')</script>";
		}else{
			echo "<script>alert('Data gagal Di Hapus')</script>";
		}
		//hapus user di tabel user
		// mysqli_query($koneksi,"DELETE from user_login where employee_number='$_GET[ids]'");
		echo "<script>history.go(-1	)</script>";

		// header('location:../../main.php?route=' . $route . '&act&asal=' . $asal);
	}

	//Update Staff
	elseif ($route == 'kategori_buffer' and $act == 'edit') {
		// echo $_GET['ids'];
		// echo '<br> :' . $_POST[$f3];

		$simpan = mysqli_query($koneksi, "UPDATE kategori_buffer set 
		$f2 = '$_POST[$f2]'
		WHERE kd_kat = '$_POST[$f1]'");

		if($simpan){
			echo "<script>alert('Data berhasil Di Update')</script>";
		}else{
			echo "<script>alert('Data gagal di update')</script>";
		}


		header('location:../../main.php?route=' . $route . '&act&asal=' . $asal);
	}

	//Tambah Staff
	elseif ($route == 'kategori_buffer' and $act == 'input') {

		$kd_kat = $_POST[$f1];
		$nilai = $_POST[$f2];
		
		// Cek apakah kd_kat sudah ada
		$cek = mysqli_query($koneksi, "SELECT * FROM `kategori_buffer` WHERE `kd_kat` = '$kd_kat'");
		
		if (mysqli_num_rows($cek) > 0) {
			// Jika kd_kat sudah ada, berikan pesan error
			echo "<script>alert('Kode kategori sudah ada, silakan gunakan kode yang berbeda.')</script>";
		} else {
			// Jika tidak ada, lakukan insert
			$simpan = mysqli_query($koneksi, "INSERT INTO `kategori_buffer`(`kd_kat`, `nilai`) VALUES ('$kd_kat', '$nilai')");
			
			if($simpan){
				echo "<script>alert('Data berhasil ditambahkan ke kategori buffer')</script>";
			} else {
				echo "<script>alert('Data gagal ditambahkan')</script>";
			}
		}
		

		echo "<script>history.go(-2	)</script>";
		// header('location:../../main.php?route=' . $route . '&act&asal=' . $asal);
	}
}
