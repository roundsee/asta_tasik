<?php

$judulform = "STOK OPNAME ";

$data = 'data_stok_opname';
$rute = 'stok_opname';
$aksi = 'aksi_stok_opname';
$view = 'stok_opname_view';

$rute_detail = 'stok_opname_detail';

$tabel = 'stok_opname';

// Variabel untuk nama kolom tabel stokopname
$f1 = 'tgl_stokopname';
$f2 = 'kd_cus';
$f3 = 'kd_brg';
$f4 = 'jml';
$f5 = 'jml_pcs';
$f6 = 'satuan';
$f7 = 'harga';
$f8 = 'qty_terakhir';
$f9 = 'input_oleh';
$f10 = 'diperintahkan_oleh';

// Variabel untuk label kolom
$j1 = 'Tanggal Stok Opname';
$j2 = 'Kode Lokasi';
$j3 = 'Kode Barang';
$j4 = 'Jumlah';
$j5 = 'Jumlah (Satuan Terkecil)';
$j6 = 'Satuan';
$j7 = 'Harga';
$j8 = 'Qty Terakhir';
$j9 = 'Input Oleh';
$j10 = 'Diperintahkan Oleh';


$pengaju = 'pengaju';

$p1 = 'brand';
$p2 = 'direktur';
$p3 = 'direktorat';
$p4 = 'manager';
$p5 = 'unitkerja';
$p6 = 'kode_pengaju';
$p7 = 'no_rek';
$p8 = 'employee_no';
$p9 = 'nama';
$p10 = 'nama_unit';

$rek_tujuan = 'rek_tujuan';
$r1 = 'no_rek';
$r2 = 'nama_bank';
$r3 = 'atas_nama';
$r4 = 'cat1';

$jr1 = 'No Rekening';
$jr2 = 'Nama Bank';
$jr3 = 'Atas Nama';
$jr4 = 'Cat 1';

$cabang_e = $_SESSION['cabang_e'];
$area_e = $_SESSION['area_e'];
$en = $_SESSION['employee_number'];


$query_kdcus = mysqli_query($koneksi, "SELECT kd_cus FROM user_login where employee_number = '$en'");
$q1 = mysqli_fetch_assoc($query_kdcus);
$kd_cus = $q1['kd_cus'];

// echo '<br><br><br>';

// echo '<br> '.$kd_cus;

// echo '<br><br><br><br>'.$kode_pengaju;
//   $kode_manajer = $q['manager'];

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

                          <button class="btn btn-primary btn-sm elevation-2 " style="opacity: .7;" onclick="window.location='route/<?php echo $data; ?>/stok_opname_tambah.php'"><i class="fa fa-plus" ;></i> Stok Opname</button>

                          <div style="margin:10px"></div>
                          <table id="example1" class="table table-bordered table-striped">
                            <thead style="background-color: lightgray;" class="elevation-2">
                              <tr>
                                <th>No.</th>
                                <th>Kode Opname</th>
                                <th><?php echo $j1; ?></th>
                                <th><?php echo $j2; ?></th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              $total_qty = 0;
                              $sql1 = mysqli_query($koneksi, "
                             SELECT 
                                 $tabel.kd_opname,$tabel.$f1, $tabel.$f2, $tabel.$f3, $tabel.$f4, $tabel.$f5, $tabel.$f6, $tabel.$f7, $tabel.$f8, $tabel.$f9, $tabel.$f10,
                                 employee1.name_e AS nama_input_oleh,
                                 employee2.name_e AS nama_diperintahkan_oleh,
                                 barang.nama AS nama_barang,
                                 pelanggan.nama AS nama_pelanggan
                             FROM $tabel
                             JOIN barang ON barang.kd_brg = $tabel.kd_brg
                             JOIN employee AS employee1 ON employee1.employee_number = $tabel.input_oleh
                             JOIN employee AS employee2 ON employee2.employee_number = $tabel.diperintahkan_oleh
                             JOIN pelanggan ON pelanggan.kd_cus = $tabel.kd_cus
                             GROUP BY kd_opname
                         ");

                              if (!$sql1) {
                                die("Error: " . mysqli_error($koneksi));
                              }

                              $no = 1;
                              while ($s1 = mysqli_fetch_array($sql1)) {

                                $total_qty = $s1[$f4] * $s1[$f5];
                                
                              ?>
                                <tr align="left">
                                  <td><?php echo $no; ?></td>
                                  <td>
                                      <a href="main.php?route=<?php echo $view; ?>&act&id=<?php echo $s1['kd_opname']; ?>&asal=<?php echo $rute; ?>" title="Detail">
                                        <?php echo $s1['kd_opname']; ?>
                                      </a>
                                    </td>
                                  <td><?php echo $s1[$f1]; ?></td>
                                  <td><?php echo $s1[$f2] . '-' . $s1['nama_pelanggan']; ?></td>
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



      <style>
        .modal-backdrop {
          z-index: 1040 !important;
        }

        .modal {
          z-index: 1050 !important;
        }

        .modal-dialog {
          max-width: 90%;
          margin: 1.75rem auto;
        }

        .modal-content {
          max-height: 90vh;
          overflow-y: auto;
        }
      </style>

      <script>
        // Fungsi untuk mengatur checkbox "Select All"
        function toggle(source) {
          checkboxes = document.getElementsByName('selected_items[]');
          for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = source.checked;
          }
        }

        // Fungsi untuk menghapus centangan pada saat halaman dimuat
        window.onload = function() {
          document.getElementById('select-all').checked = false;
          checkboxes = document.getElementsByName('selected_items[]');
          for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = false;
          }
        };
      </script>


      <style>
        .modal-dialog {
          max-width: 90%;
          margin: 1.75rem auto;
        }

        .modal-content {
          overflow-y: auto;
          max-height: 90vh;
        }

        .modal-body {
          max-height: calc(100vh - 200px);
          overflow-y: auto;
        }

        .largeCheckbox {
          width: 20px;
          height: 20px;
          text-align: center;
          vertical-align: middle;
        }

        .centerCheckbox {
          text-align: center;
          vertical-align: middle;
        }

        .modal {
          display: none;
          position: fixed;
          z-index: 1;
          left: 0;
          top: 0;
          width: 100%;
          height: 100%;
          overflow: auto;
          background-color: rgb(0, 0, 0);
          background-color: rgba(0, 0, 0, 0.4);
          padding-top: 60px;
        }

        .modal-content {
          background-color: #fefefe;
          margin: 5% auto;
          padding: 20px;
          border: 1px solid #888;
          width: 80%;
        }

        .close {
          color: #aaa;
          float: right;
          font-size: 28px;
          font-weight: bold;
        }

        .close:hover,
        .close:focus {
          color: black;
          text-decoration: none;
          cursor: pointer;
        }

        /* Styling tabel untuk cetakan */
        table {
          width: 100%;
          border-collapse: collapse;
        }

        table,
        th,
        td {
          border: 1px solid black;
        }

        th,
        td {
          padding: 8px;
          text-align: left;
        }
      </style>

    <?php
      break;

      //Form Tambah area
    case "tambah":

    ?>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="list-gds wow slideInUp" data-wow-duration=".5s" data-wow-delay="1.1s">
                  <b><?php echo $judulform; ?> <small style="font-weight: 100;">tambah</small></b>
                </h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="main.php?route=home">Beranda</a></li>
                  <li class="breadcrumb-item active">Data</li>
                  <li class="breadcrumb-item active"><?php echo $judulform; ?></li>
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
                        <form method="POST" action="route/data_alat_bayar/aksi_alat_bayar.php?route=alat_bayar&act=input" enctype="multipart/form-data">

                          <!-- <form method="post" enctype="multipart/form-data" action="<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=input"> -->

                          <div class="form-group">
                            <label><?php echo $j1; ?></label>
                            <input type="text" onkeyup="isi_otomatis()" name="<?php echo $f1; ?>" id="<?php echo $f1; ?>" required="required" class="form-control" style="width: 100px;" />
                            <input type="text" id="<?php echo $f2; ?>" class="form-control" style="width: 300px;" disabled />
                            <input type="text" id="nama" class="form-control" style="width: 300px;" />

                          </div>

                          <div class="form-group">
                            <label><?php echo $j2; ?></label>
                            <input type="text" name="<?php echo $f2; ?>" class="form-control" placeholder="Masukan <?php echo $j2; ?> ..." required="required" />
                          </div>

                          <div class="form-group">
                            <label><?php echo $j4; ?></label>
                            <select name="<?php echo $f4; ?>" class="form-control" style="width:200px;height: 40px;">
                              <option value="Non Tunai">Non Tunai</option>
                              <option value="Tunai">Tunaii</option>
                            </select>
                          </div>

                          <div class="form-group">
                            <label><?php echo $j5; ?></label>
                            <select name="<?php echo $f5; ?>" class="form-control" style="width:200px;height: 40px;">
                              <option></option>
                              <?php

                              $produk = mysqli_query($koneksi, "SELECT * from jenis_transaksi order by kd_jenis asc");
                              while ($pro = mysqli_fetch_array($produk)) {
                                echo "<option value='$pro[kd_jenis]'>$pro[kd_jenis] - $pro[nama]</option>";
                              }
                              ?>
                            </select>
                          </div>

                          <div class="row">
                            <div class="col-sm-6">
                              <div class="form-group">
                                <div id="msg"></div>
                                <input type="file" name="photo" class="file">
                                <div class="input-group my-3">
                                  <input type="text" class="form-control" disabled placeholder="Upload Gambar" id="file">
                                  <div class="input-group-append">
                                    <button type="button" id="pilih_gambar" class="browse btn btn-dark">Pilih Gambar</button>
                                  </div>
                                </div>

                                <img src="route/data_alat_bayar/gambar/images.jpeg" id="preview" class="img-thumbnail">
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
                </div> <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->


      <style>
        .file {
          visibility: hidden;
          position: absolute;
        }
      </style>
      <script>
        function isi_otomatis() {
          var <?php echo $f1; ?> = $("#<?php echo $f1; ?>").val();
          $.ajax({
            url: 'route/data_alat_bayar/ajax.php',
            data: "<?php echo $f1; ?>=" + <?php echo $f1; ?>,
          }).success(function(data) {
            var json = data,
              obj = JSON.parse(json);
            $('#<?php echo $f2; ?>').val(obj.<?php echo $f2; ?>);

          });
        }
      </script>

      <script>
        function konfirmasi() {
          konfirmasi = confirm("Apakah anda yakin ingin menghapus gambar ini?")
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

      //Form Edit
    case "edit":
      $edit = mysqli_query($koneksi, "SELECT * from $tabel where $f1='$_GET[id]'");
      $e = mysqli_fetch_array($edit);

    ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" style="background-color: ghostwhite;">
        <!-- Content Header (Page header) -->
        <section class="content-header  wow fadeInDown" data-wow-duration=".3s" data-wow-delay=".3s">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="list-gds">
                  <b><?php echo $judulform; ?></b> <small style="font-weight: 100;">edit</small>
                </h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="main.php?route=home">Beranda</a></li>
                  <li class="breadcrumb-item active">Data</li>
                  <li class="breadcrumb-item active"><?php echo $judulform; ?></li>
                  <li class="breadcrumb-item active">edit</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content wow fadeInUp" data-wow-duration=".2s" data-wow-delay=".1s">
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

                        <form method="POST" action="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=edit&id=<?php echo $e['$f1']; ?>" enctype="multipart/form-data">

                          <section class="base">
                            <div class="row">

                              <div class="col-lg-3">
                                <div class="form-group">
                                  <label><?php echo $j1; ?></label>
                                  <input type="text" name="<?php echo $f1; ?>" class="form-control" value="<?php echo $e[$f1]; ?>" readonly />
                                </div>
                              </div>

                              <div class="col-lg-2">
                                <div class="form-group">
                                  <label><?php echo $j2; ?></label>
                                  <input type="text" name="<?php echo $f2; ?>" class="form-control" value="<?php echo $e[$f2]; ?>" autofocus="" readonly />
                                </div>
                              </div>

                              <div class="col-lg-2">
                                <div class="form-group">
                                  <label><?php echo $j9; ?></label>
                                  <input type="text" name="<?php echo $f9; ?>" class="form-control" value="<?php echo $e[$f9]; ?>" autofocus="" readonly />
                                </div>
                              </div>

                              <div class="col-lg-5">
                                <div class="form-group">
                                  <label><?php echo $j3; ?></label>
                                  <input type="text" name="<?php echo $f3; ?>" class="form-control" value="<?php echo $e[$f3]; ?>" autofocus="" readonly />
                                </div>
                              </div>

                              <div class="col-lg-2">
                                <div class="form-group">
                                  <label><?php echo $j4; ?></label>
                                  <input type="text" name="<?php echo $f4; ?>" class="form-control" value="<?php echo $e[$f4]; ?>" autofocus="" required="" />
                                </div>
                              </div>

                              <div class="col-lg-3">
                                <div class="form-group">
                                  <label><?php echo $j5; ?></label>
                                  <input type="text" name="<?php echo $f5; ?>" class="form-control" value="<?php echo $e[$f5]; ?>" autofocus="" required="" />
                                </div>
                              </div>

                              <div class="col-lg-3">
                                <div class="form-group">
                                  <label><?php echo $j6; ?></label>
                                  <input type="text" name="<?php echo $f6; ?>" class="form-control" value="<?php echo $e[$f6]; ?>" autofocus="" required="" />
                                </div>
                              </div>

                              <!-- <div class="col-lg-2">
                                          <div class="form-group">
                                            <label><?php echo $j7; ?></label>
                                            <input type="text" name="<?php echo $f7; ?>" class="form-control" value="<?php echo $e[$f7]; ?>" autofocus="" required="" />
                                          </div>
                                        </div>

                                        <div class="col-lg-2">
                                          <div class="form-group">
                                            <label><?php echo $j8; ?></label>
                                            <input type="text" name="<?php echo $f8; ?>" class="form-control" value="<?php echo $e[$f8]; ?>" autofocus="" required="" />
                                          </div>
                                        </div> -->

                            </div>

                            <hr />

                            <div class="form-group">
                              <button type="submit" class="btn btn-primary elevation-2" style="opacity: .7">Simpan Perubahan</button>
                            </div>

                          </section>
                        </form>
                        <a href="main.php?route=<?php echo $rute; ?>&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=<?php echo $rute; ?>"><button class="btn btn-primary btn-sm elevation-1" style="opacity: .7">Back</button></a>
                      </div><!-- /.box-body -->
                    </div><!-- /.box -->
                  </div><!--/.col (right) -->
                </div> <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <style>
        .file {
          visibility: hidden;
          position: absolute;
        }
      </style>

      <script>
        function konfirmasi() {
          konfirmasi = confirm("Apakah anda yakin ingin menghapus gambar ini?")
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