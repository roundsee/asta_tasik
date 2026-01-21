<?php
$dir = "../../../../";
include $dir . "config/library.php";
?>
<!DOCTYPE html>


<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $judul; ?> | <?php echo $judul2; ?> | <?php echo $judul3; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="../../../../images/wsteak.ico">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $dir; ?>plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?php echo $dir; ?>plugins/daterangepicker/daterangepicker.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo $dir; ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo $dir; ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo $dir; ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?php echo $dir; ?>plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?php echo $dir; ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo $dir; ?>plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo $dir; ?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="<?php echo $dir; ?>plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $dir; ?>dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- tambahan DatePicker -->
  <link rel="stylesheet" href="<?php echo $dir; ?>dist/bootstrap-datepicker-1.9.0-dist/css/bootstrap-datepicker.min.css">
  <!-- Style tambahan -->
  <link rel="stylesheet" href="<?php echo $dir; ?>dist/style.css">

  <!-- Tambahkan jqueryUI disini -->
  <script type="text/javascript" src="<?php echo $dir; ?>jquery-ui/js/jquery-1.10.2.js"></script>
  <script type="text/javascript" src="<?php echo $dir; ?>jquery-ui/js/jquery-ui-1.10.4.custom.min.js"></script>
  <link type="text/css" rel="stylesheet" href="<?php echo $dir; ?>jquery-ui/css/smoothness/jquery-ui-1.10.4.custom.min.css" />

  <!-- SweetAlert -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
  <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous"> -->

  <!--animate-->
  <!--   <link href="<?php echo $dir; ?>dist/css/animate.css" rel="stylesheet" type="text/css" media="all">
  <script src="<?php echo $dir; ?>dist/js/wow.min.js"></script>
  <script>
   new WOW().init();
 </script> -->
  <!--//end-animate-->
</head>

<body class="skin-green layout-top-nav control-sidebar-slide-open layout-navbar-fixed layout-footer-fixed text-sm" style="height: auto;">

  <!-- ----- Wrapper----- -->
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-light  dropdown-legacy accent-warning elevation-2 border-bottom-0 bg_primary_2">
      <div class="container" style="margin:0;font-size: smaller;">
        <a href="../../main.php?route=home" class="navbar-brand">
          <img src="../../../../images/logo_steak_putih.png" alt="Steak & Shake Logo" class="brand-image elevation-2" style="opacity: .8">
          <span class="brand-text font-weight-light" style="color:yellow;font-size: smaller;"><?php echo $perusahaan; ?></span>
        </a>
        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
          <!-- Left navbar links -->
          <ul class="navbar-nav" style="font-weight:200;">
            <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation" style="background-color: gainsboro;">
              <span class="navbar-toggler-icon"></span>
            </button>

            <li class="nav-item">
              <a href="../../main.php?route=home" class="nav-link warna_primary_2">
                <i class="fa fa-home"></i> BERANDA
              </a>
            </li>

            <li class="nav-item">
              <a href="../../main.php?route=home" class="nav-link warna_primary_2">
                <i class="fa fa-database"></i> DATA
              </a>
            </li>

            <li class="nav-item">
              <a href="../../main.php?route=home" class="nav-link warna_primary_2">
                <i class="fa-solid fa-sliders"></i> SETTING
              </a>
            </li>
            <li class="nav-item">
              <a href="../../main.php?route=home" class="nav-link warna_primary_2">
                <i class="fa fa-clipboard"></i> LAPORAN
              </a>
            </li>
            <li class="nav-item">
              <a href="../../../../logout.php" class="nav-link warna_primary_2">
                <img src="../../../../assets/icons/person-leave-solid-w.png" width="20px"> LOG OUT
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="background-color: ghostwhite;">
      <!-- Content Header (Page header) -->


      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="card card-default">
            <!-- /.card-header -->
            <div class="card-body">
              <!-- Main row -->
              <div class="row">
                <!-- Left col -->
                <section class="col-lg-12 connectedSortable">
                  <!-- Custom tabs (Charts with tabs)-->
                  <div class="box" style="background-color: #eee">

                    <div class="box-body" style="margin-top: -20px">