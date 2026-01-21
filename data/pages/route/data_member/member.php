<?php
$dir = "../../";
$judulform = "Daftar Member";

$data = 'data_member';
$rute = 'member';
$aksi = 'aksi_member';

$tabel = 'member';

$f1 = 'id';
$f2 = 'kd_member';
$f3 = 'nama';
$f4 = 'telp';
$f5 = 'alamat';
$f6 = 'kelurahan';
$f7 = 'kecamatan';
$f8 = 'kabupaten';
$f9 = 'provinsi';
$f10 = 'member_ket';


$j1 = 'ID';
$j2 = 'NO HP';
$j3 = 'Nama';
$j4 = 'NIK';
$j5 = 'Alamat';
$j6 = 'Kelurahan';
$j7 = 'Kecamatan';
$j8 = 'Kabupaten';
$j9 = 'Provinsi';
$j10 = 'Jenis Member';



//session_start();
if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
  <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else {
  switch ($_GET['act']) {
      //Tampil Data 
    default:
?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" style="background-color: ghostwhite;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <!-- <div style="margin:10px;"></div> -->
                <h1 class="list-gds">
                  <b><?php echo $judulform; ?></b> <small style="font-weight: 100;"></small>
                </h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="main.php?route=home">Beranda</a></li>
                  <li class="breadcrumb-item active">Data</li>
                  <li class="breadcrumb-item active"><?php echo $judulform; ?></li>
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
                          <button class="btn btn-primary btn-sm elevation-2 " style="opacity: .7;" onclick="window.location='route/<?php echo $data; ?>/autocomplete.php?asal=<?php echo $_GET['asal']; ?>'"><i class="fa fa-plus" ;></i> Tambah</button>
                          <div style="margin:10px"></div>

                          <table id="example1" class="table table-bordered table-striped">
                            <thead style="background-color:  lightgray;" class="elevation-2">
                              <tr>
                                <th>No.</th>
                                <th>No HP</th>
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>Alamat</th>
                                <th>Kelurahan</th>
                                <th>Kecamatan</th>
                                <th>Kabupaten</th>
                                <th>Provinsi</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php

                              $query = mysqli_query($koneksi, "SELECT * FROM member JOIN kategori ON member.member_ket = kategori.id_kat");

                              $no = 1;
                              while ($j = mysqli_fetch_array($query)) {

                              ?>
                                <tr align="left">
                                  <td><?php echo $no; ?></td>
                                  <td><?php echo $j[$f2]; ?></td>
                                  <td><?php echo $j[$f3]; ?></td>
                                  <td><?php echo $j[$f4]; ?></td>
                                  <td><?php echo $j[$f5]; ?></td>
                                  <td><?php echo $j[$f6]; ?></td>
                                  <td><?php echo $j[$f7]; ?></td>
                                  <td><?php echo $j[$f8]; ?></td>
                                  <td><?php echo $j[$f9]; ?></td>
                                  <td><?php echo $j['nama_kat']; ?></td>

                                  <td><a href="main.php?route=member&act=edit&ids=<?php echo $j[$f1]; ?>&asal=<?php echo $_GET['asal']; ?>" title="Edit Data"><button class="btn btn-primary btn-sm elevation-2" style="opacity: .7;width:80px"><i class="fa fa-edit"></i> Edit</button></a>

                                    <a href="route/data_member/aksi_member.php?route=member&act=hapus&id=<?php echo $j[$f1]; ?>" title="Hapus Data" onclick="return confirm('Apakah anda yakin ingin menghapus ini ?')"><button class="btn btn-danger btn-sm elevation-2" style="opacity: .7;width:80px"><i class="fa fa-trash"></i> Hapus</button></a>
                                  </td>
                                </tr>
                              <?php
                                $no++;
                              }
                              ?>
                            </tbody>
                          </table>
                        </div><!-- /.box-body -->
                      </div><!-- /.box -->
                    </div>
                  </section><!-- /.Left col -->
                </div>
              </div>
            </div>
          </div><!-- /.row (main row) -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

    <?php
      break;

      //Form Edit 
    case "edit":

      //edit
      $ubah = mysqli_query($koneksi, "SELECT * FROM member JOIN kategori ON member.member_ket = kategori.id_kat WHERE id = '$_GET[ids]'");
      $u = mysqli_fetch_array($ubah);
    ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="list-gds wow slideInUp" data-wow-duration=".5s" data-wow-delay="1.1s">
                  User <small>update</small>
                </h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                  <li class="breadcrumb-item active">Edit User</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">

              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <!-- right column -->
                  <div class="col-md-12">
                    <!-- general form elements disabled -->
                    <div class="box box-warning">
                      <div class="box-body">

                        <form method="POST" action="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=edit&ids=<?php echo $u[$f1]; ?>" enctype="multipart/form-data">
                          <!-- text input -->
                          <!-- <div class="form-group">
                            <label>ID User</label>
                            <input type="text" name="id" class="form-control" value="<?php echo $u['id']; ?>" readonly="readonly" />
                          </div> -->

                          <div class="form-group">
                            <label><?php echo $j2; ?></label>
                            <input type="hidden" name="id" class="form-control" value="<?php echo $u['id']; ?>" readonly="readonly" />
                            <input type="text" name="<?php echo $f2; ?>" class="form-control" value="<?php echo $u[$f2]; ?>" required="required" readonly="readonly" />
                          </div>

                          <div class="form-group">
                            <label><?php echo $j3; ?></label>
                            <input type="text" name="<?php echo $f3; ?>" class="form-control" value="<?php echo $u[$f3]; ?>" required="required" />
                          </div>

                          <div class="form-group">
                            <label><?php echo $j4; ?></label>
                            <input type="text" name="<?php echo $f4; ?>" class="form-control" value="<?php echo $u[$f4]; ?>" required="required" />
                          </div>


                          <div class="form-group">
                            <label><?php echo $j5; ?></label>
                            <input type="text" name="<?php echo $f5; ?>" class="form-control" value="<?php echo $u[$f5]; ?>" required="required" />
                          </div>


                          <div class="form-group">
                            <label><?php echo $j6; ?></label>
                            <input type="text" name="<?php echo $f6; ?>" class="form-control" value="<?php echo $u[$f6]; ?>" required="required" />
                          </div>


                          <div class="form-group">
                            <label><?php echo $j7; ?></label>
                            <input type="text" name="<?php echo $f7; ?>" class="form-control" value="<?php echo $u[$f7]; ?>" required="required" />
                          </div>


                          <div class="form-group">
                            <label><?php echo $j8; ?></label>
                            <input type="text" name="<?php echo $f8; ?>" class="form-control" value="<?php echo $u[$f8]; ?>" required="required" />
                          </div>


                          <div class="form-group">
                            <label><?php echo $j9; ?></label>
                            <input type="text" name="<?php echo $f9; ?>" class="form-control" value="<?php echo $u[$f9]; ?>" required="required" />
                          </div>

                          <div class="form-group">
                            <label><?php echo $j10; ?></label>
                            <select name="<?php echo $f10; ?>">
                              <option value="<?php echo $u[$f10]; ?>"><?php echo $u['nama_kat']; ?></option>
                              <option value="4">Member Silver</option>
                              <option value="5">Member Gold</option>
                              <option value="6">Member Platinum</option>
                            </select>
                          </div>

                          <div class="form-group">
                            <hr />
                            <input type="submit" class="btn btn-primary elevation-2" style="opacity: .7" value="Update" />
                          </div>
                        </form>
                        <a href="main.php?route=<?php echo $rute; ?>&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=<?php echo $rute; ?>"><button class="btn btn-primary btn-sm elevation-1" style="opacity: .7">Back</button></a>
                      </div><!-- /.box-body -->
                    </div><!-- /.box -->
                  </div><!--/.col (right) -->
                </div> <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->


      <!-- Page script -->
      <script type="text/javascript">
        $(function() {
          //Datemask dd/mm/yyyy
          $("#datemask").inputmask("dd/mm/yyyy", {
            "placeholder": "dd/mm/yyyy"
          });
          //Datemask2 mm/dd/yyyy
          $("#datemask2").inputmask("mm/dd/yyyy", {
            "placeholder": "mm/dd/yyyy"
          });
          //Money Euro
          $("[data-mask]").inputmask();

          //Date range picker
          $('#reservation').daterangepicker();
          //Date range picker with time picker
          $('#reservationtime').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            format: 'MM/DD/YYYY h:mm A'
          });
          //Date range as a button
          $('#daterange-btn').daterangepicker({
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
            function(start, end) {
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
          var dt = '';
          $('#d1').datepicker();


          $('#d2').datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            changeYear: true,
          });

          $('#d3').datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            changeYear: true,
            onClose: function(date) {
              dt = date;
              $("#d4").datepicker("destroy");
              showdate();

            }
          });

          $('#d5').datepicker({
            changeYear: true,
          });

          $("#d6").datepicker();
          $("#hFormat").change(function() {
            $("#d6").datepicker("option", "dateFormat", $(this).val());
          });



          function showdate() {
            $('#d4').datepicker({
              changeMonth: true,
              dateFormat: 'yy-mm-dd',
              changeYear: true,
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