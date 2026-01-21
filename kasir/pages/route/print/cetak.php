<?php 

$dir = "../../../../";
include $dir."config/koneksi.php";
include '../../../../config/library.php';

session_start();

$faktur=$_GET['id'];
// $dibayar=$_GET['dibayar'];
// $faktur=$_SESSION['id'];
// $dibayar=$_SESSION['dibayar'];

// echo '<br> faktur = '.$faktur;
// echo '<br> dibayar = '.$dibayar;

?>
<div class="content-wrapper" style="padding:20px;min-height: 400px;">

  <div class="row">
    <center>
    <img src="../../images/steak_outline_shadow_clear.png" width="300px">
    <h2 style="font-weight:800;">MENU PRINT</h2>
  </center>
  </div>

  <!-- <div class="wrapper" style="padding: 5;"> -->

    <!-- <a class="btn-sm tombol1 print_faktur" href="route/print/cetak_nota.php?id=<?php echo $faktur;?>" target="_BLANK">Cetak NOTA</a> -->

      <div class="row" style="text-align:center">
    <div class="col-lg-6">
      <a class="btn-sm tombol1 print_faktur" href="route/print/cetak_nota.php?id=<?php echo $faktur;?>" target="_BLANK">Print FAKTUR</a>
    </div>

    <div class="col-lg-6">
      <a class="btn-sm tombol1 print_faktur" href="route/print/cetak_dapur.php?id=<?php echo $faktur;?>" target="_BLANK">Print DAPUR</a>
    </div>
  </div>

  <div class="row" style="height:50px">
    
  </div>

  <div class="row"> 
    <div class="row pull-center">
      <center>
      <button class="btn-sm tombol1 print_faktur" onclick="closeWin()" style="background-color: crimson;color: whitesmoke;">Close</button>
    </center>
    </div>
  </div>
</div>

  <script>
    function closeWindow() {
      window.open('','_parent','');
      window.close();
    }
  </script>
