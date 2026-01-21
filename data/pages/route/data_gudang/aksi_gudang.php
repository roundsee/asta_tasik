<?php
session_start();

$tabel = 'gudang';


$tabel = 'gudang';
$f1 = 'id_gudang';
$f2 = 'nama';
$f3 = 'alamat';

$j1 = "Kode Gudang";
$j2 = 'Nama Gudang';
$j3 = 'Alamat Gudang';


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
	if ($route == 'gudang' and $act == 'hapus') {
		//habpus staff di tebel employee
		$hapus = mysqli_query($koneksi, "DELETE from gudang where id_gudang = '$_GET[id]'");
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
	elseif ($route == 'gudang' and $act == 'edit') {
		// echo $_GET['ids'];
		// echo '<br> :' . $_POST[$f3];

		$simpan = mysqli_query($koneksi, "UPDATE gudang set 
		$f2 = '$_POST[$f2]',
		$f3 = '$_POST[$f3]'
		WHERE id_gudang = '$_POST[$f1]'");

		if($simpan){
			echo "<script>alert('Data berhasil Di Update')</script>";
		}else{
			echo "<script>alert('Data gagal di update')</script>";
		}


		header('location:../../main.php?route=' . $route . '&act&asal=' . $asal);
	}

	//Tambah Staff
	elseif ($route == 'gudang' and $act == 'input') {
		// Ambil data dari form input dengan pengamanan
		$nama = mysqli_real_escape_string($koneksi, $_POST[$f2]);
		$alamat = mysqli_real_escape_string($koneksi, $_POST[$f3]);
	
		// Ambil ID gudang terakhir
		$query_last_gudang = "SELECT MAX(id_gudang) AS last_gudang FROM gudang";
		$result_last_gudang = mysqli_query($koneksi, $query_last_gudang);
		$row_last_gudang = mysqli_fetch_assoc($result_last_gudang);
		$last_gudang = $row_last_gudang['last_gudang'];
	
		// Jika ada data id_gudang terakhir, buat nomor baru
		if ($last_gudang) {
			// Ambil bagian nomor urut dari last_gudang (format 'GD/0001')
			$last_number = (int)str_replace('GD/', '', $last_gudang);  // Hilangkan 'GD/' dan ambil nomor
			$new_number = $last_number + 1;
			$new_gudang = 'GD/' . str_pad($new_number, 4, '0', STR_PAD_LEFT);  // Buat ID baru dengan padding 4 digit
		} else {
			// Jika belum ada id_gudang, buat nomor pertama dengan format GD/0001
			$new_gudang = 'GD/0001';
		}
	
		// Lakukan query penyimpanan data ke tabel gudang
		$simpan = mysqli_query($koneksi, "INSERT INTO `gudang` (id_gudang, nama, alamat) VALUES ('$new_gudang', '$nama', '$alamat')");
	
		if ($simpan) {
			echo "<script>alert('Data berhasil ditambahkan ke gudang')</script>";
		} else {
			die("Query error: " . mysqli_error($koneksi));
		}
	
		// Redirect ke halaman sebelumnya
		header('location:../../main.php?route=' . $route . '&act&asal=' . $asal);
	}
	
}
