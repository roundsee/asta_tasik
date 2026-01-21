<?php
//error_reporting(0);
session_start();

$dir="config/";
$to=$_SESSION['to'];
$login_hash=$_SESSION['login_hash'];
// echo $to;

include $dir."library.php"

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MENU | <?php echo $perusahaan;?></title>
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
  <!-- Tuesday Demo Page -->
  <link rel="stylesheet" type="text/css" href="dist/animated_tuesday/build/tuesday.css" />
  <!--animate-->
  <link rel="stylesheet" type="text/css" href="dist/anima.css" media="all">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition ">

  <div class="wrapper" style="background-color:#f4f6f9;min-height: 53%;">

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="margin-left:0px;background-color: white;min-height: 30%;overflow-x:hidden;">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-3">
            <div class="col-sm-12" >
              <img src="images/logo1.png" height="60px" style="vertical-align:middle;" >
              <a style="font-size:30px;font-weight: 700"><?php echo $perusahaan;?></a>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Small Box (Stat card) -->
          <h5 class="mb-2 mt-4" style="font-weight:600"> MENU PILIHAN </h5>
          <br><br>
          <div class="row">

            <ul class="circles" >
        <li style="background-color:lightgray;"></li>
        <li style="background-color:gray;"></li>
        <li style="background-color:lightgray;"></li>
        <li style="background-color:lightgray;"></li>
        <li style="background-color:gray;"></li>
        <li style="background-color:lightgray;"></li>
        <li style="background-color:lightgray;"></li>
        <li style="background-color:gray;"></li>
        <li style="background-color:lightgray;"></li>
        <li style="background-color:lightgray;"></li>
        <li style="background-color:gray;"></li>
      </ul>

            <!-- ./col -->
            <!-- <div class="col-lg-3 col-6">

            </div> -->

            <?php if($to=='kasir' AND ($login_hash==7 OR $login_hash==0)){ ?>
              <!-- ./col -->
              <div class="col-lg-4 col-md-6 col-12">
                <!-- small card -->
                <a href="kasir_steak/pages/main.php?route=kasir"  >
                  <div class="small-box bg_primary_1 content">
                    <div class="inner " style="background-image: url(dist/img/button-pic.jpg);">
                      <h2>MENU KASIR</h2>
                      <p>&nbsp;</p>
                    </div>
                    <div class="icon">
                      <i class="fas">&nbsp;<img src="images/cashier_icon.png" style="max-width:55px; max-height:55px;vertical-align: sub;"></i>
                    </div>
                  </div>
                </a>
              </div>
            <?php  }?> 


            <?php if($to=='kasir' AND ($login_hash==7 OR $login_hash==0)){ ?>
              <!-- ./col -->
              <div class="col-lg-4 col-md-6 col-12">
                <!-- small card -->
                <a href="kasir_steak_b/pages/main.php?route=kasir"  >
                  <div class="small-box bg_primary_1 content">
                    <div class="inner " style="background-image: url(dist/img/button-pic.jpg);">
                      <h2>MENU KASIR B</h2>
                      <p>&nbsp;</p>
                    </div>
                    <div class="icon">
                      <i class="fas">&nbsp;<img src="images/cashier_icon.png" style="max-width:55px; max-height:55px;vertical-align: sub;"></i>
                    </div>
                  </div>
                </a>
              </div>
            <?php  }?> 

            <?php if($to=='kasir'){ ?>

              <!-- <div class="col-lg-3 col-6">

              </div> -->

              <!-- ./col -->
              <div class="col-lg-4 col-md-6 col-12">
                <!-- small card -->
                <a href="kasir_steak/pages/main.php?route=kasir_print" class="inner" >
                  <!-- <a href="#" class="inner" > -->
                  <div class="small-box bg_primary_1 content" >
                    <div class="inner" style="background-image: url(dist/img/button-pic.jpg);">
                      <h2>PRINT STRUK</h2>
                      <p>&nbsp;</p>
                    </div>
                    <div class="icon">
                      <i class="fas">&nbsp;<img src="images/print-solid.png" style="max-width:55px; max-height:55px;vertical-align: sub;"></i>

                    </div>
                  </div>
                </a>
              </div>
            <?php  }?> 



            <?php if($to=='manager' AND ($login_hash==6 OR $login_hash==0)){ ?>
              <!-- ./col -->
              <!-- <div class="col-lg-3 col-6">

              </div> -->
              <!-- ./col -->
              <div class="col-lg-4 col-md-6 col-12">
                <!-- small card -->
                <a href="void_trans/pages/main.php?route=kasir_void" class="inner" >
                  <!-- <a href="#" class="inner" > -->
                  <div class="small-box bg_primary_1 content">
                    <div class="inner " style="background-image: url(dist/img/button-pic.jpg);">
                      <h2>MENU VOID</h2>
                      <p>&nbsp;</p>
                    </div>
                    <div class="icon">
                      <i class="fas">&nbsp;<img src="images/refund.png" style="max-width:55px; max-height:55px;vertical-align: sub;"></i>
                    </div>
                  </div>
                </a>
              </div>
            <?php  }?> 

            <?php if($to=='manager'){ ?>
              <!-- ./col -->
              <div class="col-lg-4 col-md-6 col-12">
                <!-- small card -->
                <a href="steak/pages/main.php?route=home" class="inner" >
                  <div class="small-box bg_primary_1 content">
                    <div class="inner " style="background-image: url(dist/img/button-pic.jpg);">
                      <h2>MENU REPORT</h2>
                      <p>&nbsp;</p>
                    </div>
                    <div class="icon">
                      <i class="fas">&nbsp;<img src="images/chart-solid.png" style="max-width:55px; max-height:55px;vertical-align: sub;"></i>
                    </div>
                  </div>
                </a>
              </div>
            <?php  }?> 


            <!-- /.row -->
          </div><!-- /.container-fluid -->
        </section>
        <div class="row">
        <div class="col-lg-12">
          <div class="form-group">
            <a href="logout.php" class="btn-default btn tombol1 pull-right" style="padding-left: 9px;padding-right: 9px;background-color: red;color: white;"><i class="fa fa-sign-out"></i> LOG OUT</a>
          </div>
        </div>
      </div>
      </div>


    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer bg_primary_1" style="margin-left:0px;">
      <div class="float-right d-none d-sm-block">
        <b>Version</b> <?php echo $ver;?>
      </div>    
      <strong>Copyright &copy; 2020-<?php echo $thn_sekarang." ".$perusahaan;?>.</strong>  by Develop. All rights
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
