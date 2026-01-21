<?php
// $server = "localhost";
// $username = "alhircom_root";
// $password = "thej0ker";
// $database = "alhircom_erp";

// $server = "localhost";
// $username = "root";
// $password = "";
// $database = "db_erp";

$server = "127.0.0.1:3307";
$username = "root";
$password = "";
$database = "db_erp";


// Koneksi dan memilih database di server
mysql_connect($server,$username,$password) or die("Koneksi gagal");
mysql_select_db($database) or die("Database tidak bisa dibuka");
?>
