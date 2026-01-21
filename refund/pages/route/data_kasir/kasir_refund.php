<?php 
include 'header.php'; 

$dir='../../';

// include 'modal1.php';
// include 'pembayaran.php';

$en=$_SESSION['employee_number'];

$query=mysqli_query($koneksi,"SELECT * from user_login where employee_number='$en' ");
$q=mysqli_fetch_array($query);

$kd_cus=$q['kd_cus'];
$lokasi=$q['lokasi'];
$no_kasir=$q['no_kasir'];

$query1=mysqli_query($koneksi,"SELECT * from employee where employee_number='$en' ");
$q1=mysqli_fetch_array($query1);
$namakasir=$q1['name_e'];
$photo=$q1['photo'];

$query2=mysqli_query($koneksi,"SELECT * from pelanggan where kd_cus='$kd_cus' ");
$q2=mysqli_fetch_array($query2);

$nama_cab=$q2['nama'];
$alamat=$q2['alamat'];
$kd_kota=$q2['kd_kota'];
$kd_area=$q2['kd_area'];


$query3=mysqli_query($koneksi,"SELECT * from kotabaru where kode='$kd_kota' ");
$q3=mysqli_fetch_array($query3);

$tarif_pb1=$q3['tarif_pb1'];

$_SESSION['kd_kota']=$kd_kota;
$_SESSION['kd_cus']=$kd_cus;
$_SESSION['tarif_pb1']=$tarif_pb1;

// echo 'cetak : '.$_SESSION['kd_kota'];
// echo 'cetak : '.$_SESSION['kd_cus'];
// print_r($kd_kota);


?>


<style>

  .menupilihan{
    background-color:#fefefe;
    text-align:center;
    margin: 1rem auto;
    border-style: outset;
    border-color: ghostwhite;
    padding: .2rem;
    /*width: 160px;*/
    box-shadow: 2px 2px 7px #c1c2c2;
    border-radius: 15px;
  }

  .menunama{
    padding-top: 3px;
    height: 48px;
    line-height: 1.4rem;
    /*font-size: 95%;*/
    color: black;
    background-color: lightgoldenrodyellow;
    margin: 0 -1 0 -2;
  }

  .menuharga_1{
    background-color: whitesmoke;
    line-height: 20px;
    text-align: right;
    /*width: 90px;*/
    /*margin-bottom: .1rem;*/
    color: black;
    font-weight: 700;
    background-color: white;
    margin: 0 .3rem .1rem .3rem;
  }

  .menuharga{
    margin: 0 0 1px;
    height: 20px;
    background-color: white;
    color: grey;
    padding-top: 3px;
  }

  .tombol{
    box-shadow: 2px 2px 5px grey;
  }  

  .tombol1{
    font-weight: 600;
    box-shadow: 2px 2px 5px grey;
    border-bottom-right-radius: 5px!important;
    margin-left: 5px!important;
    border-style: hidden;
  }

  .tombol2{
    width: 80px;
    border-radius: 20px;
    box-shadow: 2px 2px 5px grey;
    border-bottom-right-radius: 5px!important;
    margin-left: 5px!important;
    color: dimgray;
    font-weight: 600;
  }


  .tombol3{
    width: 80px;
    border-radius: 20px;
    box-shadow: 2px 2px 5px grey;
    border-bottom-right-radius: 5px!important;
    margin-left: 5px!important;
    color: ghostwhite;
    background-color: black;
    font-weight: 600;
  }

  .row {
    padding: 5px;
    color: black;
  }

  .table{
    margin-bottom: 2px;
  }

  .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
    padding: 2px 10px;
  }

  .form-group {
    margin-bottom: 2px;
  }  

  .skin-green .wrapper, .skin-green .main-sidebar, .skin-green .left-side {
    background-color: transparent;
  }

  /*Tabel Responsive 1*/
  .table-container {
    overflow: auto;
  }

  .box-poly{
    border-radius: 18px;
    background: #feffff;
    box-shadow: inset 5px 5px 10px #c1c2c2,
    inset -5px -5px 10px #ffffff;
  }

  .box-poly-up{
    border-radius: 18px;
    background: linear-gradient(145deg, #ffffff, #e5e6e6);
    box-shadow:  5px 5px 10px #c1c2c2,
    -5px -5px 10px #ffffff;
  }

  .box-poly-kotak {
    border-radius: 5px;
    background: #feffff;
    box-shadow: inset 5px -5px 10px #939494,
    inset -5px 5px 10px #ffffff;
  }
  .box-poly-kotak2 {
    border-radius: 10px;
    background: #feffff;
    box-shadow: inset 3px -3px 3px #e5e6e6,
    inset -5px 5px 10px #ffffff;
  }

  .menupilihan_alatbayar{
    background-color:#fcfcfc;
    text-align:center;
    margin: 1rem auto;
    border-style: outset;
    border-color: ghostwhite;
    padding: .2rem;
    /*width: 160px;*/
    box-shadow: 7px 7px 10px grey;
    border-radius: 15px;
  }

  .menupilihan_sub_alatbayar{
    background-color:#fcfcfc;
    text-align:center;
    margin: 1rem auto;
    border-style: outset;
    border-color: ghostwhite;
    padding: .2rem;
    /*width: 160px;*/
    box-shadow: 7px 7px 10px grey;
    border-radius: 15px;
  }

  .menunama_alatbayar{
    padding-top: 3px;
    height: 28px;
    line-height: 1.4rem;
    /*font-size: 95%;*/
    color: black;
    background-color: lightgoldenrodyellow;
    border-radius: 0 0 15px 15px;
  }

  .menunama_sub_alatbayar{
    padding-top: 13px;
    height: 57px;
    line-height: 1.1rem;
    /*font-size: 95%;*/
    color: black;
    background-color: lightgoldenrodyellow;
    border-radius: 0 0 15px 15px;
    font-size: 95%;
    font-weight: 600;
  }

  .menupilihan_aplikasi{
    background-color:#fcfcfc;
    text-align:center;
    margin: 1rem auto;
    border-style: outset;
    border-color: ghostwhite;
    padding: .2rem;
    width: 130px;
    box-shadow: 7px 7px 10px grey;
    border-radius: 15px;
  }

  .menunama_aplikasi{
    padding-top: 3px;
    height: 28px;
    line-height: 1.4rem;
    /*font-size: 95%;*/
    color: black;
    background-color: lightgoldenrodyellow;
  }

  .print_faktur{
    width: 200px;
    height: 60px;
    font-size: 20px;
  }



  #satu, #print, #voucher, #alatbayar, #aplikasi, #payment{
    position: absolute;
    height: 100px;
  }

  #satu{
    left: 0px;
    top: 0px;
    background-color:whitesmoke;
    z-index: 1;

  }

  #aplikasi{
    width: 670px;
    height: 240px;
    left: 350px;
    top: 60px;
    background-color:ghostwhite;
    z-index: 3;

  }

  #payment{
    width: 800px;
    height: 480px;
    left: 250px;
    top: 50px;
    background-color:ghostwhite;
    z-index: 2;
  }

  #alatbayar{
    width: 440px;
    height: 370px;
    left: 350px;
    top: 20px;
    background-color:ghostwhite;
    z-index: 4;
  }

  #voucher{
    width: 440px;
    height: 390px;
    left: 350px;
    top: 20px;
    background-color:ghostwhite;
    z-index: 5;
  }

  .background_wib1{
    background-image: ../../dinein2.png;
  }

  #print{
    width: 30px;
    height: 10px;
    left: 450px;
    top: 250px;
    background-color: transparent;
    z-index: 6;
  }

</style>



<div class="content-wrapper bg_primary_3" style="min-height:8px!important;">

  <?php 
  if(isset($_GET['alert'])){
    if($_GET['alert'] == "gagal"){
      echo "<div class='alert alert-danger'>File yang diperbolehkan hanya file gambar!</div>";
    }elseif($_GET['alert'] == "duplikat"){
      echo "<div class='alert alert-danger'><b>Kode Produk</b> sudah pernah digunakan!</div>";
    }
  }
  ?>


  <form action="route/data_kasir/kasir_refund_act.php" method="post" onSubmit="return cek(this)">
    <input type="hidden" name="kd_cus" value="<?php echo $kd_cus;?>">
    <input type="hidden" name="kd_aplikasi" value="<?php echo $kd_aplikasi;?>">

    <div class="row">
      <!-- kiri -->
      <?php include 'kasir_kiri_refund.php'; ?>

      <!-- Kanan -->
      <?php include 'kasir_kanan_refund.php'; ?>
      
    </div>

    <div id="aplikasi" style="display:none;">

    </div>


  </form>

</div>
<?php
include 'wibjs.php';
?>

<script>
  function displayHasil(tgl_awal){ 
    document.getElementById("tgl_awalHasil").value=tgl_awal; 
  };

</script>

<script type="text/javascript">

  jQuery(document).ready(function(event) {
    // var x1 = document.getElementById("payment");
    // var x4 = document.getElementById("aplikasi");
    // var x6 = document.getElementById("alatbayar");
    // var x7 = document.getElementById("voucher");
    // var x8 = document.getElementById("print");

    // x1.style.display = "none";
    // x4.style.display = "none";
    // x6.style.display = "none";
    // x7.style.display = "none";
    // x8.style.display = "none";

  });

</script>


<script type="text/javascript">
  <?php 
  if(isset($_GET['alert'])){
    if($_GET['alert'] == "gagal"){
      echo "<div class='alert alert-danger'>File yang diperbolehkan hanya file gambar!</div>";
    }elseif($_GET['alert'] == "duplikat"){
      echo "<div class='alert alert-danger'><b>Kode Barang</b> sudah pernah digunakan!</div>";
    }
  }
  ?>
</script>


<script>


  function close_aplikasi(){
    console.log("masuk form close aplikasi");
    var x4 = document.getElementById("aplikasi");

    x4.style.display = "none";
  };

  function close_pembayaran(){
    console.log("masuk form close");
    var x1 = document.getElementById("payment");

    x1.style.display = "none";

  };


  function close_alatbayar(){
    console.log("masuk form close alatbayar");
    var x6 = document.getElementById("alatbayar");

    x6.style.display = "none";

  };


  function close_voucher(){
    console.log("masuk form close voucher");
    var x7 = document.getElementById("voucher");

    x7.style.display = "none";

  };

  function close_sub_alatbayar(){
    console.log("masuk form close sub alatbayar");
    var x5 = document.getElementById("showAlatbayar2");

    x5.style.display = "none";

  };



</script>

<?php include 'footer_refund.php'; ?>

