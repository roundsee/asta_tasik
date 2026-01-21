<?php

$judulform = "IMPORT SAGE RETUR PENJUALAN";

$data = 'sage';
$rute = 'import_sage';
$aksi = 'aksi_sage';

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
        <section class="content-header  wow fadeInDown" data-wow-duration=".3s" data-wow-delay=".3s">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="list-gds">
                  <b><?php echo $judulform; ?></b> <small style="font-weight: 100;">report</small>
                </h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="main.php?route=home">Beranda</a></li>
                  <li class="breadcrumb-item active">Laporan</li>
                  <li class="breadcrumb-item active"><?php echo $judulform; ?></li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <!-- <section class="content wow fadeInUp" data-wow-duration=".2s" data-wow-delay=".1s" > -->
        <section class="content wow ">
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
                        <form role="form" action="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=import_sage_retur_jual" method="post">
                          <div class="row">

                            <div class="col-lg-2">

                              <div class="form-group">
                                <label>Tanggal Awal</label>
                                <input type="date" class="form-control" name="tgl_awal" onclick="displayHasil(this.value)" placeholder="Masukkan Tanggal Awal .. (Wajib)" value="<?php echo date('Y-m-d') ?>" required="required">
                              </div>

                              <!-- <div class="form-group">
                                <label>Tanggal Akhir</label>
                                <input type="date" class="form-control" name="tgl_akhir" onclick="displayHasil(this.value)"  placeholder="Masukkan Tanggal Akhir .. (Wajib)" value="<?php echo date('Y-m-d') ?>"  required="required">
                              </div> -->
                            </div>
                          </div>
                          <!-- Generate -->
                          <div class="col-lg-3">

                            <div class="row">
                              <div class="col-lg-12">
                                <input type="hidden" name="login_hash" value="<?php echo $login_hash; ?>">

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

                    <hr />

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
        function displayHasil(tgl_awal) {
          document.getElementById("tgl_awalHasil").value = tgl_awal;
        };
      </script>
    <?php
      break;

    case "report";


      $tgl_awal = $_GET['tgl_awal'];
      $tgl_akhir = $_GET['tgl_akhir'];
      $filter = $_GET['filter'];
      $nilai = $_GET['nilai'];

      // echo "<br/>".$tgl_awal;
      // echo "<br/>".$tgl_akhir;
      // echo "<br/>".$filter;
      // echo "<br/>".$nilai;

      if ($filter == 'kota') {
        $kondisi = "AND pelanggan.kd_kota='$nilai'";
        $query = mysqli_query($koneksi, "SELECT nama FROM kotabaru WHERE kode='$nilai' ");
        $q1 = mysqli_fetch_array($query);
        $judul_nilai = $q1['nama'];
      } elseif ($filter == 'outlet') {
        $kondisi = "AND penjualan.kd_cus='$nilai'";
        $query = mysqli_query($koneksi, "SELECT nama FROM pelanggan WHERE kd_cus='$nilai' ");
        $q1 = mysqli_fetch_array($query);
        $judul_nilai = $q1['nama'];
      } elseif ($filter == 'area') {
        $kondisi = "AND kotabaru.kd_area='$nilai'";
        $query = mysqli_query($koneksi, "SELECT nama FROM area WHERE kode='$nilai' ");
        $q1 = mysqli_fetch_array($query);
        $judul_nilai = $q1['nama'];
      } elseif ($filter == 'kasir') {
        $kondisi = "AND penjualan.oleh='$nilai'";
        $query = mysqli_query($koneksi, "SELECT name_e FROM employee WHERE employee_number='$nilai' ");
        $q1 = mysqli_fetch_array($query);
        $judul_nilai = $q1['name_e'];

        $kondisi = "AND penjualan.oleh='$judul_nilai' ";
      } else {
        $kondisi = "";
        $judul_nilai = '';
      }


      if ($login_hash == '6' or $login_hash == '7') {
        $filter = 'Outlet';
        $query = mysqli_query($koneksi, "SELECT cabang_e FROM employee WHERE employee_number='$en' ");
        $q1 = mysqli_fetch_array($query);
        $nilai = $q1['cabang_e'];
        $kondisi = "AND penjualan.kd_cus='$nilai'";
        $query = mysqli_query($koneksi, "SELECT nama FROM pelanggan WHERE kd_cus='$nilai' ");
        $q1 = mysqli_fetch_array($query);
        $judul_nilai = $q1['nama'];
        $tgl_akhir = $tgl_awal;
      }

    ?>

      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
      <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">


      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" style="background-color: beige; max-height: 1400px!important;">
        <!-- Content Header (Page header) -->
        <section class="content-header  wow fadeInDown" data-wow-duration=".3s" data-wow-delay=".3s">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="list-gds">
                  <b><?php echo $judulform; ?></b> <small style="font-weight: 100;">report</small>

                </h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="main.php?route=home">Beranda</a></li>
                  <li class="breadcrumb-item active">Laporan</li>
                  <li class="breadcrumb-item active"><?php echo $judulform; ?></li>
                </ol>
              </div>

            </div>
            <button class="btn btn-primary btn-sm elevation-2 " style="opacity: .7;" onclick="window.location='route/<?php echo $data; ?>/cetak.php?tgl_awal=<?php echo $tgl_awal; ?>&tgl_akhir=<?php echo $tgl_akhir; ?>&filter=<?php echo $filter; ?>&nilai=<?php echo $nilai; ?>'"><i class="fa fa-plus" ;></i> Cetak PB1</button>

            <br>
            <center>
              <h4>Laporan Omset dan PB1
                <br><?php echo $filter . " : " . $judul_nilai . '-' . $tgl_akhir; ?>
                <br />Periode : <?php echo $tgl_awal . " s/d " . $tgl_akhir; ?>
              </h4>
            </center>
          </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content wow fadeInUp" data-wow-duration=".2s" data-wow-delay=".1s">
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
                          <?php if ($login_hash == 6 or $login_hash == 7 or $filter == 'outlet') { ?>

                            <table id="example" class="table table-bordered table-striped">
                              <thead style="background-color:  lightgray;" class="elevation-2">
                                <tr>
                                  <th>No.</th>
                                  <th><?php echo $j3; ?></th>
                                  <th>Nama Outlet</th>
                                  <th>Kode Kota</th>
                                  <th>Nama Kota</th>
                                  <th><?php echo $j2; ?></th>
                                  <th><?php echo $j1; ?></th>
                                  <th>Ket Aplikasi</th>
                                  <th>Kode Aplikasi</th>
                                  <th>Nama Aplikasi</th>
                                  <th><?php echo $j7; ?></th>
                                  <th><?php echo $j8; ?></th>
                                  <th><?php echo $j9; ?></th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php

                                //  if($filter=='kota'){
                                //   $kondisi="AND pelanggan.kd_kota='$nilai'";
                                // }elseif($filter=='outlet'){
                                //   $kondisi="AND penjualan.kd_cus='$nilai'";
                                // }elseif($filter=='area'){
                                //   $kondisi="AND kotabaru.kd_area='$nilai'";
                                // }else{
                                //   $kondisi="";
                                // }

                                $query = "SELECT  pelanggan.nama as p_nama,kotabaru.nama as kb_nama ,jenis_transaksi.nama as jt_nama
                               FROM penjualan 
                               join pelanggan on pelanggan.kd_cus=penjualan.kd_cus
                               join kotabaru on kotabaru.kode=pelanggan.kd_kota
                               join jenis_transaksi on jenis_transaksi.kd_jenis=penjualan.kd_aplikasi
                               WHERE tanggal>='$tgl_awal' AND tanggal <= '$tgl_akhir' $kondisi ";



                                $sql1 = mysqli_query($koneksi, $query);
                                $no = 1;

                                $tot_subjumlah = 0;
                                $tot_ppn = 0;
                                $tot_jumlah = 0;

                                $tot_11 = 0;
                                $tot_22 = 0;
                                $tot_33 = 0;
                                $tot_44 = 0;

                                $tot_ofline = 0;
                                $tot_online = 0;


                                while ($s1 = mysqli_fetch_array($sql1)) {
                                ?>
                                  <tr align="left">
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $s1[$f3]; ?></td>
                                    <td><?php echo $s1['p_nama']; ?></td>
                                    <td><?php echo $s1['kd_kota']; ?></td>
                                    <td><?php echo $s1['kb_nama']; ?></td>
                                    <td><?php echo $s1[$f2]; ?></td>
                                    <td><?php echo $s1[$f1]; ?></td>
                                    <td><?php echo $s1[$f20]; ?></td>
                                    <td style="text-align: center;"><?php echo $s1[$f4]; ?></td>
                                    <td><?php echo $s1['jt_nama']; ?></td>
                                    <td style="text-align: right;"><?php echo format_rupiah($s1[$f7]); ?></td>
                                    <td style="text-align: right;"><?php echo format_rupiah($s1[$f8]); ?></td>
                                    <td style="text-align: right;"><?php echo format_rupiah($s1[$f9]); ?></td>

                                  </tr>
                                <?php
                                  $no++;
                                  $tot_subjumlah = $tot_subjumlah + $s1[$f7];
                                  $tot_ppn = $tot_ppn + $s1[$f8];
                                  $tot_jumlah = $tot_jumlah + $s1[$f9];

                                  if ($s1[$f4] == '11') {
                                    $tot_11++;
                                  }
                                  if ($s1[$f4] == '22') {
                                    $tot_22++;
                                  }
                                  if ($s1[$f4] == '33') {
                                    $tot_33++;
                                  }
                                  if ($s1[$f4] == '44') {
                                    $tot_44++;
                                  }

                                  $tot_online = $tot_22 + $tot_33 + $tot_44;
                                  $tot_ofline = $tot_11;
                                }
                                ?>
                              </tbody>
                              <tfoot>
                                <tr style="font-weight:800">
                                  <td colspan="10" style="text-align:right;"> Total :</td>
                                  <td><?php echo format_rupiah($tot_subjumlah); ?></td>
                                  <td><?php echo format_rupiah($tot_ppn); ?></td>
                                  <td><?php echo format_rupiah($tot_jumlah); ?></td>
                                </tr>
                              </tfoot>

                            </table>

                          <?php } ?>


                          <hr>
                          <div>
                            SUMMARY REPORT
                          </div>
                          <table style="background-color:beige;font-weight:700">
                            <tr>
                              <td style="width:200px"> Total</td>
                              <td style="width:30px">:</td>
                              <td style="text-align:right;"><?php echo format_rupiah($tot_subjumlah); ?></td>
                            </tr>
                            <tr>
                              <td> Total PPn</td>
                              <td>:</td>
                              <td style="text-align:right;"><?php echo format_rupiah($tot_ppn); ?></td>
                            </tr>

                            <tr>
                              <td> Total setelah Pajak</td>
                              <td>:</td>
                              <td style="text-align:right;"><?php echo format_rupiah($tot_jumlah); ?></td>
                            </tr>

                            <tr>
                              <td>.</td>
                            </tr>

                            <tr>
                              <td>Total OFF Line </td>
                              <td>:</td>
                              <td><?php echo $tot_ofline; ?></td>
                            </tr>
                            <tr>
                              <td>Total ON Line </td>
                              <td>:</td>
                              <td><?php echo $tot_online; ?></td>
                            </tr>
                            <tr>
                              <td>.</td>
                            </tr>
                            <tr>
                              <td>Total Dine In</td>
                              <td>:</td>
                              <td><?php echo $tot_11; ?></td>
                            </tr>
                            <tr>
                              <td>Total Aplikasi Shoppe</td>
                              <td>:</td>
                              <td><?php echo $tot_22; ?></td>
                            </tr>
                            <tr>
                              <td>Total Aplikasi Grab</td>
                              <td>:</td>
                              <td><?php echo $tot_33; ?></td>
                            </tr>
                            <tr>
                              <td>Total Aplikasi GoJek</td>
                              <td>:</td>
                              <td><?php echo $tot_44; ?></td>
                            </tr>


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


      <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
      <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
      <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>

      <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>




      <script>
        $(document).ready(function() {
          $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [
              'copy', 'csv', 'excel', 'pdf', 'print'
            ]
          });
        });
      </script>



      <script>
        function isi_otomatis() {
          var <?php echo $f1; ?> = $("#<?php echo $f1; ?>").val();
          $.ajax({
            url: 'ajax.php',
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


<?php
      break;
  }
}
?>