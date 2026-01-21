<?php
// mengaktifkan session php
session_start();

// menghubungkan dengan koneksi
include "config/koneksi.php";

$to = $_GET['to'];
$hash = $_GET['hash'];
// echo $to;

$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = mysqli_real_escape_string($koneksi, md5($_POST['password']));

// menyeleksi data user dengan username dan password yang sesuai
$result = mysqli_query($koneksi, "SELECT * FROM user_login where username='$username' and password='$password' and (login_hash='$hash' OR login_hash='0') ");
$ketemu = mysqli_num_rows($result);
$r = mysqli_fetch_array($result);

if ($ketemu > 0 and $r['enable_status'] > 0) {

	$employee_number = $r['employee_number'];

	$employee = mysqli_query($koneksi, "SELECT * FROM employee WHERE employee_number='$employee_number'");
	$fetch_employee = mysqli_fetch_array($employee);
	$id_jabatan =  $fetch_employee['id_jabatan'];
	$cabang_e = $fetch_employee['cabang_e'];

	$area_e = $fetch_employee['area_e'];

	$area = mysqli_query($koneksi, "SELECT * FROM area WHERE kode='$area_e' ");

	$fetch_area = mysqli_fetch_array($area);
	if (isset($fetch_area['nama'])) {
		$area_nama = $fetch_area['nama'];
	} else {
		$area_nama = "";
	}

	$pelanggan = mysqli_query($koneksi, "SELECT nama FROM pelanggan WHERE kd_cus='$cabang_e' ");
	$fetch_pelanggan = mysqli_fetch_array($pelanggan);
	if (isset($fetch_pelanggan['nama']) and ($cabang_e != '0000')) {
		$pelanggan_nama = $fetch_pelanggan['nama'];
	} else {
		$pelanggan_nama = $area_nama;
	}


	$jabatan = mysqli_query($koneksi, "SELECT * FROM jabatan WHERE id_jabatan='$id_jabatan'");
	$fetch_jabatan = mysqli_fetch_array($jabatan);

	$_SESSION['namauser']     		= $r['username'];
	$_SESSION['passuser']     		= $r['password'];
	$_SESSION['jabatan']      		= $fetch_jabatan['nama_jabatan'];
	$_SESSION['employee_number'] 	= $r['employee_number'];
	$_SESSION['login_hash']     	= $r['login_hash'];
	$_SESSION['to']								= $_GET['to'];
	$_SESSION['area_e'] 					= $area_e;
	$_SESSION['area_nama'] 				= $area_nama;
	$_SESSION['cabang_e'] 				= $cabang_e;
	$_SESSION['pelanggan_nama'] 	= $pelanggan_nama;
	$_SESSION['id_jabatan']				= $id_jabatan;

	// echo $area_e;
	// echo $area_nama;

	// header('location:pages/main.php?route=home');
	// kasir_steak/pages/main.php?route=kasir
	if ($to == 'kasir') {
		// header('location:index_pilih.php?to='.$to);
		header('location:kasir/pages/main.php?route=kasir&to=' . $to);
	} elseif ($to == 'manager') {
		//header('location:index_pilih.php?to='.$to);
		header('location:data/pages/main.php?route=home');


		// header('location:void_trans/pages/main.php?route=kasir_void&to='.$to);
	}
} else {
	echo "<script>alert('Login failured, please try again !');</script>";
	echo "<script>window.location='index.php'</script>";
}
