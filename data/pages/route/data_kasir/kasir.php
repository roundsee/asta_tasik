<?php

if ($ua['platform'] != 'android') {

  include 'header.php';
  // include 'detect.php';

  $dir = '../../';

  // include 'pembayaran.php';

  $en = $_SESSION['employee_number'];

  $query = mysqli_query($koneksi, "SELECT kd_cus,lokasi,no_kasir from user_login where employee_number='$en' ");
  $q = mysqli_fetch_array($query);

  $kd_cus = $q['kd_cus'];
  $lokasi = $q['lokasi'];
  $no_kasir = $q['no_kasir'];

  $query1 = mysqli_query($koneksi, "SELECT name_e,photo,kategori_kasir from employee where employee_number='$en' ");
  $q1 = mysqli_fetch_array($query1);
  $namakasir = $q1['name_e'];
  $kategori_kasir_harga = $q1['kategori_kasir'];
  $photo = $q1['photo'];
  if ($photo == 'profil.jpg') {
    $photo = 'member.jpg';
  }

  $query2 = mysqli_query($koneksi, "SELECT nama,alamat,kd_kota,kd_area from pelanggan where kd_cus='$kd_cus' ");
  $q2 = mysqli_fetch_array($query2);

  $nama_cab = $q2['nama'];
  $alamat = $q2['alamat'];
  $kd_kota = $q2['kd_kota'];
  $kd_area = $q2['kd_area'];


  $query3 = mysqli_query($koneksi, "SELECT tarif_pb1 from kotabaru where kode='$kd_kota' ");
  $q3 = mysqli_fetch_array($query3);

  $tarif_pb1 = 0;

  $_SESSION['kd_kota'] = $kd_kota;
  $_SESSION['kd_cus'] = $kd_cus;
  $_SESSION['tarif_pb1'] = $tarif_pb1;
  $_SESSION['nama_cab'] = $q2['nama'];
  $_SESSION['alamat'] = $q2['alamat'];
  $_SESSION['kd_area'] = $q2['kd_area'];

  // echo 'cetak : '.$_SESSION['kd_kota'];
  // echo 'cetak : '.$_SESSION['kd_cus'];
  // print_r($kd_kota);


?>


  <style>
    .menupilihan {
      /*      background-color: #fefefe;*/
      background-color: #f9e1b2;
      text-align: left;
      margin: .1rem auto;
      border-style: none;
      border-color: ghostwhite;
      padding: 1rem;
      /*width: 160px;*/
      box-shadow: 1px 1px 1px #c1c2c2;
      border-radius: 1px;
      /*      height: 200px;*/
    }

    .menunama {
      padding-top: 3px;
      height: 20px;
      line-height: 1.4rem;
      font-size: 100%;
      color: black;
      background-color: #f9e1b2;
      margin: 0 -1 0 -2;
      font-weight: 400;
      width: 250px;
      display: inline-block;
    }

    .menunama2 {
      padding-top: 3px;
      height: 20px;
      line-height: 1.4rem;
      font-size: 100%;
      color: black;
      background-color: #f9e1b2;
      margin: 0 -1 0 -2;
      font-weight: 400;
      width: 130px;
      display: inline-block;
    }

    .menunama3 {
      padding-top: 3px;
      height: 20px;
      line-height: 1.4rem;
      font-size: 100%;
      color: black;
      background-color: #f9e1b2;
      margin: 0 -1 0 -2;
      font-weight: 400;
      width: 100px;
      display: inline-block;
    }

    .menuharga_1 {
      background-color: whitesmoke;
      line-height: 20px;
      text-align: right;
      /*width: 90px;*/
      /*margin-bottom: .1rem;*/
      color: darkslategray;
      font-weight: 600;
      background-color: white;
      margin: 0 .3rem .1rem .3rem;
    }

    .menuharga {
      margin: 0 0 1px;
      height: 20px;
      background-color: white;
      color: grey;
      padding-top: 3px;
    }

    .tombol {
      box-shadow: 2px 2px 5px grey;
    }

    .tombol1 {
      font-weight: 600;
      box-shadow: 2px 2px 5px grey;
      border-bottom-right-radius: 5px !important;
      margin-left: 5px !important;
      border-style: hidden;
    }

    .tombol2 {
      width: 80px;
      border-radius: 20px;
      box-shadow: 2px 2px 5px grey;
      border-bottom-right-radius: 5px !important;
      margin-left: 5px !important;
      color: dimgray;
      font-weight: 600;
    }


    .tombol3 {
      width: 50px;
      border-radius: 20px;
      box-shadow: 2px 2px 5px grey;
      border-bottom-right-radius: 5px !important;
      margin-left: 5px !important;
      color: ghostwhite;
      background-color: black;
      font-weight: 600;
    }

    .row {
      padding: 5px;
      color: black;
    }

    .table {
      margin-bottom: 2px;
    }

    .table>tbody>tr>td,
    .table>tbody>tr>th,
    .table>tfoot>tr>td,
    .table>tfoot>tr>th,
    .table>thead>tr>td,
    .table>thead>tr>th {
      padding: 2px 5px;
    }

    .form-group {
      margin-bottom: 2px;
    }

    .skin-green .wrapper,
    .skin-green .main-sidebar,
    .skin-green .left-side {
      background-color: transparent;
    }

    /*Tabel Responsive 1*/
    .table-container {
      overflow: auto;
    }

    .box-poly {
      border-radius: 3px;
      background: #feffff;
      box-shadow: inset 2px 2px 2px #c1c2c2,
        inset -5px -5px 5px #ffffff;
    }

    .box-poly-up {
      border-radius: 3px;
      background: linear-gradient(145deg, #ffffff, #e5e6e6);
      box-shadow: 2px 2px 5px #c1c2c2,
        -5px -5px 5px #ffffff;
    }

    .box-poly-kotak {
      border-radius: 2px;
      background: #feffff;
      box-shadow: inset 2px -2px 10px #939494,
        inset -5px 5px 10px #ffffff;
    }

    .box-poly-kotak2 {
      border-radius: 10px;
      background: #feffff;
      box-shadow: inset 3px -3px 3px #e5e6e6,
        inset -5px 5px 10px #ffffff;
    }

    .menupilihan_alatbayar {
      background-color: #fcfcfc;
      text-align: center;
      margin: 1rem auto;
      border-style: outset;
      border-color: ghostwhite;
      padding: .2rem;
      /*width: 160px;*/
      box-shadow: 7px 7px 10px grey;
      border-radius: 15px;
    }

    .menupilihan_sub_alatbayar {
      background-color: #fcfcfc;
      text-align: center;
      margin: 1rem auto;
      border-style: outset;
      border-color: ghostwhite;
      padding: .2rem;
      /*width: 160px;*/
      box-shadow: 7px 7px 10px grey;
      border-radius: 15px;
    }

    .menunama_alatbayar {
      padding-top: 3px;
      height: 28px;
      line-height: 1.4rem;
      /*font-size: 95%;*/
      color: black;
      background-color: lightgoldenrodyellow;
      border-radius: 0 0 15px 15px;
    }

    .menunama_sub_alatbayar {
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

    .menupilihan_aplikasi {
      background-color: #fcfcfc;
      text-align: center;
      margin: 1rem auto;
      border-style: outset;
      border-color: ghostwhite;
      padding: .2rem;
      width: 130px;
      box-shadow: 7px 7px 10px grey;
      border-radius: 15px;
    }

    .menunama_aplikasi {
      padding-top: 3px;
      height: 28px;
      line-height: 1.4rem;
      /*font-size: 95%;*/
      color: black;
      background-color: lightgoldenrodyellow;
    }

    .print_faktur {
      width: 200px;
      height: 60px;
      font-size: 20px;
    }



    #satu,
    #print,
    #voucher,
    #alatbayar,
    #aplikasi,
    #payment,
    #sub_alat_bayar,
    #layerpayment {
      position: absolute;
      height: 100px;
    }

    #satu {
      left: 0px;
      top: 0px;
      background-color: whitesmoke;
      z-index: 1;

    }

    #aplikasi {
      width: 670px;
      height: 240px;
      left: 350px;
      top: 60px;
      background-color: ghostwhite;
      z-index: 3;

    }


    #payment {
      width: 1100px;
      height: 540px;
      left: 100px;
      top: 100px;
      /*    background-color:ghostwhite;*/
      z-index: 2;
    }

    #layerpayment {
      width: 100%;
      height: 100%;
      left: 0%;
      top: 0%;
      /*    background-color:ghostwhite;*/
      z-index: 0;
      /*    opacity: .9;*/
    }

    #alatbayar {
      width: 440px;
      height: 370px;
      left: 400px;
      top: 125px;
      background-color: ghostwhite;
      z-index: 4;
    }

    #sub_alat_bayar {
      width: 660px;
      height: 440px;
      left: 500px;
      top: 125px;
      background-color: ghostwhite;
      z-index: 9;
    }

    /*#sub_alat_bayar{
    width: 320px;
    height: 370px;
    left: 850px;
    top: 125px;
    background-color:ghostwhite;
    z-index: 9;
  }*/

    #voucher {
      width: 660px;
      height: 440px;
      left: 500px;
      top: 125px;
      background-color: ghostwhite;
      z-index: 15;
    }

    .background_wib1 {
      background-image: "../../dinein2.png";

    }

    #print {
      width: 100%;
      height: 100%;
      left: 0%;
      top: 0%;
      background-color: transparent;
      z-index: 6;
    }
  </style>

  <div class="content-wrapper bg_primary_3">

    <?php
    if (isset($_GET['alert'])) {
      if ($_GET['alert'] == "gagal") {
        echo "<div class='alert alert-danger'>File yang diperbolehkan hanya file gambar!</div>";
      } elseif ($_GET['alert'] == "duplikat") {
        echo "<div class='alert alert-danger'><b>Kode Produk</b> sudah pernah digunakan!</div>";
      }
    }
    ?>
    <div id="overlay" style="
    position: fixed; top: 0; left: 0; width: 100%; height: 100%;
    background: rgba(0, 0, 0, 0.7); color: white; text-align: center;
    display: flex; justify-content: center; align-items: center;
    z-index: 9999;">
      <div>
        <p>Anda harus mengklik tombol sebelum melanjutkan.</p>
        <button id="unlockButton" class="btn btn-success">Klik untuk Melanjutkan</button>
      </div>
    </div>

    <!-- <form action="route/data_kasir/kasir_act.php" method="post" onSubmit="return cek(this)"> -->
    <form method="post" class="form-user">
      <input type="hidden" name="kd_cus" value="<?php echo $kd_cus; ?>">
      <input type="hidden" name="kd_kategori_harga_online" id="kd_kategori_harga_online">

      <input type="hidden" name="kd_aplikasi" value="<?php echo $kd_aplikasi; ?>">

      <div class="row">
        <!-- kiri -->
        <?php include 'kasir_kiri.php'; ?>

        <!-- Kanan -->
        <?php include 'kasir_kanan.php'; ?>

      </div>

      <div id="aplikasi" style="display:none;">

      </div>

      <div id="layerpayment" class="" style="display:none">

      </div>

      <div id="payment" class="box-poly" style="display:none">

      </div>

      <div id="alatbayar" class="box-poly-up" style="display:none;padding:10 5 40;">

      </div>

      <div id="sub_alat_bayar" class="box-poly-up" style="display:none">

      </div>

      <div id="voucher" class="box-poly-up" style="display:none">

      </div>

      <div id="print" class="box-poly-up" style="display:none">

        <!-- <button class="print_faktur tombol1"><a style="cursor:pointer; color:blue; font-weight:bold; " onclick="window.open('cetak_faktur.php','nama window','width=280,height=600,toolbar=no,location=no,directories=no,status=no,menubar=no, scrollbars=no,resizable=yes,copyhistory=no')">Cetak Faktur</a></button> -->
      </div>

    </form>
    <!-- <div class="tampildata"></div> -->

  </div>
  </body>
  <?php
  include 'wibjs.php';
  ?>

  <script>
    function displayHasil(tgl_awal) {
      document.getElementById("tgl_awalHasil").value = tgl_awal;
    };
  </script>

  <script type="text/javascript">
    jQuery(document).ready(function(event) {
      var x1 = document.getElementById("payment");
      var x4 = document.getElementById("aplikasi");
      var x6 = document.getElementById("alatbayar");
      var x7 = document.getElementById("voucher");
      var x8 = document.getElementById("print");
      var x5 = document.getElementById("sub_alat_bayar");

      x1.style.display = "none";
      x4.style.display = "none";
      // x6.style.display = "none";
      // x7.style.display = "none";
      x8.style.display = "none";
      // x5.style.display = "none";

    });
  </script>

  <script>
    let timeout;

    function resetTimer() {
      clearTimeout(timeout);
      timeout = setTimeout(() => {
        document.getElementById("overlay").style.display = "flex";
      }, 60000); // 300000 ms = 5 menit
    }

    // Event listener untuk mendeteksi aktivitas pengguna
    document.addEventListener("mousemove", resetTimer);
    document.addEventListener("keypress", resetTimer);
    document.addEventListener("click", resetTimer);
    document.addEventListener("scroll", resetTimer);
    document.addEventListener("touchstart", resetTimer);

    // Set timer saat pertama kali load
    resetTimer();

    // Saat tombol diklik, hilangkan overlay dan reset timer
    document.getElementById("unlockButton").addEventListener("click", function() {
      document.getElementById("overlay").style.display = "none";
      resetTimer();
      // Saat tombol diklik, halaman akan di-refresh
      document.getElementById("unlockButton").addEventListener("click", function() {
        location.reload(); // Refresh halaman
      });
    });
  </script>
  <!-- <script type="text/javascript">
  <?php
  if (isset($_GET['alert'])) {
    if ($_GET['alert'] == "gagal") {
      echo "<div class='alert alert-danger'>File yang diperbolehkan hanya file gambar!</div>";
    } elseif ($_GET['alert'] == "duplikat") {
      echo "<div class='alert alert-danger'><b>Kode Barang</b> sudah pernah digunakan!</div>";
    }
  }
  ?>
</script> -->


  <script>
    function close_aplikasi() {
      console.log("close aplikasi");
      var x4 = document.getElementById("aplikasi");

      x4.style.display = "none";
    };

    function close_pembayaran() {
      $("#layerpayment").hide();

      console.log("close pembayaran");
      var x1 = document.getElementById("payment");

      var nilai_non_tunai = document.getElementById("payment_nilai_non_tunai").value;
      var nilai_no_ref = document.getElementById("tampil_alatbayar_pin").value;
      console.log('nilai_non tunai = ' + nilai_non_tunai)
      console.log('nilai_no_ref = ' + nilai_no_ref)

      console.log('pjg no_ref = ' + nilai_no_ref.trim().length)

      // x1.style.display = "none";
      document.getElementById("payment_nilai_tunai").innerHTML = nilai_non_tunai;


      if (nilai_non_tunai != '' && nilai_non_tunai != 0) {
        if (nilai_no_ref.trim().length == 0) {
          nilai_no_ref = 0;
          // document.getElementById("pesan_no_ref").innerHTML = "!!!...  no ref belum di isi";
          // alert("!!!...  no ref belum di isi");

          document.getElementById("pesan_no_ref").innerHTML = "";
          x1.style.display = "none";
          var x7 = document.getElementById("voucher");
          x7.style.display = "none";

          var x6 = document.getElementById("alatbayar");
          x6.style.display = "none";

          var x5 = document.getElementById("sub_alat_bayar");
          x5.style.display = "none";
        } else {
          document.getElementById("pesan_no_ref").innerHTML = "";
          x1.style.display = "none";
          var x7 = document.getElementById("voucher");
          x7.style.display = "none";

          var x6 = document.getElementById("alatbayar");
          x6.style.display = "none";

          var x5 = document.getElementById("sub_alat_bayar");
          x5.style.display = "none";
        }
      } else {
        document.getElementById("pesan_no_ref").innerHTML = "";
        x1.style.display = "none";

        var x7 = document.getElementById("voucher");
        x7.style.display = "none";

        var x5 = document.getElementById("sub_alat_bayar");
        x5.style.display = "none";
      }

    };


    function close_alatbayar() {
      console.log("close alatbayar");
      document.getElementById("pesan_no_ref").innerHTML = "";
      $('#tampil_alatbayar_pin').attr('disabled', 'disabled');
      $('#payment_nilai_non_tunai').attr('disabled', 'disabled');
      var x6 = document.getElementById("alatbayar");
      x6.style.display = "none";

      // var x5 = document.getElementById("showAlatbayar2");
      // var x5 = document.getElementById("sub_alat_bayar");
      // x5.style.display = "none";


    };


    function close_voucher() {
      console.log("close voucher");
      var x7 = document.getElementById("voucher");

      x7.style.display = "none";

    };

    function close_sub_alatbayar() {
      console.log("close sub alatbayar");
      // var x5 = document.getElementById("showAlatbayar2");
      var x5 = document.getElementById("sub_alat_bayar");
      x5.style.display = "none";

    };
  </script>

  <?php include 'footer.php'; ?>

<?php } else {
  echo 'access denied..';
} ?>