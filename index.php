<?php
//error_reporting(0);
$dir = "";

include $dir . "config/library.php"

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MENU | <?php echo $perusahaan; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="images/favicon.ico">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Style tambahan -->
  <link rel="stylesheet" href="dist/style.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- Tuesday Demo Page -->
  <link rel="stylesheet" type="text/css" href="dist/animated_tuesday/build/tuesday.css" />
  <!--animate-->
  <link rel="stylesheet" type="text/css" href="dist/anima.css" media="all">

</head>

<body class="hold-transition ">

  <div class="wrapper" style="background-color:#f4f6f9;min-height: 53%;">

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="margin-left:0px;background-color: white;min-height: 30%;overflow-x:hidden;">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-3">
            <div class="col-sm-12">
              <img src="images/logo1.png" height="60px" style="vertical-align:middle;">
              <a style="
    font-size: 30px;
    font-weight: bold;
    color: #0a499e; /* warna utama */
    text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3); /* bayangan teks */
    display: inline-block;
    text-align: center;
    transition: color 0.3s ease, text-shadow 0.3s ease;
"
                href="#"
                onmouseover="this.style.color='#1a514d'; this.style.textShadow='4px 4px 10px rgba(0, 0, 0, 0.4)';"
                onmouseout="this.style.color='#0a499e'; this.style.textShadow='2px 2px 5px rgba(0, 0, 0, 0.3)';">
                <?php echo $perusahaan; ?>
              </a>

              <!-- <a style="font-size:30px;font-weight: bold;"><?php echo $perusahaan; ?></a> -->
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>



      <section class="content">
        <div class="container-fluid">
          <!-- Judul -->
          <h5 class="mb-2 mt-4" style="font-weight: 600; color: #0a499e; font-size: 3.5em; text-align: center;">
            MENU UTAMA
          </h5>

          <br>

          <!-- Background Circle Decorations -->
          <ul class="circles">
            <li style="background-color:ghostwhite;"></li>
            <li style="background-color:lightgoldenrodyellow;"></li>
            <li style="background-color:azure;"></li>
            <li style="background-color:ghostwhite;"></li>
            <li style="background-color:whitesmoke;"></li>
            <li style="background-color:lightgoldenrodyellow;"></li>
            <li style="background-color:whitesmoke;"></li>
            <li style="background-color:lightgoldenrodyellow;"></li>
            <li style="background-color:whitesmoke;"></li>
            <li style="background-color:ghostwhite;"></li>
          </ul>

          <div class="row">
            <!-- Kotak KASIR -->
            <div class="col-lg-6 col-md-6 col-12 mb-3">
              <a href="index_login.php?to=kasir&hash=7" class="inner">
                <div class="small-box bg_primary_1">
                  <div class="inner" style="background-image: url('dist/img/button-pic1.jpg'); background-size: cover; height: 150px;">
                    <center>
                      <h3 class="text-white">KASIR</h3>
                    </center>
                  </div>
                </div>
              </a>
            </div>

            <!-- Kotak Manager Outlet -->
            <div class="col-lg-6 col-md-6 col-12 mb-3">
              <a href="index_login.php?to=manager&hash=6" class="inner">
                <div class="small-box bg_primary_1">
                  <div class="inner" style="background-image: url('dist/img/button-pic1.jpg'); background-size: cover; height: 150px;">
                    <center>
                      <h3 class="text-white">ADMIN</h3>
                    </center>
                  </div>
                </div>
              </a>
            </div>

            <!-- Kotak Gudang -->
            <div class="col-lg-6 col-md-6 col-12 mb-3">
              <a href="index_login.php?to=manager&hash=21" class="inner">
                <div class="small-box bg_primary_1">
                  <div class="inner" style="background-image: url('dist/img/button-pic1.jpg'); background-size: cover; height: 150px;">
                    <center>
                      <h3 class="text-white">GUDANG</h3>
                    </center>
                  </div>
                </div>
              </a>
            </div>

            <!-- Kotak Kepala Toko -->
            <div class="col-lg-6 col-md-6 col-12 mb-3">
              <a href="index_login.php?to=manager&hash=22" class="inner">
                <div class="small-box bg_primary_1">
                  <div class="inner" style="background-image: url('dist/img/button-pic1.jpg'); background-size: cover; height: 150px;">
                    <center>
                      <h3 class="text-white">SPG / SPB</h3>
                    </center>
                  </div>
                </div>
              </a>
            </div>
          </div>
          <!-- Kotak Kepala Toko -->
          <div class="col-lg-12 col-md-12 col-12 mb-3">
            <a href="index_login.php?to=manager&hash=2" class="inner">
              <div class="small-box bg_primary_1">
                <div class="inner" style="background-image: url('dist/img/button-pic1.jpg'); background-size: cover; height: 150px;">
                  <center>
                    <h3 class="text-white">KEPALA TOKO</h3>
                  </center>
                </div>
              </div>
            </a>
          </div>

        </div>
      </section>

      <!-- CSS untuk elemen circles dan background card -->
      <style>
        /* Dekorasi background lingkaran */
        .circles {
          position: absolute;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          z-index: -1;
          display: flex;
          justify-content: space-around;
          flex-wrap: wrap;
          padding-top: 50px;
        }

        .circles li {
          position: relative;
          display: block;
          list-style: none;
          width: 100px;
          height: 100px;
          border-radius: 50%;
          opacity: 0.5;
          margin: 20px;
        }

        /* Styling kotak menu */
        .small-box {
          border-radius: 10px;
          overflow: hidden;
          box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .small-box .inner {
          display: flex;
          align-items: center;
          justify-content: center;
          color: white;
        }

        .small-box h3 {
          font-weight: bold;
          font-size: 32px;
          color: white;
        }
      </style>






    </div>


  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer bg_primary_1" style="margin-left:0px;">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> <?php echo $ver; ?>
    </div>
    <strong>Copyright &copy;<?php echo $thn_sekarang . " " . $perusahaan; ?>.</strong> on develop by DATASYNC. All rights
    reserved.
  </footer>


  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
</body>

</html>