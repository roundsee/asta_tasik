<?php 
// mengaktifkan session php
session_start();

// menghubungkan dengan koneksi
include "../config/koneksi.php";

$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = mysqli_real_escape_string($koneksi, md5($_POST['password']));

// menyeleksi data user dengan username dan password yang sesuai
$result = mysqli_query($koneksi,"SELECT * FROM user_login where username='$username' and password='$password'");
$ketemu=mysqli_num_rows($result);
$r=mysqli_fetch_array($result);

if($ketemu > 0 AND $r['login_hash'] <= 2 ){
	$employee_number = $r['employee_number'];

	$employee= mysqli_query($koneksi,"SELECT * FROM employee WHERE employee_number='$employee_number'");
	$fetch_employee= mysqli_fetch_array($employee);
	$id_jabatan =  $fetch_employee['id_jabatan'];

	$jabatan= mysqli_query($koneksi,"SELECT * FROM jabatan WHERE id_jabatan='$id_jabatan'");
	$fetch_jabatan= mysqli_fetch_array($jabatan);

	$_SESSION['namauser']     = $r['username'];
	$_SESSION['passuser']     = $r['password'];
	$_SESSION['jabatan']      = $fetch_jabatan['nama_jabatan'];
	$_SESSION['employee_number'] = $r['employee_number'];
	$_SESSION['login_hash']     = $r['login_hash'];
	
	header('location:pages/main.php?route=home');
	// header('location:pages/index.php');
} else {
	echo "<script>alert('Login failured, please try again !');</script>";
	echo "<script>window.location='index.php'</script>";
	
}
?>