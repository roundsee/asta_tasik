	<?php
	session_start();

	$data = 'data_lokasi';
	$rute = 'lokasi';
	$aksi = 'aksi_lokasi';

	$tabel = 'pelanggan';
	$f1 = 'kd_cus';
	$f2 = 'nama';
	$f3 = 'alamat';
	$f4 = 'kd_kota';
	$f5 = 'kd_area';
	$f6 = 'kd_dispenda';
	$f7 = 'id_kat';


	$j1 = "Kode Lokasi";
	$j2 = 'Nama Lokasi';
	$j3 = 'Alamat Lokasi';
	$j4 = "Kode Kota";
	$j5 = 'Kode Area';
	$j6 = 'Kode Dispenda';
	$j7 = 'ID Kat';


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
			if ($hapus) {
				echo "<script>alert('Data berhasil Di Hapus')</script>";
			} else {
				echo "<script>alert('Data gagal Di Hapus')</script>";
			}
			//hapus user di tabel user
			// mysqli_query($koneksi,"DELETE from user_login where employee_number='$_GET[ids]'");
			echo "<script>history.go(-1	)</script>";

			// header('location:../../main.php?route=' . $route . '&act&asal=' . $asal);
		}

		//Update Staff
		elseif ($route == 'lokasi' and $act == 'edit') {
			// echo $_GET['ids'];
			// echo '<br> :' . $_POST[$f3];

			$simpan = mysqli_query($koneksi, "UPDATE pelanggan set 
			$f2 = '$_POST[$f2]',
			$f3 = '$_POST[$f3]',
			$f4 = '$_POST[$f4]',
			$f5 = '$_POST[$f5]'
			WHERE kd_cus = '$_POST[$f1]'");

			if ($simpan) {
				echo "<script>alert('Data berhasil Di Update')</script>";
			} else {
				echo "<script>alert('Data gagal di update')</script>";
			}


			header('location:../../main.php?route=' . $route . '&act&asal=' . $asal);
		}

		//Tambah Staff
		elseif ($route == 'lokasi' and $act == 'input') {
			// Ambil data dari form input dengan pengamanan
			$nama = mysqli_real_escape_string($koneksi, $_POST[$f2]);
			$alamat = mysqli_real_escape_string($koneksi, $_POST[$f3]);
			$kd_kota = mysqli_real_escape_string($koneksi, $_POST[$f4]);
			$kd_area = mysqli_real_escape_string($koneksi, $_POST[$f5]);

			// Ambil ID gudang terakhir
			$query_last_lokasi = "SELECT MAX(kd_cus) AS last_lokasi FROM pelanggan";
			$result_last_lokasi = mysqli_query($koneksi, $query_last_lokasi);
			$row_last_lokasi = mysqli_fetch_assoc($result_last_lokasi);
			$last_lokasi = $row_last_lokasi['last_lokasi'];

			// Jika ada data id_gudang terakhir, buat nomor baru
			if ($last_lokasi) {
				$new_lokasi = $last_lokasi + 1;
			} else {
				$new_lokasi = 8001;
			}



			// Lakukan query penyimpanan data ke tabel gudang
			$simpan = mysqli_query($koneksi, "INSERT INTO `pelanggan` (kd_cus, nama, alamat, kd_kota, kd_area) VALUES ('$new_lokasi', '$nama', '$alamat', '$kd_kota', '$kd_area')");

			if ($simpan) {
				echo "<script>alert('Data berhasil ditambahkan ke gudang')</script>";
			} else {
				die("Query error: " . mysqli_error($koneksi));
			}

			// Redirect ke halaman sebelumnya
			header('location:../../main.php?route=' . $route . '&act&asal=' . $asal);
		}
	}
