<?php
date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.
$seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
$hari = date("w");
$hari_ini = $seminggu[$hari];

$tgl_sekarang = date("Y-m-d");
$tgl_skrg     = date("d");
$bln_sekarang = date("m");
$thn_sekarang = date("Y");
$jam_sekarang = date("H:i:s");

$nama_bln=array(1=> "Januari", "Februari", "Maret", "April", "Mei", 
                    "Juni", "Juli", "Agustus", "September", 
                    "Oktober", "November", "Desember");

include "koneksi.php";

$query=mysqli_query($koneksi,"SELECT * FROM setup ");
$q=mysqli_fetch_array($query);

$perusahaan=$q['perusahaan'];
$naper_mini=$q['naper_mini'];
$naper1=$q['naper1'];
$naper2=$q['naper2'];
$ver=$q['ver'];

$warna_primary_1="
#0b5cb4";
$warna_primary_2="#333333";
$warna_primary_3="#f8f9fa";


?>

<!-- pengaturan warna untuk Waroeng Steak -->

  <style type="text/css">
    .bg_primary_1{
      background-color: 
      #0b5cb4!important;
      /* color: #212529!important; */
      color: whitesmoke!important;

    }
    .bg_primary_2{
      background-color: 
      #2c57a4!important;
      color: whitesmoke!important;
    }
    .bg_primary_3{
      background-color: #f8f9fa!important;
    }
    .bg_primary_4{
      background-color: #5f9eef!important;
      background-color: #f8f9fa!important;
    }

    .warna_primary_1{
      color: #212529;
    }
    .warna_primary_2{
      color: whitesmoke!important;
    }
    .warna_primary_3{
      color: #f8f9fa;
    }

  </style>
