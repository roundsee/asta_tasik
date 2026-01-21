<?php

$judulform="Jual Detil";

$data='data_tarif_diskon';
$rute='jualdetil';
$aksi='aksi_jualdetil';

$tabel="jualdetil";
$f1='jadi';
$f2='faktur';
$f3='tanggal';
$f4='kd_cus';
$f5='kd_aplikasi';
$f6='kd_promo';
$f7='kd_brg';
$f8='banyak';
$f9='harga';
$f10='diskon';
$f11='jumlah';
$f12='faktur_refund';
$f12='penyajian';

$j1='Jadi';
$j2='Faktur';
$j3='Tanggal';
$j4='Kode Customer';
$j5='Kode Aplikasi';
$j6='Kode Promo';
$j7='Kode Barang';
$j8='Banyak';
$j9='Harga';
$j10='Diskon';
$j11='Jumlah';
$j12='Faktur Refund';
$j13='Penyajian';


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
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="list-gds wow slideInUp" data-wow-duration=".5s" data-wow-delay="1.1s">
              <?php echo $judulform ;?></h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="main.php?route=home">Beranda</a></li>
                <li class="breadcrumb-item active">Data Master</li>
                <li class="breadcrumb-item active"><?php echo $judulform ;?></li>
              </ol>
            </div>
          </div> 
        </div><!-- /.container-fluid -->
      </section>

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
                  <div class="box">
                    <div class="box-body">
                      <div class="table-responsive">
                        <button class="btn btn-primary btn-sm" onclick="window.location='main.php?route=<?php echo $rute;?>&act=tambah'"><i class="fa fa-plus"></i> Tambah Data</button>
                        <table id="example1" class="table table-bordered table-striped">
                          <thead style="background-color: pink;color: black;">
                            <tr>
                              <th>No.</th>
                              <th><?php echo $j1;?></th>
                              <th><?php echo $j2;?></th>
                              <th><?php echo $j3;?></th>
                              <th><?php echo $j4;?></th>
                              <th><?php echo $j5;?></th>
                              <th><?php echo $j6;?></th>
                              <th><?php echo $j7;?></th>
                              <th><?php echo $j8;?></th>
                              <th><?php echo $j9;?></th>
                              <th><?php echo $j10;?></th>
                              <th><?php echo $j11;?></th>
                              <th><?php echo $j12;?></th>
                              <th><?php echo $j13;?></th>
                              <th width="60px">Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                           <?php
					
                           $sql1=mysqli_query($koneksi,"SELECT * from $tabel order by $f1 desc");
                           $no=1;
                           $totluaslahan=0;
                           while($s1=mysqli_fetch_array($sql1))
                           {
                            
                            ?>
                            <tr align="left">
                              <td><?php echo $no; ?></td>
                              <td><?php echo $s1[$f1]; ?></td>
                              <td><?php echo $s1[$f2]; ?></td>
                              <td><?php echo $s1[$f3]; ?></td>
                              <td><?php echo $s1[$f4]; ?></td>
                              <td><?php echo $s1[$f5]; ?></td>
                              <td><?php echo $s1[$f6]; ?></td>
                              <td><?php echo $s1[$f7]; ?></td>
                              <td><?php echo $s1[$f8]; ?></td>
                              <td><?php echo $s1[$f9]; ?></td>
                              <td><?php echo $s1[$f10]; ?></td>
                              <td><?php echo $s1[$f11]; ?></td>
                              <td><?php echo $s1[$f12]; ?></td>
                              <td><?php echo $s1[$f13]; ?></td>
  
                              <td>
                                <a href="main.php?route=<?php echo $rute;?>&act=edit&id=<?php echo $s1[$f1]; ?>" title="Edit"><button class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button></a>

                                <a href="route/<?php echo $data;?>/<?php echo $aksi;?>.php?route=<?php echo $rute;?>&act=hapus&id=<?php echo $s1[$f1]; ?>" title="Hapus">
                                  <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></a>                                
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

//Form Tambah area
    case "tambah":
    ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="list-gds wow slideInUp" data-wow-duration=".5s" data-wow-delay="1.1s">
                <b><?php echo $judulform ;?> <small>tambah</small></b></h1>
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
        <section class="content">
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
                        <form role="form" action="route/<?php echo $data;?>/<?php echo $aksi;?>.php?route=<?php echo $rute;?>&act=input" method="post">

                         <div class="form-group">
                          <label><?php echo $j1;?></label>
                          <input type="text" name="<?php echo $f1;?>" class="form-control" placeholder="Masukan <?php echo $j1;?>" required="required"/>
                        </div>
                         <div class="form-group">
                          <label><?php echo $j2;?></label>
                          <input type="text" name="<?php echo $f2;?>" class="form-control" placeholder="Masukan <?php echo $j2;?> ..." required="required"/>
                        </div>
                         <div class="form-group">
                          <label><?php echo $j3;?></label>
                          <input type="text" name="<?php echo $f3;?>" class="form-control" placeholder="Masukan <?php echo $j3;?> ..." required="required"/>
                        </div>
                         <div class="form-group">
                          <label><?php echo $j4;?></label>
                          <input type="text" name="<?php echo $f4;?>" class="form-control" placeholder="Masukan <?php echo $j4;?> ..." required="required"/>
                        </div>
                         <div class="form-group">
                          <label><?php echo $j5;?></label>
                          <input type="text" name="<?php echo $f5;?>" class="form-control" placeholder="Masukan <?php echo $j5;?> ..." required="required"/>
                        </div>
                         <div class="form-group">
                          <label><?php echo $j6;?></label>
                          <input type="text" name="<?php echo $f6;?>" class="form-control" placeholder="Masukan <?php echo $j6;?> ..." required="required"/>
                        </div>
                         <div class="form-group">
                          <label><?php echo $j7;?></label>
                          <input type="text" name="<?php echo $f7;?>" class="form-control" placeholder="Masukan <?php echo $j7;?> ..." required="required"/>
                        </div>
                         <div class="form-group">
                          <label><?php echo $j8;?></label>
                          <input type="text" name="<?php echo $f8;?>" class="form-control" placeholder="Masukan <?php echo $j8;?> ..." required="required"/>
                        </div>
                         <div class="form-group">
                          <label><?php echo $j9;?></label>
                          <input type="text" name="<?php echo $f9;?>" class="form-control" placeholder="Masukan <?php echo $j9;?> ..." required="required"/>
                        </div>
                         <div class="form-group">
                          <label><?php echo $j10;?></label>
                          <input type="text" name="<?php echo $f10;?>" class="form-control" placeholder="Masukan <?php echo $j10;?> ..." required="required"/>
                        </div>
                         <div class="form-group">
                          <label><?php echo $j11;?></label>
                          <input type="text" name="<?php echo $f11;?>" class="form-control" placeholder="Masukan <?php echo $j11;?> ..." required="required"/>
                        </div>
                         <div class="form-group">
                          <label><?php echo $j12;?></label>
                          <input type="text" name="<?php echo $f12;?>" class="form-control" placeholder="Masukan <?php echo $j12;?> ..." required="required"/>
                        </div>
                         <div class="form-group">
                          <label><?php echo $j13;?></label>
                          <input type="text" name="<?php echo $f13;?>" class="form-control" placeholder="Masukan <?php echo $j13;?> ..." required="required"/>
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

//Form Edit area
   case "edit":
   $edit=mysqli_query($koneksi,"SELECT * from $tabel where $f1='$_GET[id]'");
   $e=mysqli_fetch_array($edit);
   ?>
   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="list-gds wow slideInUp" data-wow-duration=".5s" data-wow-delay="1.1s">
              <b><?php echo $judulform ;?> <small>edit</small></b></h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="main.php?route=home">Beranda</a></li>
                <li class="breadcrumb-item active">Data Master</li>
                <li class="breadcrumb-item active"><?php echo $judulform ;?></li>
                <li class="breadcrumb-item active">edit</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
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
                      <form role="form" action="route/<?php echo $data;?>/<?php echo $aksi;?>.php?route=<?php echo $rute;?>&act=update" method="post">
                        <!-- text input -->
                        <div class="form-group">
                          <label><?php echo $j1;?></label>
                          <input type="text" name="id" class="form-control" value="<?php echo $e[$f1]; ?>" readonly="readonly"/>
                        </div>               

                        <div class="form-group">
                          <label><?php echo $j2;?></label>
                          <input type="text" name="<?php echo $f2;?>" class="form-control" value="<?php echo $e[$f2]; ?>" required="required"/>
                        </div>             

                        <div class="form-group">
                          <label><?php echo $j3;?></label>
                          <input type="text" name="<?php echo $f3;?>" class="form-control" value="<?php echo $e[$f3]; ?>" required="required"/>
                        </div>             

                        <div class="form-group">
                          <label><?php echo $j4;?></label>
                          <input type="text" name="<?php echo $f4;?>" class="form-control" value="<?php echo $e[$f4]; ?>" required="required"/>
                        </div>             
                        
                        <div class="form-group">
                          <label><?php echo $j5;?></label>
                          <input type="text" name="<?php echo $f5;?>" class="form-control" value="<?php echo $e[$f5]; ?>" required="required"/>
                        </div> 
                        <div class="form-group">
                          <label><?php echo $j6;?></label>
                          <input type="text" name="<?php echo $f6;?>" class="form-control" value="<?php echo $e[$f6]; ?>" required="required"/>
                        </div> 
                        <div class="form-group">
                          <label><?php echo $j7;?></label>
                          <input type="text" name="<?php echo $f7;?>" class="form-control" value="<?php echo $e[$f7]; ?>" required="required"/>
                        </div> 
                        <div class="form-group">
                          <label><?php echo $j8;?></label>
                          <input type="text" name="<?php echo $f8;?>" class="form-control" value="<?php echo $e[$f8]; ?>" required="required"/>
                        </div> 
                        <div class="form-group">
                          <label><?php echo $j9;?></label>
                          <input type="text" name="<?php echo $f9;?>" class="form-control" value="<?php echo $e[$f9]; ?>" required="required"/>
                        </div> 
                        <div class="form-group">
                          <label><?php echo $j10;?></label>
                          <input type="text" name="<?php echo $f10;?>" class="form-control" value="<?php echo $e[$f10]; ?>" required="required"/>
                        </div> 
                        <div class="form-group">
                          <label><?php echo $j11;?></label>
                          <input type="text" name="<?php echo $f11;?>" class="form-control" value="<?php echo $e[$f11]; ?>" required="required"/>
                        </div> 
                        <div class="form-group">
                          <label><?php echo $j12;?></label>
                          <input type="text" name="<?php echo $f12;?>" class="form-control" value="<?php echo $e[$f12]; ?>" required="required"/>
                        </div>  
                        <div class="form-group">
                          <label><?php echo $j13;?></label>
                          <input type="text" name="<?php echo $f13;?>" class="form-control" value="<?php echo $e[$f13]; ?>" required="required"/>
                        </div> 

                        <div class="form-group">
                          <hr />
                          <input type="submit" class="btn btn-primary" value="Update" />
                        </div>
                      </form>
                    </div><!-- /.box-body -->
                  </div><!-- /.box -->
                </div><!--/.col (right) -->
              </div>   <!-- /.row -->
            </section><!-- /.content -->
          </div><!-- /.content-wrapper -->


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