<?php
include "../../config/koneksi.php";

$hari_ini = date("Y-m-d");

$error="";
$username = $_POST['username'];
$password = md5($_POST['password']);
$login_hash = $_POST['login_hash'];
$employee_number = $_POST['employee_number'];

  // Proses Pengecekan Jika terdapat username yang sama   
$check_user = mysqli_query($koneksi,"SELECT * FROM user_login WHERE username='$username'");
$fetch_user = mysqli_num_rows($check_user);


  // Proses Pengecekan Jika terdapat employee_number yang sama   
$check_employee_number = mysqli_query($koneksi,"SELECT * FROM user_login WHERE employee_number='$employee_number'");
$fetch_employee_number = mysqli_num_rows($check_employee_number);


$check_employee = mysqli_query($koneksi,"SELECT * FROM employee WHERE employee_number='$employee_number'");
$fetch_employee = mysqli_num_rows($check_employee);

$data_employee = mysqli_fetch_array($check_employee);
$kd_cus=$data_employee['cabang_e'];


  // Proses pengecekan jika terdapat alamat Email yang sama
  // $check_email = mysql_query("SELECT * FROM user WHERE email='$email'");
  // $fetch_email = mysql_num_rows($check_email);

if( empty($username) || empty($password) || empty($login_hash) || empty($employee_number) )
{ 
  echo "<script>alert('Semua field harus terisi !');</script>";
  echo "<script>window.location='route/register.php'</script>";    

} elseif ($fetch_user == 1)     
{    
  echo "<script>alert('Username yang anda masukan kebetulan sudah ada, mohon mencoba yang lainnya!');</script>";
  echo "<script>window.location='register.php'</script>";
    //$error = "Username yang anda kebetulan sudah ada, mohon mencoba yang lainnya!";      
}elseif ($fetch_employee_number >= 1)     
{    
  echo "<script>alert('Staff kebetulan sudah memiliki User, mohon mencoba yang lainnya!');</script>";
  echo "<script>window.location='register.php'</script>";
    //$error = "Staff yang anda kebetulan sudah memiliki USER, mohon mencoba yang lainnya!";      
} elseif ($fetch_employee ==0)
{
  echo "<script>alert('Id Staff tersebut tidak ada......!!!!!!!!');</script>";
  echo "<script>window.location='register.php'</script>";
    //$error = "Id Staff tersebut tidak ada......!!!!!!!!";
}  else 
{ 
    $query = mysqli_query($koneksi, "SELECT max(no_kasir) as kodeTerbesar FROM user_login where kd_cus='$kd_cus' ");
    $data = mysqli_fetch_array($query);
    $no_kasir = $data['kodeTerbesar'];

// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
    $no_kasir++;

    if($login_hash!=5){
      $no_kasir=0;
    }

  $query = mysqli_query ($koneksi,"INSERT INTO user_login 
    (username, password, login_hash, employee_number, kd_cus, no_kasir) 
    VALUES 
    ('$username', '$password', '$login_hash', '$employee_number', '$kd_cus','$no_kasir' )");

  if ($query) 
  { 
    $success = "Terima kasih, akun anda telah berhasil dibuat. Selamat Datang!"; 
    header('location:main.php?route=home');
  } else 
  { 
    echo "<script>alert('Terjadi masalah pada sistem kami,  mohon mengulangi beberapa saat lagi.');</script>";
    echo "<script>window.location='register.php'</script>";
      //$error = "Terjadi masalah pada sistem kami,  mohon mengulangi beberapa saat lagi.";  
  }
}

echo $error;
?>
