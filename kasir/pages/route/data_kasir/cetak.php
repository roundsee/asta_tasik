<?php 

$dir = "../../../../";
include $dir."config/koneksi.php";
include $dir."config/library.php";

session_start();

$faktur=$_SESSION['id'];
$dibayar=$_SESSION['dibayar'];

$status_simpan=$_SESSION['status_simpan'];
if ($status_simpan=='berhasil'){
  // echo 'Berhasil';


// $tarif_fee=$_SESSION['tarif_fee'];
// $acuan_fee=$_SESSION['acuan_fee'];
// $b_paking=$_SESSION['b_packing'];
// $nama_sub_alat_bayar=$_SESSION['nama_sub_alat_bayar'];

?>

<div class="row">
  <center>
    <img src="../../images/steak_outline_shadow_clear.png" width="300px">
    <h1 style="font-weight:800;">MENU PRINT</h1>
    <h1 style="font-weight:800;"><?php echo $faktur;?></h1>
  </center>
</div>

<!-- <div class="wrapper" style="padding: 5;"> -->
  <div class="row" style="height:80px">
    
  </div>

  <div class="row" style="text-align:center">
    <div class="col-lg-6">
      <a class="btn-lg tombol1 print_faktur" href="route/data_kasir/cetak_nota.php?id=<?php echo $faktur;?>" target="_BLANK">Cetak FAKTUR</a>
    </div>

    <div class="col-lg-6">
      <a class="btn-lg tombol1 print_faktur" href="route/data_kasir/cetak_dapur.php?id=<?php echo $faktur;?>" target="_BLANK">Cetak MENU DAPUR</a>
    </div>
  </div>

  <div class="row" style="height:100px">
    
  </div>

  
  <div class="row" style="padding:40"> 
    <div class="row">
      <center>
        <button class="btn-sm tombol1 print_faktur" onclick="closeWindow()" style="width: 100px;background-color: crimson;color: white;">Close</button>
      </center>
      <!-- <button class="btn-sm tombol1 print_faktur" onclick="closeWin()" style="width: -webkit-fill-available;background-color: crimson;color: whitesmoke;">Close</button> -->
    </div>
  </div>
  <?php

  }else{
  echo "<script>alert('Gagal proses Penyimpanan, Mohon di Ulang kembali.')</script>";
  echo "<script>document.location.reload();</script>";
}

?>

  <script>
    function closeWindow() {
      window.open('','_parent','');
      window.close();
      document.location.reload();
    }
  </script>
