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

if($ketemu > 0 AND $r['login_hash']==3) {
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

	$setup= mysqli_query($koneksi,"SELECT * FROM setup");
	$s= mysqli_fetch_array($setup);

	$_SESSION['naper']     	= $s['naper'];
	$_SESSION['alamat1']   	= $s['alamat1'];
	$_SESSION['alamat2']   	= $s['alamat2'];
	$_SESSION['telp'] 			= $s['telp'];
	$_SESSION['fax']     		= $s['fax'];
	$_SESSION['email']     	= $s['email'];
	$_SESSION['tax']     		= $s['tax'];
	$_SESSION['initial']    = $s['initial'];
	$_SESSION['naper1']     = $s['naper1'];
	$_SESSION['naper2']     = $s['fax'];
	$_SESSION['ver']     		= $s['ver'];
	$_SESSION['primary1']   = $s['primary1'];
	$_SESSION['primary2']   = $s['primary2'];
	$_SESSION['primary3']   = $s['primary3'];
	$_SESSION['bg1']     		= $s['bg1'];
	$_SESSION['color1']     = $s['color1'];
	$_SESSION['bg2']     		= $s['bg2'];
	$_SESSION['color2']    	= $s['color2'];
	$_SESSION['bg3']     		= $s['bg3'];
	$_SESSION['color3']     = $s['color3'];


	header('location:pages/main.php?route=kasir_refund');
	 // header('location:pages/main_kasir.php?route=kasir_test');
	// header('location:pages/main_kasir.php?route=kasir2');
	//header('location:pages/route/data_kasir/kasir_bakup.php');
	// header('location:pages/index.php');
} else {
	echo "<script>alert('Login failured, please try again !');</script>";
	echo "<script>window.location='index.php'</script>";
	
}
?>