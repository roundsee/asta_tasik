<?php

$judulform="SETUP";

$data='data_setup';
$rute='setup';
$aksi='aksi_setup';

$tabel="setup";

$f1='nama';	
$f2='perusahaan';	
$f3='alamat';	
$f4='telp';	
$f5='email';	
$f6='web';	
$f7='naper_mini';	
$f8='naper1';	
$f9='naper2';	
$f10='ver';	
$f11='warna_primary_1';	
$f12='warna_primary_2';	
$f13='warna_primary_3';	
$f14='pesan1';	
$f15='pesan2';
$f16='photo';	

$j1='Nama User';	
$j2='Perusahaan';	
$j3='Alamat';	
$j4='No Telp';	
$j5='eMail';	
$j6='Web';	
$j7='naper_mini';	
$j8='naper1';	
$j9='naper2';	
$j10='ver';	
$j11='warna_primary_1';	
$j12='warna_primary_2';	
$j13='warna_primary_3';	
$j14='Pesan Struk';	
$j15='Pesan2';
$j16='photo';	

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
      <!-- <div style="padding:2px"></div> -->
      <!-- Content Header (Page header) -->
      <section class="content-header  wow fadeInDown" data-wow-duration=".3s" data-wow-delay=".3s" >
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="list-gds">
                <b><?php echo $judulform ;?></b> <small>list</small></h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="main.php?route=home">Beranda</a></li>
                  <li class="breadcrumb-item active">Data Organisasi</li>
                  <li class="breadcrumb-item active"><?php echo $judulform ;?></li>
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
                <!-- Main row -->
                <div class="row">
                  <!-- Left col -->
                  <section class="col-lg-12 connectedSortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="box">
                      <div class="box-body">
                        <div class="table-responsive">

                          
                          <div style="margin:10px"></div>

                          <table id="example1" class="table table-bordered table-striped">
                            <thead style="background-color:  lightgray;" class="elevation-2">
                              <tr>
                                <th>No.</th>
                                <th><?php echo $j1; ?></th>
                                <th><?php echo $j2; ?></th>
                                <th><?php echo $j3; ?></th>
                                <th><?php echo $j4; ?></th>
                                <th><?php echo $j5; ?></th>
                                <th><?php echo $j6; ?></th>
                                <th><?php echo $j14; ?></th>
                                <th width="150px">Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                             <?php

                             // $sql1=mysqli_query($koneksi,"SELECT * from $tabel  order by $f1 desc");

                             $query="SELECT *
                             from $tabel ";

                             $sql1=mysqli_query($koneksi,$query);
                             $no=1;

                             while($s1=mysqli_fetch_array($sql1))
                             {
                              if ($s1[$f16]=="")
                              {
                                $datagambar="images.jpeg";
                              }else{
                                $datagambar=$s1[$f3];
                              }

                              ?>
                              <tr align="left">
                                <td><?php echo $no; ?></td>
                                <td><?php echo $s1[$f1]; ?></td>
                                <td><?php echo $s1[$f2]; ?></td>
                                <td><?php echo $s1[$f3]; ?></td>
                                <td><?php echo $s1[$f4]; ?></td>
                                <td><?php echo $s1[$f5]; ?></td>
                                <td><?php echo $s1[$f6]; ?></td>
                                <td><?php echo $s1[$f14]; ?></td>

                                <td>
                                  <a href="main.php?route=<?php echo $rute;?>&act=edit&id=<?php echo $s1[$f1]; ?>" title="Edit"> <button class="btn btn-primary btn-sm elevation-2" style="opacity: .7;width:80px"><i class="fa fa-edit"></i> Edit</button></a>

                                  
                                  </td>
                                </tr>
                                <?php
                                $no++;
                              }
                              ?>
                            </tbody>

                          </table>
                        </div>
                      </div><!-- /.box-body -->
                    </div><!-- /.box -->
                  </section><!-- /.Left col -->
                </div><!-- /.row (main row) -->
              </div>
            </div>
          </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <?php
      break;

//Form Tambah 
      case "tambah":

      ?>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper"style="background-color: ghostwhite;">
        <!-- Content Header (Page header) -->
        <section class="content-header  wow fadeInDown" data-wow-duration=".3s" data-wow-delay=".3s" >
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="list-gds">
                  <?php echo $judulform ;?></h1>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="main.php?route=home">Beranda</a></li>
                    <li class="breadcrumb-item active">Data Master</li>
                    <li class="breadcrumb-item active"><?php echo $judulform ;?></li>
                    <li class="breadcrumb-item active">tambah</li>
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
                          <form method="POST" action="route/$data/$aksi.php?route=<?php echo $rute;?>&act=input" enctype="multipart/form-data" >

                            <!-- <form method="post" enctype="multipart/form-data" action="<?php echo $aksi;?>.php?route=<?php echo $rute;?>&act=input"> -->

                              <div class="form-group">
                                <label><?php echo $j1;?></label>
                                <input type="text" onkeyup="isi_otomatis()" name="<?php echo $f1;?>" id="<?php echo $f1;?>" required="required" class="form-control" style="width: 100px;"/>
                                <input type="text" id="<?php echo $f2;?>"  class="form-control" style="width: 300px;" disabled />
                                <input type="text" id="nama"  class="form-control" style="width: 300px;"  />

                              </div>

                              <div class="form-group">
                                <label><?php echo $j2;?></label>
                                <input type="text" name="<?php echo $f2;?>" class="form-control" placeholder="Masukan <?php echo $j2;?> ..." required="required"/>
                              </div>

                              <div class="form-group">
                                <label><?php echo $j4;?></label>
                                <select name="<?php echo $f4;?>" class="form-control" style="width:200px;height: 40px;">
                                  <option value="Non Tunai">Non Tunai</option>
                                  <option value="Tunai">Tunai</option>
                                </select>
                              </div>

                              <div class="form-group">
                                <label><?php echo $j5;?></label>
                                <select name="<?php echo $f5;?>" class="form-control" style="width:200px;height: 40px;">
                                  <option></option>
                                  <?php

                                  $produk=mysqli_query($koneksi,"SELECT * from jenis_transaksi order by kd_jenis asc");
                                  while($pro=mysqli_fetch_array($produk))
                                  {
                                   echo"<option value='$pro[kd_jenis]'>$pro[kd_jenis] - $pro[nama]</option>";
                                 }
                                 ?>
                               </select>
                             </div>

                             <div class="row">
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <div id="msg"></div>
                                  <input type="file" name="photo" class="file" >
                                  <div class="input-group my-3">
                                    <input type="text" class="form-control" disabled placeholder="Upload Gambar" id="file">
                                    <div class="input-group-append">
                                      <button type="button" id="pilih_gambar" class="browse btn btn-dark">Pilih Gambar</button>
                                    </div>
                                  </div>

                                  <img src="route/<?php echo $data;?>/gambar/images.jpeg" id="preview" class="img-thumbnail elevation-3">
                                </div>
                              </div>
                            </div>

                            <div class="form-group">
                              <hr />
                              <input type="submit" class="btn btn-primary" value="Simpan" />
                            </div>

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
                function isi_otomatis(){
                  var <?php echo $f1;?> = $("#<?php echo $f1;?>").val();
                  $.ajax({
                    url: 'ajax.php',
                    data:"<?php echo $f1;?>="+<?php echo $f1;?> ,
                  }).success(function (data) {
                    var json = data,
                    obj = JSON.parse(json);
                    $('#<?php echo $f2;?>').val(obj.<?php echo $f2;?>);

                  });
                }
              </script>

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

//Form Edit 
   case "edit":
   $edit=mysqli_query($koneksi,"SELECT * from $tabel where $f1='$_GET[id]'");
   $e=mysqli_fetch_array($edit);

   ?>
   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper" style="background-color: ghostwhite;">
    <!-- Content Header (Page header) -->
    <section class="content-header  wow fadeInDown" data-wow-duration=".3s" data-wow-delay=".3s" >
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="list-gds">
              <b><?php echo $judulform ;?></b> <small>edit</small></h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="main.php?route=home">Beranda</a></li>
                <li class="breadcrumb-item active">Data Organisasi</li>
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

                      <form method="POST" action="route/<?php echo $data;?>/<?php echo $aksi;?>.php?route=<?php echo $rute;?>&act=edit&id=<?php echo $_GET['id']; ?>" enctype="multipart/form-data" >

                          <section class="base">

                            <div class="form-group">
                              <label><?php echo $j1; ?></label>
                              <input type="text" name="<?php echo $f1; ?>" class="form-control"  value="<?php echo $e[$f1]; ?>"  readonly />
                            </div>

                            <div class="form-group">
                              <label><?php echo $j2; ?></label>
                              <input type="text" name="<?php echo $f2; ?>" class="form-control" value="<?php echo $e[$f2]; ?>" autofocus=""  />
                            </div>

                            <div class="form-group">
                              <label><?php echo $j3; ?></label>
                              <input type="text" name="<?php echo $f3; ?>" class="form-control" value="<?php echo $e[$f3]; ?>" autofocus=""  />
                            </div>

                            <div class="form-group">
                              <label><?php echo $j4; ?></label>
                              <input type="text" name="<?php echo $f4; ?>" class="form-control" value="<?php echo $e[$f4]; ?>" autofocus=""  />
                            </div>

                            <div class="form-group">
                              <label><?php echo $j5; ?></label>
                              <input type="text" name="<?php echo $f5; ?>" class="form-control" value="<?php echo $e[$f5]; ?>" autofocus="" />
                            </div>


                            <div class="form-group">
                              <label><?php echo $j6; ?></label>
                              <input type="text" name="<?php echo $f6; ?>" class="form-control" value="<?php echo $e[$f6]; ?>" autofocus="" />
                            </div>

                            <div class="form-group">
                              <label><?php echo $j14; ?></label>
                              <input type="text" name="<?php echo $f14; ?>" class="form-control" value="<?php echo $e[$f14]; ?>" autofocus="" />
                            </div>

                            

                      <hr/>

                      <div class="form-group">
                       <button type="submit" class="btn btn-primary elevation-2"  style="opacity: .7">Simpan Perubahan</button>
                     </div>

                   </section>
                 </form>
                 <a href="main.php?route=<?php echo $rute;?>&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=<?php echo $rute;?>"><button class="btn btn-primary btn-sm elevation-1" style="opacity: .7">Back</button></a> 

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