<?php

$tabel='user_login';
$f1='username';
$f2='password';

$tabel2='employee';
$ff1='employee_number';
$ff16='photo';

session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser']))
{
	echo "<link href='style.css' rel='stylesheet' type='text/css'>
	<center>Untuk mengakses modul, Anda harus login <br>";
	echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else
{
	include"../../../../config/koneksi.php";
	
	$route=$_GET['route'];
	$act=$_GET['act'];

	//Update Profile
	if($route=='profile' AND $act=='edit')
	{
		$pass = md5($_POST['password']);
		if(empty($_POST['password']))
		{
			$simpan = mysqli_query($koneksi,"UPDATE employee SET telpon_e = '$_POST[telpon_e]' WHERE employee_number ='$_POST[ids]'");
			if($simpan)
			{
				echo "<script>alert('Data profile user berhasil diperbaharui');</script>";
				echo "<script>window.location='../../main.php?route=profile'</script>";
			}
			else
			{
				echo "<script>alert('Data profile user gagal diperbaharui');</script>";
				echo "<script>window.location='../../main.php?route=profile'</script>";
			}
		}
		else
		{
			$simpan = mysqli_query($koneksi,"UPDATE employee SET telpon_e = '$_POST[telpon_e]' WHERE employee_number = '$_POST[ids]'");
			$simpans = mysqli_query($koneksi,"UPDATE user_login SET password = '$pass' WHERE employee_number = '$_POST[ids]'");
			if($simpans)
			{
				// echo "<script>alert('Data profile user berhasil diperbaharui');</script>";
				echo "<script>window.location='../../main.php?route=profile'</script>";
			}
			else
			{
				echo "<script>alert('Data profile user gagal diperbaharui');</script>";
				echo "<script>window.location='../../main.php?route=profile'</script>";
			}
		}
	}elseif($route=='profile' AND $act=='edit2')
	{
		// if(empty($_POST['password']) AND $_FILES['photo']['name'] =="")
		// {
		// 	echo "<script>alert('Kosong.')</script>";
		// 	echo "<script>history.go(-2)</script>";
		// }
		$pass = md5($_POST['password']);

		$photo = $_FILES['photo']['name'];
		$employee_number = $_POST['ids'];

		if(empty($_POST['password']) AND $_FILES['photo']['name'] =="")
		{
			echo "<script>alert('Kosong.')</script>";
			echo "<script>history.go(-2)</script>";
		}elseif($photo != "") 
  		//cek ada perubahan photo
		{
			$ekstensi_diperbolehkan = array('png','jpg','jpeg','bmp'); 
    //ekstensi file gambar yang bisa diupload 
			$x = explode('.', $photo); 
    //memisahkan nama file dengan ekstensi yang diupload
			$ekstensi = strtolower(end($x));
			$file_tmp = $_FILES['photo']['tmp_name']; 

			$namafile=$employee_number.'.'.$ekstensi;

				$size = $_FILES['photo']['size']; //untuk mengetahui ukuran file

		if((in_array($ekstensi, $ekstensi_diperbolehkan) === true) && (($size !=0)&&($size<100000)) )  
		{
				move_uploaded_file($file_tmp, '../../../../images/staff/'.$namafile); 
    //memindah file gambar ke folder gambar

				if(empty($_POST['password']))
				{
					$query2  = "UPDATE $tabel2 SET 
					photo = '$namafile' ";
					$query2 .= "WHERE employee_number = '$employee_number' ";
					$result2 = mysqli_query($koneksi, $query2);
				}else
				{
					$query  = "UPDATE $tabel SET 
					password = '$pass' ";
					$query .= "WHERE $f1 = '$_POST[$f1]' ";
					$result = mysqli_query($koneksi, $query);

					$query2  = "UPDATE $tabel2 SET 
					photo = '$namafile' ";
					$query2 .= "WHERE employee_number = '$employee_number' ";
					$result2 = mysqli_query($koneksi, $query2);

				}

				if(!$result2){
					die ("Query gagal dijalankan 1: ".mysqli_errno($koneksi).
						" - ".mysqli_error($koneksi));
				} else {
					// echo "<script>alert('Data berhasil diubah.')</script>";
					echo "<script>history.go(-2)</script>";
				}
			} else {    
				echo "<script>alert('Ekstensi gambar yang boleh hanya jpg jpeg bmp atau png.  atau file tsb lebih dari 100 Kb');</script>";
				echo "<script>history.go(-1)</script>";
			}
		} else {
		//jika photo kosong
      	// jalankan query UPDATE berdasarkan ID yang produknya kita edit
			$query  = "UPDATE $tabel SET 
			password = '$pass' ";
			$query .= "WHERE $f1 = '$_POST[$f1]' ";
			$result = mysqli_query($koneksi, $query);

      // periska query apakah ada error
			if(!$result){
				die ("Query gagal dijalankan : ".mysqli_errno($koneksi).
					" - ".mysqli_error($koneksi));
			} else {
				// echo "<script>alert('Data Password berhasil diubah.')</script>";
				echo "<script>history.go(-2)</script>";
			}
		}
	}
}

?>
