<?php
$dir = '../../';
include $dir . "config/koneksi.php";
include $dir . "config/library.php";
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title><?php echo $perusahaan . " " . $naper1 . " " . $naper2; ?> | Log in</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

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
  <!-- Style tambahan -->
  <link rel="stylesheet" href="<?php echo $dir; ?>dist/style.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!--animate-->
  <link href="<?php echo $dir; ?>dist/css/animate.css" rel="stylesheet" type="text/css" media="all">
  <script src="<?php echo $dir; ?>dist/js/wow.min.js"></script>
  <script>
    new WOW().init();
  </script>
  <!--//end-animate-->
  <style type="text/css">
    .kotak {
      position: relative;
      /*border-radius: 13px;*/
      background: #ffffff;
      /*border-top: 1px solid #d2d6de;*/
      margin-bottom: 20px;
      width: 100%;
      box-shadow: 0 5px 5px rgba(0, 0, 0, 0.1);
    }

    .belakang {
      background-image: url('<?php echo $dir; ?>dist/img/4873152.jpg') !important;

    }

    .belakang2 {
      background-image: url('<?php echo $dir; ?>dist/img/button-pic1.jpg') !important;

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
    }
  </style>
  <!--//end-animate-->
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
      <![endif]-->
</head>

<body class="login-page">

  <div id="bg-slideshow">
    <img src="<?php echo $dir; ?>images/4873152.jpg" alt="background" />
    <!-- Gambar yang lain akan dimasukkan kesini dengan bantuan dari jquery -->
  </div>
  <div class="list-gds wow fadeIn" data-wow-duration="1.5s" data-wow-delay="0s">
    <div id="wrapper" class="belakang">
      <div class="login-box">
        <div class="login-logo">
          <img src="<?php echo $dir; ?>images/logo3.png" height="50px" style="vertical-align:text-bottom;" class="list-gds wow fadeIn" data-wow-duration="1.5s" data-wow-delay="0.6s">
          <!-- <a href="index.php"><b><?php echo $naper1 . "</b> " . $naper2; ?></a> -->
          <h5>&nbsp;</h5>
        </div><!-- /.login-logo -->


        <div class="login-box-body belakang2 kotak" style="border-radius: 20px;padding:5px">
          <br>
          <p class="login-box-msg" style="font-weight:600">Daftar | Register</p>

          <form action="register-log.php" method="post">
            <div class="form-group has-feedback">
              <input type="text" class="form-control" placeholder="Username" name="username" />
              <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
              <input type="password" class="form-control" placeholder="Password" name="password" required="" />
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
              <input type="text" class="form-control" placeholder="ID User" name="employee_number" required="" />
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <?php
            $query = mysqli_query($koneksi, "SELECT * FROM user_level WHERE login_hash=1 OR login_hash=2 OR login_hash=6 OR login_hash=7 OR login_hash=21 OR login_hash=22 order by login_hash");

            $q = mysqli_fetch_array($query);

            ?>

            <div class="form-group has-feedback">
              <select class="form-control" placeholder="Level User" name="login_hash" required="">
                <?php
                while ($q = mysqli_fetch_array($query)) {
                ?>
                  <option value="<?php echo $q['login_hash']; ?>"><?php echo $q['nama']; ?></option>
                <?php } ?>

              </select>
            </div>

            <div class="row">
              <!-- <div class="col-xs-4">
                      <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                    </div> -->
              <div class="col-xs-4">
                <div class="login-box-msg">
                  <button type="submit" class="btn btn-sm btn-primary btn-block tombol1">Register</button>
                </div>
                <div class="col-xs-4">
                  <div class="login-box-msg">
                    <button type="button" class="btn btn-sm btn-danger btn-block tombol1" onclick="history.back(-1)">BACK</button>
                  </div>
                </div><!-- /.col -->
              </div>

          </form>

        </div><!-- /.login-box-body -->
      </div><!-- /.login-box -->
    </div>
  </div>

  <!-- jQuery -->
  <script src="<?php echo $dir; ?>plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo $dir; ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Select2 -->
  <script src="<?php echo $dir; ?>plugins/select2/js/select2.full.min.js"></script>
  <!-- Bootstrap4 Duallistbox -->
  <script src="<?php echo $dir; ?>plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
  <!-- InputMask -->
  <script src="<?php echo $dir; ?>plugins/moment/moment.min.js"></script>
  <script src="<?php echo $dir; ?>plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
  <!-- date-range-picker -->
  <script src="<?php echo $dir; ?>plugins/daterangepicker/daterangepicker.js"></script>
  <!-- DataTables -->
  <script src="<?php echo $dir; ?>plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo $dir; ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo $dir; ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?php echo $dir; ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <!-- bootstrap color picker -->
  <script src="<?php echo $dir; ?>plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="<?php echo $dir; ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Bootstrap Switch -->
  <script src="<?php echo $dir; ?>plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo $dir; ?>dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../dist/js/demo.js"></script>
  <!-- Page script -->
  <script>
    $(function() {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
      });
    });
  </script>
</body>

</html>