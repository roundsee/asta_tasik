<?php
$login_hash = $_SESSION['login_hash'];
$namauser = $_SESSION['namauser'];

$tujuan = $_GET['tujuan'];

$judulform = "Sales Report ";

$data = 'lap_sales';
$rute = 'rekap_sales_report';
$aksi = 'aksi_rekap_sales_report';

$tabel = "penjualan";
$f1 = 'faktur';
$f2 = 'tanggal';
$f3 = 'kd_cus';
$f4 = 'kd_aplikasi';
$f5 = 'no_meja';
$f6 = 'oleh';
$f7 = 'subjumlah';
$f8 = 'ppn';
$f9 = 'jumlah';
$f10 = 'byr_pocer';
$f11 = 'byr_tunai';
$f12 = 'byr_non_tunai';
$f13 = 'kd_alatbayar';
$f14 = 'no_urut';
$f15 = 'tahun';
$f16 = 'bulan';
$f17 = 'jam';
$f18 = 'kdsub_alatbayar';
$f19 = 'subjumlah_offline';
$f20 = 'ket_aplikasi';
$f21 = 'dasar_fee';
$f22 = 'acuan_fee';
$f23 = 'tarif_fee';
$f24 = 'b_packing';
$f25 = 'no_online';
$f26 = 'no_ofline';
$f27 = 'tarif_pb1';
$f28 = 'faktur_refund';
$f29 = 'dasar_faktur';

$j1 = 'Faktur';
$j2 = 'Tanggal';
$j3 = 'Kode Outlet';
$j4 = 'kd_aplikasi';
$j5 = 'no_meja';
$j6 = 'oleh';
$j7 = 'Sub jumlah';
$j8 = 'PPn';
$j9 = 'Jumlah';
$j10 = 'byr_pocer';
$j11 = 'byr_tunai';
$j12 = 'byr_non_tunai';
$j13 = 'kd_alatbayar';
$j14 = 'no_urut';
$j15 = 'tahun';
$j16 = 'bulan';
$j17 = 'jam';
$j18 = 'kdsub_alatbayar';
$j19 = 'subjumlah_offline';
$j20 = 'ket_aplikasi';
$j21 = 'dasar_fee';
$j22 = 'acuan_fee';
$j23 = 'tarif_fee';
$j24 = 'b_packing';
$j25 = 'no_online';
$j26 = 'no_ofline';
$j27 = 'tarif_pb1';
$j28 = 'faktur_refund';
$j29 = 'dasar_faktur';


$tabel2 = 'kotabaru';
$ff1 = 'kode';
$tabel3 = 'pelanggan';
$gg1 = 'kd_cus';

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
                  <b><?php echo $judulform . $tujuan; ?></b> <small style="font-weight: 100;">report</small>
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
                        <form role="form" action="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=report&tujuan=<?php echo $tujuan; ?>" method="post">
                          <div class="row">
                            <!-- Batas -------------- -->


                            <div class="col-lg-2">

                              <div class="form-group">
                                <label>Tanggal Awal</label>
                                <input type="date" class="form-control" name="tgl_awal" onclick="displayHasil(this.value)" placeholder="Masukkan Tanggal Awal .. (Wajib)" value="<?php echo date('Y-m-d') ?>" required="required">
                              </div>

                              <?php if ($login_hash != '6' and $login_hash != '7') { ?>

                                <div class="form-group">
                                  <label>Tanggal Akhir</label>
                                  <input type="date" class="form-control" name="tgl_akhir" onclick="displayHasil(this.value)" placeholder="Masukkan Tanggal Akhir .. (Wajib)" value="<?php echo date('Y-m-d') ?>" required="required">
                                </div>

                              <?php } ?>

                            </div>

                            <?php if ($login_hash != '6' and $login_hash != '7') { ?>

                              <!-- Filter -->
                              <div class="col-lg-2">
                                <!-- <div class="col-lg-12"> -->
                                <div class="form-group">
                                  <label>Filter
                                  </label>
                                  <!-- <div>
                                      <input type="radio" name="cakup" onclick="displayResult(this.value)" value="Semua"> Semua
                                    </div> -->
                                  <div>
                                    <input type="radio" name="cakup" onclick="displayResult(this.value)" value="Kota"> Kota
                                  </div>
                                  <div>
                                    <input type="radio" name="cakup" onclick="displayResult(this.value)" value="Outlet"> Outlet
                                  </div>
                                  <div>
                                    <input type="radio" name="cakup" onclick="displayResult(this.value)" value="Area"> Area
                                  </div>


                                  <div class="form-group">
                                    <!-- <label>Cakupan terpilih : </label> -->
                                    <input type="text" id="result" required readonly style="width:100;font-size:120%;font-weight:600">
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
                                              <!-- <input type="hidden" class="form-control" name="kota" required="required" id="tampil_kota_id"> -->
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
                                          <input type="text" class="form-control" nama="outlet" value="" required="required" placeholder="Nama Outlet .." id="tampil_outlet_nama" readonly>

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
                                                      $data = mysqli_query($koneksi, "SELECT kd_cus,nama,kd_area FROM pelanggan ORDER BY kd_cus ASC");
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

                                              <input type="text" class="form-control" required="required" id="tampil_area_kode" placeholder="Isi Kode area">
                                            </div>
                                            <div class="col-lg-5">

                                              <button style="margin-top: 27px" type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#cariArea">
                                                <i class="fa fa-search"></i> Cari Area
                                              </button>
                                            </div>
                                          </div>

                                          <label>Area <span id="status_area"></span></label>
                                          <input type="text" class="form-control" nama="area" value="" required="required" placeholder="Nama Area .." id="tampil_area_nama" readonly>

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

                                  <div class="form-group">
                                    <?php if ($login_hash == 6 or $login_hash == 7) { ?>

                                      <input type="submit" class="btn btn-primary elevation-2" style="opacity: .7" value="Generate Report" id="id_generate" />

                                    <?php } else { ?>
                                      <input type="submit" class="btn btn-primary elevation-2" style="opacity: .7" value="Generate Report" id="id_generate" disabled />
                                    <?php } ?>

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
            $('#id_generate').removeAttr('disabled');
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

    <?php
      break;

    case "report";


      $tgl_awal = $_GET['tgl_awal'];
      $tgl_akhir = $_GET['tgl_akhir'];
      $filter = $_GET['filter'];
      $nilai = $_GET['nilai'];

      // $tujuan=$_GET['tujuan'];

      // echo "<br/>".$tgl_awal;
      // echo "<br/>".$tgl_akhir;
      // echo "<br/>".$filter;
      // echo "<br/>".$nilai;
      // echo "<br/>".$login_hash;


      if ($tujuan == 'aplikasi') {
        $kondisi2 = 'Aplikasi';
        $kondisi_group = ' ,penjualan.kd_aplikasi';
      } elseif ($tujuan == 'carabayar') {
        $kondisi2 = 'Cara Bayar';
        $kondisi_group = ' ,penjualan.kd_alatbayar';
      } elseif ($tujuan == 'kasir') {
        $kondisi2 = 'Kasir';
        $kondisi_group = ' ,penjualan.oleh';
      } elseif ($tujuan == 'menu') {
        $kondisi2 = 'Menu';
        $kondisi_group = ' ,jualdetil.kd_brg';
      } else {
        $kondisi2 = '';
        $kondisi_group = '';
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
        $kondisi = "AND pelanggan.kd_area='$nilai'";
        $query = mysqli_query($koneksi, "SELECT nama FROM area WHERE kode='$nilai' ");
        $q1 = mysqli_fetch_array($query);
        $judul_nilai = $q1['nama'];
      } else {
        $kondisi = "";
        $judul_nilai = 'All';
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

      $judul = 'Laporan ' . $judulform;
      $judul2 = $filter . " : " . $judul_nilai;
      $judul3 = 'Date : ' . $tgl_awal . " s/d " . $tgl_akhir;

    ?>

      <!-- <link rel="stylesheet"  href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
          <link rel="stylesheet"  href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css"> -->


      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper " style="background-color: beige;">
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

            <!-- <div class="row"  style="width:600px"> -->

            <button class="btn btn-primary btn-sm elevation-2 " style="opacity: .7;" onclick="window.location='route/<?php echo $data; ?>/cetak.php?tgl_awal=<?php echo $tgl_awal; ?>&tgl_akhir=<?php echo $tgl_akhir; ?>&filter=<?php echo $filter; ?>&nilai=<?php echo $nilai; ?>&judul=<?php echo $judul; ?>'"><img src="../../assets/icons/print.png" width="20px"> print </button>



            <button class="btn btn-primary btn-sm elevation-2 " style="opacity: .7;" onclick="window.location='route/<?php echo $data; ?>/lap_sales_excel.php?tgl_awal=<?php echo $tgl_awal; ?>&tgl_akhir=<?php echo $tgl_akhir; ?>&filter=<?php echo $filter; ?>&nilai=<?php echo $nilai; ?>&judul=<?php echo $judul; ?>'"><img src="../../assets/icons/excel2.png" width="20px"> export</button>

            <br>
            <h4><?php echo $judulform; ?></h4>
            <br>
            <?php echo $judul2; ?>
            <br>
            <?php echo $judul3; ?>
            <br>
            By : <?php echo $namauser; ?>
            <!-- </div> -->

          </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content wow fadeInUp" data-wow-duration=".2s" data-wow-delay=".1s" style="max-width:700px">
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

                      <?php if ($filter == 'outlet' or $login_hash == '6' or $login_hash == '7') { ?>

                        <div class="box-body">
                          <div class="table-responsive">

                            <div style="margin:10px"></div>

                            <table id="example" class="table table-bordered table-striped" style="width:600px">

                              <thead style="background-color:  lightgray;" class="elevation-2">
                                <tr>
                                  <th style="text-align:center;width: 30px;">No.</th>
                                  <th style="width: 400px;">Menu Code</th>
                                  <th style="text-align:right ;width:80px;">Qty</th>
                                  <th style="text-align: right;width: 100px;">Payment</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php


                                // UTK GRAND TOTAL

                                $query = "SELECT 
                                      penjualan.tarif_pb1 as penjualan_tarif_pb1,
                                      sum(penjualan.jumlah) as rekap_jumlah, 
                                      sum(penjualan.ppn) as rekap_ppn, 
                                      sum(penjualan.byr_pocer) as rekap_pocer,
                                      sum(penjualan.subjumlah) as rekap_subjumlah
                                      FROM penjualan 
                                      join jenis_transaksi on jenis_transaksi.kd_jenis=penjualan.kd_aplikasi 
                                      join alat_bayar on alat_bayar.kd_alat=penjualan.kd_alatbayar 
                                      WHERE penjualan.tanggal>='$tgl_awal' AND penjualan.tanggal <= '$tgl_akhir' +interval 1 day AND penjualan.kd_cus='$nilai'
                                      ";

                                $sql = mysqli_query($koneksi, $query);
                                $s1 = mysqli_fetch_array($sql);

                                $tarif_pb1 = $s1['penjualan_tarif_pb1'];


                                $grand_penjualan = $s1['rekap_jumlah'];
                                $grand_pajak = $grand_penjualan * ($tarif_pb1 / 100);
                                $grand_stlh_pajak = $grand_penjualan + $grand_pajak;
                                $grand_ppn = $s1['rekap_ppn'];
                                $grand_pocer = $s1['rekap_pocer'];


                                // $query="SELECT barang.nama as brg_nama, sum(jualdetil.banyak) as rekap_jualdetil_banyak, sum(jualdetil.jumlah) as rekap_jualdetil_jumlah 
                                // FROM jualdetil 
                                // join pelanggan on pelanggan.kd_cus=jualdetil.kd_cus 
                                // join barang on barang.kd_brg=jualdetil.kd_brg 
                                // WHERE jualdetil.tanggal>='$tgl_awal' AND jualdetil.tanggal <= '$tgl_akhir' +interval 1 day AND jualdetil.kd_cus='$nilai' GROUP By jualdetil.kd_brg
                                // ";

                                $query = "SELECT barang.nama as brg_nama, sum(jualdetil.banyak) as rekap_jualdetil_banyak, sum(jualdetil.jumlah) as rekap_jualdetil_jumlah 
                                      FROM penjualan
                                      join jualdetil on jualdetil.faktur=penjualan.faktur 
                                      join pelanggan on pelanggan.kd_cus=jualdetil.kd_cus 
                                      join barang on barang.kd_brg=jualdetil.kd_brg 
                                      WHERE penjualan.tanggal>='$tgl_awal' AND penjualan.tanggal <= '$tgl_akhir' +interval 1 day AND penjualan.kd_cus='$nilai' GROUP By jualdetil.kd_brg
                                      ";

                                $sql1 = mysqli_query($koneksi, $query);
                                $no = 1;

                                $tot_subjumlah = 0;
                                $tot_ppn = 0;
                                $tot_jumlah = 0;

                                $tot_penjualan = 0;
                                $tot_byr_tunai = 0;
                                $tot_byr_non_tunai = 0;
                                $tot_pocer = 0;

                                $grand_jumlah = 0;
                                $nilai_tunai_khusus = 0;

                                while ($s1 = mysqli_fetch_array($sql1)) {

                                ?>
                                  <tr align="left">
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $s1['brg_nama']; ?></td>
                                    <td style="text-align: right;"><?php echo number_format($s1['rekap_jualdetil_banyak']); ?></td>
                                    <td style="text-align: right;"><?php echo number_format($s1['rekap_jualdetil_jumlah']); ?></td>
                                  </tr>
                                <?php
                                  $no++;
                                }
                                ?>
                              </tbody>
                              <tfoot align="right">

                                <?php


                                $query2 = "SELECT 
                                      sum(penjualan.byr_tunai) as rekap_tunai
                                      FROM penjualan 
                                      WHERE penjualan.tanggal>='$tgl_awal' AND penjualan.tanggal <= '$tgl_akhir' +interval 1 day AND penjualan.kd_cus='$nilai' ";

                                $sql2 = mysqli_fetch_array(mysqli_query($koneksi, $query2));

                                $nilai_tunai_khusus = $sql2['rekap_tunai'];


                                $query1 = "SELECT  
                                      alat_bayar.nama as ab_nama,
                                      penjualan.kd_alatbayar as p_alat_bayar, 
                                      sum(penjualan.byr_tunai) as rekap_tunai,
                                      sum(penjualan.byr_non_tunai) as rekap_non_tunai
                                      FROM penjualan
                                      join alat_bayar on alat_bayar.kd_alat=penjualan.kd_alatbayar 
                                      WHERE penjualan.tanggal>='$tgl_awal' AND penjualan.tanggal <= '$tgl_akhir' +interval 1 day AND penjualan.kd_cus='$nilai'
                                      GROUP By p_alat_bayar
                                      ";

                                $sql = mysqli_query($koneksi, $query1);


                                $jumlah_tunai = 0;
                                $jumlah_edc_bca = 0;
                                $jumlah_edc_mandiri = 0;

                                while ($qq1 = mysqli_fetch_array($sql)) {
                                  if ($qq1['ab_nama'] == 'TUNAI') {
                                ?>
                                    <tr>
                                      <td colspan="2"><?php echo $qq1['ab_nama']; ?></td>
                                      <td colspan="2" align="right"><?php echo number_format($nilai_tunai_khusus); ?></td>
                                    </tr>
                                  <?php
                                  } else {
                                  ?>
                                    <tr>
                                      <td colspan="2"><?php echo $qq1['ab_nama']; ?></td>
                                      <td colspan="2" align="right"><?php echo number_format($qq1['rekap_non_tunai']); ?></td>
                                    </tr>

                                <?php
                                  }
                                }

                                ?>

                                <tr>
                                  <td colspan="2">Total Voucher </td>
                                  <td colspan="2" align="right"><?php echo number_format($grand_pocer); ?></td>
                                </tr>

                                <tr>
                                  <td colspan="2">Total Jumlah </td>
                                  <td colspan="2" align="right" style="font-size:105%;font-weight:600"><?php echo number_format($grand_penjualan); ?></td>
                                </tr>
                                <tr>
                                  <td colspan="2">Total Pajak </td>
                                  <td colspan="2" align="right"><?php echo number_format($grand_ppn); ?></td>

                                </tr>
                              </tfoot>

                            </table>

                            <table id="example" class="table table-bordered table-striped" style="width:600px">

                              <thead style="background-color:  lightgray;" class="elevation-2">

                              </thead>
                              <tbody>

                              </tbody>
                              <tfoot>

                                <tr>
                                  <td colspan="2">Total Voucher </td>
                                  <td colspan="2" align="right"><?php echo number_format($grand_pocer); ?></td>
                                </tr>

                                <tr>
                                  <td colspan="2">Total Jumlah </td>
                                  <td colspan="2" align="right" style="font-size:105%;font-weight:600"><?php echo number_format($grand_penjualan); ?></td>
                                </tr>
                                <tr>
                                  <td colspan="2">Total Pajak </td>
                                  <td colspan="2" align="right"><?php echo number_format($grand_ppn); ?></td>
                                </tr>
                              </tfoot>
                            </table>
                          </div><!-- /.box-body -->

                        </div><!-- /.box -->

                      <?php
                      }

                      if ($filter == 'kota') { ?>

                        <div class="box-body">
                          <div class="table-responsive">

                            <div style="margin:10px"></div>

                            <table id="example" class="table table-bordered table-striped" style="width:600px">

                              <thead style="background-color:  lightgray;" class="elevation-2">
                                <tr>
                                  <th style="text-align:center;width: 30px;">No.</th>
                                  <th style="width: 400px;">Menu Code</th>
                                  <th style="text-align:right ;width:80px;">Qty</th>
                                  <th style="text-align: right;width: 100px;">Payment</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php


                                // UTK GRAND TOTAL

                                $query = "SELECT 
                                      penjualan.tarif_pb1 as penjualan_tarif_pb1,
                                      sum(penjualan.jumlah) as rekap_jumlah, 
                                      sum(penjualan.ppn) as rekap_ppn, 
                                      sum(penjualan.byr_pocer) as rekap_pocer,
                                      sum(penjualan.subjumlah) as rekap_subjumlah
                                      FROM penjualan 
                                      join pelanggan on pelanggan.kd_cus=penjualan.kd_cus
                                      join jenis_transaksi on jenis_transaksi.kd_jenis=penjualan.kd_aplikasi 
                                      join alat_bayar on alat_bayar.kd_alat=penjualan.kd_alatbayar 
                                      WHERE penjualan.tanggal>='$tgl_awal' AND penjualan.tanggal <= '$tgl_akhir' +interval 1 day  AND pelanggan.kd_kota='$nilai'
                                      ";



                                $sql = mysqli_query($koneksi, $query);
                                $s1 = mysqli_fetch_array($sql);

                                $tarif_pb1 = $s1['penjualan_tarif_pb1'];


                                $grand_penjualan = $s1['rekap_jumlah'];
                                $grand_pajak = $grand_penjualan * ($tarif_pb1 / 100);
                                $grand_stlh_pajak = $grand_penjualan + $grand_pajak;
                                $grand_ppn = $s1['rekap_ppn'];
                                $grand_pocer = $s1['rekap_pocer'];
                                $grand_subjumlah = $s1['rekap_subjumlah'];

                                $query = "SELECT barang.nama as brg_nama, sum(jualdetil.banyak) as rekap_jualdetil_banyak, sum(jualdetil.jumlah) as rekap_jualdetil_jumlah 
                                      FROM jualdetil 
                                      join pelanggan on pelanggan.kd_cus=jualdetil.kd_cus 
                                      join barang on barang.kd_brg=jualdetil.kd_brg
                                      WHERE jualdetil.tanggal>='$tgl_awal' AND jualdetil.tanggal <= '$tgl_akhir' +interval 1 day AND pelanggan.kd_kota='$nilai' GROUP By jualdetil.kd_brg
                                      ";

                                $sql1 = mysqli_query($koneksi, $query);
                                $no = 1;

                                $grand_jumlah = 0;
                                $nilai_tunai_khusus = 0;


                                while ($s1 = mysqli_fetch_array($sql1)) {

                                ?>
                                  <tr align="left">
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $s1['brg_nama']; ?></td>
                                    <td style="text-align: right;"><?php echo number_format($s1['rekap_jualdetil_banyak']); ?></td>
                                    <td style="text-align: right;"><?php echo number_format($s1['rekap_jualdetil_jumlah']); ?></td>
                                  </tr>
                                <?php
                                  $no++;
                                }
                                ?>
                              </tbody>
                              <tfoot align="right">

                                <?php


                                $query2 = "SELECT 
                                      sum(penjualan.byr_tunai) as rekap_tunai
                                      FROM penjualan 
                                      join pelanggan on pelanggan.kd_cus=penjualan.kd_cus
                                      WHERE penjualan.tanggal>='$tgl_awal' AND penjualan.tanggal <= '$tgl_akhir' +interval 1 day  AND pelanggan.kd_kota='$nilai' ";

                                $sql2 = mysqli_fetch_array(mysqli_query($koneksi, $query2));

                                $nilai_tunai_khusus = $sql2['rekap_tunai'];


                                $query1 = "SELECT  
                                      alat_bayar.nama as ab_nama,
                                      penjualan.kd_alatbayar as p_alat_bayar, 
                                      sum(penjualan.byr_tunai) as rekap_tunai,
                                      sum(penjualan.byr_non_tunai) as rekap_non_tunai
                                      FROM penjualan
                                      join pelanggan on pelanggan.kd_cus=penjualan.kd_cus
                                      join alat_bayar on alat_bayar.kd_alat=penjualan.kd_alatbayar 
                                      WHERE penjualan.tanggal>='$tgl_awal' AND penjualan.tanggal <= '$tgl_akhir' +interval 1 day AND pelanggan.kd_kota='$nilai'
                                      GROUP By p_alat_bayar
                                      ";


                                $sql = mysqli_query($koneksi, $query1);


                                while ($qq1 = mysqli_fetch_array($sql)) {
                                  if ($qq1['ab_nama'] == 'TUNAI') {
                                ?>
                                    <tr>
                                      <td colspan="2"><?php echo $qq1['ab_nama']; ?></td>
                                      <td colspan="2" align="right"><?php echo number_format($nilai_tunai_khusus); ?></td>
                                    </tr>
                                  <?php
                                  } else {
                                  ?>
                                    <tr>
                                      <td colspan="2"><?php echo $qq1['ab_nama']; ?></td>
                                      <td colspan="2" align="right"><?php echo number_format($qq1['rekap_non_tunai']); ?></td>
                                    </tr>

                                <?php
                                  }
                                }

                                ?>

                                <tr>
                                  <td colspan="2">Total Voucher </td>
                                  <td colspan="2" align="right"><?php echo number_format($grand_pocer); ?></td>
                                </tr>

                                <tr>
                                  <td colspan="2">Total Jumlah </td>
                                  <td colspan="2" align="right" style="font-size:105%;font-weight:600"><?php echo number_format($grand_penjualan); ?></td>
                                </tr>
                                <tr>
                                  <td colspan="2">Total Pajak </td>
                                  <td colspan="2" align="right"><?php echo number_format($grand_ppn); ?></td>

                                </tr>
                              </tfoot>

                            </table>

                            <table id="example" class="table table-bordered table-striped" style="width:600px">

                              <thead style="background-color:  lightgray;" class="elevation-2">

                              </thead>
                              <tbody>

                              </tbody>
                              <tfoot>


                                <tr>
                                  <td colspan="2">Total Voucher </td>
                                  <td colspan="2" align="right"><?php echo number_format($grand_pocer); ?></td>
                                </tr>

                                <tr>
                                  <td colspan="2">Total Jumlah </td>
                                  <td colspan="2" align="right" style="font-size:105%;font-weight:600"><?php echo number_format($grand_penjualan); ?></td>
                                </tr>
                                <tr>
                                  <td colspan="2">Total Pajak </td>
                                  <td colspan="2" align="right"><?php echo number_format($grand_ppn); ?></td>
                                </tr>
                              </tfoot>
                            </table>
                          </div><!-- /.box-body -->

                        </div><!-- /.box -->

                      <?php } ?>

                      <?php if ($filter == 'area') { ?>

                        <div class="box-body">
                          <div class="table-responsive">

                            <div style="margin:10px"></div>

                            <table id="example" class="table table-bordered table-striped" style="width:600px">

                              <thead style="background-color:  lightgray;" class="elevation-2">
                                <tr>
                                  <th style="text-align:center;width: 30px;">No.</th>
                                  <th style="width: 400px;">Menu Code</th>
                                  <th style="text-align:right ;width:80px;">Qty</th>
                                  <th style="text-align: right;width: 100px;">Payment</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php


                                // UTK GRAND TOTAL

                                $query = "SELECT 
                                      penjualan.tarif_pb1 as penjualan_tarif_pb1,
                                      sum(penjualan.jumlah) as rekap_jumlah, 
                                      sum(penjualan.ppn) as rekap_ppn, 
                                      sum(penjualan.byr_pocer) as rekap_pocer,
                                      sum(penjualan.subjumlah) as rekap_subjumlah
                                      FROM penjualan 
                                      join pelanggan on pelanggan.kd_cus=penjualan.kd_cus
                                      join jenis_transaksi on jenis_transaksi.kd_jenis=penjualan.kd_aplikasi 
                                      join alat_bayar on alat_bayar.kd_alat=penjualan.kd_alatbayar 
                                      WHERE penjualan.tanggal>='$tgl_awal' AND penjualan.tanggal <= '$tgl_akhir' +interval 1 day AND pelanggan.kd_area='$nilai'
                                      ";



                                $sql = mysqli_query($koneksi, $query);
                                $s1 = mysqli_fetch_array($sql);

                                $tarif_pb1 = $s1['penjualan_tarif_pb1'];


                                $grand_penjualan = $s1['rekap_jumlah'];
                                $grand_pajak = $grand_penjualan * ($tarif_pb1 / 100);
                                $grand_stlh_pajak = $grand_penjualan + $grand_pajak;
                                $grand_ppn = $s1['rekap_ppn'];
                                $grand_pocer = $s1['rekap_pocer'];
                                $grand_subjumlah = $s1['rekap_subjumlah'];

                                $query = "SELECT barang.nama as brg_nama, sum(jualdetil.banyak) as rekap_jualdetil_banyak, sum(jualdetil.jumlah) as rekap_jualdetil_jumlah 
                                      FROM jualdetil 
                                      join pelanggan on pelanggan.kd_cus=jualdetil.kd_cus 
                                      join barang on barang.kd_brg=jualdetil.kd_brg
                                      WHERE jualdetil.tanggal>='$tgl_awal' AND jualdetil.tanggal <= '$tgl_akhir' +interval 1 day AND pelanggan.kd_area='$nilai' GROUP By jualdetil.kd_brg
                                      ";

                                $sql1 = mysqli_query($koneksi, $query);
                                $no = 1;

                                $grand_jumlah = 0;
                                $nilai_tunai_khusus = 0;


                                while ($s1 = mysqli_fetch_array($sql1)) {

                                ?>
                                  <tr align="left">
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $s1['brg_nama']; ?></td>
                                    <td style="text-align: right;"><?php echo number_format($s1['rekap_jualdetil_banyak']); ?></td>
                                    <td style="text-align: right;"><?php echo number_format($s1['rekap_jualdetil_jumlah']); ?></td>
                                  </tr>
                                <?php
                                  $no++;
                                }
                                ?>
                              </tbody>
                              <tfoot align="right">

                                <?php


                                $query2 = "SELECT 
                                      sum(penjualan.byr_tunai) as rekap_tunai
                                      FROM penjualan 
                                      join pelanggan on pelanggan.kd_cus=penjualan.kd_cus
                                      WHERE penjualan.tanggal>='$tgl_awal' AND penjualan.tanggal <= '$tgl_akhir' +interval 1 day AND pelanggan.kd_area='$nilai' ";

                                $sql2 = mysqli_fetch_array(mysqli_query($koneksi, $query2));

                                $nilai_tunai_khusus = $sql2['rekap_tunai'];


                                $query1 = "SELECT  
                                      alat_bayar.nama as ab_nama,
                                      penjualan.kd_alatbayar as p_alat_bayar, 
                                      sum(penjualan.byr_tunai) as rekap_tunai,
                                      sum(penjualan.byr_non_tunai) as rekap_non_tunai
                                      FROM penjualan
                                      join pelanggan on pelanggan.kd_cus=penjualan.kd_cus
                                      join alat_bayar on alat_bayar.kd_alat=penjualan.kd_alatbayar 
                                      WHERE penjualan.tanggal>='$tgl_awal' AND penjualan.tanggal <= '$tgl_akhir' +interval 1 day AND pelanggan.kd_area='$nilai'
                                      GROUP By p_alat_bayar
                                      ";


                                $sql = mysqli_query($koneksi, $query1);


                                while ($qq1 = mysqli_fetch_array($sql)) {
                                  if ($qq1['ab_nama'] == 'TUNAI') {
                                ?>
                                    <tr>
                                      <td colspan="2"><?php echo $qq1['ab_nama']; ?></td>
                                      <td colspan="2" align="right"><?php echo number_format($nilai_tunai_khusus); ?></td>
                                    </tr>
                                  <?php
                                  } else {
                                  ?>
                                    <tr>
                                      <td colspan="2"><?php echo $qq1['ab_nama']; ?></td>
                                      <td colspan="2" align="right"><?php echo number_format($qq1['rekap_non_tunai']); ?></td>
                                    </tr>

                                <?php
                                  }
                                }

                                ?>

                                <tr>
                                  <td colspan="2">Total Voucher </td>
                                  <td colspan="2" align="right"><?php echo number_format($grand_pocer); ?></td>
                                </tr>

                                <tr>
                                  <td colspan="2">Total Jumlah </td>
                                  <td colspan="2" align="right" style="font-size:105%;font-weight:600"><?php echo number_format($grand_penjualan); ?></td>
                                </tr>
                                <tr>
                                  <td colspan="2">Total Pajak </td>
                                  <td colspan="2" align="right"><?php echo number_format($grand_ppn); ?></td>

                                </tr>
                              </tfoot>

                            </table>

                            <table id="example" class="table table-bordered table-striped" style="width:600px">

                              <thead style="background-color:  lightgray;" class="elevation-2">

                              </thead>
                              <tbody>

                              </tbody>
                              <tfoot>

                                <tr>
                                  <td colspan="2">Total Voucher </td>
                                  <td colspan="2" align="right"><?php echo number_format($grand_pocer); ?></td>
                                </tr>

                                <tr>
                                  <td colspan="2">Total Jumlah </td>
                                  <td colspan="2" align="right" style="font-size:105%;font-weight:600"><?php echo number_format($grand_penjualan); ?></td>
                                </tr>
                                <tr>
                                  <td colspan="2">Total Pajak </td>
                                  <td colspan="2" align="right"><?php echo number_format($grand_ppn); ?></td>
                                </tr>
                              </tfoot>
                            </table>
                          </div><!-- /.box-body -->

                        </div><!-- /.box -->

                      <?php } ?>

                      <?php if ($filter == 'semua') { ?>

                        <div class="box-body">
                          <div class="table-responsive">

                            <div style="margin:10px"></div>

                            <table id="example" class="table table-bordered table-striped" style="width:600px">

                              <thead style="background-color:  lightgray;" class="elevation-2">
                                <tr>
                                  <th style="text-align:center;width: 30px;">No.</th>
                                  <th style="width: 400px;">Menu Code</th>
                                  <th style="text-align:right ;width:80px;">Qty</th>
                                  <th style="text-align: right;width: 100px;">Payment</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php


                                // UTK GRAND TOTAL

                                $query = "SELECT 
                                      penjualan.tarif_pb1 as penjualan_tarif_pb1,
                                      sum(penjualan.jumlah) as rekap_jumlah, 
                                      sum(penjualan.ppn) as rekap_ppn, 
                                      sum(penjualan.byr_pocer) as rekap_pocer,
                                      sum(penjualan.subjumlah) as rekap_subjumlah
                                      FROM penjualan 
                                      join jenis_transaksi on jenis_transaksi.kd_jenis=penjualan.kd_aplikasi 
                                      join alat_bayar on alat_bayar.kd_alat=penjualan.kd_alatbayar 
                                      WHERE penjualan.tanggal>='$tgl_awal' AND penjualan.tanggal <= '$tgl_akhir' +interval 1 day 
                                      ";

                                $sql = mysqli_query($koneksi, $query);
                                $s1 = mysqli_fetch_array($sql);

                                $tarif_pb1 = $s1['penjualan_tarif_pb1'];


                                $grand_penjualan = $s1['rekap_jumlah'];
                                $grand_pajak = $grand_penjualan * ($tarif_pb1 / 100);
                                $grand_stlh_pajak = $grand_penjualan + $grand_pajak;
                                $grand_ppn = $s1['rekap_ppn'];
                                $grand_pocer = $s1['rekap_pocer'];
                                $grand_subjumlah = $s1['rekap_subjumlah'];

                                $query = "SELECT barang.nama as brg_nama, 
                                      sum(jualdetil.banyak) as rekap_jualdetil_banyak, 
                                      sum(jualdetil.jumlah) as rekap_jualdetil_jumlah 
                                      FROM jualdetil  
                                      join barang on barang.kd_brg=jualdetil.kd_brg
                                      WHERE jualdetil.tanggal>='$tgl_awal' AND jualdetil.tanggal <= '$tgl_akhir' +interval 1 day  GROUP By jualdetil.kd_brg";

                                $sql1 = mysqli_query($koneksi, $query);
                                $no = 1;

                                $grand_jumlah = 0;
                                $nilai_tunai_khusus = 0;

                                while ($s1 = mysqli_fetch_array($sql1)) {

                                ?>
                                  <tr align="left">
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $s1['brg_nama']; ?></td>
                                    <td style="text-align: right;"><?php echo number_format($s1['rekap_jualdetil_banyak']); ?></td>
                                    <td style="text-align: right;"><?php echo number_format($s1['rekap_jualdetil_jumlah']); ?></td>
                                  </tr>
                                <?php
                                  $no++;
                                }
                                ?>
                              </tbody>
                              <tfoot align="right">

                                <?php

                                $query2 = "SELECT 
                                      sum(penjualan.byr_tunai) as rekap_tunai
                                      FROM penjualan 
                                      WHERE penjualan.tanggal>='$tgl_awal' AND penjualan.tanggal <= '$tgl_akhir' +interval 1 day ";

                                $sql2 = mysqli_fetch_array(mysqli_query($koneksi, $query2));

                                $nilai_tunai_khusus = $sql2['rekap_tunai'];

                                $query1 = "SELECT  
                                      alat_bayar.nama as ab_nama,
                                      penjualan.kd_alatbayar as p_alat_bayar, 
                                      sum(penjualan.byr_tunai) as rekap_tunai,
                                      sum(penjualan.byr_non_tunai) as rekap_non_tunai
                                      FROM penjualan
                                      join alat_bayar on alat_bayar.kd_alat=penjualan.kd_alatbayar 
                                      WHERE penjualan.tanggal>='$tgl_awal' AND penjualan.tanggal <= '$tgl_akhir' +interval 1 day 
                                      GROUP By p_alat_bayar
                                      ";


                                $sql = mysqli_query($koneksi, $query1);

                                while ($qq1 = mysqli_fetch_array($sql)) {
                                  if ($qq1['ab_nama'] == 'TUNAI') {
                                ?>
                                    <tr>
                                      <td colspan="2"><?php echo $qq1['ab_nama']; ?></td>
                                      <td colspan="2" align="right"><?php echo number_format($nilai_tunai_khusus); ?></td>
                                    </tr>
                                  <?php
                                  } else {
                                  ?>
                                    <tr>
                                      <td colspan="2"><?php echo $qq1['ab_nama']; ?></td>
                                      <td colspan="2" align="right"><?php echo number_format($qq1['rekap_non_tunai']); ?></td>
                                    </tr>

                                <?php
                                  }
                                }

                                ?>

                                <tr>
                                  <td colspan="2">Total Voucher </td>
                                  <td colspan="2" align="right"><?php echo number_format($grand_pocer); ?></td>
                                </tr>

                                <tr>
                                  <td colspan="2">Total Jumlah </td>
                                  <td colspan="2" align="right" style="font-size:105%;font-weight:600"><?php echo number_format($grand_penjualan); ?></td>
                                </tr>
                                <tr>
                                  <td colspan="2">Total Pajak </td>
                                  <td colspan="2" align="right"><?php echo number_format($grand_ppn); ?></td>

                                </tr>
                              </tfoot>

                            </table>

                            <table id="example" class="table table-bordered table-striped" style="width:600px">

                              <thead style="background-color:  lightgray;" class="elevation-2">

                              </thead>
                              <tbody>

                              </tbody>
                              <tfoot>

                                <tr>
                                  <td colspan="2">Total Voucher </td>
                                  <td colspan="2" align="right"><?php echo number_format($grand_pocer); ?></td>
                                </tr>

                                <tr>
                                  <td colspan="2">Total Jumlah </td>
                                  <td colspan="2" align="right" style="font-size:105%;font-weight:600"><?php echo number_format($grand_penjualan); ?></td>
                                </tr>
                                <tr>
                                  <td colspan="2">Total Pajak </td>
                                  <td colspan="2" align="right"><?php echo number_format($grand_ppn); ?></td>
                                </tr>
                              </tfoot>
                            </table>
                          </div><!-- /.box-body -->

                        </div><!-- /.box -->

                      <?php } ?>

                  </section><!-- /.Left col -->
                </div><!-- /.row (main row) -->
              </div>
            </div>
          </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <script>
        $(document).ready(function() {
          $('#example').DataTable({
            lengthMenu: [
              [100, 500, 1000, -1],
              [100, 500, 1000, 'All'],
            ],

          });
        });
      </script>


<?php
      break;
  }
}
?>