<?php
$dir='../../';
include $dir."config/koneksi.php";
include $dir."config/library.php";

$judulform="STAFF";

$data='data_staff';
$rute='staff';
$aksi='aksi_staff';

$tabel='employee';
$f1='employee_number';
$f2='name_e';
$f3='birth_place';
$f4='birth_date';
$f5='alamat_e';
$f6='alamat2_e';
$f7='city_e';
$f8='state_e';
$f9='zipcode_e';
$f10='id_jabatan';
$f11='telpon_e';
$f12='hp_e';
$f13='email_e';
$f14='website_e';
$f15='desc_e';
$f16='photo';
$f17='cabang_e';

$j1='Kode Staff';
$j2='Nama';
$j3='Tempat Lahir';
$j4='Tgl Lahir';
$j5='Alamat 1';
$j6='Alamat 2';
$j7='Kota';
$j8='Negara';
$j9='KodePos';
$j10='Kode Jabatan ';
$j11='Telp';
$j12='Hp';
$j13='email';
$j14='Website';
$j15='Keterangan';
$j16='Photo';
$j17='Kode Cabang';

//session_start();
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
  <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../../index.php><b>LOGIN</b></a></center>";
}
else{

	if(!empty($_GET["act"]))$act = $_GET["act"]; else $act="";
	switch($act){

   default:

   $row_user_login = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * from user_login where username = '$_SESSION[namauser]'"));
   // $row_employee = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * from employee where employee_number = '$row_user_login[employee_number]'"));

   $row_employee = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * from employee where employee_number = '$row_user_login[employee_number]'"));


   // $edit=mysqli_query($koneksi,"SELECT * from $tabel where $f1='$_GET[id]'");
   // $e=mysqli_fetch_array($edit);
   ?>
   <link rel="shortcut icon" href="../../images/wsteak.ico">

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
   <!-- Style tambahan -->
   <link rel="stylesheet" href="../../dist/style.css">

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

   <!-- Content Wrapper. Contains page content -->
   <div class="content" style="min-height: 470px">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User <?php echo $naper1.' '.$naper2;?>
        <small>Profile</small>
      </h1>
      <!-- <ol class="breadcrumb">
        <li><a href="main.php?route=home"><i class="fa fa-home"></i> Beranda</a></li>
        <li class="active">Profile</li>
      </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid"  style="min-height: 380px">
        <div class="card card-default">            
          <!-- /.card-header -->
          <div class="card-body">
            <!-- Main row -->
            <div class="row">
              <!-- Left col -->
              <section class="col-lg-12 connectedSortable">
                <!-- right column -->
                <!-- <div class="col-md-12"> -->
                  <!-- general form elements disabled -->
                  <div class="box box-warning">
                    <div class="box-header">
                      <!-- <h3 class="box-title">*Isi data dengan lengkap & jelas</h3> -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                      <form role="form" action="route/data_profile/aksi_profile.php?route=profile&act=edit2" method="post" enctype="multipart/form-data" >
                        <!-- text input -->
                        <!-- <div class="container-fluid"> -->
                          <fieldset>
                            <legend><b>Data Password User</b></legend>
                            <div class="form-group">
                              <label>Username</label>
                              <input type="text" name="username" class="form-control" value="<?php echo $row_user_login['username']; ?>" readonly="readonly"/>
                            </div>
                            <div class="form-group">
                              <label>Password *)<i>kosongkan jika tidak ingin mengganti password lama</i></label>
                              <input type="password" name="password" class="form-control" placeholder="Masukan Password Baru ..." />
                            </div>


                            <!-- <div class="row">
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <div id="msg"></div>
                                  <input type="file" name="photo" class="file" >
                                  <div class="input-group my-3">
                                    <input type="text" class="form-control" disabled placeholder="Upload Gambar" id="file">
                                    <div class="input-group-append">
                                      <button type="button" id="pilih_gambar" class="browse btn btn-dark elevation-3" >Pilih Gambar</button>
                                    </div>
                                  </div>

                                  <img src="../../images/<?php echo $rute;?>/images.jpeg" id="preview" class="img-thumbnail elevation-3">
                                </div>
                              </div>
                            </div> -->


                            <div class="row">
                            <div class="col-sm-6">
                              <div class="form-group">
                                <div id="msg"></div>
                                <input type="file" name="photo" class="file" >
                                <div class="input-group my-3">
                                  <input type="text" class="form-control" disabled placeholder="Upload Gambar (max 100 kb)." id="file">
                                  <div class="input-group-append">
                                    <button type="button" id="pilih_gambar" class="browse btn btn-dark elevation-2">Pilih Gambar</button>
                                  </div>
                                </div>
                                <?php 
                                if ($row_employee['photo']=="")
                                  {$datagambar="images.jpeg";
                              }else{$datagambar=$row_employee['photo'];
                            }?>

                            <img src="../../images/<?php echo $rute;?>/<?php echo $datagambar; ?>" id="preview" class="img-thumbnail elevation-3" style="width: 120px;float: left;margin-bottom: 5px;">
                          </div>
                        </div>
                      </div>


                            <div class="form-group">
                              <hr />
                              <input type="hidden" name="ids" value="<?php echo $row_user_login['employee_number']; ?>" />
                              <input type="submit" class="btn btn-primary elevation-2" style="opacity:.7" value="Update" />
                            </div>
                          </fieldset>
                        </form>
                        <button class="btn btn-primary btn-sm elevation-1" style="opacity:.7" onclick="history.back(-1)">Back</button>

                      </div><!-- /.box-body -->
                    </div><!-- /.box -->
                  </section>
                </div>   <!-- /.row -->
              </div>
            </div>
          </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <style>
      .file {
        visibility: hidden;
        position: absolute;
      }
    </style>

      <script>

      function konfirmasi(){
        konfirmasi=confirm("Apakah anda yakin ingin menghapus gambar ini?")
        document.writeln(konfirmasi)
      }

      $(document).on("click", "#pilih_gambar", function() {
        var file = $(this).parents().find(".file");
        file.trigger("click");
      });

      $('input[type="file"]').change(function(e) {
        var fileName = e.target.files[0].name;
        $("#file").val(fileName);

        var reader = new FileReader();
        reader.onload = function(e) {
        // get loaded data and render thumbnail.
        document.getElementById("preview").src = e.target.result;
      };
    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
  });
</script>


      <!-- Page script -->
      <script type="text/javascript">
        $(function () {
        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
        //Money Euro
        $("[data-mask]").inputmask();

        //Date range picker
        $('#reservation').daterangepicker();
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
        //Date range as a button
        $('#daterange-btn').daterangepicker(
        {
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
            'Last 7 Days': [moment().subtract('days', 6), moment()],
            'Last 30 Days': [moment().subtract('days', 29), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
          },
          startDate: moment().subtract('days', 29),
          endDate: moment()
        },
        function (start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        );

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass: 'iradio_minimal-red'
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });

        //Colorpicker
        $(".my-colorpicker1").colorpicker();
        //color picker with addon
        $(".my-colorpicker2").colorpicker();

        //Timepicker
        $(".timepicker").timepicker({
          showInputs: false
        });
      });
    </script>
    
    <script>
      $(function() {	
       var dt='';
       $('#d1').datepicker();	


       $('#d2').datepicker({ 
        changeMonth:true,
        dateFormat: 'yy-mm-dd',
        changeYear:true,
      });

       $('#d3').datepicker({ 
        changeMonth:true,
        dateFormat: 'yy-mm-dd',
        changeYear:true,
        onClose: function (date) {
        	dt=date;
        	$( "#d4" ).datepicker("destroy");
        	showdate();

        }
      });

       $('#d5').datepicker({
        changeYear:true,
      });

       $( "#d6" ).datepicker();
       $( "#hFormat" ).change(function() {
        $( "#d6" ).datepicker( "option", "dateFormat", $( this ).val() );
      });



       function showdate()
       {
         $('#d4').datepicker({ 
          changeMonth:true,
          dateFormat: 'yy-mm-dd',
          changeYear:true,
          minDate: new Date(dt),
          hideIfNoPrevNext: true 
        });
       }

     });    
   </script>
   <?php
   break;
 }
}
?>