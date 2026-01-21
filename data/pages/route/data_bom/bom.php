<?php

$judulform = "Data Bill of materials";

$data = 'data_bom';
$data2 = 'import_data_bom';
$rute = 'bom';
$aksi = 'aksi_bom';

$tabel = 'bom';

$f1 = 'kode_bom';
$f2 = 'kode_bahan';
$f3 = 'nama_bahan';
$f4 = 'satuan_bahan';
$f5 = 'qty_satuan';
$f6 = 'qty_bahan';
$f7 = 'kode_barang_jadi';
$f8 = 'nama_barang_jadi';
$f9 = 'satuan_barang_jadi';

$j1 = 'Kode Bom';
$j2 = 'Kode Bahan';
$j3 = 'Nama Bahan';
$j4 = 'Satuan Bahan';
$j5 = 'Qty Satuan';
$j6 = 'Qty Bahan';
$j7 = 'Kode Barang Jadi';
$j8 = 'Nama Barang Jadi';
$j9 = 'Satuan Barang Jadi';



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
      <style>
        /* Style untuk link */
        .open-modal {
          text-decoration: none;
          color: #021526;
          font-weight: bold;
          padding: 5px 10px;
          border-radius: 5px;
          transition: background-color 0.3s, color 0.3s;
        }

        /* Efek hover untuk link */
        .open-modal:hover {
          background-color: #021526;
          color: #f8f8f8;
          cursor: pointer;
        }

        /* Efek fokus untuk link (misalnya ketika menggunakan keyboard) */
        .open-modal:focus {
          outline: none;
          box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }
      </style>

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
                          <button class="btn btn-primary btn-sm elevation-2 " style="opacity: .7;" onclick="window.location='route/<?php echo $data; ?>/bom_tambah.php'"><i class="fa fa-plus" ;></i> Tambah</button>
                          <div style="margin:10px"></div>
                          <table id="example1" class="table table-bordered table-striped">
                            <thead style="background-color: lightgray;" class="elevation-2">
                              <tr>
                                <th>No.</th>
                                <th><?php echo $j1; ?></th>
                                <th><?php echo $j7; ?></th>
                                <th><?php echo $j8; ?></th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php

                              $data_bahan = [];
                              $sql1 = mysqli_query($koneksi, "SELECT  $tabel.$f1, $tabel.$f2, $tabel.$f3, $tabel.$f4, $tabel.$f5,
                                   $tabel.$f6, $tabel.$f7, $f8                                 FROM $tabel
                                    ORDER BY $tabel.$f7 ASC");

                              if (!$sql1) {
                                die("Query Error" . mysqli_error($koneksi));
                              }

                              while ($s1 = mysqli_fetch_array($sql1)) {
                                $data_bahan[$s1[$f1]][$s1[$f7]][$s1[$f8]][] = [
                                  'kode_bahan' => $s1[$f2],
                                  'nama_bahan' => $s1[$f3],
                                  'satuan_bahan' => $s1[$f4],
                                  'qty_bahan' => $s1[$f6]
                                ];
                              }


                              $no = 1;
                              foreach ($data_bahan as $kode_bom => $barangs) {
                                foreach ($barangs as $kode_barang => $nama_barangs) {
                                  foreach ($nama_barangs as $nama_barang => $bahans) {
                              ?>
                                    <tr align="left">
                                      <td><?php echo $no; ?></td>
                                      <td><?php echo $kode_bom; ?></td>
                                      <td><?php echo $kode_barang; ?></td>
                                      <td>
                                      <a href="#" class="open-modal" data-brand="<?php echo $kode_bom; ?>" data-kode="<?php echo $kode_barang; ?>" data-nama="<?php echo $nama_barang; ?>">
                                          <?php echo $nama_barang; ?>
                                        </a>
                                        <!-- <a href="#" class="open-modal" data-bom="<?php echo $kode_bom; ?>" data-kode="<?php echo $kode_barang; ?>" data-nama="<?php echo $nama_barang; ?>">
                                          <?php echo $nama_barang; ?>
                                        </a> -->
                                      </td>
                                    </tr>
                              <?php
                                    $no++;
                                  }
                                }
                              }
                              ?>
                            </tbody>
                          </table>

                          <!-- Modal -->
                          <!-- Modal -->
                          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document" style="max-width: 90%; margin: 30px auto;">
                              <div class="modal-content" style="border-radius: 10px; overflow: hidden; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);">
                                <div class="modal-header" style="background-color: #f8f850; color: black; padding: 10px 20px;">
                                  <h5 class="modal-title" id="exampleModalLabel">Detail Bahan</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: black;">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body" style="padding: 20px;">
                                  <table class="table table-bordered table-striped" style="margin-bottom: 0;">
                                    <thead>
                                      <tr style="background-color: #f2f2f2;">
                                        <th style="padding: 8px; text-align: left;">Kode Bahan</th>
                                        <th style="padding: 8px; text-align: left;">Nama Bahan</th>
                                        <th style="padding: 8px; text-align: left;">Qty</th>
                                        <th style="padding: 8px; text-align: left;">Satuan Bahan</th>
                                      </tr>
                                    </thead>
                                    <tbody id="modal-table-body">
                                      <!-- Isi tabel akan dimuat di sini menggunakan JavaScript -->
                                    </tbody>
                                  </table>
                                </div>
                                <div class="modal-footer" style="background-color: #f9f9f9; border-top: 1px solid #e9ecef; padding: 10px 20px;">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: #f44336; border: none; color: white; padding: 10px 20px; border-radius: 5px;">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>

                          <!-- <?php echo '<pre>';
                          print_r($data_bahan);
                          echo '</pre>';
                          ?> -->
                          <script>
                            var dataBahan = <?php echo json_encode($data_bahan); ?>;

                            $(document).ready(function() {
                              $('.open-modal').click(function(e) {
                                e.preventDefault();
                                var brand = $(this).data('brand');
                                var kodeBarang = $(this).data('kode');
                                var namaBarang = $(this).data('nama');

                                var relatedData = dataBahan[brand][kodeBarang][namaBarang] || [];

                                var modalTableBody = $('#modal-table-body');
                                modalTableBody.empty();

                                relatedData.forEach(function(item) {
                                  var qty_bahan = parseFloat(item.qty_bahan); // Mengubah qty_bahan menjadi bilangan desimal
                                  qty_bahan = qty_bahan % 1 === 0 ? qty_bahan.toFixed(0) : qty_bahan; // Menghilangkan trailing zeros jika qty_bahan adalah bilangan bulat

                                  var row = '<tr>' +
                                    '<td>' + item.kode_bahan + '</td>' +
                                    '<td>' + item.nama_bahan + '</td>' +
                                    '<td>' + qty_bahan + '</td>' +
                                    '<td>' + item.satuan_bahan + '</td>' +
                                    '</tr>';
                                  modalTableBody.append(row);
                                });

                                $('#myModal').modal('show');
                              });
                            });
                          </script>

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
      $edit = mysqli_query($koneksi, "SELECT * from $tabel where $f2='$_GET[id]'");
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

                        <form method="POST" action="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=edit&id=<?php echo $e['kode_bahan']; ?>" enctype="multipart/form-data">

                          <section class="base">

                            <div class="form-group">
                              <label for="kode_barang"><?php echo $j1; ?></label>
                              <select id="kode_barang" name="<?php echo $f1; ?>" class="form-control select2" style="width:300px;height: 40px;">
                                <option value="">Pilih jenis</option>
                                <?php
                                $produk = mysqli_query($koneksi, "SELECT * FROM barang_menu ORDER BY kd_brg ASC");
                                while ($row = mysqli_fetch_array($produk)) {
                                  $selected = ($row['kd_brg'] == $e[$f1]) ? 'selected' : ''; // Check if this is the selected value
                                  echo "<option value='$row[kd_brg]' $selected>$row[kd_brg] - $row[nama]</option>";
                                }
                                ?>
                              </select>
                            </div>

                            <div class="form-group">
                              <label><?php echo $j2; ?></label>
                              <select id="kode_bahan" name="<?php echo $f2; ?>" class="form-control select2" style="width:300px; height: 40px;">
                                <option value="">Pilih Bahan</option>
                                <?php
                                $bahan = mysqli_query($koneksi, "SELECT * FROM barang_sage ORDER BY kd_sage ASC");
                                while ($row = mysqli_fetch_array($bahan)) {
                                  $selected = ($row['kd_sage'] == $e[$f2]) ? 'selected' : ''; // Check if this is the selected value
                                  echo "<option value='$row[kd_sage]' $selected>$row[kd_sage] - $row[nama]</option>";
                                }
                                ?>
                              </select>
                            </div>

                            <div class="form-group">
                              <label><?php echo $j3; ?></label>
                              <select id="kode_bahan" name="<?php echo $f3; ?>" class="form-control select2" style="width:300px; height: 40px;">
                                <option value="">Pilih Bahan</option>
                                <?php
                                $bahan = mysqli_query($koneksi, "SELECT * FROM brand ORDER BY kd_brand ASC");
                                while ($row = mysqli_fetch_array($bahan)) {
                                  $selected = ($row['kd_brand'] == $e[$f3]) ? 'selected' : ''; // Check if this is the selected value
                                  echo "<option value='$row[kd_brand]' $selected>$row[kd_brand] - $row[nama]</option>";
                                }
                                ?>
                              </select>
                            </div>
                            <!-- 
                            <div class="form-group">
                              <label><?php echo $j3; ?></label>
                              <input type="text" name="<?php echo $f3; ?>" class="form-control" value="<?php echo $e[$f3]; ?>" autofocus="" required="" readonly />
                            </div> -->

                            <div class="form-group">
                              <label><?php echo $j4; ?></label>
                              <input type="text" name="<?php echo $f4; ?>" class="form-control" value="<?php echo $e[$f4]; ?>" autofocus="" />
                            </div>

                            <div class="form-group">
                              <select id="kode_bahan" name="<?php echo $f5; ?>" class="form-control select2" style="width:100%; height: 40px;">
                                <option value="">Pilih Satuan</option>
                                <?php
                                $satuan = mysqli_query($koneksi, "SELECT * FROM satuan ORDER BY kd_satuan ASC");
                                while ($row = mysqli_fetch_array($satuan)) {
                                  $selected = ($row['kd_satuan'] == $e[$f5]) ? 'selected' : ''; // Check if this is the selected value
                                  echo "<option value='$row[kd_satuan]' $selected>$row[nama]</option>";
                                }
                                ?>
                              </select>
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
      <script type="text/javascript">
        $(function() {
          $('.select2').select2({
            theme: 'bootstrap4'
          });
        });
      </script>
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