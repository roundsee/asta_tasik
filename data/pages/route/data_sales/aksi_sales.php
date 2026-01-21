<?php
session_start();

$judulform = "Daftar Sales";

$data = 'data_sales';
$rute = 'sales';
$aksi = 'aksi_sales';

$tabel = 'sales';
$f1 = 'id_sales';
$f2 = 'nama';
$f3 = 'alamat';

$j1 = "ID Sales";
$j2 = 'Nama Sales';
$j3 = 'Alamat Sales';



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
	if ($route == 'sales' and $act == 'hapus') {
		//habpus staff di tebel employee
		$hapus = mysqli_query($koneksi, "DELETE from sales where id_sales = '$_GET[id]'");
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
	elseif ($route == 'sales' and $act == 'edit') {
		// echo $_GET['ids'];
		// echo '<br> :' . $_POST[$f3];

		$simpan = mysqli_query($koneksi, "UPDATE sales set 
		$f2 = '$_POST[$f2]',
		$f3 = '$_POST[$f3]'
		WHERE id_sales = '$_POST[$f1]'");

		if($simpan){
			echo "<script>alert('Data berhasil Di Update')</script>";
		}else{
			echo "<script>alert('Data gagal di update')</script>";
		}


		header('location:../../main.php?route=' . $route . '&act&asal=' . $asal);
	}

	//Tambah Staff
	elseif ($route == 'sales' and $act == 'input') {
		// Ambil data dari form input dengan pengamanan
		$nama = mysqli_real_escape_string($koneksi, $_POST[$f2]);
		$alamat = mysqli_real_escape_string($koneksi, $_POST[$f3]);
	
		// Ambil ID sales terakhir
		$query_last_sales = "SELECT MAX(id_sales) AS last_sales FROM sales";
		$result_last_sales = mysqli_query($koneksi, $query_last_sales);
		$row_last_sales = mysqli_fetch_assoc($result_last_sales);
		$last_sales = $row_last_sales['last_sales'];
	
		// Jika ada data id_sales terakhir, buat nomor baru
		if ($last_sales) {
			// Ambil bagian nomor urut dari last_sales (format 'SLS/0001')
			$last_number = (int)str_replace('SLS/', '', $last_sales);  // Hilangkan 'SLS/' dan ambil nomor
			$new_number = $last_number + 1;
			$new_sales = 'SLS/' . str_pad($new_number, 4, '0', STR_PAD_LEFT);  // Buat ID baru dengan padding 4 digit
		} else {
			// Jika belum ada id_sales, buat nomor pertama dengan format SLS/0001
			$new_sales = 'SLS/0001';
		}
	
		// Lakukan query penyimpanan data ke tabel sales
		$simpan = mysqli_query($koneksi, "INSERT INTO `sales` (id_sales, nama, alamat) VALUES ('$new_sales', '$nama', '$alamat')");
	
		if ($simpan) {
			echo "<script>alert('Data berhasil ditambahkan ke sales')</script>";
		} else {
			die("Query error: " . mysqli_error($koneksi));
		}
	
		// Redirect ke halaman sebelumnya
		header('location:../../main.php?route=' . $route . '&act&asal=' . $asal);
	}
	
}
