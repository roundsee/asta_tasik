<?php 

include '../../../../config/koneksi.php';
include '../../../../config/fungsi_rupiah.php';
include '../../../../config/library.php';

session_start();


$namauser=$_SESSION['namauser'];
$login_hash=$_SESSION['login_hash'];
$en=$_SESSION['employee_number'];
$to=$_SESSION['to'];
$area_e=$_SESSION['area_e'];
$area_nama=$_SESSION['area_nama'];

$judulform="Sales Report ";

$data='lap_sales';
$rute='rekap_sales_report';
$aksi='aksi_rekap_sales_report';

$tabel="penjualan";
$f1='faktur';
$f2='tanggal';
$f3='kd_cus';
$f4='kd_aplikasi';
$f5='no_meja';
$f6='oleh';
$f7='subjumlah';
$f8='ppn';
$f9='jumlah';
$f10='byr_pocer';
$f11='byr_tunai';
$f12='byr_non_tunai';
$f13='kd_alatbayar';
$f14='no_urut';
$f15='tahun';
$f16='bulan';
$f17='jam';
$f18='kdsub_alatbayar';
$f19='subjumlah_offline';
$f20='ket_aplikasi';
$f21='dasar_fee';
$f22='acuan_fee';
$f23='tarif_fee';
$f24='b_packing';
$f25='no_online';
$f26='no_ofline';
$f27='tarif_pb1';
$f28='faktur_refund';
$f29='dasar_faktur';

$j1='Faktur';
$j2='Tanggal';
$j3='Kode Outlet';
$j4='kd_aplikasi';
$j5='no_meja';
$j6='oleh';
$j7='Sub jumlah';
$j8='PPn';
$j9='Jumlah';
$j10='byr_pocer';
$j11='byr_tunai';
$j12='byr_non_tunai';
$j13='kd_alatbayar';
$j14='no_urut';
$j15='tahun';
$j16='bulan';
$j17='jam';
$j18='kdsub_alatbayar';
$j19='subjumlah_offline';
$j20='ket_aplikasi';
$j21='dasar_fee';
$j22='acuan_fee';
$j23='tarif_fee';
$j24='b_packing';
$j25='no_online';
$j26='no_ofline';
$j27='tarif_pb1';
$j28='faktur_refund';
$j29='dasar_faktur';


$tabel2='kotabaru';
$ff1='kode';
$tabel3='pelanggan';
$gg1='kd_cus';


?>

<html>
<head>
	<title><?php echo $judulform;?></title>

	<!-- <link rel="stylesheet" type="text/css" href="../style_cetak.css"> -->
	<style type="text/css">
		table {
			border-collapse: collapse;
			font-family:Arial, Helvetica, sans-serif;
			font-size:14px;
		}

		td {
			font-size:11px;
		}

		table, td, th {
			border: 1px solid lightgray;
			padding: 1px;
		}

		th{
			padding-top: 10px;
			padding-bottom: 10px;
			border: 1px solid gray;
		}
	</style>

</head>
<body style='font-family:Arial;background-color: ghostwhite;font-size: 8pt;' onload="javascript:window.print()">
	<?php

	$tgl_awal=$_GET['tgl_awal'];
	$tgl_akhir=$_GET['tgl_akhir'];
	$filter=$_GET['filter'];
	$nilai=$_GET['nilai'];

        // echo "<br/>".$tgl_awal;
        // echo "<br/>".$tgl_akhir;
        // echo "<br/>".$filter;
        // echo "<br/>".$nilai;
  if($login_hash==8){
    $judul_area=$area_nama;
  }else{
    $judul_area="";
  }
  
  if($filter=='kota'){
    $kondisi="AND pelanggan.kd_kota='$nilai'";
    $query=mysqli_query($koneksi,"SELECT * FROM kotabaru WHERE kode='$nilai' ");
    $q1=mysqli_fetch_array($query);
    $judul_nilai= $q1['nama'];
  }elseif($filter=='outlet'){
    $kondisi="AND penjualan.kd_cus='$nilai'";
    $query=mysqli_query($koneksi,"SELECT * FROM pelanggan WHERE kd_cus='$nilai' ");
    $q1=mysqli_fetch_array($query);
    $judul_nilai= $q1['nama'];
  }elseif($filter=='area'){
    $kondisi="AND kotabaru.kd_area='$nilai'";
    $query=mysqli_query($koneksi,"SELECT * FROM area WHERE kode='$nilai' ");
    $q1=mysqli_fetch_array($query);
    $judul_nilai= $q1['nama'];
  }else{
    $kondisi="";
    $judul_nilai='';
  }

  if($login_hash=='6' OR $login_hash=='7'){
    $filter='Outlet';
    $query=mysqli_query($koneksi,"SELECT * FROM employee WHERE employee_number='$en' ");
    $q1=mysqli_fetch_array($query);
    $nilai= $q1['cabang_e'];
    $kondisi="AND penjualan.kd_cus='$nilai'";
    $query=mysqli_query($koneksi,"SELECT * FROM pelanggan WHERE kd_cus='$nilai' ");
    $q1=mysqli_fetch_array($query);
    $judul_nilai= $q1['nama'];
    $tgl_akhir=$tgl_awal;
  }

  $judul='Laporan '.$judulform;
  $judul2=$filter." : ".$judul_nilai;
  $judul3='Date : '.$tgl_awal." s/d ".$tgl_akhir;

  ?>

  <div class="row" >
    <strong><h2><?php echo $judulform;?></h2></strong>
    <br>
    <?php echo $judul2;?>
    <br>
    <?php echo $judul3;?>
    <br>
    By : <?php echo $namauser;?>
  </div>
  <div class="box">
    <?php if($login_hash==6 OR $login_hash==7) { 
      include 'sales_kasirmanager.php';
    } elseif ($login_hash==8) { 
      include 'sales_mr.php';
    }else { 
      include 'sales_admin.php';
    } ?>
  </div>

  <br/>

  <?php 
  include '../footer_cetak.php';
  ?>

</body>
</html>
