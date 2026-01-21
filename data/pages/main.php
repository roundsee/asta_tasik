<?php
//error_reporting(0);

session_start();

$dir = "../../";
$login_hash = $_SESSION['login_hash'];
$en = $_SESSION['employee_number'];
$to = $_SESSION['to'];
$area_e = $_SESSION['area_e'];
$area_nama = $_SESSION['area_nama'];
$namauser = $_SESSION['namauser'];
$jabatan = $_SESSION['jabatan'];
$pelanggan_nama = $_SESSION['pelanggan_nama'];

// echo '<br><br>';
// echo '<br>login_hash : '.$login_hash;
// echo '<br>namauser : '.$namauser;
// echo '<br>pelanggan_nama : '.$pelanggan_nama;
// echo '<br>employee_number : '.$en;
// echo '<br>kd_cus : '.$kd_cus;
// echo '<br>cabang_e : '.$cabang_e;

if (empty($_SESSION['namauser']) and empty($_SESSION['passuser'])) {
  echo "<link href='../../dist/style.css' rel='stylesheet' type='text/css'>
  <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<div class='wrapper'><a href=../../index.php><b>LOGIN</b></a></div></center>";
} else {
  include $dir . "config/koneksi.php";
  include $dir . "config/fungsi_kode_otomatis.php";
  include $dir . "config/fungsi_rupiah.php";
  include $dir . "config/fungsi_indotgl.php";
  include $dir . "config/library.php";

  $en = $_SESSION['employee_number'];
  $foto = mysqli_query($koneksi, "SELECT * from employee where employee_number='$_SESSION[employee_number]' ");
  $f_foto = mysqli_fetch_array($foto);
  $filefoto = $f_foto['photo'];
  if ($filefoto == 'profil.jpg') {
    $filefoto = 'member.jpg';
  }

?>
  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $perusahaan; ?> system</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../../images/favicon.ico">

    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css"> -->
    <!-- fontawesome-free-6.3.0-web -->
    <link rel="stylesheet" href="../../assets/fontawesome-free-6.3.0-web/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="../../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="../../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- tambahan DatePicker -->
    <link rel="stylesheet" href="../../dist/bootstrap-datepicker-1.9.0-dist/css/bootstrap-datepicker.min.css">

    <!-- Tambahkan jqueryUI disini -->
    <script type="text/javascript" src="<?php echo $dir; ?>jquery-ui/js/jquery-1.10.2.js"></script>
    <script src="<?php echo $dir; ?>jquery-ui/js/tableToExcel.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsbarcode/3.11.3/JsBarcode.all.min.js"></script>


    <!-- <script type="text/javascript" src="<?php echo $dir; ?>jquery-ui/js/jquery-ui-1.10.4.custom.min.js"></script> -->
    <link type="text/css" rel="stylesheet" href="<?php echo $dir; ?>jquery-ui/css/smoothness/jquery-ui-1.10.4.custom.min.css" />

    <!-- SweetAlert -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous"> -->

    <!-- Style sendiri -->
    <link rel="stylesheet" type="text/css" href="../../dist/wib.css">

    <!-- Tuesday Demo Page -->
    <link rel="stylesheet" type="text/css" href="../../dist/animated_tuesday/build/tuesday.css" />
    <!--animate-->
    <link rel="stylesheet" type="text/css" href="../../dist/anima.css" media="all">

    <!--test111-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />
    <!-- <script src="<?php echo $dir; ?>dist/js/wow.min.js"></script> -->
    <script>
      new WOW().init();
    </script>
    <!--//end-animate-->

    <style type="text/css">
      /* Full-page overlay */
      #loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        z-index: 9999;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: #fff;
        font-size: 1.2em;
      }

      /* Spinner Animation */
      .spinner {
        width: 60px;
        height: 60px;
        border: 8px solid #f3f3f3;
        border-top: 8px solid #3498db;
        border-radius: 50%;
        animation: spin 1s linear infinite;
      }

      @keyframes spin {
        0% {
          transform: rotate(0deg);
        }

        100% {
          transform: rotate(360deg);
        }
      }

      .table td,
      .table th {
        padding: .575rem;
      }

      .table3 td,
      .table3 th {
        padding: .375rem;
      }

      /* Dropdown LAPORAN scroll */
      .dropdown-scroll {
        max-height: 70vh;
        /* maksimal 70% tinggi layar */
        overflow-y: auto;
        overflow-x: hidden;
      }

      /* Scrollbar halus */
      .dropdown-scroll::-webkit-scrollbar {
        width: 6px;
      }

      .dropdown-scroll::-webkit-scrollbar-thumb {
        background: rgba(0, 0, 0, .3);
        border-radius: 4px;
      }

      /* Firefox */
      .dropdown-scroll {
        scrollbar-width: thin;
      }
    </style>
  </head>

  <body class="skin-green layout-top-nav control-sidebar-slide-open layout-navbar-fixed layout-footer-fixed text-sm" style="height: auto;">
    <div class="wrapper">

      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand-md navbar-light  dropdown-legacy accent-warning elevation-2 border-bottom-0 bg_primary_2">
        <div class="container-fluid" style="margin:0;">
          <a href="#" class="navbar-brand">
            <img src="../../images/logo3.png" alt="Steak & Shake Logo" class="brand-image elevation-2" style="opacity: .8">
            <span class="brand-text font-weight-light" style="color:white;"><?php echo $perusahaan; ?></span>
          </a>

          <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation" style="background-color: gainsboro;">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <!-- Left navbar links -->
            <ul class="navbar-nav" style="font-weight:200;">
              <li class="nav-item">
                <a href="main.php?route=home" class="nav-link warna_primary_2">
                  <i class="fa fa-home"></i> BERANDA
                </a>
              </li>
              <?php if ($login_hash == 22 or $login_hash == 21) { ?>

                <li class="nav-item dropdown">
                  <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle  warna_primary_2">
                    <i class="fa-solid fa-database"></i> DATA</a>
                  <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow " style="left: 0px; right: inherit;">
                    <li><a href="main.php?route=barang&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=barang" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> DATA BARANG</a></li>

                  </ul>
                </li>

              <?php } ?>

              <?php if ($login_hash == 0 or $login_hash == 1 or $login_hash == 2  or $login_hash == 3 or $login_hash == 6 and $login_hash != 21) { ?>

                <li class="nav-item dropdown">
                  <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle  warna_primary_2">
                    <i class="fa-solid fa-database"></i> DATA</a>
                  <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow dropdown-scroll">

                    <li><a href="main.php?route=barang&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=barang" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> DATA BARANG</a></li>
                    <!-- <li><a href="main.php?route=gudang&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=barang" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> DATA GUDANG</a></li> -->
                    <li><a href="main.php?route=lokasi&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=lokasi" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> DATA LOKASI</a></li>
                    <!-- <li><a href="main.php?route=kategori_satuan&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=barang" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> DATA KATEGORI SATUAN</a></li> -->

                    <li><a href="main.php?route=member&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=member" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> DATA MEMBER</a></li>

                    <li><a href="main.php?route=supplier&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=supplier" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> DATA SUPPLIER</a></li>
                    <li><a href="main.php?route=sales&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=sales" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> DATA SALES</a></li>

                    <li><a href="main.php?route=kategori&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=kategori" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> DATA KATEGORI</a></li>
                    <li><a href="main.php?route=kategori_buffer&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=barang" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> DATA KATEGORI BUFFER</a></li>

                    <li><a href="main.php?route=account&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=account" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> DATA ACCOUNT</a></li>

                    <li><a href="main.php?route=jenis_transaksi&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=jenis_transaksi" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> JENIS TRANSAKSI </a></li>

                    <?php if ($login_hash == 0) { ?>
                      <li><a href="main.php?route=delete_mutasi&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=kotabaru" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> DELETE DATA MUTASI </a></li>
                    <?php } ?>
                  </ul>
                </li>


                <?php if ($login_hash == 0) { ?>
                  <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle  warna_primary_2">
                      <i class="fa-solid fa-database"></i> MUTASI </a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow dropdown-scroll">
                      <li><a href="main.php?route=mutasi_stok&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=mutasi_stok" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> MUTASI STOK </a></li>
                      <li><a href="main.php?route=export_pembelian&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=export_pembelian" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> EXPORT PEMBELIAN </a></li>
                      <li><a href="main.php?route=export_pengiriman&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=export_pengiriman" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> EXPORT PENGIRIMAN </a></li>
                      <!-- <li><a href="main.php?route=export_pembelian_retur&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=export_pembelian_retur" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> EXPORT PEMBELIAN RETUR </a></li> -->
                      <li><a href="main.php?route=export_penjualan&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=export_penjualan" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> EXPORT PENJUALAN </a></li>
                      <li><a href="main.php?route=import_pembelian&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=import_pembelian" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> IMPORT PEMBELIAN </a></li>
                      <li><a href="main.php?route=import_pengiriman&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=import_pengiriman" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> IMPORT PENGIRIMAN </a></li>
                      <!-- <li><a href="main.php?route=import_pembelian_retur&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=import_pembelian_retur" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> IMPORT PEMBELIAN RETUR </a></li> -->
                      <li><a href="main.php?route=import_penjualan&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=import_penjualan" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> IMPORT PENJUALAN </a></li>

                      <li class="dropdown-divider"></li>

                      <li class="dropdown-submenu dropdown-hover">
                        <a href="main.php?route=import_stok_opname&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=import_stok_opname" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> IMPORT STOK OPNAME</a>
                      </li>
                    </ul>
                  </li>
                <?php } ?>
                <li class="nav-item dropdown">
                  <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle  warna_primary_2">
                    <i class="fa-solid fa-database"></i> SETTING </a>
                  <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow dropdown-scroll">
                    <li><a href="main.php?route=staff&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=staff" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> CREATE STAFF </a></li>
                    <li><a href="register.php" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> REGISTER LOGIN STAFF </a></li>
                    <li><a href="main.php?route=setup&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=setup" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> SETUP</a></li>
                  </ul>
                </li>


              <?php } ?>



              <?php if ($login_hash == 0 or $login_hash == 1 or $login_hash == 2 or $login_hash == 3 or $login_hash == 6  or $login_hash == 21) { ?>

                <li class="nav-item dropdown">
                  <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle  warna_primary_2">
                    <i class="fa-solid fa-database"></i> TRANSAKSI</a>
                  <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow dropdown-scroll">


                    <!-- <li><a href="main.php?route=pembelian&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=beli" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> PEMBELIAN</a></li> -->
                    <?php if ($login_hash != 21) { ?>
                      <li><a href="main.php?route=generate_stok&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=beli" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> GENERATE BASED ON QTY</a></li>
                      <li><a href="main.php?route=generate_stok_supplier&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=beli" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> GENERATE BASED ON SUPPLIER</a></li>
                      <li><a href="main.php?route=beli&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=beli" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> PURCHASE REQUEST</a></li>
                      <li><a href="main.php?route=po&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=purchase_order" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> PURCHASE ORDER</a></li>
                    <?php } ?>

                    <?php if ($login_hash == 21) { ?>
                      <li><a href="main.php?route=purchase_order_gudang&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=purchase_order" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> PURCHASE ORDER GUDANG</a></li>
                    <?php } ?>
                    <li><a href="main.php?route=good_receiving&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=good_receiving" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> GOODS RECEIVING</a></li>
                    <?php if ($login_hash != 21) { ?>
                      <li><a href="main.php?route=purchase_order_keuangan&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=purchase_order" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> INVOICE</a></li>
                      <!-- <li><a href="main.php?route=stok_opname&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=stok_opname" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> STOK OPNAME</a></li> -->
                    <?php } ?>
                    <!-- <li><a href="main.php?route=pembelian_retur&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=data-pembelian-retur" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> PURCHASE RETURN </a></li> -->
                    <li><a href="main.php?route=penjualan_retur&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=data-penjualan-retur" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> RETUR PENJUALAN </a></li>
                    <li><a href="main.php?route=pembelian_retur_nota&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=data-pembelian-retur" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> RETUR PEMBELIAN </a></li>

                    <!-- <li><a href="main.php?route=invoice_pembelian&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=good_receiving" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> INVOICE PEMBELIAN</a></li> -->

                  </ul>
                </li>

                <li class="nav-item dropdown">
                  <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle  warna_primary_2">
                    <i class="fa-solid fa-database"></i> BUILD </a>
                  <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow dropdown-scroll">
                    <li><a href="main.php?route=assembly&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=assembly" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> BUILD</a></li>
                    <li><a href="main.php?route=bompenjualan&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=bompenjualan" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> BUILD REPORT</a></li>
                  </ul>
                </li>
              <?php } ?>

              <?php if ($login_hash == 0 or $login_hash == 1 or $login_hash == 2 or $login_hash == 3 or $login_hash == 6  or $login_hash == 21 or $login_hash == 22) { ?>
                <li class="nav-item dropdown">
                  <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle  warna_primary_2">
                    <i class="fa-solid fa-database"></i> TRANSFER BARANG </a>
                  <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow dropdown-scroll">
                    <li><a href="main.php?route=permintaan_barang&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=permintaan_barang" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Permintaan Barang</a></li>
                    <li><a href="main.php?route=penerimaan_barang_internal&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=penerimaan_barang_internal" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Penerimaan Barang</a></li>
                    <li><a href="main.php?route=pengiriman_barang&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=pengiriman_barang" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> <?php echo ($login_hash == 22) ? 'Retur Barang' : 'Pengiriman Barang'; ?> </a></li>
                    <li><a href="main.php?route=permintaan_barang_selesai&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=permintaan_barang_selesai" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Permintaan Barang Selesai</a></li>
                    <li><a href="main.php?route=mutasi_bs&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=mutasi_bs" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Mutasi Barang BS</a></li>
                    <li>
                      <hr class="dropdown-divider">
                    </li>
                  </ul>
                </li>
              <?php } ?>


              <!-- <?php if ($login_hash == 0 or $login_hash == 1 or $login_hash == 2 or $login_hash == 3 or $login_hash == 6) { ?>

                <li class="nav-item dropdown">
                  <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle  warna_primary_2">
                    <i class="fa-solid fa-database"></i> INVOICE </a>
                  <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow dropdown-scroll">


                  </ul>
                </li>

              <?php } ?> -->

              <?php if ($login_hash == 0 or $login_hash == 1 or $login_hash == 2 or $login_hash == 3 or $login_hash == 6) { ?>

                <li class="nav-item dropdown">
                  <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle  warna_primary_2">
                    <i class="fa-solid fa-database"></i> PAYMENT </a>
                  <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow dropdown-scroll">
                    <li><a href="main.php?route=payment_based_supplier&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=payment_based_supplier" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> PAYMENT BASED ON SUPPLIER</a></li>
                    <li><a href="main.php?route=payment&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=good_receiving" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> PAYMENT</a></li>
                    <li><a href="main.php?route=paylater&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=good_receiving" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> PAYLATER</a></li>
                    <li><a href="main.php?route=biaya&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=biaya" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> BIAYA</a></li>
                    <li><a href="main.php?route=payment_success&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=good_receiving" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> PAYMENT LUNAS</a></li>
                    <li><a href="main.php?route=paylaterreport&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=paylaterreport" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> PAYLATER REPORT</a></li>
                    <li><a href="main.php?route=lap_biaya&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=lap_biaya" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> BIAYA REPORT </a></li>

                    <!-- <li><a href="main.php?route=payment_belum_lunas&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=good_receiving" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> PAYMENT BELUM LUNAS</a></li> -->
                    <!-- <li><a href="main.php?route=piutang&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=piutang" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Pembayaran Piutang</a></li> -->

                    <li>
                      <hr class="dropdown-divider">
                    </li>
                    <li><a href="main.php?route=outstanding_utang&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=outstanding_utang" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> OUTSTANDING UTANG </a></li>
                    <li><a href="main.php?route=outstanding_utang_detail&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=outstanding_utang" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> OUTSTANDING UTANG DETAIL</a></li>
                  </ul>
                </li>
                <!-- <li class="nav-item dropdown">
                  <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle  warna_primary_2">
                    <i class="fa-solid fa-database"></i> BIAYA </a>
                  <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow dropdown-scroll">
                    <li><a href="main.php?route=biaya&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=biaya" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Biaya</a></li>
                    <li><a href="main.php?route=lap_biaya&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=lap_biaya" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Laporan Biaya </a></li>
                  </ul>
                </li> -->


                <!-- <li class="nav-item dropdown">
                  <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle  warna_primary_2">
                    <i class="fa-solid fa-database"></i> PAYMENT </a>
                  <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow dropdown-scroll">

                    <li><a href="main.php?route=payment_invoice&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=good_receiving" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> PAYMENT</a></li>
                    <li><a href="main.php?route=payment_lunas&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=good_receiving" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> PAYMENT LUNAS</a></li>
                    <li><a href="main.php?route=payment_belum_lunas&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=good_receiving" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> PAYMENT BELUM LUNAS</a></li>

                  </ul>
                </li> -->

              <?php } ?>



              <?php if ($login_hash == 0 or $login_hash == 1 or $login_hash == 2 or $login_hash == 4 or $login_hash == 5 or $login_hash == 6 or $login_hash == 7 or $login_hash == 8 or $login_hash == 10 or $login_hash == 11 or $login_hash == 21 or $login_hash == 22) { ?>
                <li class="nav-item dropdown">
                  <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link  warna_primary_2 dropdown-toggle">
                    <i class="fa-solid fa-clipboard"></i> LAPORAN</a>
                  <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow dropdown-scroll">
                    <?php if ($login_hash == 0 or $login_hash == 1 or $login_hash == 2 or $login_hash == 4 or $login_hash == 5 or $login_hash == 6 or $login_hash == 8 or $login_hash == 9 or $login_hash == 12 or $login_hash == 13 or $login_hash == 14) { ?>

                      <li class="dropdown-submenu dropdown-hover">
                        <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle"> MUTASI</a>
                        <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow ">

                          <li>
                            <a tabindex="-1" href="main.php?route=lap_mutasi_per_barang&act&ide=<?php echo $_SESSION['employee_number']; ?>&tujuan=mutasi" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Data Mutasi</a>
                          </li>
                          <li>
                            <a tabindex="-1" href="main.php?route=lap_mutasi_per_barang2&act&ide=<?php echo $_SESSION['employee_number']; ?>&tujuan=mutasi" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Data Mutasi Per Barang</a>
                          </li>
                          <li>
                            <a tabindex="-1" href="main.php?route=lap_mutasi_per_barang_detail&act&ide=<?php echo $_SESSION['employee_number']; ?>&tujuan=mutasi" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Data Mutasi Detail</a>
                          </li>
                          <!-- <li>
                            <a tabindex="-1" href="main.php?route=lap_mutasi_stok_per_outlet&act&ide=<?php echo $_SESSION['employee_number']; ?>&tujuan=mutasi" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Mutasi Stok (nilai)</a>
                          </li> -->
                        </ul>
                      </li>
                    <?php } ?>
                    <?php if ($login_hash == 0 or $login_hash == 1 or $login_hash == 2 or $login_hash == 4 or $login_hash == 5 or $login_hash == 6 or $login_hash == 8 or $login_hash == 9 or $login_hash == 12 or $login_hash == 13 or $login_hash == 14 or $login_hash == 21 or $login_hash == 22) { ?>

                      <li class="dropdown-submenu dropdown-hover">
                        <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle"> OPNAME</a>
                        <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow ">
                          <li>
                            <a tabindex="-1" href="main.php?route=opname_stock_mutasi&act&ide=<?php echo $_SESSION['employee_number']; ?>&tujuan=mutasi" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Stock Opname</a>
                          </li>
                          <li>
                            <a tabindex="-1" href="main.php?route=lap_opname_stock_mutasi&act&ide=<?php echo $_SESSION['employee_number']; ?>&tujuan=mutasi" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Laporan Stock Opname</a>
                          </li>
                        </ul>
                      </li>
                    <?php } ?>

                    <!-- <?php if ($login_hash == 0 or $login_hash == 1 or $login_hash == 2 or $login_hash == 6 or $login_hash == 8 or $login_hash == 9 or $login_hash == 10 or $login_hash == 12  or $login_hash == 13  or $login_hash == 14) { ?>
                      <li class="dropdown-divider"></li>


                      <li class="dropdown-submenu dropdown-hover">
                        <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle"> Laporan Laba</a>
                        <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                          <li><a href="main.php?route=lap_mutasi_laba_penjualan&act&ide=<?php echo $_SESSION['employee_number']; ?>&tujuan=alatbayar" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Laba Penjualan (Barang)</a></li>
                          <li><a href="main.php?route=lap_mutasi_laba_penjualan_grosir&act&ide=<?php echo $_SESSION['employee_number']; ?>&tujuan=alatbayar" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Laba Penjualan Grosir (Barang)</a></li>
                          <li><a href="main.php?route=lap_mutasi_laba_penjualan_retail&act&ide=<?php echo $_SESSION['employee_number']; ?>&tujuan=alatbayar" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Laba Penjualan Retail (Barang)</a></li>

                          <li><a href="main.php?route=lap_rekap_penjualan&act&ide=<?php echo $_SESSION['employee_number']; ?>&tujuan=alatbayar" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Laba Penjualan (Nilai)</a></li>
                          <li><a href="main.php?route=lap_member_laba_penjualan&act&ide=<?php echo $_SESSION['employee_number']; ?>&tujuan=alatbayar" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Laba Penjualan (Member)</a></li>

                        </ul>
                      </li>


                    <?php } ?> -->

                    <li class="dropdown-divider"></li>
                    <?php if ($login_hash != 7) { ?>
                      <li><a href="main.php?route=lap_stok&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=lap_stok" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Laporan Stok Terkini </a></li>
                      <li><a href="main.php?route=lap_stok_summary&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=lap_stok" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Laporan Rangkuman Stok Terkini</a></li>

                      <?php if ($login_hash != 22 and $login_hash != 21) { ?>
                        <li><a href="main.php?route=lap_barang_beli&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=pb1" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Laporan Pembelian (Barang) </a></li>
                        <li><a href="main.php?route=lap_pembelian_invoice&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=lap_pembelian_invoice" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Laporan Pembelian (Invoice) </a></li>
                        <li><a href="main.php?route=lap_payment_lunas&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=lap_payment_lunas" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Laporan Payment </a></li>
                        <li><a href="main.php?route=lap_transfer_barang&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=lap_transfer_barang" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Laporan Transfer Barang </a></li>
                        <li class="dropdown-divider"></li>
                        <!-- <li><a href="main.php?route=lap_retur_penjualan_summary&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=lap_retur_penjualan_summary" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Laporan Retur Penjualan </a></li> -->
                        <li><a href="main.php?route=lap_retur_penjualan&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=lap_retur_penjualan" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Laporan Retur Penjualan </a></li>
                        <li><a href="main.php?route=lap_retur_pembelian&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=lap_retur_pembelian" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Laporan Retur Pembelian </a></li>
                        <li class="dropdown-divider"></li>

                      <?php } ?>
                    <?php } ?>
                    <?php if ($login_hash != 22 and $login_hash != 21) { ?>
                      <li><a href="main.php?route=pb1&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=pb1" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Daftar Penjualan </a></li>
                      <li><a href="main.php?route=pb1_detil&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=pb1" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Daftar Penjualan Detail </a></li>
                      <li><a href="main.php?route=pb1_barang_diskon&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=pb1" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Daftar Penjualan Barang Diskon </a></li>
                    <?php } ?>
                    <!-- <li><a href="main.php?route=daftar_pembelian&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=daftar_pembelian" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Daftar Pembelian </a></li> -->
                  <?php } ?>

                  <?php if ($login_hash == 0 or $login_hash == 1 or $login_hash == 3 or $login_hash == 4 or $login_hash == 5) { ?>

                    <li><a href="main.php?route=daftar_harga_model2&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=daftar_harga" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Daftar HARGA</a></li>
                  <?php } ?>
                  <?php if ($login_hash == 0 or $login_hash == 1 or $login_hash == 2 or $login_hash == 3 or $login_hash == 6) { ?>

                  <?php } ?>

                  <!-- <?php if ($login_hash == 0 or $login_hash == 1 or $login_hash == 4 or $login_hash == 5) { ?>

                    <li><a href="main.php?route=daftar_diskon&act&ide=<?php echo $_SESSION['employee_number']; ?>&tujuan"   class="dropdown-item"><i class="fa-solid fa-caret-right"></i>  Daftar DISKON & PROMOSI</a></li>
                  <?php } ?> -->

                  <!-- <?php if ($login_hash == 0 or $login_hash == 1 or $login_hash == 2 or $login_hash == 4 or $login_hash == 5) { ?>

                    <li class="dropdown-divider"></li>

                    <li class="dropdown-submenu dropdown-hover">
                      <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle"> Daftar VOUCHER</a>
                      <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow ">

                        <li><a href="main.php?route=daftar_voucher&act&ide=<?php echo $_SESSION['employee_number']; ?>&tujuan=terbit"   class="dropdown-item"><i class="fa-solid fa-caret-right"></i> yg di terbitkan</a></li>
                        <li><a href="main.php?route=daftar_voucher&act&ide=<?php echo $_SESSION['employee_number']; ?>&tujuan=blm"   class="dropdown-item"><i class="fa-solid fa-caret-right"></i> yg Blm di Gunakan</a></li>
                        <li><a href="main.php?route=daftar_voucher&act&ide=<?php echo $_SESSION['employee_number']; ?>&tujuan=sdh"   class="dropdown-item"><i class="fa-solid fa-caret-right"></i> yg Sdh di Gunakan</a></li>

                      </ul>
                    </li>
                  <?php } ?> -->

                  <!-- <?php if ($login_hash == 0 or $login_hash == 1 or $login_hash == 3) { ?>

                    <li class="dropdown-divider"></li>

                    <li><a href="main.php?route=daftar_alat_bayar_model2&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=alat_bayar" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Daftar ALAT PEMBAYARAN</a></li>
                  <?php } ?> -->



                  <!-- <?php if ($login_hash != 6 and $login_hash != 7) { ?>

                    <li class="dropdown-divider"></li>

                    <li class="dropdown-submenu dropdown-hover">
                      <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle"> Daftar PENJUALAN</a>
                      <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow ">
                        <?php if ($login_hash == 0 or $login_hash == 1 or $login_hash == 2 or $login_hash == 4 or $login_hash == 5 or $login_hash == 8) { ?>

                          <li>
                            <a tabindex="-1" href="main.php?route=rekap_penjualan&act&ide=<?php echo $_SESSION['employee_number']; ?>&tujuan=outlet"  class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Rekap PENJUALAN per OUTLET</a>
                          </li>
                          
                        <?php } ?>

                        <?php if ($login_hash == 0 or $login_hash == 1 or $login_hash == 2 or $login_hash == 8) { ?>

                          <li>
                            <a tabindex="-1" href="main.php?route=rekap_penjualan&act&ide=<?php echo $_SESSION['employee_number']; ?>&tujuan=kasir"  class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Rekap PENJUALAN per KASIR</a>
                          </li>
                          
                        <?php } ?>


                        <?php if ($login_hash == 0 or $login_hash == 1 or $login_hash == 2 or $login_hash == 4 or $login_hash == 5 or $login_hash == 8) { ?>

                          <li><a href="main.php?route=rekap_penjualan&act&ide=<?php echo $_SESSION['employee_number']; ?>&tujuan=aplikasi"   class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Rekap PENJUALAN per APLIKASI</a></li>
                          
                        <?php } ?>


                        <?php if ($login_hash == 0 or $login_hash == 1 or $login_hash == 2 or $login_hash == 10) { ?>

                          <li><a href="main.php?route=rekap_penjualan&act&ide=<?php echo $_SESSION['employee_number']; ?>&tujuan=alatbayar" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Rekap PENJUALAN per ALAT BAYAR</a></li>
                          
                        <?php } ?>


                        <?php if ($login_hash == 0 or $login_hash == 1 or $login_hash == 2 or $login_hash == 8) { ?>

                          <li><a href="main.php?route=rekap_penjualan&act&ide=<?php echo $_SESSION['employee_number']; ?>&tujuan=carabayar" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Rekap PENJUALAN dari EDC & APLIKASI</a></li>
                          
                        <?php } ?>


                        <?php if ($login_hash == 0 or $login_hash == 1 or $login_hash == 2 or $login_hash == 4 or $login_hash == 5 or $login_hash == 8) { ?>

                          <li><a href="main.php?route=rekap_penjualan_menu&act&ide=<?php echo $_SESSION['employee_number']; ?>&tujuan=menu" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Rekap PENJUALAN per MENU</a></li>
                          
                        <?php } ?>

                        <?php if ($login_hash == 0 or $login_hash == 1 or $login_hash == 2 or $login_hash == 4 or $login_hash == 5 or $login_hash == 8) { ?>

                          <li><a href="main.php?route=rekap_penjualan_menu_outlet&act&ide=<?php echo $_SESSION['employee_number']; ?>&tujuan=menu" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Rekap PENJUALAN per Outlet MENU</a></li>
                          
                        <?php } ?>


                      </ul>
                    </li>
                    <li class="dropdown-divider"></li>
                    
                  <?php } ?> -->

                  <!-- <?php if ($login_hash == 0 or $login_hash == 1 or $login_hash == 2 or $login_hash == 10) { ?>

                    <li><a href="main.php?route=rekap_penjualan_sage&act&ide=<?php echo $_SESSION['employee_number']; ?>&tujuan=alatbayar" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Rekap PENJUALAN per ALAT BAYAR (Khusus)</a></li>
                    
                  <?php } ?> -->


                  <!-- <?php if ($login_hash == 0 or $login_hash == 1 or $login_hash == 2) { ?>

                    <li class="dropdown-divider"></li>

                    <li class="dropdown-submenu dropdown-hover">
                      <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">  BEBAN ADM Bank</a>
                      <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">

                        <li><a href="main.php?route=menu_lap_beban_adm&act&ide=<?php echo $_SESSION['employee_number']; ?>&tujuan="   class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Laporan BEBAN ADM Bank</a></li>

                        <li><a href="main.php?route=menu_rekap_beban_adm&act&ide=<?php echo $_SESSION['employee_number']; ?>&tujuan="   class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Rekap BEBAN ADM Bank</a></li>

                      </ul>
                    </li>
                  <?php } ?> -->


                  <!-- <?php if ($login_hash == 0 or $login_hash == 1 or $login_hash == 2) { ?>

                    <li class="dropdown-divider"></li>

                    <li class="dropdown-submenu dropdown-hover">
                      <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle"> BEBAN FEE</a>
                      <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow ">

                        <li><a href="main.php?route=lap_beban_fee&act&ide=<?php echo $_SESSION['employee_number']; ?>&tujuan="   class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Laporan BEBAN FEE Penjualan</a></li>

                        <li><a href="main.php?route=rekap_beban_fee&act&ide=<?php echo $_SESSION['employee_number']; ?>&tujuan="   class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Rekap BEBAN FEE Penjualan</a></li>

                      </ul>
                    </li>
                  <?php } ?> -->

                  <?php if ($login_hash == 0 or $login_hash == 1 or $login_hash == 2 or $login_hash == 6 or $login_hash == 7 or $login_hash == 8) { ?>

                    <li class="dropdown-divider"></li>

                    <li><a href="main.php?route=rekap_sales_report&act&ide=<?php echo $_SESSION['employee_number']; ?>&tujuan=menu" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Sales Report</a></li>


                  <?php } ?>

                  <!-- <?php if ($login_hash == 0 or $login_hash == 1 or $login_hash == 2) { ?>

                    <li class="dropdown-divider"></li>

                    <li class="dropdown-submenu dropdown-hover">
                      <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">  Payment POS</a>
                      <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow ">

                        <li><a href="main.php?route=payment_pos1&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=pos1" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Payment POS</a></li>
                        <li><a href="main.php?route=payment_pos2&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=pos2" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Payment POS Detail</a></li>
                        <li><a href="main.php?route=payment_pos2b&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=pos2" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Payment POS Detail B</a></li>

                      </ul>
                    </li>

                  <?php } ?> -->
                  <?php if ($login_hash == 0) { ?>
                    <!-- <li class="dropdown-submenu dropdown-hover">
                      <a href="main.php?route=lap_stok_opname&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=lap_stok_opname" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Laporan Stok Opname</a>
                    </li> -->
                  <?php } ?>



                  <?php if ($login_hash == 0 or $login_hash == 1 or $login_hash == 2 or $login_hash == 6 or $login_hash == 7 or $login_hash == 8) { ?>
                    <li class="dropdown-divider"></li>

                    <li class="dropdown-submenu dropdown-hover">
                      <a href="main.php?route=void_pos1&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=pos1" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> VOID POS</a>
                    </li>


                    <!-- <li class="dropdown-divider"></li>

                    <li class="dropdown-submenu dropdown-hover">
                      <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle"> VOID POS</a>
                      <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow ">

                      </ul>
                    </li> -->

                  <?php } ?>

                  <?php if ($login_hash == 0 or $login_hash == 2 or $login_hash == 6) { ?>
                    <li class="dropdown-divider"></li>

                    <li class="dropdown-submenu dropdown-hover">
                      <a href="main.php?route=import_sage&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=pos1" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> IMPORT SAGE PENJUALAN</a>
                    </li>
                    <li class="dropdown-submenu dropdown-hover">
                      <a href="main.php?route=import_sage_retur_jual&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=pos1" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> IMPORT SAGE RETUR PENJUALAN</a>
                    </li>
                    <!-- <li class="dropdown-submenu dropdown-hover">
                      <a href="main.php?route=import_sage2&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=pos1" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> IMPORT SAGE PENJUALAN V.2</a>
                    </li> -->
                    <li class="dropdown-submenu dropdown-hover">
                      <a href="main.php?route=import_sage_build&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=pos1" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> IMPORT SAGE BUILD</a>
                    </li>
                    <li class="dropdown-submenu dropdown-hover">
                      <a href="main.php?route=import_sage_pembelian&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=pos1" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> IMPORT SAGE PEMBELIAN</a>
                    </li>
                    <li class="dropdown-submenu dropdown-hover">
                      <a href="main.php?route=import_sage_retur_beli&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=pos1" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> IMPORT SAGE RETUR PEMBELIAN</a>
                    </li>
                  <?php } ?>

                  <!-- <?php if ($login_hash == 0 or $login_hash == 1 or $login_hash == 2) { ?>

                        <li class="dropdown-divider"></li>

                        <li><a href="main.php?route=omzet&act&ide=<?php echo $_SESSION['employee_number']; ?>&tujuan="   class="dropdown-item"><i class="fa-solid fa-caret-right"></i>  Laporan Omzet</a></li>
                      <?php } ?> -->


                  <li class="dropdown-divider"></li>

                  <?php
                  if ($login_hash == 6  or $login_hash == 2 or $login_hash == 7) {

                  ?>
                    <li><a href="main.php?route=test_penjualan&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=test1&tujuan=" class="dropdown-item">Test Penjualan</a></li>
                    <li><a href="main.php?route=test_penjualan_detil&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=test1&tujuan=" class="dropdown-item">Test Penjualan detil</a></li>
                  <?php
                  }
                  ?>
                  <?php
                  if ($login_hash == 0) {

                  ?>

                    <li><a href="main.php?route=test_penjualan&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=test1&tujuan=" class="dropdown-item">Test Penjualan</a></li>
                    <li><a href="main.php?route=test_penjualan_detil&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=test1&tujuan=" class="dropdown-item">Test Penjualan detil</a></li>
                    <!-- <li><a href="main.php?route=import_penjualan&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=import_penjualan" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> IMPORT PENJUALAN </a></li>
                    <li><a href="main.php?route=export_penjualan&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=export_penjualan" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> EXPORT PENJUALAN </a></li> -->


                    <li><a href="main.php?route=setup&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=setup" class="dropdown-item">SETUP</a></li>

                    <li><a href="main.php?route=void_pos2&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=pos2" class="dropdown-item"> VOID POS Detail</a></li>

                  <?php
                  }
                  ?>

                  </ul>
                </li>
                <?php if ($login_hash == 0 or $login_hash == 1 or $login_hash == 2 or $login_hash == 4 or $login_hash == 5 or $login_hash == 6 or $login_hash == 8 or $login_hash == 9 or $login_hash == 12 or $login_hash == 13 or $login_hash == 14) { ?>

                  <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link  warna_primary_2 dropdown-toggle">
                      <i class="fa-solid fa-clipboard"></i> LAPORAN NEW!</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
                      <?php if ($login_hash == 0 or $login_hash == 1 or $login_hash == 2 or $login_hash == 4 or $login_hash == 5 or $login_hash == 6 or $login_hash == 8 or $login_hash == 9 or $login_hash == 12 or $login_hash == 13 or $login_hash == 14) { ?>
                        <li class="dropdown-submenu dropdown-hover">
                          <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle" style="min-width: 220px;"> Vendors & Purchases</a>
                          <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow ">
                            <li>
                              <a tabindex="-1" href="main.php?route=vendor_aged&act&ide=<?php echo $_SESSION['employee_number']; ?>&tujuan=list_lap_baru" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Vendor Aged</a>
                            </li>
                            <li>
                              <a tabindex="-1" href="main.php?route=vendor_purchases&act&ide=<?php echo $_SESSION['employee_number']; ?>&tujuan=list_lap_baru" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Vendor Purchases</a>
                            </li>
                            <li class="dropdown-submenu dropdown-hover">
                              <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle" style="min-width: 220px;"> <i class="fa-solid fa-caret-right"></i> Pending Purchase Orders</a>
                              <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow ">
                                <li>
                                  <a tabindex="-1" href="main.php?route=vendor_pending_purchases_vendor&act&ide=<?php echo $_SESSION['employee_number']; ?>&tujuan=list_lap_baru" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> By Vendor</a>
                                </li>
                                <li>
                                  <a tabindex="-1" href="main.php?route=vendor_pending_purchases_items&act&ide=<?php echo $_SESSION['employee_number']; ?>&tujuan=list_lap_baru" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> By Inventory Item</a>
                                </li>
                              </ul>
                            </li>
                          </ul>
                        </li>
                      <?php } ?>
                      <?php if ($login_hash == 0 or $login_hash == 1 or $login_hash == 2 or $login_hash == 4 or $login_hash == 5 or $login_hash == 6 or $login_hash == 8 or $login_hash == 9 or $login_hash == 12 or $login_hash == 13 or $login_hash == 14) { ?>
                        <li class="dropdown-divider"></li>
                        <li class="dropdown-submenu dropdown-hover">
                          <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle"> Customers & Sales</a>
                          <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow ">
                            <li>
                              <a tabindex="-1" href="main.php?route=customer_aged&act&ide=<?php echo $_SESSION['employee_number']; ?>&tujuan=list_lap_baru" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Customer Aged</a>
                            </li>
                            <li>
                              <a tabindex="-1" href="main.php?route=customer_sales&act&ide=<?php echo $_SESSION['employee_number']; ?>&tujuan=list_lap_baru" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Customer Sales</a>
                            </li>
                            <li>
                              <a tabindex="-1" href="main.php?route=customer_category_sales&act&ide=<?php echo $_SESSION['employee_number']; ?>&tujuan=list_lap_baru" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Sales by Job Categories</a>
                            </li>
                          </ul>
                        </li>
                      <?php } ?>
                      <?php if ($login_hash == 0 or $login_hash == 1 or $login_hash == 2 or $login_hash == 4 or $login_hash == 5 or $login_hash == 6 or $login_hash == 8 or $login_hash == 9 or $login_hash == 12 or $login_hash == 13 or $login_hash == 14) { ?>
                        <li class="dropdown-divider"></li>
                        <li class="dropdown-submenu dropdown-hover">
                          <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle"> Inventory & Services</a>
                          <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow ">
                            <li>
                              <a tabindex="-1" href="main.php?route=inventory_summary&act&ide=<?php echo $_SESSION['employee_number']; ?>&tujuan=list_lap_baru" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Summary</a>
                            </li>
                            <li>
                              <a tabindex="-1" href="main.php?route=inventory_sales&act&ide=<?php echo $_SESSION['employee_number']; ?>&tujuan=list_lap_baru" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Sales</a>
                            </li>
                            <li>
                              <a tabindex="-1" href="main.php?route=inventory_transaksi&act&ide=<?php echo $_SESSION['employee_number']; ?>&tujuan=list_lap_baru" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> Transaction</a>
                            </li>
                          </ul>
                        </li>
                      <?php } ?>


                    </ul>
                  </li>
                <?php } ?>



                <!-- <li class="nav-item dropdown">
                  <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle  warna_primary_2">
                    <i class="fa-solid fa-database"></i> INVENTORY </a>
                  <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow dropdown-scroll">
                    <li><a href="main.php?route=transfer_inventory&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=transfer_inventory" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> TRANSFER INVENTORY</a></li>
                    <li><a href="main.php?route=stok_opname&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=stok_opname" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> STOK OPNAME</a></li>
                    <li><a href="main.php?route=bom&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=bom" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> BOM</a></li>
                    <li><a href="main.php?route=assembly&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=assembly" class="dropdown-item"><i class="fa-solid fa-caret-right"></i> ASSEMBLY</a></li>

                    <li>
                      <hr class="dropdown-divider">
                    </li>
                  </ul>
                </li> -->
                <?php if (($login_hash == 6 or $login_hash == 7 or $login_hash == 8 or $login_hash == 0 or $login_hash == 21 or $login_hash == 2 or $login_hash == 22) and ($to == 'manager' or $to == 'manajer_regional')) { ?>
                  <!-- <li class="nav-item"> -->
                  <a href="../../logout.php" class="nav-link warna_primary_2">
                    <img src="../../assets/icons/person-leave-solid-w.png" width="20px"> LOG OUT
                  </a>
                  <!-- </li> -->
                <?php } ?>

                <?php if (($login_hash == 6 or $login_hash == 7) and $to == 'kasir') { ?>

                  <li class="nav-item">
                    <a href="../../kasir/pages/main.php?route=kasir&to=kasir" class="nav-link warna_primary_2" onclick="window.close()">
                      <img src="../../assets/icons/rotate-left-solid-w.png" width="25px"> Back
                    </a>
                  </li>
                <?php } ?>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
              <?php if ($login_hash == 21) { ?>
                <li class="nav-item" style="margin-left: 1em; margin-top: .2em;">
                  <a href="route/dashboard_gudang/dashboard_gudang.php" class="nav-link warna_primary_2" style="font-size: 19px;">
                    <i class="fa-solid fa-desktop" style="margin-right:.3em;"></i>Order
                  </a>
                </li>
              <?php } else if ($login_hash != 21 and $login_hash != 22 and $login_hash != 7) {
              ?>
                <li class="nav-item" style="margin-left: 1em; margin-top: .2em;">
                  <a href="route/dashboard/dashboard.php" class="nav-link warna_primary_2" style="font-size: 19px;">
                    <i class="fa-solid fa-desktop" style="margin-right:.3em;"></i>Dashboard
                  </a>
                </li>
              <?php } ?>
              <li class="nav-item" style="margin-left: 1em; margin-top: .9em;">
                <a href="main.php?route=profile&act"><img src="../../images/staff/<?php echo $filefoto; ?>" alt="photo Profile" class="brand-image elevation-2" style="opacity: .8"></a>
              </li>
              <a style="font-weight:100; color:white">
                <?php echo $namauser . '<br>' . $jabatan . ' - ' . $pelanggan_nama; ?>
              </a>
            </ul>
          </div>


        </div>


      </nav>
      <!-- /.navbar -->



      <!-- Control Sidebar -->

      <!-- /.control-sidebar -->

      <!-- Content Wrapper. Contains page content -->
      <div class="list-gds">
        <?php include "content.php"; ?>
      </div>
      <!-- /.content-wrapper -->

      <!-- Main Footer -->
      <footer class="main-footer bg_primary_1" style="padding:.3rem;font-size:.75rem">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
          <b>Version</b> <?php echo $ver; ?>
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; <?php echo $thn_sekarang . " " . $perusahaan; ?>.</strong> by Develop. All rights Reserved.
      </footer>
    </div>

    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 -->
    <script src="../../plugins/select2/js/select2.full.min.js"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="../../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
    <!-- InputMask -->
    <script src="../../plugins/moment/moment.min.js"></script>
    <script src="../../plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
    <!-- date-range-picker -->
    <script src="../../plugins/daterangepicker/daterangepicker.js"></script>
    <!-- DataTables -->
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <!-- bootstrap color picker -->
    <script src="../../plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Bootstrap Switch -->
    <script src="../../plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <!-- ChartJS -->
    <script src="../../plugins/chart.js/Chart.min.js"></script>
    <!-- tambahan utk datepicer -->
    <script src="../../dist/bootstrap-datepicker-1.9.0-dist/js/bootstrap-datepicker.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>


  </body>

  </html>


  <!-- Page script -->
  <script>
    var _delay = 3000;

    function checkLoginStatus() {
      $.get("checkStatus.php", function(data) {
        if (!data) {
          window.location = "../../logout.php";
        }
        setTimeout(function() {
          checkLoginStatus();
        }, _delay);
      });
    }
    checkLoginStatus();
    var tablebaranguntuksearch = $("#examplebarang").DataTable({
      "responsive": false,
      "autoWidth": false,
      'searching': false,
    });


    $('#sandbox-container .input-group.date').datepicker({
      format: "dd-mm-yyyy",
      autoclose: true,
      todayHighlight: true
    });
  </script>

  <script>
    $('.datepicker').datepicker({
      format: "dd-mm-yyyy",
      autoclose: true,
      todayHighlight: true
    });
  </script>
  <script>
    $('#table-datatable-outlet').DataTable({
      'paging': true,
      'lengthChange': false,
      'searching': true,
      'ordering': false,
      'info': true,
      'autoWidth': true,
      "pageLength": 50
    });

    $('#table-datatable-kota').DataTable({
      'paging': true,
      'lengthChange': false,
      'searching': true,
      'ordering': false,
      'info': true,
      'autoWidth': true,
      "pageLength": 50
    });

    $('#table-datatable-barang').DataTable({
      'paging': true,
      'lengthChange': false,
      'searching': true,
      'ordering': false,
      'info': true,
      'autoWidth': true,
      "pageLength": 50
    });
  </script>

  <script>
    $(function() {
      $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
        "ordering": false,
      });
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
  <script>
    $(function() {
      //Initialize Select2 Elements
      $('.select2').select2()

      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })

      //Datemask dd/mm/yyyy
      $('#datemask').inputmask('dd/mm/yyyy', {
        'placeholder': 'dd/mm/yyyy'
      })
      //Datemask2 mm/dd/yyyy
      $('#datemask2').inputmask('mm/dd/yyyy', {
        'placeholder': 'mm/dd/yyyy'
      })
      //Money Euro
      $('[data-mask]').inputmask()

      //Date range picker 1
      $('#reservationdate').datetimepicker({
        format: 'DD/MM/YYYY'
      });

      //Date range picker 2
      $('#reservationdate2').datetimepicker({
        format: 'DD/MM/YYYY'
      });
      //Date range picker
      $('#reservation').daterangepicker()
      //Date range picker with time picker
      $('#reservationtime').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        locale: {
          format: 'MM/DD/YYYY'
        }
      })


      //Date range as a button
      $('#daterange-btn').daterangepicker({
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function(start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
        }
      )

      //Timepicker
      $('#timepicker').datetimepicker({
        format: 'LT'
      })

      //Bootstrap Duallistbox
      $('.duallistbox').bootstrapDualListbox()

      //Colorpicker
      $('.my-colorpicker1').colorpicker()
      //color picker with addon
      $('.my-colorpicker2').colorpicker()

      $('.my-colorpicker2').on('colorpickerChange', function(event) {
        $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
      });

      $("input[data-bootstrap-switch]").each(function() {
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
      });

    })
  </script>

  <script>
    $(function() {
      $("#datepicker").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd',
        yearRange: '-45:+10'
      });
    });
  </script>

  <script>
    $(function() {
      $("#datepicker2").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd',
        yearRange: '-45:+10'
      });
    });
  </script>

  <script>
    $(function() {
      $("#datepicker3").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd',
        yearRange: '-45:+10'
      });
    });
  </script>

  <script>
    function goBack() {
      window.history.back();
    }
  </script>


<?php
}
?>