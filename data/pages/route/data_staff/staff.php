<?php
$dir = "../../";
$judulform = "Daftar User";

$data = 'data_staff';
$rute = 'staff';
$aksi = 'aksi_staff';

$tabel = 'employee';
$f1 = 'employee_number';
$f2 = 'name_e';
$f3 = 'birth_place';
$f4 = 'birth_date';
$f5 = 'alamat_e';
$f6 = 'alamat2_e';
$f7 = 'city_e';
$f8 = 'state_e';
$f9 = 'zipcode_e';
$f10 = 'id_jabatan';
$f11 = 'telpon_e';
$f12 = 'hp_e';
$f13 = 'email_e';
$f14 = 'website_e';
$f15 = 'desc_e';
$f16 = 'image';
$f17 = 'cabang_e';

$j1 = 'Kode Staff';
$j2 = 'Nama';
$j3 = 'Tempat Lahir';
$j4 = 'Tgl Lahir';
$j5 = 'Alamat 1';
$j6 = 'Alamat 2';
$j7 = 'Kota';
$j8 = 'Negara';
$j9 = 'KodePos';
$j10 = 'Kode Jabatan ';
$j11 = 'Telp';
$j12 = 'Hp';
$j13 = 'email';
$j14 = 'Website';
$j15 = 'Deskription';
$j16 = 'Photo';
$j17 = 'Lokasi';

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
                  <li class="breadcrumb-item active">Data Organisasi</li>
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
                                <th>ID User</th>
                                <th>Nama User</th>
                                <th>Jabatan</th>
                                <th>Kode Outlet</th>
                                <th>Outlet</th>
                                <th>Status</th>
                                <th>Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php

                              $query = mysqli_query($koneksi, "SELECT * ,p.kd_cus as p_kd_cus , p.nama as p_nama,ue.aktif FROM employee e 
                            join jabatan j on j.id_jabatan=e.id_jabatan 
                            join pelanggan p on p.kd_cus=e.cabang_e
                            LEFT join user_login ue on e.employee_number = ue.employee_number
                            WHERE e.id_jabatan!=1
                            order by e.employee_number asc");

                              $no = 1;
                              while ($j = mysqli_fetch_array($query)) {

                              ?>
                                <tr align="left">
                                  <td><?php echo $no; ?></td>
                                  <td><?php echo $j['employee_number']; ?></td>
                                  <td><?php echo $j['name_e']; ?></td>
                                  <td><?php echo $j['nama_jabatan']; ?></td>
                                  <td><?php echo $j['p_kd_cus']; ?></td>
                                  <td><?php echo $j['p_nama']; ?></td>
                                  <td>
                                    <?php if ($j['enable_status'] != 0) { ?>
                                      <span class="badge bg-success">Active</span>
                                    <?php } else { ?>
                                      <span class="badge bg-secondary">Not Active</span>
                                    <?php } ?>
                                  </td>
                                  <td>
                                    <?php if ($login_hash == 2) { ?>
                                      <?php if ($j['enable_status'] != 0) { ?>
                                        <a href="route/data_staff/aksi_staff.php?route=staff&act=disable&ids=<?php echo $j['employee_number']; ?>"
                                          onclick="return confirm('Apakah anda yakin ingin menonaktifkan ini ?')">
                                          <button class="btn btn-danger btn-sm elevation-2" style="width:80px"> Disable
                                          </button>
                                        </a>

                                      <?php } else { ?>
                                        <a href="route/data_staff/aksi_staff.php?route=staff&act=enable&ids=<?php echo $j['employee_number']; ?>">
                                          <button class="btn btn-primary btn-sm elevation-2" style="width:80px"> Enable
                                          </button>
                                        </a>
                                      <?php } ?>
                                    <?php } ?>
                                    <a href="main.php?route=staff&act=edit&ids=<?php echo $j['employee_number']; ?>&asal=<?php echo $_GET['asal']; ?>" title="Edit Data"><button class="btn btn-primary btn-sm elevation-2" style="opacity: .7;width:80px"><i class="fa fa-edit"></i> Edit</button></a>

                                    <a href="route/data_staff/aksi_staff.php?route=staff&act=hapus&ids=<?php echo $j['employee_number']; ?>" title="Hapus Data" onclick="return confirm('Apakah anda yakin ingin menghapus ini ?')"><button class="btn btn-danger btn-sm elevation-2" style="opacity: .7;width:80px"><i class="fa fa-trash"></i> Hapus</button></a>

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
      $ubah = mysqli_query($koneksi, "SELECT * FROM employee e join jabatan j on j.id_jabatan=e.id_jabatan join pelanggan p on p.kd_cus=e.cabang_e 
      LEFT join kategori z on z.id_kat=e.kategori_kasir WHERE e.employee_number = '$_GET[ids]'");
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

                        <form method="POST" action="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=edit&id=<?php echo $u['employee_number']; ?>" enctype="multipart/form-data">
                          <!-- text input -->
                          <div class="form-group">
                            <label>ID User</label>
                            <input type="text" name="employee_number" class="form-control" value="<?php echo $u['employee_number']; ?>" readonly="readonly" />
                          </div>
                          <div class="form-group">
                            <label>Nama User</label>
                            <input type="text" name="name_e" class="form-control" value="<?php echo $u['name_e']; ?>" readonly="readonly" />
                          </div>

                          <div class="form-group">
                            <label><?php echo $j10; ?></label>
                            <select id="nama_jabatan" name="<?php echo $f10; ?>" class="form-control" style="width:400px;height: 40px;" readonly>
                              <option value="<?php echo $u['id_jabatan']; ?>"><?php echo $u['nama_jabatan']; ?></option>
                              <?php

                              $produk = mysqli_query($koneksi, "SELECT * from jabatan WHERE id_jabatan!=1 AND id_jabatan<=7 order by id_jabatan asc");
                              while ($pro = mysqli_fetch_array($produk)) {
                                echo "<option value='$pro[id_jabatan]'>$pro[nama_jabatan]</option>";
                              }
                              ?>
                            </select>
                          </div>

                          <div class="form-group">
                            <label><?php echo $j17; ?></label>
                            <select name="<?php echo $f17; ?>" class="form-control" style="width:400px;height: 40px;">
                              <option value="<?php echo $u['cabang_e']; ?>"><?php echo $u['cabang_e'] . ' - ' . $u['nama']; ?></option>
                              <?php

                              $produk = mysqli_query($koneksi, "SELECT * from pelanggan order by nama asc");
                              while ($pro = mysqli_fetch_array($produk)) {
                                echo "<option value='$pro[kd_cus]'>$pro[kd_cus] - $pro[nama]</option>";
                              }
                              ?>
                            </select>
                          </div>
                          <div id="divkategori_kasir_login" style="display: none;">
                            <div class="form-group">
                              <label>Kategori Kasir</label>
                              <select id="kategori_kasir_login" name="kategori_kasir_login" class="form-control" style="width:400px;height: 40px;" value="<?php echo $u['kategori_kasir']; ?>">
                                <option value="<?php echo $u['kategori_kasir']; ?>"><?php echo $u['nama_kat']; ?></option>
                                <option value="0">Semua</option>
                                <option value="1">Retail</option>
                                <option value="2">Grosir</option>
                                <option value="3">Online</option>
                              </select>
                            </div>
                          </div>


                          <!-- <div class="form-group"> -->
                          <!-- <label>Foto </label> <small>( nama file sesuai nama User )</small>
                                  <input type="file" name="file" class="form-control"  /> -->

                          <!-- </div> -->
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
        document.addEventListener("DOMContentLoaded", function() {
          const selectedValue = document.getElementById('nama_jabatan').value;
          if (selectedValue == 2) {
            document.getElementById('divkategori_kasir_login').style.display = 'block';
          }
        });
        document.getElementById("nama_jabatan").addEventListener("change", function() {
          document.getElementById("divkategori_kasir_login").style.display = this.value == 2 ? 'block' : 'none';
        });
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