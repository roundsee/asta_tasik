<?php

$judulform="Daftar Alat Bayar";

$data='lap_daftar_alat_bayar';
$rute='daftar_alat_bayar';
$aksi='aksi_daftar_alat_bayar';

$tabel="alat_bayar";
$f1='kd_alat';
$f2='nama';

$j1='Kode Alat Bayar';
$j2='Nama';


//session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
  <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

  switch($_GET['act']){
	//Tampil Data 
    default:
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper"style="background-color: ghostwhite;">
      <!-- Content Header (Page header) -->
      <section class="content-header  wow fadeInDown" data-wow-duration=".3s" data-wow-delay=".3s" >
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="list-gds">
                <b><?php echo $judulform ;?></b> <small style="font-weight: 100;">report</small>
              </h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="main.php?route=home">Beranda</a></li>
                <li class="breadcrumb-item active">Laporan</li>
                <li class="breadcrumb-item active"><?php echo $judulform ;?></li>
              </ol>
            </div>
          </div> 
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <!-- <section class="content wow fadeInUp" data-wow-duration=".2s" data-wow-delay=".1s" > -->
        <section class="content wow " >
          <div class="card card-default">            
            <!-- /.card-header -->
            <div class="card-body">
              <!-- Main row -->
              <div class="row">
                <!-- Left col -->
                <section class="col-lg-12 connectedSortable">
                  <!-- Custom tabs (Charts with tabs)-->
                  <div class="box">
                    <div class="box-body">

                      <!-- Wrapper 1 -->
                      <div class="wrapper" style="min-height:30%">
                        <form role="form" action="route/<?php echo $data;?>/<?php echo $aksi;?>.php?route=<?php echo $rute;?>&act=report_model2" method="post">
                          <div class="row">
                            <!-- Batas -------------- -->

                            <!-- Aplikasi -->
                            <div class="col-lg-3">

                              <div class="col-lg-7">
                                <div class="form-group">

                                  <div class="form-group">
                                    <label>Kode Alat Bayar</label>
                                    <select name="kd_alat" multiple class="form-control" style="width:250px;height: 100px;" >
                                      <!-- <option></option> -->
                                      <?php

                                      $produk=mysqli_query($koneksi,"SELECT * from alat_bayar where kd_alat!=100 order by kd_alat asc");
                                      while($pro=mysqli_fetch_array($produk))
                                      {
                                        echo"<option value='$pro[kd_alat]'>$pro[kd_alat] - $pro[nama]</option>";
                                      }
                                      ?>
                                    </select>
                                  </div>

                                </div>
                              </div>
                            </div>


                            <!-- Generate -->
                            <div class="col-lg-3">

                              <div class="row">
                                <div class="col-lg-12">
                                <input type="hidden" name="kota" id="tampil_kota_id">
                                <input type="hidden" name="outlet" id="tampil_outlet_id">
                                <input type="hidden" name="area" id="tampil_area_id">

                                <div class="form-group">
                                  <input type="submit" class="btn btn-primary elevation-2" style="opacity: .7" value="Generate Report" />
                                </div>

                              </div>
                            </div>
                          </div>
                          <!-- Generate -->

                        </div>
                      </form>
                    </div>
                    <!-- end Wrapper 1 -->

                    <hr/>

                    <!-- Wraper 3 -->
                    <div class="wrapper" style="min-height:10">
                      <div class="row">
                        <div class="col-lg-7">
                          <div class="form-group">
                            <a href="main.php?route=home" title="Batal"> <button class="btn btn-danger btn-sm elevation-2" style="opacity: .7;width:80px"><i class="fa fa-edit"></i> Batal</button></a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- end Wraper 3 -->

                  </div><!-- /.box-body -->
                </div><!-- /.box -->
              </section><!-- /.Left col -->
            </div><!-- /.row (main row) -->
          </div>
        </div>
      </section><!-- /.content -->
    </div><!-- /.content-wrapper -->


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
        var x0 = document.getElementById("isian0");
        var x1 = document.getElementById("isian1");
        var x2 = document.getElementById("isian2");
        var x3 = document.getElementById("isian3");

        x0.style.display = "none";
        x1.style.display = "none";
        x2.style.display = "none";
        x3.style.display = "none";

      });

    </script>

    <!-- Cakupan ========== -->
    <script>
      function displayResult(cakup){ 
        document.getElementById("result").value=cakup;
        var x=document.getElementById("result").value;  
        var x0 = document.getElementById("isian0");
        var x1 = document.getElementById("isian1");
        var x2 = document.getElementById("isian2");
        var x3 = document.getElementById("isian3");
        if (x=="Semua"){
          x0.style.display = "block";
          x1.style.display = "none";
          x2.style.display = "none";
          x3.style.display = "none";
            // alert(x + " adalah Filter 2");
        }else if(x=="Kota"){
          x0.style.display = "none";
          x1.style.display = "block";
          x2.style.display = "none";
          x3.style.display = "none";
            // alert(x + " adalah Filter 3");
        }
        else if(x=="Outlet"){
          x0.style.display = "none";
          x1.style.display = "none";
          x2.style.display = "block";
          x3.style.display = "none";
            // alert(x + " adalah Filter 4");
        }
        else if(x=="Area"){
          x0.style.display = "none";
          x1.style.display = "none";
          x2.style.display = "none";
          x3.style.display = "block";
            // alert(x + " adalah Filter 4");
        }
      }

    </script>
    <!-- Cakupan ========== -->

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

    <?php 
    break;


//Form Edit 
    case "edit":

    $kota=$_GET['kota'];
    $kd_aplikasi=$_GET['kd_aplikasi'];

    $edit=mysqli_query($koneksi,"SELECT * from $tabel where $f1='$_GET[id]'");
    $e=mysqli_fetch_array($edit);

    $sql=mysqli_query($koneksi,"SELECT * from $rujukan where $fr1='$e[$f2]'");
    $s1=mysqli_fetch_array($sql);

    $rujuk2=mysqli_query($koneksi,"SELECT * from $rujukan2 where $frr1='$e[$f6]'");
    $r2=mysqli_fetch_array($rujuk2);

    $rujuk3=mysqli_query($koneksi,"SELECT * from $rujukan3 where $frrr1='$e[$f3]'");
    $r3=mysqli_fetch_array($rujuk3);

    ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper"  style="background-color: ghostwhite;">
      <!-- Content Header (Page header) -->
      <section class="content-header  wow fadeInDown" data-wow-duration=".3s" data-wow-delay=".3s" >
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <!-- <div style="margin:10px;"></div> -->
              <h1 class="list-gds">
                <b><?php echo $judulform ;?></b> <small style="font-weight: 100;">edit</small>
              </h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="main.php?route=home">Beranda</a></li>
                <li class="breadcrumb-item active">Laporan</li>
                <li class="breadcrumb-item active"><?php echo $judulform ;?></li>
                <li class="breadcrumb-item active">edit</li>
              </ol>
            </div>
          </div> 
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content wow fadeInUp" data-wow-duration=".2s" data-wow-delay=".1s" >
        <div class="container-fluid">
          <div class="card card-default">            
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <!-- right column -->
                <div class="col-md-12">
                  <!-- general form elements disabled -->
                  <div class="box box-warning">
                    <div class="box-body">

                      <form method="POST" action="route/<?php echo $data;?>/<?php echo $aksi;?>.php?route=<?php echo $rute;?>&act=edit&id=<?php echo $_GET['id']; ?>&kota=<?php echo $kota;?> &kd_aplikasi=<?php echo $kd_aplikasi;?>" enctype="multipart/form-data" >

                        <section class="base">

                          <div class="form-group">
                            <legend>Aplikasi : <?php echo $r2['nama']; ?></legend>
                            <legend>Kota : <?php echo $r3['nama']; ?></legend>
                          </div>


                          <div class="form-group">
                            <label><?php echo $j2; ?></label>
                            <input type="text" name="<?php echo $f2; ?>" class="form-control" value="<?php echo $e[$f2]; ?>" readonly />
                          </div>

                          <div class="form-group">
                            <label><?php echo $jr2; ?></label>
                            <input type="text" name="<?php echo $fr2; ?>" class="form-control" value="<?php echo $s1[$fr2]; ?>" readonly />
                          </div>

                          
                          <div class="form-group">
                            <label><?php echo $j4; ?></label>
                            <input type="text" name="<?php echo $f4; ?>" class="form-control" value="<?php echo $e[$f4]; ?>" autofocus="" required="" />
                          </div>

                          <div class="form-group">
                           <button type="submit" class="btn btn-primary elevation-2" style="opacity:.7" >Simpan Perubahan</button>
                         </div>
                         <button  class="btn btn-primary elevation-1" style="opacity:.7" onClick="javascript:history.go(-1);">back</button>

                       </section>
                     </form>

                   </div><!-- /.box-body -->
                 </div><!-- /.box -->
               </div><!--/.col (right) -->
             </div>   <!-- /.row -->
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