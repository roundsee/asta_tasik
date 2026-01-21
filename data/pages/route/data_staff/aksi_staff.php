<?php
session_start();
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
	if ($route == 'staff' and $act == 'hapus') {
		//habpus staff di tebel employee
		mysqli_query($koneksi, "DELETE from employee where employee_number='$_GET[ids]'");
		//hapus user di tabel user
		mysqli_query($koneksi, "DELETE from user_login where employee_number='$_GET[ids]'");
		header('location:../../main.php?route=' . $route . '&act&asal=' . $asal);
	} elseif ($route == 'staff' and $act == 'enable') {
		$simpan_user_login = mysqli_query($koneksi, "UPDATE user_login set   
				enable_status = 1
		WHERE employee_number='$_GET[ids]'");
		header('location:../../main.php?route=' . $route . '&act&asal=' . $asal);
	} elseif ($route == 'staff' and $act == 'disable') {
		$simpan_user_login = mysqli_query($koneksi, "UPDATE user_login set   
				enable_status = 0
		WHERE employee_number='$_GET[ids]'");
		header('location:../../main.php?route=' . $route . '&act&asal=' . $asal);
	}

	//Update Staff
	elseif ($route == 'staff' and $act == 'edit') {
		$simpan = mysqli_query($koneksi, "UPDATE employee set   
									name_e = '$_POST[name_e]',
									id_jabatan = '$_POST[id_jabatan]',
									cabang_e = '$_POST[cabang_e]',
									kategori_kasir = '$_POST[kategori_kasir_login]'
							WHERE employee_number = '$_POST[employee_number]'");
		// $simpan=mysqli_query($koneksi,"UPDATE employee set   
		// 							name_e = '$_POST[name_e]',
		// 							birth_place = '$_POST[birth_place]',
		// 							birth_date = '$_POST[birth_date]',
		// 							alamat_e = '$_POST[alamat_e]',
		// 							alamat2_e = '$_POST[alamat2_e]',
		// 							city_e = '$_POST[city_e]',
		// 							zipcode_e = '$_POST[zipcode_e]',
		// 							telpon_e = '$_POST[telpon_e]',
		// 							hp_e = '$_POST[hp_e]',
		// 							email_e = '$_POST[email_e]',
		// 							desc_e = '$_POST[desc_e]' ,
		// 							id_jabatan = '$_POST[id_jabatan]',
		// 							cabang_e = '$_POST[cabang_e]'   
		// 					WHERE employee_number = '$_POST[employee_number]'");
		$simpan_user_login = mysqli_query($koneksi, "UPDATE user_login set   
				kd_cus = '$_POST[cabang_e]'
		WHERE employee_number = '$_POST[employee_number]'");
		header('location:../../main.php?route=' . $route . '&act&asal=' . $asal);
	}

	//Tambah Staff
	elseif ($route == 'staff' and $act == 'input') {
		$asal = $_POST['asal'];
		echo $asal;


		$query = mysqli_query($koneksi, "SELECT max(employee_number) as kodeTerbesar FROM employee ");
		$data = mysqli_fetch_array($query);
		$kode = $data['kodeTerbesar'];

		$urutan = (int) substr($kode, 3, 4);
		// echo '<br/>'.$kode;
		// echo '<br/>'.$urutan;

		// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
		$urutan++;
		$huruf = 'WG';

		$ids = $huruf . sprintf("%04s", $urutan);
		// echo '<br/>'.$urutan;
		// echo '<br/>'.$huruf;
		// echo '<br/>'.$ids;

		$simpan = mysqli_query($koneksi, "INSERT into employee 
									(employee_number,
									name_e,
									id_jabatan,
									cabang_e,kategori_kasir	) 
								values 
									('$ids',
									'$_POST[name_e]',
									'$_POST[id_jabatan]',
									'$_POST[cabang_e]',
									'$_POST[kategori_kasir_login]'
								)");

		// $simpan=mysql_query("INSERT INTO staff 
		// 							(nama_staff,jabatan,telp,email) 
		// 		values ('$_POST[nama]','$_POST[jabatan]','$_POST[telpon]','$_POST[email]')");

		header('location:../../main.php?route=' . $route . '&act&asal=' . $asal);
	}
}
