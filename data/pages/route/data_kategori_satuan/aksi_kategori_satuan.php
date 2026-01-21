<?php
session_start();

$tabel = 'kategori_satuan';

$f1 = 'id_kat_satuan';
$f2 = 'Satuan_1';
$f3 = 'Satuan_2';
$f4 = 'Satuan_3';
$f5 = 'Satuan_4';
$f6 = 'Satuan_5';

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
	if ($route == 'kategori_satuan' and $act == 'hapus') {
		//habpus staff di tebel employee
		mysqli_query($koneksi, "DELETE from kategori_satuan where id_kat_satuan = '$_GET[id]'");
		//hapus user di tabel user
		// mysqli_query($koneksi,"DELETE from user_login where employee_number='$_GET[ids]'");
		header('location:../../main.php?route=' . $route . '&act&asal=' . $asal);
	}

	//Update Staff
	elseif ($route == 'kategori_satuan' and $act == 'edit') {
		// echo $_GET['ids'];
		// echo '<br> :' . $_POST[$f3];

		$simpan = mysqli_query($koneksi, "UPDATE kategori_satuan set 
		$f2 = '$_POST[$f2]', 
		$f3 = '$_POST[$f3]', 
		$f4 = '$_POST[$f4]', 
		$f5 = '$_POST[$f5]', 
		$f6 = '$_POST[$f6]'

		WHERE id_kat_satuan = '$_POST[$f1]'");


		header('location:../../main.php?route=' . $route . '&act&asal=' . $asal);
	}

	//Tambah Staff
	elseif ($route == 'kategori_satuan' and $act == 'input') {
		$asal = $_POST['asal'];
		echo $asal;
		$stmt = mysqli_prepare($koneksi, "SELECT MAX(CAST(SUBSTRING(id_kat_satuan, 2) AS UNSIGNED)) AS max_id FROM kategori_satuan WHERE id_kat_satuan LIKE CONCAT(?, '%')");
		mysqli_stmt_bind_param($stmt, 's', $_POST[$f1]);

		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$row = $result->fetch_assoc();
		if ($row['max_id'] !== NULL) {
			$next_id = $_POST[$f1] . ($row['max_id'] + 1); // Concatenate the letter with the next number
		} else {
			$next_id = $_POST[$f1] . '1'; // Start with 'A1' if no matching record exists
		}

		$simpan = mysqli_query($koneksi, "INSERT INTO `kategori_satuan`(`id_kat_satuan`, `Satuan_1`, `Satuan_2`, `Satuan_3`, `Satuan_4`, `Satuan_5`) 
								values 
									('$next_id',
									'$_POST[$f2]',
									'$_POST[$f3]',
									'$_POST[$f4]',
									'$_POST[$f5]',
									'$_POST[$f6]'
								)");

		// $simpan=mysql_query("INSERT INTO staff 
		// 							(nama_staff,jabatan,telp,email) 
		// 		values ('$_POST[nama]','$_POST[jabatan]','$_POST[telpon]','$_POST[email]')");

		header('location:../../main.php?route=' . $route . '&act&asal=' . $asal);
	}
}
