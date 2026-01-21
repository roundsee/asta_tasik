<?php
$login_hash = $_SESSION['login_hash'];
$en = $_SESSION['employee_number'];
$to = $_SESSION['to'];
$area_e = $_SESSION['area_e'];
$area_nama = $_SESSION['area_nama'];

$judulform = "Daftar Transaksi Paylater ";

$data = 'lap_paylater';
$rute = 'paylaterreport';
$aksi = 'aksi_export';

$tabel = 'jualdetil';

$f1 = 'kd_beli';
$f2 = 'tgl_beli';
$f3 = 'kd_supp';
$f4 = 'ket_payment';
$f5 = 'status_payment';
$f6 = 'jenis_po';
$f7 = 'ppn';
$f8 = 'status_penjualan';
$f9 = 'kd_po';
$f10 = 'tgl_po';
$f11 = 'tgl_rilis';
$f12 = 'durasi_kirim';
$f13 = 'term_payment';
$f14 = 'user_input';
$f15 = 'tujuan_kirim';
$f16 = 'statuts_invoice';
$f17 = 'tenggat_waktu';
$f18 = 'user_input_terbit';
$f19 = 'user_input_rilis';
$f20 = 'tarif_ppn';

$j1 = 'Kode Purchase Request';
$j2 = 'Tanggal';
$j3 = 'Kode Supplier';
$j4 = 'Ket Payment';
$j5 = 'Status';
$j6 = 'Jenis';
$j7 = 'PPN';
$j8 = 'Status penjualan';
$j9 = 'KD Po';
$J10 = 'Tgl Po';
$j11 = 'Tgl Rilis';
$j12 = 'Durasi Kirim';
$j13 = 'Term Of Payment';
$j14 = 'User Input';
$j15 = 'Tujuan Kirim';
$j16 = 'Status Invoice';
$j17 = 'Tenggat Waktu';
$j18 = 'user_input_terbit';
$j19 = 'user_input_rilis';
$j20 = 'tarif_ppn';

$tabel2 = 'penjualan_detail';

$ff1 = 'kd_beli';
$ff2 = 'kd_brg';
$ff3 = 'jml';
$ff4 = 'price';
$ff5 = 'currency';
$ff6 = 'kurs';
$ff7 = 'disc';
$ff8 = 'urut';


$jj1 = 'Kode Beli';
$jj2 = 'Kode Barang';
$jj3 = 'Jumlah';
$jj4 = 'Price';
$jj5 = 'Currency';
$jj6 = 'Kurs';
$jj7 = 'Discount';
$jj8 = 'urut';


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
                        <form role="form" action="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=report" method="post">
                          <div class="row">
                            <!-- Batas -------------- -->

                            <div class="col-lg-2">

                              <h4><b>Masukan Rentang Tanggal</b></h4>

                              <div class="form-group">
                                <label>Tanggal Mulai</label>
                                <input type="date" class="form-control" name="tgl_awal" id="tgl_awal" placeholder="Masukkan Tanggal Awal .. (Wajib)" value="<?php echo date('Y-m-d') ?>" required="required" onchange="validateDates()">
                              </div>
                              <div class="form-group">
                                <label>Tanggal Selesai</label>
                                <input type="date" class="form-control" name="tgl_akhir" id="tgl_akhir" value="<?php echo date('Y-m-d') ?>" required="required" onchange="validateDates()">
                              </div>


                              <!-- <div class="form-group">
                                <?php if ($login_hash == 6 or $login_hash == 7 or $login_hash == 8) {
                                  echo '<label>Tanggal Akhir <i>(Max 7 hari)</i></label>';
                                } else {
                                  echo '<label>Tanggal Akhir <i>(Max 31 hari)</i></label>';
                                }
                                ?>
                                <input type="date" class="form-control" name="tgl_akhir" onclick="displayHasil(this.value)" placeholder="Masukkan Tanggal Akhir .. (Wajib)" value="<?php echo date('Y-m-d') ?>" required="required">
                              </div> -->
                            </div>

                            <?php if ($login_hash != '6' and $login_hash != '7' and $login_hash != '2' and $login_hash != '21' and $login_hash != '0') { ?>

                              <!-- Filter -->
                              <div class="col-lg-2">
                                <!-- <div class="col-lg-12"> -->
                                <div class="form-group">
                                  <label>Filter
                                  </label>

                                  <?php if ($login_hash != '8') { ?>
                                    <div>
                                      <input type="radio" name="cakup" onclick="displayResult(this.value)" value="Semua"> Semua
                                    </div>

                                    <div>
                                      <input type="radio" name="cakup" onclick="displayResult(this.value)" value="Area"> Area
                                    </div>

                                    <div>
                                      <input type="radio" name="cakup" onclick="displayResult(this.value)" value="Kota"> Kota
                                    </div>
                                  <?php } ?>

                                  <div>
                                    <input type="radio" name="cakup" onclick="displayResult(this.value)" value="Outlet"> Outlet
                                  </div>


                                  <div class="form-group">
                                    <!-- <label>Cakupan terpilih : </label> -->
                                    <input type="text" id="result" readonly style="width:100;font-size:120%;font-weight:600">
                                  </div>

                                </div>
                                <!-- </div> -->
                              </div>
                              <!-- Filter -->
                            <?php } ?>


                            <!-- Filter Isian-------------- -->

                            <div class="col-lg-3">
                              <div class="row">

                                <div id="isian0" style="display: none;">
                                  <div class="row" style="height:133px">
                                    <div class="col-lg-7">
                                      <div class="form-group">
                                        <form method="post" action="simpan_index.php?act=proses2">
                                        </form>
                                      </div>
                                    </div>

                                  </div>
                                </div>

                                <!-- Show Utk Kota -->
                                <div id="isian1" style="display: none;">
                                  <div class="row">
                                    <div class="col-lg-10">
                                      <div class="form-group">
                                        <form method="post" action="simpan_index.php">
                                          <div class="row">
                                            <div class="col-lg-7">

                                              <label>Kode Kota</label>
                                              <input type="text" class="form-control" required="required" id="tampil_kota_kode" placeholder="Isi Kode Kota">
                                            </div>
                                            <div class="col-lg-5">
                                              <button style="margin-top: 27px" type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#cariKota">
                                                <i class="fa fa-search"></i> Cari Kota
                                              </button>
                                            </div>
                                          </div>

                                          <label>Kota <span id="status_kota"></span></label>
                                          <input type="text" class="form-control" name="kota" value="" required="required" placeholder="Nama Kota .." id="tampil_kota_nama" readonly>

                                        </form>
                                      </div>
                                    </div>

                                    <div class="col-lg-5">
                                      <div class="form-group">

                                        <!-- Modal KOTA-->
                                        <div class="modal fade" id="cariKota" tabindex="-1" role="dialog" aria-labelledby="cariKotaLabel" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                Data KOTA
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;&nbsp; Close</span>
                                                </button>
                                              </div>
                                              <div class="modal-body">

                                                <div class="table-responsive">
                                                  <table class="table table-bordered table-striped table-hover" id="table-datatable-kota">
                                                    <thead>
                                                      <tr>
                                                        <th class="text-center">NO</th>
                                                        <th>KODE KOTA</th>
                                                        <th>NAMA KOTA</th>
                                                        <th>KD AREA</th>
                                                        <th></th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                      <?php
                                                      $no = 1;
                                                      $data = mysqli_query($koneksi, "SELECT kode,nama,kd_area FROM kotabaru ORDER BY kode ASC");
                                                      while ($d = mysqli_fetch_array($data)) {
                                                      ?>
                                                        <tr>
                                                          <td width="1%" class="text-center"><?php echo $no++; ?></td>
                                                          <td width="3%"><?php echo $d['kode']; ?></td>
                                                          <td><?php echo $d['nama']; ?></td>
                                                          <td width="1%" class="text-center"><?php echo $d['kd_area']; ?></td>
                                                          <td width="1%">
                                                            <button type="button" class="btn btn-success btn-sm modal-pilih-kota" id="<?php echo $d['kode']; ?>" kode="<?php echo $d['kode']; ?>" nama="<?php echo $d['nama']; ?>" data-dismiss="modal">Pilih</button>
                                                          </td>
                                                        </tr>
                                                      <?php
                                                      }
                                                      ?>
                                                    </tbody>
                                                  </table>
                                                </div>

                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        <!-- Modal KOTA End-->

                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <!-- Show Utk Kota End-->

                                <!-- Show utk Outlet -->
                                <div id="isian2" style="display: none;">
                                  <div class="row">
                                    <div class="col-lg-10">
                                      <div class="form-group">
                                        <form method="post" action="simpan_index.php">
                                          <div class="row">
                                            <div class="col-lg-7">

                                              <label>Kode Outlet</label>
                                              <input type="text" class="form-control" name="kd_outlet" required="required" id="tampil_outlet_kode" placeholder="Isi Kode Outlet">
                                            </div>
                                            <div class="col-lg-5">
                                              <button style="margin-top: 27px" type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#cariOutlet">
                                                <i class="fa fa-search"></i> Cari Outlet
                                              </button>
                                            </div>
                                          </div>

                                          <label>Outlet <span id="status_outlet"></span></label>
                                          <input type="text" class="form-control" name="outlet" value="" required="required" placeholder="Nama Outlet .." id="tampil_outlet_nama" readonly>

                                        </form>
                                      </div>
                                    </div>

                                    <div class="col-lg-5">
                                      <div class="form-group">

                                        <!-- Modal OUTLET-->
                                        <div class="modal fade" id="cariOutlet" tabindex="-1" role="dialog" aria-labelledby="cariOutletLabel" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                Data OUTLET
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;&nbsp; Close</span>
                                                </button>
                                              </div>
                                              <div class="modal-body">

                                                <div class="table-responsive">
                                                  <table class="table table-bordered table-striped table-hover" id="table-datatable-outlet">
                                                    <thead>
                                                      <tr>
                                                        <th class="text-center">NO</th>
                                                        <th>KODE OUTLET</th>
                                                        <th>NAMA OUTLET</th>
                                                        <th>KD AREA</th>
                                                        <th></th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                      <?php
                                                      $no = 1;
                                                      if ($login_hash != 8) {

                                                        $data = mysqli_query($koneksi, "SELECT kd_cus,nama,kd_area FROM pelanggan ORDER BY kd_cus ASC");
                                                      } else {
                                                        $data = mysqli_query($koneksi, "SELECT kd_cus,nama,kd_area FROM pelanggan WHERE kd_area=$area_e ORDER BY kd_cus ASC");
                                                      }
                                                      while ($d = mysqli_fetch_array($data)) {
                                                      ?>
                                                        <tr>
                                                          <td width="1%" class="text-center"><?php echo $no++; ?></td>
                                                          <td width="3%"><?php echo $d['kd_cus']; ?></td>
                                                          <td><?php echo $d['nama']; ?></td>
                                                          <td width="1%" class="text-center"><?php echo $d['kd_area']; ?></td>
                                                          <td width="1%">
                                                            <button type="button" class="btn btn-success btn-sm modal-pilih-outlet" id="<?php echo $d['kd_cus']; ?>" kode="<?php echo $d['kd_cus']; ?>" nama="<?php echo $d['nama']; ?>" data-dismiss="modal">Pilih</button>
                                                          </td>
                                                        </tr>
                                                      <?php
                                                      }
                                                      ?>
                                                    </tbody>
                                                  </table>
                                                </div>

                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        <!-- Modal OUTLET End-->

                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <!-- Show utk Outlet End -->

                                <!-- Show utk Area -->
                                <div id="isian3" style="display: none;">
                                  <div class="row">
                                    <div class="col-lg-10">
                                      <div class="form-group">
                                        <form method="post" action="simpan_index.php">

                                          <div class="row">
                                            <div class="col-lg-7">
                                              <label>Kode Area</label>
                                              <!-- <input type="hidden" class="form-control" name="area" required="required" id="tampil_area_id"> -->
                                              <input type="text" class="form-control" required="required" id="tampil_area_kode" placeholder="Isi Kode area">
                                            </div>
                                            <div class="col-lg-5">

                                              <button style="margin-top: 27px" type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#cariArea">
                                                <i class="fa fa-search"></i> Cari Area
                                              </button>
                                            </div>
                                          </div>

                                          <label>Area <span id="status_area"></span></label>
                                          <input type="text" class="form-control" name="area" value="" required="required" placeholder="Nama Area .." id="tampil_area_nama" readonly>

                                        </form>
                                      </div>
                                    </div>

                                    <div class="col-lg-5">
                                      <div class="form-group">

                                        <!-- Modal Area-->
                                        <div class="modal fade" id="cariArea" tabindex="-1" role="dialog" aria-labelledby="cariAreaLabel" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                Data AREA
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;&nbsp; CLose</span>
                                                </button>
                                              </div>
                                              <div class="modal-body">

                                                <div class="table-responsive">
                                                  <table class="table table-bordered table-striped table-hover" id="table-datatable-area">
                                                    <thead>
                                                      <tr>
                                                        <th class="text-center">NO</th>
                                                        <th>KODE AREA</th>
                                                        <th>NAMA AREA</th>
                                                        <th></th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                      <?php
                                                      $no = 1;
                                                      $data = mysqli_query($koneksi, "SELECT kode,nama FROM area ORDER BY kode ASC");
                                                      while ($d = mysqli_fetch_array($data)) {
                                                      ?>
                                                        <tr>
                                                          <td width="1%" class="text-center"><?php echo $no++; ?></td>
                                                          <td width="3%"><?php echo $d['kode']; ?></td>
                                                          <td><?php echo $d['nama']; ?></td>
                                                          <td width="1%">
                                                            <button type="button" class="btn btn-success btn-sm modal-pilih-area" id="<?php echo $d['kode']; ?>" kode="<?php echo $d['kode']; ?>" nama="<?php echo $d['nama']; ?>" data-dismiss="modal">Pilih</button>
                                                          </td>
                                                        </tr>
                                                      <?php
                                                      }
                                                      ?>
                                                    </tbody>
                                                  </table>
                                                </div>

                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        <!-- Modal Area End-->

                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <!-- Show utk Area End -->


                              </div>

                            </div>

                            <!-- Filter Isian -->



                            <!-- Generate -->
                            <div class="col-lg-3">

                              <div class="row">
                                <div class="col-lg-12">
                                  <input type="hidden" name="kota" id="tampil_kota_id">
                                  <input type="hidden" name="outlet" id="tampil_outlet_id">
                                  <input type="hidden" name="area" id="tampil_area_id">
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

                      <!-- <input style="width: 100px;"  value="RESET" onclick="window.location='main.php?route=pb1&act';" class="btn btn-sm btn-danger "> -->

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
        // function displayHasil(tgl_awal) {
        //   document.getElementById("tgl_awalHasil").value = tgl_awal;
        // };
        function validateDates() {
          const startDate = document.getElementById('tgl_awal').value;
          const endDate = document.getElementById('tgl_akhir').value;

          const tanggalawal = document.getElementById('tgl_awal');
          const tanggalakhir = document.getElementById('tgl_akhir');

          tanggalakhir.min = startDate;
          tanggalawal.max = endDate;
          if (new Date(endDate) < new Date(startDate)) {
            tanggalakhir.value = startDate;
          }
        }
        document.addEventListener('DOMContentLoaded', validateDates);
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
        function displayResult(cakup) {
          document.getElementById("result").value = cakup;
          var x = document.getElementById("result").value;
          var x0 = document.getElementById("isian0");
          var x1 = document.getElementById("isian1");
          var x2 = document.getElementById("isian2");
          var x3 = document.getElementById("isian3");
          if (x == "Semua") {
            x0.style.display = "block";
            x1.style.display = "none";
            x2.style.display = "none";
            x3.style.display = "none";
            // alert(x + " adalah Filter 2");
          } else if (x == "Kota") {
            x0.style.display = "none";
            x1.style.display = "block";
            x2.style.display = "none";
            x3.style.display = "none";
            // alert(x + " adalah Filter 3");
          } else if (x == "Outlet") {
            x0.style.display = "none";
            x1.style.display = "none";
            x2.style.display = "block";
            x3.style.display = "none";
            // alert(x + " adalah Filter 4");
          } else if (x == "Area") {
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
        if (isset($_GET['alert'])) {
          if ($_GET['alert'] == "gagal") {
            echo "<div class='alert alert-danger'>File yang diperbolehkan hanya file gambar!</div>";
          } elseif ($_GET['alert'] == "duplikat") {
            echo "<div class='alert alert-danger'><b>Kode Barang</b> sudah pernah digunakan!</div>";
          }
        }
        ?>
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


      if ($login_hash == 8) {
        $judul_area = $area_nama;
      } else {
        $judul_area = "";
      }

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
      } else {
        $kondisi = "";
        $judul_nilai = '';
      }


      if ($login_hash == '6' or $login_hash == '7' or $login_hash == '21'  or $login_hash == '2'  or $login_hash == '0') {
        $filter = 'Outlet';
        $query = mysqli_query($koneksi, "SELECT cabang_e FROM employee WHERE employee_number='$en' ");
        $q1 = mysqli_fetch_array($query);
        $nilai = $q1['cabang_e'];
        $kondisi = "AND penjualan.kd_cus='$nilai'";
        $query = mysqli_query($koneksi, "SELECT nama FROM pelanggan WHERE kd_cus='$nilai' ");
        $q1 = mysqli_fetch_array($query);
        $judul_nilai = $q1['nama'];
        // $tgl_akhir=$tgl_awal;
      }

      $tgl1 = new DateTime($tgl_awal);
      $tgl2 = new DateTime($tgl_akhir);
      $selisihtgl = $tgl2->diff($tgl1);
      $selisihtgl = $selisihtgl->days;

      // if ($login_hash == '6' or $login_hash == '7' or $login_hash == '8') {
      //   if ($selisihtgl >= 7) {
      //     $tgl_akhir = date('Y-m-d', strtotime($tgl_awal . ' + 6 days'));
      //     $pesantgl = 'Range Tanggal lebih dari 7 Hari';
      //   }
      // } else {
      //   if ($selisihtgl >= 31) {
      //     $tgl_akhir = date('Y-m-d', strtotime($tgl_awal . ' + 30 days'));
      //     $pesantgl = 'Range Tanggal lebih dari 31 Hari';
      //   }
      // }



      $judul = 'Laporan Paylater';
      $judul2 = $filter . " : " . $judul_nilai . $judul_area;
      $judul3 = 'Tanggal : ' . $tgl_awal . " - " . $tgl_akhir;


    ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" style="background-color: beige; max-height: 1400px!important;">
        <!-- <div style="padding:2px"></div> -->
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
            <!-- <button class="btn btn-primary btn-sm elevation-2 " style="opacity: .7;" onclick="window.location='route/<?php echo $data; ?>/cetak.php?tgl_awal=<?php echo $tgl_awal; ?>&tgl_akhir=<?php echo $tgl_akhir; ?>&filter=<?php echo $filter; ?>&nilai=<?php echo $nilai; ?>&judul=<?php echo $judul; ?>'"><img src="../../assets/icons/print.png" width="20px"> print </button> -->

            <button class="btn btn-primary btn-sm elevation-2 " style="opacity: .7;" onclick="window.location='route/<?php echo $data; ?>/lap_paylater.php?tgl_awal=<?php echo $tgl_awal; ?>&tgl_akhir=<?php echo $tgl_akhir; ?>&filter=<?php echo $filter; ?>&nilai=<?php echo $nilai; ?>&judul=<?php echo $judul; ?>'"><img src="../../assets/icons/excel2.png" width="20px"> export </button>

            <br>
            <center>
              <h4><?php echo $judul; ?>
                <br><?php echo $judul2; ?>
                <br /><?php echo $judul3; ?>
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

                          <?php
                          include 'paylater_hasil.php';
                          ?>



                        </div>
                      </div><!-- /.box-body -->
                    </div><!-- /.box -->
                  </section><!-- /.Left col -->
                </div><!-- /.row (main row) -->
              </div>
            </div>
          </div>
          <br />
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <script>
        $(document).ready(function() {
          $('#example').DataTable({
            lengthMenu: [
              [50, 100, 500, -1],
              [50, 100, 500, 'All'],
            ],

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

<?php
      break;
  }
}
?>