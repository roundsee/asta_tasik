<?php
$dir = "../../";

$judulform = "Daftar Sales";

$data = 'data_sales';
$rute = 'sales';
$aksi = 'aksi_sales';

$tabel = 'sales';
$f1 = 'id_sales';
$f2 = 'nama';
$f3 = 'alamat';

$j1 = "ID Sales";
$j2 = 'Nama Sales';
$j3 = 'Alamat Sales';



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
                    <div class="hrg_box">
                      <div class="box-body">
                        <div class="table-responsive">
                          <button class="btn btn-primary btn-sm elevation-2 " style="opacity: .7;" onclick="window.location='route/<?php echo $data; ?>/autocomplete.php?asal=<?php echo $_GET['asal']; ?>'"><i class="fa fa-plus" ;></i> Tambah</button>
                          <!-- <button type="button" class="btn btn-sm btn-primary" id="btn-tambah-kategori" data-toggle="modal" data-target="#modal-kategori"><i class="fa fa-plus-circle"></i> Kategori</button> -->
                          <div style="margin:10px"></div>

                          <table id="example1" class="table table-bordered table-striped">
                            <thead style="background-color:  lightgray;" class="elevation-2">
                              <tr align="middle">
                                <th><?php echo $j1 ?></th>
                                <th><?php echo $j2 ?></th>
                                <th><?php echo $j3 ?></th>
                                <th>Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php

                              $query = mysqli_query($koneksi, "SELECT * FROM $tabel");

                              while ($j = mysqli_fetch_array($query)) {

                              ?>
                                <tr align="middle">
                                  <td><b><?php echo $j[$f1]; ?></b></td>
                                  <td><?php echo $j[$f2]; ?> </td> 
                                  <td><?php echo $j[$f3]; ?> </td> 
                                  <td><a href="main.php?route=sales&act=edit&ids=<?php echo $j[$f1]; ?>&asal=<?php echo $_GET['asal']; ?>" title="Edit Data"><button class="btn btn-primary btn-sm elevation-2" style="opacity: .7;width:80px"><i class="fa fa-edit"></i> Edit</button></a>

                                    <a href="route/data_sales/aksi_sales.php?route=sales&act=hapus&id=<?php echo $j[$f1]; ?>" title="Hapus Data" onclick="return confirm('Apakah anda yakin ingin menghapus ini ?')"><button class="btn btn-danger btn-sm elevation-2" style="opacity: .7;width:80px"><i class="fa fa-trash"></i> Hapus</button></a>
                                  </td>
                                </tr>
                              <?php
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
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

      <script>
        function initializeTabelKategori(params = '') {
          let tabel_kategori = $('.tabel-kategori tbody');
          tabel_kategori.empty();
          $.get('route/data_kategori_satuan/aksi_kategori_nilai.php?action=getall&search=' + params, function(response) {
            if (response.status) {
              let data = response.data;
              data.forEach((kategori, i) => {
                // buat button untuk edit dan hapus berdasarkan id
                let act = `<button class="btn btn-sm btn-success nilai4-2" type="button" onclick="editKategori('${kategori.id_kategoriNilai}')"><i class="fa fa-edit nilai4-2"></i></button><button class="btn btn-danger btn-sm" type="button" onclick="deleteKategori('${kategori.id_kategoriNilai}')"><i class="fa fa-trash nilai4-2"></i></button>`;
                let button_pilih = ``
                tabel_kategori.append(`
                              <tr>
                                <td>${kategori.id_kategoriNilai}</td>
                                <td>${kategori.nilai1} %</td>
                                <td>${kategori.nilai2} %</td>
                                <td>${kategori.nilai3} %</td>
                                <td>${kategori.nilai4} %</td>
                                <td>${kategori.nilai5} %</td>
                                <td>${act}</td>
                                `);
              });
            } else {
              tabel_kategori.append(`<tr>
                                <td colspan="6" class="text-center">Data kategori tidak ditemukan</td>
                              </tr>`);
            }
          });
        }

        function deleteKategori(params) {
          Swal.fire({
            title: "Yakin ingin menghapus kategori " + params + " ?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya",
            cancelButtonText: "Tidak"
          }).then((result) => {
            if (result.value) {
              let id_kategoriNilai = params;
              $.ajax({
                type: 'POST',
                url: "route/data_kategori_satuan/aksi_kategori_nilai.php?action=delete",
                data: {
                  "id_kategoriNilai": id_kategoriNilai
                },
                success: function(res) {
                  console.log(res);
                  if (res.status) {
                    initializeTabelKategori();
                    Swal.fire({
                      icon: 'success',
                      title: 'Berhasil',
                      text: 'kategori berhasil dihapus',
                      showConfirmButton: false,
                      timer: 1500
                    });
                  } else {
                    console.log(res);
                  }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                  console.log(xhr.responseText);
                }
              });
            }
          });
        }

        function editKategori(params) {
          let id_kategoriNilai = params;
          $.get('route/data_kategori_satuan/aksi_kategori_nilai.php?action=get&kode=' + id_kategoriNilai, function(response) {
            let data = response.data;
            document.getElementById("id_kategoriNilai").setAttribute("readonly", true);
            $('#modal-kategori #id_kategoriNilai').val(data.id_kategoriNilai);
            $('#modal-kategori #nilai1').val(data.nilai1);
            $('#modal-kategori #nilai2').val(data.nilai2);
            $('#modal-kategori #nilai3').val(data.nilai3);
            $('#modal-kategori #nilai4').val(data.nilai4);
            $('#modal-kategori #nilai5').val(data.nilai5);
            $('.form-kategori').show();
            $('#btn-batal-kategori').hide();
            $('#btn-daftar-kategori').hide();
            $('#btn-save-kategori').hide();
            $('.data-tabel-kategori').hide();
            $('#btn-kembali-kategori').hide();
            $('#btn-update-kategori').show();
          });
        }
        $(document).ready(function() {

          //crud kategori
          $('#btn-tambah-kategori').on('click', function() {
            initializeTabelKategori();
            $('.form-kategori').show();
            $('#btn-batal-kategori').show();
            $('#btn-daftar-kategori').show();
            $('#btn-save-kategori').show();
            $('.data-tabel-kategori').hide();
            $('#btn-kembali-kategori').hide();
            $('#btn-update-kategori').hide();
            document.getElementById("btn-daftar-kategori").click();
          });

          $('#btn-daftar-kategori').on('click', function() {
            $('.form-kategori').hide();
            $('#btn-batal-kategori').hide();
            $('#btn-daftar-kategori').hide();
            $('#btn-save-kategori').hide();
            $('.data-tabel-kategori').show();
            $('#btn-kembali-kategori').show();
            $('#btn-update-kategori').hide();
          });

          $('#btn-kembali-kategori').on('click', function() {
            $('.form-kategori').show();
            $('#btn-batal-kategori').show();
            $('#btn-daftar-kategori').show();
            $('#btn-save-kategori').show();
            $('.data-tabel-kategori').hide();
            $('#btn-kembali-kategori').hide();
            $('#btn-update-kategori').hide();
            $('#modal-kategori #id_kategoriNilai').val("");
            $('#modal-kategori #nilai1').val("");
            $('#modal-kategori #nilai2').val("");
            $('#modal-kategori #nilai3').val("");
            $('#modal-kategori #nilai4').val("");
            $('#modal-kategori #nilai5').val("");
          });

          $('#btn-update-kategori').on('click', function() {
            let id_kategoriNilai = $('#modal-kategori #id_kategoriNilai').val();
            let nilai1 = $('#modal-kategori #nilai1').val();
            let nilai2 = $('#modal-kategori #nilai2').val();
            let nilai3 = $('#modal-kategori #nilai3').val();
            let nilai4 = $('#modal-kategori #nilai4').val();
            let nilai5 = $('#modal-kategori #nilai5').val();
            document.getElementById("id_kategoriNilai").removeAttribute("readonly");

            if (id_kategoriNilai == '') {
              alert('Kode kategori harus diisi');
              return false;
            } else {
              $.ajax({
                type: 'POST',
                url: "route/data_kategori_satuan/aksi_kategori_nilai.php?action=update",
                data: {
                  "nilai1": nilai1,
                  "nilai2": nilai2,
                  "nilai3": nilai3,
                  "nilai4": nilai4,
                  "nilai5": nilai5,
                  "id_kategoriNilai": id_kategoriNilai
                },
                success: function(res) {
                  if (res.status) {
                    $('#modal-kategori #id_kategoriNilai').val("");
                    $('#modal-kategori #nilai1').val("");
                    $('#modal-kategori #nilai2').val("");
                    $('#modal-kategori #nilai3').val("");
                    $('#modal-kategori #nilai4').val("");
                    $('#modal-kategori #nilai5').val("");
                    $('.form-kategori').hide();
                    $('#btn-batal-kategori').show();
                    $('#btn-daftar-kategori').hide();
                    $('#btn-save-kategori').hide();
                    $('.data-tabel-kategori').show();
                    $('#btn-kembali-kategori').show();
                    $('#btn-update-kategori').hide();
                    initializeTabelKategori();
                    Swal.fire({
                      icon: 'success',
                      title: 'Berhasil',
                      text: 'Member berhasil diedit',
                      showConfirmButton: false,
                      timer: 1500
                    });
                  } else {
                    console.log(res);
                  }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                  console.log(xhr.responseText);
                }
              });
            }
          });

          $('#btn-save-kategori').on('click', function() {
            let id_kategoriNilai = $('#modal-kategori #id_kategoriNilai').val();
            let nilai1 = $('#modal-kategori #nilai1').val();
            let nilai2 = $('#modal-kategori #nilai2').val();
            let nilai3 = $('#modal-kategori #nilai3').val();
            let nilai4 = $('#modal-kategori #nilai4').val();
            let nilai5 = $('#modal-kategori #nilai5').val();

            if (id_kategoriNilai == '') {
              alert('Kode kategori kosong');
              return false;
            } else {
              $.ajax({
                type: 'POST',
                url: "route/data_kategori_satuan/aksi_kategori_nilai.php?action=save",
                data: {
                  "id_kategoriNilai": id_kategoriNilai,
                  "nilai1": nilai1,
                  "nilai2": nilai2,
                  "nilai3": nilai3,
                  "nilai4": nilai4,
                  "nilai5": nilai5
                },
                success: function(res) {
                  if (res.status) {
                    $('#modal-kategori').modal('hide');
                    $('#modal-kategori #id_kategoriNilai').val("");
                    $('#modal-kategori #nilai1').val("");
                    $('#modal-kategori #nilai2').val("");
                    $('#modal-kategori #nilai3').val("");
                    $('#modal-kategori #nilai4').val("");
                    $('#modal-kategori #nilai5').val("");

                    Swal.fire({
                      icon: 'success',
                      title: 'Berhasil',
                      text: 'kategori berhasil ditambahkan',
                      showConfirmButton: false,
                      timer: 1500
                    });
                  } else {
                    console.log(res);
                  }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                  console.log(xhr.responseText);
                }
              });
            }
          });
        });
      </script>
    <?php
      break;

      //Form Edit 
    case "edit":

      //edit
      $ubah = mysqli_query($koneksi, "SELECT * FROM sales WHERE id_sales  = '$_GET[ids]'");
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
                  Kategori Satuan<small>update</small>
                </h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                  <li class="breadcrumb-item active">Edit kategori</li>
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
                            <input type="text" name="id" class="form-control" value="<?php echo $u[$f1]; ?>" readonly="readonly" />
                          </div> -->

                          <div class="form-group">
                          <label><?php echo $j1 ?> </label>
                            <input name="<?php echo $f1; ?>" class="form-control" value="<?php echo $u[$f1]; ?>" readonly="readonly" />
                          </div>
                          <div class="form-group">
                            <label><?php echo $j2 ?> </label>
                            <input name="<?php echo $f2; ?>" class="form-control" value="<?php echo $u[$f2]; ?>" " />
                          </div>
                          <div class="form-group">
                          <label><?php echo $j3 ?> </label>
                            <input name="<?php echo $f3; ?>" class="form-control" value="<?php echo $u[$f3]; ?>"  />
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