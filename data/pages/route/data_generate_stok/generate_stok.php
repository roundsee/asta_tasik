<?php
$login_hash = $_SESSION['login_hash'];
$en = $_SESSION['employee_number'];
$to = $_SESSION['to'];
$area_e = $_SESSION['area_e'];
$area_nama = $_SESSION['area_nama'];

$judulform = "Generate QTY To Order ";

$data = 'data_generate_stok';
$rute = 'generate_stok';
$aksi = 'aksi_generate_stok';

$tabel = 'transaksi';
$f1 = 'reff';
$f2 = 'tanggal';
$f3 = 'kode_pasien';
$f4 = 'kode_asuransi';
$f5 = 'no_invoice';
$f6 = 'tanggal_invoice';
$f7 = 'status_Print';

$j1 = 'Reff';
$j2 = 'Tanggal';
$j3 = 'Kode Pasien';
$j4 = 'Kode Asuransi';
$j5 = 'No Invoice';
$j6 = 'Tanggal Invoice';
$j7 = 'Status Print';

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

                                                            <div class="form-group">
                                                                <label>Tanggal Generate</label>
                                                                <input type="date" class="form-control" name="tgl_awal" onclick="displayHasil(this.value)" placeholder="Masukkan Tanggal Awal .. (Wajib)" value="<?php echo date('Y-m-d') ?>" required="required" disabled>
                                                            </div>


                                                            <!-- <div class="form-group">
                                                                <label>Tanggal Akhir</label>
                                                                <input type="date" class="form-control" name="tgl_akhir" onclick="displayHasil(this.value)" placeholder="Masukkan Tanggal Akhir .. (Wajib)" value="<?php echo date('Y-m-d') ?>" required="required">
                                                            </div> -->
                                                        </div>

                                                        <!-- Filter -->


                                                        <!-- Filter -->
                                                        <div class="col-lg-2">
                                                            <!-- <div class="col-lg-12"> -->
                                                            <div class="form-group">
                                                                <label>Generate Berdasarkan :
                                                                </label>
                                                                <div>
                                                                    <input type="radio" name="qtyorderto" onclick="displayResultVoucher(this.value)" value="rata_rata"> Rata Rata Penjualan
                                                                </div>
                                                                <div>
                                                                    <input type="radio" name="qtyorderto" onclick="displayResultVoucher(this.value)" value="tertinggi"> Qty Penjualan Tertinggi
                                                                </div>
                                                                <div>
                                                                    <input type="radio" name="qtyorderto" onclick="displayResultVoucher(this.value)" value="keduanya"> Rata Rata Dan Tertinggi
                                                                </div>
                                                                <div class="form-group">
                                                                    <!-- <label>Cakupan terpilih : </label> -->
                                                                    <input type="text" id="voucherresult" required readonly style="width:100;font-size:120%;font-weight:600">
                                                                </div>

                                                            </div>
                                                            <!-- </div> -->
                                                        </div>
                                                        <!-- Filter -->





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
                                                                                        <div class="col-lg-6">

                                                                                            <label>Kode Asuransi</label>
                                                                                            <input type="text" class="form-control" required="required" id="tampil_asuransi_kode" placeholder="Isi Kode Asuransi">
                                                                                        </div>
                                                                                        <div class="col-lg-6">
                                                                                            <button style="margin-top: 27px" type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#cariAsuransi">
                                                                                                <i class="fa fa-search"></i> Cari Asuransi
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>

                                                                                    <label>Asuransi<span id="status_asuransi"></span></label>
                                                                                    <input type="text" class="form-control" name="asuransi" value="" required="required" placeholder="Nama Asuransi .." id="tampil_asuransi_nama" readonly>

                                                                                </form>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-5">
                                                                            <div class="form-group">

                                                                                <!-- Modal KOTA-->
                                                                                <div class="modal fade" id="cariAsuransi" tabindex="-1" role="dialog" aria-labelledby="cariAsuransiLabel" aria-hidden="true">
                                                                                    <div class="modal-dialog" role="document">
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-header">
                                                                                                DATA ASURANSI
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
                                                                                                                <th>KODE</th>
                                                                                                                <th>ASURANSI/PERUSAHAAN</th>
                                                                                                                <th></th>
                                                                                                            </tr>
                                                                                                        </thead>
                                                                                                        <tbody>
                                                                                                            <?php
                                                                                                            $no = 1;
                                                                                                            $data = mysqli_query($koneksi, "SELECT kd_perusahaan,nama_perusahaan
                                                                                                                                            FROM perusahaan WHERE kd_perusahaan !='P000'                                                                                                                
                                                                                                                                            ORDER BY kd_perusahaan ASC;
                                                                                                                                            ");
                                                                                                            while ($d = mysqli_fetch_array($data)) {
                                                                                                            ?>
                                                                                                                <tr>
                                                                                                                    <td width="1%" class="text-center"><?php echo $no++; ?></td>
                                                                                                                    <td width="1%" class="text-center"><?php echo $d['kd_perusahaan']; ?></td>
                                                                                                                    <td width="3%"><?php echo $d['nama_perusahaan']; ?></td>
                                                                                                                    <td width="1%">
                                                                                                                        <button type="button" class="btn btn-success btn-sm modal-pilih-asuransi" id="<?php echo $d['kd_perusahaan']; ?>" kode="<?php echo $d['kd_perusahaan']; ?>" nama="<?php echo $d['nama_perusahaan']; ?>" data-dismiss="modal">Pilih</button>
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
                                                            </div>

                                                        </div>

                                                        <!-- Filter Isian -->



                                                        <!-- Generate -->
                                                        <div class="col-lg-3">

                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <input type="hidden" name="asuransi" id="tampil_asuransi_id">
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
                        // alert(x + " adalah Filter 2");
                    } else if (x == "Asuransi") {
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
            <script>
                function displayResultVoucher(qtyorderto) {
                    document.getElementById("voucherresult").value = qtyorderto;

                }
            </script>
        <?php
            break;

        case "report";

            $tgl_awal = $_GET['tgl_awal'];
            $tgl_akhir = $_GET['tgl_akhir'];
            $filter = $_GET['filter'];
            $nilai = $_GET['nilai'];
            $qtyorder = $_GET['qtyorderto'];


            // echo "<br/>" . $tgl_awal;
            // echo "<br/>" . $tgl_akhir;
            // echo "<br/>" . $filter;
            // echo "<br/>" . $nilai;

            if ($login_hash == 8) {
                $judul_area = $area_nama;
            } else {
                $judul_area = "";
            }

            if ($filter == 'asuransi') {
                $kondisi = "AND transaksi.kd_asuransi='$nilai'";
                $query = mysqli_query($koneksi, "SELECT nama_perusahaan FROM perusahaan WHERE kd_perusahaan='$nilai'");
                $q1 = mysqli_fetch_array($query);
                $judul_nilai = $q1['nama_perusahaan'];
            } elseif ($filter == 'outlet') {
                $kondisi = "AND asuransi_perusahaan='$nilai'";
                $query = mysqli_query($koneksi, "SELECT asuransi_perusahaan FROM data_tagihan WHERE asuransi_perusahaan='$nilai'");
                $q1 = mysqli_fetch_array($query);
                $judul_nilai = $q1['asuransi_perusahaan'];
            } elseif ($filter == 'area') {
                $kondisi = "AND kotabaru.kd_area='$nilai'";
                $query = mysqli_query($koneksi, "SELECT nama FROM area WHERE kode='$nilai'");
                $q1 = mysqli_fetch_array($query);
                $judul_nilai = $q1['nama'];
            } else {
                $kondisi = "";
                $judul_nilai = '';
            }

            $judul = 'Generate Qty To Order';
            $judul2 = $qtyorder . " : " . $judul_nilai . $judul_area;
            $judul3 = '';

        ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper" style="background-color: white; max-height: 1400px!important;">
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
                        <!-- button save  -->
                        <br>
                        <center>
                            <h4><?php echo $judul; ?>
                                <br><?php echo $judul2; ?>
                                <br /><?php echo $judul3; ?>
                                <br /><?php echo $filter; ?>
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
                                                    <?php if ($filter == 'semua'  && $qtyorder == 'tertinggi') { ?>
                                                        <form id="invoiceForm" action="route/<?php echo $data; ?>/generate_stock_order.php?tgl_awal=<?php echo $tgl_awal; ?>&tgl_akhir=<?php echo $tgl_akhir; ?>&filter=<?php echo $filter; ?>&nilai=<?php echo $nilai; ?>&judul=<?php echo $judul; ?>*&act=keduanya" method="post"> <!-- Form untuk proses penyimpanan -->
                                                            <button type="submit" class="btn btn-success mb-3"><i class="fas fa-save"></i> Generate Purchase Request </button> <!-- Tombol Save di atas tabel -->
                                                            <table id="example" class="table table-bordered table-striped">
                                                                <thead style="background-color: lightgray;" class="elevation-2">
                                                                    <tr style="text-align: center;">
                                                                        <th rowspan="2">No.</th>
                                                                        <th rowspan="2">Kode Barang</th>
                                                                        <th rowspan="2">Nama Barang</th>
                                                                        <th rowspan="2">Buffer</th>
                                                                        <th rowspan="2">nilai buffer</th>
                                                                        <th rowspan="2">Stok Akhir</th>
                                                                        <th rowspan="2">Perhitungan Stok Akhir</th>
                                                                        <!-- <th style="text-align: center; background-color:#8EACCD;" colspan="4">Total</th> -->

                                                                        <th style="text-align: center; background-color:#B0BEC5;" colspan="4">Rata-rata penjualan perhari dalam 7 hari</th>
                                                                        <!-- <th style="text-align: center; background-color:#B3E5FC;" colspan="4">Tertinggi Perminggu</th> -->
                                                                        <th rowspan="2">Tertinggi Penjualan per minggu dalam 4 minggu</th>
                                                                        <th rowspan="2">Waktu Kirim</th>
                                                                        <th rowspan="2">Waktu Kirim berdasarkan barang</th>
                                                                        <th rowspan="2">Current Order Tertinggi</th>
                                                                        <th rowspan="2">Minimum Order</th>
                                                                        <th rowspan="2">Barang yang harus dipesan tidak sesuai jadwal</th>

                                                                    <tr style="text-align: center;">
                                                                        <!-- Untuk Total -->
                                                                        <!-- <th style="background-color: #D2E0FB;">I</th>
                                                                        <th style="background-color: #D2E0FB;">II</th>
                                                                        <th style="background-color: #D2E0FB;">III</th>
                                                                        <th style="background-color: #D2E0FB;">IV</th> -->
                                                                        <!-- Untuk Rata Rata -->
                                                                        <th style="background-color: #CFD8DC;">I</th>
                                                                        <th style="background-color: #CFD8DC;">II</th>
                                                                        <th style="background-color: #CFD8DC;">III</th>
                                                                        <th style="background-color: #CFD8DC;">IV</th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $query_kd_brg = "SELECT DISTINCT kd_brg FROM barang";
                                                                    $result_kd_brg = mysqli_query($koneksi, $query_kd_brg);

                                                                    if ($result_kd_brg && mysqli_num_rows($result_kd_brg) > 0) {
                                                                        $no = 1;
                                                                        while ($row_kd_brg = mysqli_fetch_assoc($result_kd_brg)) {
                                                                            $kd_brg = $row_kd_brg['kd_brg'];

                                                                            // Menentukan tanggal awal dan akhir minggu
                                                                            $start_date = date('Y-m-d', strtotime('Monday this week')); // 9 September 2024 jatuh di hari Senin, jadi ini 9 September 2024
                                                                            $start_date = date('Y-m-d', strtotime('last Monday', strtotime($start_date))); // Mengubah ke Senin minggu sebelumnya

                                                                            // Menghitung tanggal untuk setiap minggu
                                                                            $week1_start = date('Y-m-d', strtotime($start_date . ' - 21 days')); // 12 Agustus 2024
                                                                            $week1_end = date('Y-m-d', strtotime($start_date . ' - 15 days')); // 18 Agustus 2024
                                                                            $week2_start = date('Y-m-d', strtotime($start_date . ' - 14 days')); // 19 Agustus 2024
                                                                            $week2_end = date('Y-m-d', strtotime($start_date . ' - 8 days')); // 25 Agustus 2024
                                                                            $week3_start = date('Y-m-d', strtotime($start_date . ' - 7 days')); // 26 Agustus 2024
                                                                            $week3_end = date('Y-m-d', strtotime($start_date . ' - 1 days')); // 1 September 2024
                                                                            $week4_start = $start_date; // 2 September 2024
                                                                            $week4_end = date('Y-m-d', strtotime($start_date . ' + 6 days')); // 8 September 2024
                                                                            $end_date = $week4_end;
                                                                            // Debugging: Print tanggal minggu
                                                                            // echo '<pre>';
                                                                            // echo 'Tanggal Minggu I: Dari ' . $week1_start . ' sampai ' . $week1_end . PHP_EOL;
                                                                            // echo 'Tanggal Minggu II: Dari ' . $week2_start . ' sampai ' . $week2_end . PHP_EOL;
                                                                            // echo 'Tanggal Minggu III: Dari ' . $week3_start . ' sampai ' . $week3_end . PHP_EOL;
                                                                            // echo 'Tanggal Minggu IV: Dari ' . $week4_start . ' sampai ' . $week4_end . PHP_EOL;
                                                                            // echo '</pre>';

                                                                            // Query untuk menghitung total, rata-rata, dan tertinggi per minggu
                                                                            $query_per_minggu = "
                                                                                SELECT 
                                                                                     SUM(CASE WHEN tanggal BETWEEN '$week1_start' AND '$week1_end' THEN banyak * qty_satuan ELSE 0 END) AS total_minggu_I,
                                                                                    SUM(CASE WHEN tanggal BETWEEN '$week2_start' AND '$week2_end' THEN banyak * qty_satuan  ELSE 0 END) AS total_minggu_II,
                                                                                    SUM(CASE WHEN tanggal BETWEEN '$week3_start' AND '$week3_end' THEN banyak * qty_satuan ELSE 0 END) AS total_minggu_III,
                                                                                    SUM(CASE WHEN tanggal BETWEEN '$week4_start' AND '$week4_end' THEN banyak * qty_satuan ELSE 0 END) AS total_minggu_IV
                                                                                FROM 
                                                                                    jualdetil
                                                                                WHERE 
                                                                                    kd_brg = '$kd_brg'
                                                                                    AND tanggal BETWEEN '$week1_start' AND '$end_date'
                                                                                ";

                                                                            $result_per_minggu = mysqli_query($koneksi, $query_per_minggu);

                                                                            // Debugging: Check if query was successful
                                                                            if (!$result_per_minggu) {
                                                                                die('Query error: ' . mysqli_error($koneksi));
                                                                            }

                                                                            // Fetch the result
                                                                            $row_per_minggu = mysqli_fetch_assoc($result_per_minggu);

                                                                            // Debugging: Print the raw result from the query
                                                                            // echo '<pre>';
                                                                            // print_r($row_per_minggu);
                                                                            // echo '</pre>';

                                                                            // Extract values from the query
                                                                            $total_minggu_I = isset($row_per_minggu['total_minggu_I']) ? $row_per_minggu['total_minggu_I'] : 0;
                                                                            $total_minggu_II = isset($row_per_minggu['total_minggu_II']) ? $row_per_minggu['total_minggu_II'] : 0;
                                                                            $total_minggu_III = isset($row_per_minggu['total_minggu_III']) ? $row_per_minggu['total_minggu_III'] : 0;
                                                                            $total_minggu_IV = isset($row_per_minggu['total_minggu_IV']) ? $row_per_minggu['total_minggu_IV'] : 0;

                                                                            // $rata_minggu_I = isset($row_per_minggu['rata_minggu_I']) ? $row_per_minggu['rata_minggu_I'] : 0;
                                                                            // $rata_minggu_II = isset($row_per_minggu['rata_minggu_II']) ? $row_per_minggu['rata_minggu_II'] : 0;
                                                                            // $rata_minggu_III = isset($row_per_minggu['rata_minggu_III']) ? $row_per_minggu['rata_minggu_III'] : 0;
                                                                            // $rata_minggu_IV = isset($row_per_minggu['rata_minggu_IV']) ? $row_per_minggu['rata_minggu_IV'] : 0;
                                                                            // Calculate average per week
                                                                            $rata_minggu_I = round($total_minggu_I / 7);
                                                                            $rata_minggu_II = round($total_minggu_II / 7);
                                                                            $rata_minggu_III = round($total_minggu_III / 7);
                                                                            $rata_minggu_IV = round($total_minggu_IV / 7);


                                                                            // $max_rata_per_minggu = max($rata_minggu_I, $rata_minggu_II, $rata_minggu_III, $rata_minggu_III);
                                                                            $max_rata_per_minggu = ($rata_minggu_I + $rata_minggu_II + $rata_minggu_III + $rata_minggu_IV) / 4;

                                                                            $tertinggi_minggu_I = isset($row_per_minggu['tertinggi_minggu_I']) ? $row_per_minggu['tertinggi_minggu_I'] : 0;
                                                                            $tertinggi_minggu_II = isset($row_per_minggu['tertinggi_minggu_II']) ? $row_per_minggu['tertinggi_minggu_II'] : 0;
                                                                            $tertinggi_minggu_III = isset($row_per_minggu['tertinggi_minggu_III']) ? $row_per_minggu['tertinggi_minggu_III'] : 0;
                                                                            $tertinggi_minggu_IV = isset($row_per_minggu['tertinggi_minggu_IV']) ? $row_per_minggu['tertinggi_minggu_IV'] : 0;

                                                                            $max_tertinggi_perminggu = max($rata_minggu_I, $rata_minggu_II, $rata_minggu_III, $rata_minggu_IV);



                                                                            // Query untuk mencari kd_supp di tabel supplier_barang berdasarkan kd_brg
                                                                            $query_kd_supp = "SELECT kd_supp , durasi_kirim , minimum_order FROM supplier_barang WHERE kd_brg = '$kd_brg'";
                                                                            $result_kd_supp = mysqli_query($koneksi, $query_kd_supp);
                                                                            $row_kd_supp = $result_kd_supp ? mysqli_fetch_assoc($result_kd_supp) : [];
                                                                            $kd_supp = isset($row_kd_supp['kd_supp']) ? $row_kd_supp['kd_supp'] : '';
                                                                            $waktu_kirim_barang = isset($row_kd_supp['durasi_kirim']) ? $row_kd_supp['durasi_kirim'] : 0;
                                                                            $minimum_order = isset($row_kd_supp['minimum_order']) ? $row_kd_supp['minimum_order'] : 0;

                                                                            // Query untuk mencari durasi_waktu di tabel supplier berdasarkan kd_supp
                                                                            $query_durasi_waktu = "SELECT term FROM supplier WHERE kd_supp = '$kd_supp'";
                                                                            $result_durasi_waktu = mysqli_query($koneksi, $query_durasi_waktu);
                                                                            $row_durasi_waktu = $result_durasi_waktu ? mysqli_fetch_assoc($result_durasi_waktu) : [];
                                                                            $waktu_kirim_supplier = isset($row_durasi_waktu['term']) ? $row_durasi_waktu['term'] : 0;

                                                                            // Hitung Qty Order dan Qty Order Max Jual
                                                                            // $qty_order = $max_rata_per_minggu * $waktu_kirim_supplier;
                                                                            // $qty_order_max_jual = $max_tertinggi_perminggu * $waktu_kirim_supplier;

                                                                            // hitung stok aman satu minggu kedepan
                                                                            $estimasi = $max_rata_per_minggu * 7;

                                                                            // Ambil stok akhir dari tabel barang
                                                                            $query_stok_akhir = "SELECT sum(inventory.stok)as Quantity , barang.nama , barang.ktg_buffer FROM barang join inventory on inventory.kd_brg = barang.kd_brg WHERE barang.kd_brg = '$kd_brg'";
                                                                            $result_stok_akhir = mysqli_query($koneksi, $query_stok_akhir);
                                                                            $row_stok_akhir = $result_stok_akhir ? mysqli_fetch_assoc($result_stok_akhir) : [];
                                                                            $perhitungan_stok_akhir = isset($row_stok_akhir['Quantity']) ? $row_stok_akhir['Quantity'] : 0;
                                                                            $nama_barang = $row_stok_akhir['nama'];
                                                                            $ktg_buffer = $row_stok_akhir['ktg_buffer'];

                                                                            // Mengecek jumlah kategorinya ada berapa
                                                                            $query_cek_buffer = "SELECT nilai FROM kategori_buffer WHERE kd_kat = '$ktg_buffer'";
                                                                            $result_cek_buffer = mysqli_query($koneksi, $query_cek_buffer);

                                                                            if ($result_cek_buffer && mysqli_num_rows($result_cek_buffer) > 0) {
                                                                                $row_nilai_buffer = mysqli_fetch_assoc($result_cek_buffer);
                                                                                $nilai_buffer = $row_nilai_buffer['nilai'];
                                                                            } else {
                                                                                $nilai_buffer = 0;
                                                                            }


                                                                            // Hitung Qty Order dan Qty Order Max Jual
                                                                            // $qty_order = $max_rata_per_minggu * $waktu_kirim_supplier;
                                                                            $qty_order = ((7 * $max_rata_per_minggu) + ($waktu_kirim_barang * $max_rata_per_minggu)) - $perhitungan_stok_akhir;
                                                                            $qty_order_max_jual = ((7 * $max_tertinggi_perminggu) + ($waktu_kirim_barang * $max_tertinggi_perminggu)) - $perhitungan_stok_akhir;

                                                                            $buffer = round($qty_order * ($nilai_buffer / 100));
                                                                            $stok_akhir = $perhitungan_stok_akhir + $buffer;


                                                                            $estimasi_tidak_aman = ($max_rata_per_minggu * $waktu_kirim_barang) - $perhitungan_stok_akhir;


                                                                            // Tentukan status rata rata
                                                                            // if ($stok_akhir < $qty_order) {
                                                                            //     $status_rata = '<span class="badge bg-danger" style="padding: 8px 16px; font-size: 14px; border-radius: 8px; cursor: not-allowed;">Pesan</span>';
                                                                            // } else {
                                                                            //     $status_rata = '<span class="badge bg-success" style="padding: 8px 16px; font-size: 14px; border-radius: 8px; cursor: not-allowed;">Aman</span>';
                                                                            // }                                                                            // Tentukan Status Tertinggi
                                                                            // if ($stok_akhir < $qty_order_max_jual) {
                                                                            //     $status = '<span class="badge bg-danger" style="padding: 8px 16px; font-size: 14px; border-radius: 8px; cursor: not-allowed;">Pesan</span>';
                                                                            // } else {
                                                                            //     $status = '<span class="badge bg-success" style="padding: 8px 16px; font-size: 14px; border-radius: 8px; cursor: not-allowed;">Aman</span>';
                                                                            // }
                                                                            if ($estimasi_tidak_aman < 0) {
                                                                                $status = '<span class="badge bg-danger" style="padding: 8px 16px; font-size: 14px; border-radius: 8px; cursor: not-allowed;">Pesan</span>';
                                                                            } else {
                                                                                $status = '<span class="badge bg-success" style="padding: 8px 16px; font-size: 14px; border-radius: 8px; cursor: not-allowed;">Aman</span>';
                                                                            }





                                                                    ?>
                                                                            <tr align="left">
                                                                                <td><?php echo $no; ?></td>
                                                                                <td><?php echo $kd_brg; ?></td>
                                                                                <td><?php echo $nama_barang; ?></td>
                                                                                <td style="text-align:right;"><?php echo number_format($buffer); ?></td>
                                                                                <td style="text-align:right;"><?php echo number_format($nilai_buffer); ?> %</td>
                                                                                <td style="text-align:right;"><?php echo number_format($stok_akhir); ?></td>
                                                                                <td style="text-align:right;"><?php echo number_format($perhitungan_stok_akhir); ?></td>
                                                                                <td style="background-color: rgba(207, 216, 220, 0.6); text-align:right;"><?php echo number_format($rata_minggu_I); ?></td>
                                                                                <td style="background-color: rgba(207, 216, 220, 0.6); text-align:right;"><?php echo number_format($rata_minggu_II); ?></td>
                                                                                <td style="background-color: rgba(207, 216, 220, 0.6); text-align:right;"><?php echo number_format($rata_minggu_III); ?></td>
                                                                                <td style="background-color: rgba(207, 216, 220, 0.6); text-align:right;"><?php echo number_format($rata_minggu_IV); ?></td>
                                                                                <td style="text-align:right;"><?php echo number_format($max_tertinggi_perminggu); ?></td>
                                                                                <td style="text-align:right;"><?php echo $waktu_kirim_supplier . " Hari"; ?></td>
                                                                                <td style="text-align:right;"><?php echo $waktu_kirim_barang . " Hari"; ?></td>
                                                                                <td style="text-align:right;">
                                                                                    <input type="radio" name="selection_<?php echo $kd_brg; ?>" value="qty_order_tertinggi_<?php echo $kd_brg; ?>" class="largeRadio">
                                                                                    <?php echo number_format($qty_order_max_jual); ?>
                                                                                    <input type="hidden" name="qty_order_max_<?php echo $kd_brg; ?>" value="<?php echo $qty_order_max_jual; ?>">


                                                                                    <input type="hidden" name="kd_brg_<?php echo $kd_brg; ?>" value="<?php echo $kd_brg; ?>">
                                                                                    <input type="hidden" name="nama_barang_<?php echo $kd_brg; ?>" value="<?php echo $nama_barang; ?>">
                                                                                    <input type="hidden" name="buffer_<?php echo $kd_brg; ?>" value="<?php echo $buffer; ?>">
                                                                                    <input type="hidden" name="stok_akhir_<?php echo $kd_brg; ?>" value="<?php echo $stok_akhir; ?>">
                                                                                    <input type="hidden" name="perhitungan_stok_akhir_<?php echo $kd_brg; ?>" value="<?php echo $perhitungan_stok_akhir; ?>">
                                                                                    <input type="hidden" name="rata_minggu_I_<?php echo $kd_brg; ?>" value="<?php echo $rata_minggu_I; ?>">
                                                                                    <input type="hidden" name="rata_minggu_II_<?php echo $kd_brg; ?>" value="<?php echo $rata_minggu_II; ?>">
                                                                                    <input type="hidden" name="rata_minggu_III_<?php echo $kd_brg; ?>" value="<?php echo $rata_minggu_III; ?>">
                                                                                    <input type="hidden" name="rata_minggu_IV_<?php echo $kd_brg; ?>" value="<?php echo $rata_minggu_IV; ?>">
                                                                                    <input type="hidden" name="max_rata_per_minggu_<?php echo $kd_brg; ?>" value="<?php echo $max_rata_per_minggu; ?>">
                                                                                    <input type="hidden" name="max_tertinggi_perminggu_<?php echo $kd_brg; ?>" value="<?php echo $max_tertinggi_perminggu; ?>">
                                                                                    <input type="hidden" name="waktu_kirim_supplier_<?php echo $kd_brg; ?>" value="<?php echo $waktu_kirim_supplier; ?>">
                                                                                    <input type="hidden" name="waktu_kirim_barang_<?php echo $kd_brg; ?>" value="<?php echo $waktu_kirim_barang; ?>">
                                                                                    <input type="hidden" name="kd_supp_<?php echo $kd_brg; ?>" value="<?php echo $kd_supp; ?>">
                                                                                </td>

                                                                                <td style="text-align:right;">
                                                                                    <input type="radio" name="selection_<?php echo $kd_brg; ?>" value="minimum_order_<?php echo $kd_brg; ?>" class="largeRadio">
                                                                                    <?php echo $minimum_order; ?>
                                                                                    <input type="hidden" name="minimum_order_<?php echo $kd_brg; ?>" value="<?php echo $minimum_order; ?>">
                                                                                </td>
                                                                                <?php if ($estimasi_tidak_aman < 0) { ?>
                                                                                    <td style="text-align:right;"><?php echo number_format($estimasi_tidak_aman); ?></td>
                                                                                <?php } else { ?>
                                                                                    <td></td>
                                                                                <?php } ?>
                                                                            </tr><?php
                                                                                    $no++;
                                                                                }
                                                                            } else {
                                                                                echo "<tr><td colspan='21' align='center'>Data tidak ditemukan</td></tr>";
                                                                            }
                                                                                    ?>
                                                                </tbody>
                                                            </table>


                                                        </form>
                                                    <?php } elseif ($filter == 'semua' && $qtyorder == 'rata_rata') { ?>
                                                        <form id="invoiceForm" action="route/<?php echo $data; ?>/generate_stock_order.php?tgl_awal=<?php echo $tgl_awal; ?>&tgl_akhir=<?php echo $tgl_akhir; ?>&filter=<?php echo $filter; ?>&nilai=<?php echo $nilai; ?>&judul=<?php echo $judul; ?>*&act=keduanya" method="post"> <!-- Form untuk proses penyimpanan -->
                                                            <button type="submit" class="btn btn-success mb-3"><i class="fas fa-save"></i> Generate Purchase Request </button> <!-- Tombol Save di atas tabel -->
                                                            <table id="example" class="table table-bordered table-striped">
                                                                <thead style="background-color: lightgray;" class="elevation-2">
                                                                    <tr style="text-align: center;">
                                                                        <th rowspan="2">No.</th>
                                                                        <th rowspan="2">Kode Barang</th>
                                                                        <th rowspan="2">Nama Barang</th>
                                                                        <th rowspan="2">Buffer</th>
                                                                        <th rowspan="2">nilai buffer</th>
                                                                        <th rowspan="2">Stok Akhir</th>
                                                                        <th rowspan="2">Perhitungan Stok Akhir</th>

                                                                        <th style="text-align: center; background-color:#B0BEC5;" colspan="4">Rata-rata penjualan perhari dalam 7 hari</th>
                                                                        <th rowspan="2">Rata-rata penjualan perminggu dalam 4 minggu</th>
                                                                        <th rowspan="2">Waktu Kirim berdasarkan barang</th>
                                                                        <th rowspan="2">Current Order Rata-rata</th>
                                                                        <th rowspan="2">Minimum Order</th>
                                                                        <th rowspan="2">Barang yang harus dipesan tidak sesuai jadwal</th>

                                                                    </tr>
                                                                    <tr style="text-align: center;">
                                                                        <!-- Untuk Rata Rata -->
                                                                        <th style="background-color: #CFD8DC;">I</th>
                                                                        <th style="background-color: #CFD8DC;">II</th>
                                                                        <th style="background-color: #CFD8DC;">III</th>
                                                                        <th style="background-color: #CFD8DC;">IV</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $query_kd_brg = "SELECT DISTINCT kd_brg FROM barang";
                                                                    $result_kd_brg = mysqli_query($koneksi, $query_kd_brg);

                                                                    if ($result_kd_brg && mysqli_num_rows($result_kd_brg) > 0) {
                                                                        $no = 1;
                                                                        while ($row_kd_brg = mysqli_fetch_assoc($result_kd_brg)) {
                                                                            $kd_brg = $row_kd_brg['kd_brg'];

                                                                            // Menentukan tanggal awal dan akhir minggu
                                                                            $start_date = date('Y-m-d', strtotime('Monday this week')); // 9 September 2024 jatuh di hari Senin, jadi ini 9 September 2024
                                                                            $start_date = date('Y-m-d', strtotime('last Monday', strtotime($start_date))); // Mengubah ke Senin minggu sebelumnya

                                                                            // Menghitung tanggal untuk setiap minggu
                                                                            $week1_start = date('Y-m-d', strtotime($start_date . ' - 21 days')); // 12 Agustus 2024
                                                                            $week1_end = date('Y-m-d', strtotime($start_date . ' - 15 days')); // 18 Agustus 2024
                                                                            $week2_start = date('Y-m-d', strtotime($start_date . ' - 14 days')); // 19 Agustus 2024
                                                                            $week2_end = date('Y-m-d', strtotime($start_date . ' - 8 days')); // 25 Agustus 2024
                                                                            $week3_start = date('Y-m-d', strtotime($start_date . ' - 7 days')); // 26 Agustus 2024
                                                                            $week3_end = date('Y-m-d', strtotime($start_date . ' - 1 days')); // 1 September 2024
                                                                            $week4_start = $start_date; // 2 September 2024
                                                                            $week4_end = date('Y-m-d', strtotime($start_date . ' + 6 days')); // 8 September 2024
                                                                            $end_date = $week4_end;
                                                                            // Debugging: Print tanggal minggu
                                                                            // echo '<pre>';
                                                                            // echo 'Tanggal Minggu I: Dari ' . $week1_start . ' sampai ' . $week1_end . PHP_EOL;
                                                                            // echo 'Tanggal Minggu II: Dari ' . $week2_start . ' sampai ' . $week2_end . PHP_EOL;
                                                                            // echo 'Tanggal Minggu III: Dari ' . $week3_start . ' sampai ' . $week3_end . PHP_EOL;
                                                                            // echo 'Tanggal Minggu IV: Dari ' . $week4_start . ' sampai ' . $week4_end . PHP_EOL;
                                                                            // echo '</pre>';

                                                                            // Query untuk menghitung total, rata-rata, dan tertinggi per minggu
                                                                            $query_per_minggu = "
                                                                                SELECT 
                                                                                    SUM(CASE WHEN tanggal BETWEEN '$week1_start' AND '$week1_end' THEN banyak * qty_satuan ELSE 0 END) AS total_minggu_I,
                                                                                    SUM(CASE WHEN tanggal BETWEEN '$week2_start' AND '$week2_end' THEN banyak * qty_satuan  ELSE 0 END) AS total_minggu_II,
                                                                                    SUM(CASE WHEN tanggal BETWEEN '$week3_start' AND '$week3_end' THEN banyak * qty_satuan ELSE 0 END) AS total_minggu_III,
                                                                                    SUM(CASE WHEN tanggal BETWEEN '$week4_start' AND '$week4_end' THEN banyak * qty_satuan ELSE 0 END) AS total_minggu_IV
                                                                                FROM 
                                                                                    jualdetil
                                                                                WHERE 
                                                                                    kd_brg = '$kd_brg'
                                                                                    AND tanggal BETWEEN '$week1_start' AND '$end_date'
                                                                                ";

                                                                            $result_per_minggu = mysqli_query($koneksi, $query_per_minggu);

                                                                            // Debugging: Check if query was successful
                                                                            if (!$result_per_minggu) {
                                                                                die('Query error: ' . mysqli_error($koneksi));
                                                                            }

                                                                            // Fetch the result
                                                                            $row_per_minggu = mysqli_fetch_assoc($result_per_minggu);


                                                                            // Extract values from the query
                                                                            $total_minggu_I = isset($row_per_minggu['total_minggu_I']) ? $row_per_minggu['total_minggu_I'] : 0;
                                                                            $total_minggu_II = isset($row_per_minggu['total_minggu_II']) ? $row_per_minggu['total_minggu_II'] : 0;
                                                                            $total_minggu_III = isset($row_per_minggu['total_minggu_III']) ? $row_per_minggu['total_minggu_III'] : 0;
                                                                            $total_minggu_IV = isset($row_per_minggu['total_minggu_IV']) ? $row_per_minggu['total_minggu_IV'] : 0;

                                                                            // Calculate average per week
                                                                            $rata_minggu_I = round($total_minggu_I / 7);
                                                                            $rata_minggu_II = round($total_minggu_II / 7);
                                                                            $rata_minggu_III = round($total_minggu_III / 7);
                                                                            $rata_minggu_IV = round($total_minggu_IV / 7);


                                                                            // $max_rata_per_minggu = max($rata_minggu_I, $rata_minggu_II, $rata_minggu_III, $rata_minggu_III);
                                                                            $max_rata_per_minggu = ($rata_minggu_I + $rata_minggu_II + $rata_minggu_III + $rata_minggu_IV) / 4;


                                                                            $max_tertinggi_perminggu = max($rata_minggu_I, $rata_minggu_II, $rata_minggu_III, $rata_minggu_IV);


                                                                            // Query untuk mencari kd_supp di tabel supplier_barang berdasarkan kd_brg
                                                                            $query_kd_supp = "SELECT kd_supp , durasi_kirim , minimum_order FROM supplier_barang WHERE kd_brg = '$kd_brg'";
                                                                            $result_kd_supp = mysqli_query($koneksi, $query_kd_supp);
                                                                            $row_kd_supp = $result_kd_supp ? mysqli_fetch_assoc($result_kd_supp) : [];
                                                                            $kd_supp = isset($row_kd_supp['kd_supp']) ? $row_kd_supp['kd_supp'] : '';
                                                                            $waktu_kirim_barang = isset($row_kd_supp['durasi_kirim']) ? $row_kd_supp['durasi_kirim'] : 0;
                                                                            $minimum_order = isset($row_kd_supp['minimum_order']) ? $row_kd_supp['minimum_order'] : 0;

                                                                            // Query untuk mencari durasi_waktu di tabel supplier berdasarkan kd_supp
                                                                            $query_durasi_waktu = "SELECT term FROM supplier WHERE kd_supp = '$kd_supp'";
                                                                            $result_durasi_waktu = mysqli_query($koneksi, $query_durasi_waktu);
                                                                            $row_durasi_waktu = $result_durasi_waktu ? mysqli_fetch_assoc($result_durasi_waktu) : [];
                                                                            $waktu_kirim_supplier = isset($row_durasi_waktu['term']) ? $row_durasi_waktu['term'] : 0;


                                                                            // hitung stok aman satu minggu kedepan
                                                                            $estimasi = $max_rata_per_minggu * 7;

                                                                            // Ambil stok akhir dari tabel barang
                                                                            $query_stok_akhir = "SELECT sum(inventory.stok)as Quantity , barang.nama , barang.ktg_buffer FROM barang join inventory on inventory.kd_brg = barang.kd_brg WHERE barang.kd_brg = '$kd_brg'";
                                                                            $result_stok_akhir = mysqli_query($koneksi, $query_stok_akhir);
                                                                            $row_stok_akhir = $result_stok_akhir ? mysqli_fetch_assoc($result_stok_akhir) : [];
                                                                            $perhitungan_stok_akhir = isset($row_stok_akhir['Quantity']) ? $row_stok_akhir['Quantity'] : 0;
                                                                            $nama_barang = $row_stok_akhir['nama'];
                                                                            $ktg_buffer = $row_stok_akhir['ktg_buffer'];

                                                                            // Mengecek jumlah kategorinya ada berapa
                                                                            $query_cek_buffer = "SELECT nilai FROM kategori_buffer WHERE kd_kat = '$ktg_buffer'";
                                                                            $result_cek_buffer = mysqli_query($koneksi, $query_cek_buffer);

                                                                            if ($result_cek_buffer && mysqli_num_rows($result_cek_buffer) > 0) {
                                                                                $row_nilai_buffer = mysqli_fetch_assoc($result_cek_buffer);
                                                                                $nilai_buffer = $row_nilai_buffer['nilai'];
                                                                            } else {
                                                                                $nilai_buffer = 0;
                                                                            }


                                                                            // Hitung Qty Order dan Qty Order Max Jual
                                                                            // $qty_order = $max_rata_per_minggu * $waktu_kirim_supplier;
                                                                            $qty_order = ((7 * $max_rata_per_minggu) + ($waktu_kirim_barang * $max_rata_per_minggu)) - $perhitungan_stok_akhir;
                                                                            $qty_order_max_jual = ((7 * $max_tertinggi_perminggu) + ($waktu_kirim_barang * $max_tertinggi_perminggu)) - $perhitungan_stok_akhir;

                                                                            $buffer = round($qty_order * ($nilai_buffer / 100));
                                                                            $stok_akhir = $perhitungan_stok_akhir + $buffer;


                                                                            $estimasi_tidak_aman = ($max_rata_per_minggu * $waktu_kirim_barang) - $perhitungan_stok_akhir;
                                                                            if ($estimasi_tidak_aman < 0) {
                                                                                $status = '<span class="badge bg-danger" style="padding: 8px 16px; font-size: 14px; border-radius: 8px; cursor: not-allowed;">Pesan</span>';
                                                                            } else {
                                                                                $status = '<span class="badge bg-success" style="padding: 8px 16px; font-size: 14px; border-radius: 8px; cursor: not-allowed;">Aman</span>';
                                                                            }





                                                                    ?>
                                                                            <tr align="left">
                                                                                <td><?php echo $no; ?></td>
                                                                                <td><?php echo $kd_brg; ?></td>
                                                                                <td><?php echo $nama_barang; ?></td>
                                                                                <td style="text-align:right;"><?php echo number_format($buffer); ?></td>
                                                                                <td style="text-align:right;"><?php echo number_format($nilai_buffer); ?> %</td>
                                                                                <td style="text-align:right;"><?php echo number_format($stok_akhir); ?></td>
                                                                                <td style="text-align:right;"><?php echo number_format($perhitungan_stok_akhir); ?></td>
                                                                                <td style="background-color: rgba(207, 216, 220, 0.6); text-align:right;"><?php echo number_format($rata_minggu_I); ?></td>
                                                                                <td style="background-color: rgba(207, 216, 220, 0.6); text-align:right;"><?php echo number_format($rata_minggu_II); ?></td>
                                                                                <td style="background-color: rgba(207, 216, 220, 0.6); text-align:right;"><?php echo number_format($rata_minggu_III); ?></td>
                                                                                <td style="background-color: rgba(207, 216, 220, 0.6); text-align:right;"><?php echo number_format($rata_minggu_IV); ?></td>
                                                                                <td style="text-align:right;"><?php echo number_format($max_rata_per_minggu); ?></td>
                                                                                <td style="text-align:right;"><?php echo $waktu_kirim_barang . " Hari"; ?></td>
                                                                                <td style="text-align:right;">
                                                                                    <input type="radio" name="selection_<?php echo $kd_brg; ?>" value="qty_order_rata_<?php echo $kd_brg; ?>" class="largeRadio">
                                                                                    <?php echo number_format($qty_order); ?>
                                                                                    <input type="hidden" name="qty_order_<?php echo $kd_brg; ?>" value="<?php echo $qty_order; ?>">

                                                                                    <input type="hidden" name="kd_brg_<?php echo $kd_brg; ?>" value="<?php echo $kd_brg; ?>">
                                                                                    <input type="hidden" name="nama_barang_<?php echo $kd_brg; ?>" value="<?php echo $nama_barang; ?>">
                                                                                    <input type="hidden" name="buffer_<?php echo $kd_brg; ?>" value="<?php echo $buffer; ?>">
                                                                                    <input type="hidden" name="stok_akhir_<?php echo $kd_brg; ?>" value="<?php echo $stok_akhir; ?>">
                                                                                    <input type="hidden" name="perhitungan_stok_akhir_<?php echo $kd_brg; ?>" value="<?php echo $perhitungan_stok_akhir; ?>">
                                                                                    <input type="hidden" name="rata_minggu_I_<?php echo $kd_brg; ?>" value="<?php echo $rata_minggu_I; ?>">
                                                                                    <input type="hidden" name="rata_minggu_II_<?php echo $kd_brg; ?>" value="<?php echo $rata_minggu_II; ?>">
                                                                                    <input type="hidden" name="rata_minggu_III_<?php echo $kd_brg; ?>" value="<?php echo $rata_minggu_III; ?>">
                                                                                    <input type="hidden" name="rata_minggu_IV_<?php echo $kd_brg; ?>" value="<?php echo $rata_minggu_IV; ?>">
                                                                                    <input type="hidden" name="max_rata_per_minggu_<?php echo $kd_brg; ?>" value="<?php echo $max_rata_per_minggu; ?>">
                                                                                    <input type="hidden" name="max_tertinggi_perminggu_<?php echo $kd_brg; ?>" value="<?php echo $max_tertinggi_perminggu; ?>">
                                                                                    <input type="hidden" name="waktu_kirim_supplier_<?php echo $kd_brg; ?>" value="<?php echo $waktu_kirim_supplier; ?>">
                                                                                    <input type="hidden" name="waktu_kirim_barang_<?php echo $kd_brg; ?>" value="<?php echo $waktu_kirim_barang; ?>">
                                                                                    <input type="hidden" name="kd_supp_<?php echo $kd_brg; ?>" value="<?php echo $kd_supp; ?>">
                                                                                </td>
                                                                                <td style="text-align:right;">
                                                                                    <input type="radio" name="selection_<?php echo $kd_brg; ?>" value="minimum_order_<?php echo $kd_brg; ?>" class="largeRadio">
                                                                                    <?php echo $minimum_order; ?>
                                                                                    <input type="hidden" name="minimum_order_<?php echo $kd_brg; ?>" value="<?php echo $minimum_order; ?>">
                                                                                </td>
                                                                                <?php if ($estimasi_tidak_aman < 0) { ?>
                                                                                    <td style="text-align:right;"><?php echo number_format($estimasi_tidak_aman); ?></td>
                                                                                <?php } else { ?>
                                                                                    <td></td>
                                                                                <?php } ?>
                                                                            </tr><?php
                                                                                    $no++;
                                                                                }
                                                                            } else {
                                                                                echo "<tr><td colspan='21' align='center'>Data tidak ditemukan</td></tr>";
                                                                            }
                                                                                    ?>
                                                                </tbody>
                                                            </table>


                                                        </form>
                                                        <!-- Save button -->

                                                    <?php } elseif ($filter == 'semua'  && $qtyorder == 'keduanya') { ?>
                                                        <form id="invoiceForm" action="route/<?php echo $data; ?>/generate_stock_order.php?tgl_awal=<?php echo $tgl_awal; ?>&tgl_akhir=<?php echo $tgl_akhir; ?>&filter=<?php echo $filter; ?>&nilai=<?php echo $nilai; ?>&judul=<?php echo $judul; ?>*&act=keduanya" method="post"> <!-- Form untuk proses penyimpanan -->
                                                            <button type="submit" class="btn btn-success mb-3"><i class="fas fa-save"></i> Generate Purchase Request </button> <!-- Tombol Save di atas tabel -->
                                                            <table id="example" class="table table-bordered table-striped">
                                                                <thead style="background-color: lightgray;" class="elevation-2">
                                                                    <tr style="text-align: center;">
                                                                        <th rowspan="2">No.</th>
                                                                        <th rowspan="2">Kode Barang</th>
                                                                        <th rowspan="2">Nama Barang</th>
                                                                        <th rowspan="2">Buffer</th>
                                                                        <th rowspan="2">nilai buffer</th>
                                                                        <th rowspan="2">Stok Akhir</th>
                                                                        <th rowspan="2">Perhitungan Stok Akhir</th>

                                                                        <th style="text-align: center; background-color:#B0BEC5;" colspan="4">Rata-rata penjualan perhari dalam 7 hari</th>
                                                                        <th rowspan="2">Rata-rata penjualan perminggu dalam 4 minggu</th>
                                                                        <th rowspan="2">Tertinggi Penjualan per minggu dalam 4 minggu</th>
                                                                        <th rowspan="2">Waktu Kirim berdasarkan barang</th>
                                                                        <th rowspan="2">Current Order Rata-rata</th>
                                                                        <th rowspan="2">Current Order Tertinggi</th>
                                                                        <th rowspan="2">Minimum Order</th>
                                                                        <th rowspan="2">Barang yang harus dipesan tidak sesuai jadwal</th>
                                                                    <tr style="text-align: center;">
                                                                        <th style="background-color: #CFD8DC;">I</th>
                                                                        <th style="background-color: #CFD8DC;">II</th>
                                                                        <th style="background-color: #CFD8DC;">III</th>
                                                                        <th style="background-color: #CFD8DC;">IV</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $query_kd_brg = "SELECT DISTINCT kd_brg FROM barang";
                                                                    $result_kd_brg = mysqli_query($koneksi, $query_kd_brg);

                                                                    if ($result_kd_brg && mysqli_num_rows($result_kd_brg) > 0) {
                                                                        $no = 1;
                                                                        while ($row_kd_brg = mysqli_fetch_assoc($result_kd_brg)) {
                                                                            $kd_brg = $row_kd_brg['kd_brg'];

                                                                            // Menentukan tanggal awal dan akhir minggu
                                                                            $start_date = date('Y-m-d', strtotime('Monday this week')); // 9 September 2024 jatuh di hari Senin, jadi ini 9 September 2024
                                                                            $start_date = date('Y-m-d', strtotime('last Monday', strtotime($start_date))); // Mengubah ke Senin minggu sebelumnya

                                                                            // Menghitung tanggal untuk setiap minggu
                                                                            $week1_start = date('Y-m-d', strtotime($start_date . ' - 21 days')); // 12 Agustus 2024
                                                                            $week1_end = date('Y-m-d', strtotime($start_date . ' - 15 days')); // 18 Agustus 2024
                                                                            $week2_start = date('Y-m-d', strtotime($start_date . ' - 14 days')); // 19 Agustus 2024
                                                                            $week2_end = date('Y-m-d', strtotime($start_date . ' - 8 days')); // 25 Agustus 2024
                                                                            $week3_start = date('Y-m-d', strtotime($start_date . ' - 7 days')); // 26 Agustus 2024
                                                                            $week3_end = date('Y-m-d', strtotime($start_date . ' - 1 days')); // 1 September 2024
                                                                            $week4_start = $start_date; // 2 September 2024
                                                                            $week4_end = date('Y-m-d', strtotime($start_date . ' + 6 days')); // 8 September 2024
                                                                            $end_date = $week4_end;
                                                                            // Debugging: Print tanggal minggu
                                                                            // echo '<pre>';
                                                                            // echo 'Tanggal Minggu I: Dari ' . $week1_start . ' sampai ' . $week1_end . PHP_EOL;
                                                                            // echo 'Tanggal Minggu II: Dari ' . $week2_start . ' sampai ' . $week2_end . PHP_EOL;
                                                                            // echo 'Tanggal Minggu III: Dari ' . $week3_start . ' sampai ' . $week3_end . PHP_EOL;
                                                                            // echo 'Tanggal Minggu IV: Dari ' . $week4_start . ' sampai ' . $week4_end . PHP_EOL;
                                                                            // echo '</pre>';

                                                                            /*
                                                                            
                                                                            Tanggal Minggu I: Dari 2024-09-30 sampai 2024-10-06
                                                                            Tanggal Minggu II: Dari 2024-10-07 sampai 2024-10-13
                                                                            Tanggal Minggu III: Dari 2024-10-14 sampai 2024-10-20
                                                                            Tanggal Minggu IV: Dari 2024-10-21 sampai 2024-10-27

                                                                            */



                                                                            // SUM(CASE WHEN tanggal BETWEEN '$week1_start' AND '$week1_end' THEN banyak * jumlah ELSE 0 END) AS total_minggu_I,

                                                                            // Query untuk menghitung total, rata-rata, dan tertinggi per minggu
                                                                            $query_per_minggu = "
                                                                                SELECT 
                                                                                    SUM(CASE WHEN tanggal BETWEEN '$week1_start' AND '$week1_end' THEN banyak * qty_satuan ELSE 0 END) AS total_minggu_I,
                                                                                    SUM(CASE WHEN tanggal BETWEEN '$week2_start' AND '$week2_end' THEN banyak * qty_satuan  ELSE 0 END) AS total_minggu_II,
                                                                                    SUM(CASE WHEN tanggal BETWEEN '$week3_start' AND '$week3_end' THEN banyak * qty_satuan ELSE 0 END) AS total_minggu_III,
                                                                                    SUM(CASE WHEN tanggal BETWEEN '$week4_start' AND '$week4_end' THEN banyak * qty_satuan ELSE 0 END) AS total_minggu_IV
                                                                                FROM 
                                                                                    jualdetil
                                                                                WHERE 
                                                                                    kd_brg = '$kd_brg'
                                                                                    AND tanggal BETWEEN '$week1_start' AND '$end_date'
                                                                                ";
                                                                            // Debugging: Print tanggal minggu
                                                                            $result_per_minggu = mysqli_query($koneksi, $query_per_minggu);

                                                                            // Debugging: Check if query was successful
                                                                            if (!$result_per_minggu) {
                                                                                die('Query error: ' . mysqli_error($koneksi));
                                                                            }

                                                                            // Fetch the result
                                                                            $row_per_minggu = mysqli_fetch_assoc($result_per_minggu);
                                                                            // echo '<pre>';
                                                                            // echo 'Total minggu 1 ' . $row_per_minggu['total_minggu_I'] . "untuk barang : " . $kd_brg;
                                                                            // echo 'Total minggu 2 ' . $row_per_minggu['total_minggu_II'] . "untuk barang : " . $kd_brg;
                                                                            // echo 'Total minggu 3 ' . $row_per_minggu['total_minggu_III'] . "untuk barang : " . $kd_brg;
                                                                            // echo 'Total minggu 4 ' . $row_per_minggu['total_minggu_IV'] . "untuk barang : " . $kd_brg;

                                                                            // echo '</pre>';


                                                                            // Extract values from the query
                                                                            $total_minggu_I = isset($row_per_minggu['total_minggu_I']) ? $row_per_minggu['total_minggu_I'] : 0;
                                                                            $total_minggu_II = isset($row_per_minggu['total_minggu_II']) ? $row_per_minggu['total_minggu_II'] : 0;
                                                                            $total_minggu_III = isset($row_per_minggu['total_minggu_III']) ? $row_per_minggu['total_minggu_III'] : 0;
                                                                            $total_minggu_IV = isset($row_per_minggu['total_minggu_IV']) ? $row_per_minggu['total_minggu_IV'] : 0;
                                                                            // Calculate average per week
                                                                            $rata_minggu_I = round($total_minggu_I / 7);
                                                                            $rata_minggu_II = round($total_minggu_II / 7);
                                                                            $rata_minggu_III = round($total_minggu_III / 7);
                                                                            $rata_minggu_IV = round($total_minggu_IV / 7);


                                                                            // $max_rata_per_minggu = max($rata_minggu_I, $rata_minggu_II, $rata_minggu_III, $rata_minggu_III);
                                                                            $max_rata_per_minggu = ($rata_minggu_I + $rata_minggu_II + $rata_minggu_III + $rata_minggu_IV) / 4;

                                                                            $max_tertinggi_perminggu = max($rata_minggu_I, $rata_minggu_II, $rata_minggu_III, $rata_minggu_IV);


                                                                            // Query untuk mencari kd_supp di tabel supplier_barang berdasarkan kd_brg
                                                                            $query_kd_supp = "SELECT kd_supp , durasi_kirim , minimum_order FROM supplier_barang WHERE kd_brg = '$kd_brg'";
                                                                            $result_kd_supp = mysqli_query($koneksi, $query_kd_supp);
                                                                            $row_kd_supp = $result_kd_supp ? mysqli_fetch_assoc($result_kd_supp) : [];
                                                                            $kd_supp = isset($row_kd_supp['kd_supp']) ? $row_kd_supp['kd_supp'] : '';
                                                                            $waktu_kirim_barang = isset($row_kd_supp['durasi_kirim']) ? $row_kd_supp['durasi_kirim'] : 0;
                                                                            $minimum_order = isset($row_kd_supp['minimum_order']) ? $row_kd_supp['minimum_order'] : 0;

                                                                            // Query untuk mencari durasi_waktu di tabel supplier berdasarkan kd_supp
                                                                            $query_durasi_waktu = "SELECT term FROM supplier WHERE kd_supp = '$kd_supp'";
                                                                            $result_durasi_waktu = mysqli_query($koneksi, $query_durasi_waktu);
                                                                            $row_durasi_waktu = $result_durasi_waktu ? mysqli_fetch_assoc($result_durasi_waktu) : [];
                                                                            $waktu_kirim_supplier = isset($row_durasi_waktu['term']) ? $row_durasi_waktu['term'] : 0;


                                                                            // hitung stok aman satu minggu kedepan
                                                                            $estimasi = $max_rata_per_minggu * 7;

                                                                            // Ambil stok akhir dari tabel barang
                                                                            $query_stok_akhir = "SELECT sum(inventory.stok)as Quantity , barang.nama , barang.ktg_buffer FROM barang join inventory on inventory.kd_brg = barang.kd_brg WHERE barang.kd_brg = '$kd_brg'";
                                                                            $result_stok_akhir = mysqli_query($koneksi, $query_stok_akhir);
                                                                            $row_stok_akhir = $result_stok_akhir ? mysqli_fetch_assoc($result_stok_akhir) : [];
                                                                            $perhitungan_stok_akhir = isset($row_stok_akhir['Quantity']) ? $row_stok_akhir['Quantity'] : 0;
                                                                            $nama_barang = $row_stok_akhir['nama'];
                                                                            $ktg_buffer = $row_stok_akhir['ktg_buffer'];

                                                                            // Mengecek jumlah kategorinya ada berapa
                                                                            $query_cek_buffer = "SELECT nilai FROM kategori_buffer WHERE kd_kat = '$ktg_buffer'";
                                                                            $result_cek_buffer = mysqli_query($koneksi, $query_cek_buffer);

                                                                            if ($result_cek_buffer && mysqli_num_rows($result_cek_buffer) > 0) {
                                                                                $row_nilai_buffer = mysqli_fetch_assoc($result_cek_buffer);
                                                                                $nilai_buffer = $row_nilai_buffer['nilai'];
                                                                            } else {
                                                                                $nilai_buffer = 0;
                                                                            }


                                                                            // Hitung Qty Order dan Qty Order Max Jual
                                                                            // $qty_order = $max_rata_per_minggu * $waktu_kirim_supplier;
                                                                            $qty_order = ((7 * $max_rata_per_minggu) + ($waktu_kirim_barang * $max_rata_per_minggu)) - $perhitungan_stok_akhir;
                                                                            $qty_order_max_jual = ((7 * $max_tertinggi_perminggu) + ($waktu_kirim_barang * $max_tertinggi_perminggu)) - $perhitungan_stok_akhir;

                                                                            $buffer = round($qty_order * ($nilai_buffer / 100));
                                                                            $stok_akhir = $perhitungan_stok_akhir + $buffer;


                                                                            $estimasi_tidak_aman = ($max_rata_per_minggu * $waktu_kirim_barang) - $perhitungan_stok_akhir;

                                                                            if ($estimasi_tidak_aman < 0) {
                                                                                $status = '<span class="badge bg-danger" style="padding: 8px 16px; font-size: 14px; border-radius: 8px; cursor: not-allowed;">Pesan</span>';
                                                                            } else {
                                                                                $status = '<span class="badge bg-success" style="padding: 8px 16px; font-size: 14px; border-radius: 8px; cursor: not-allowed;">Aman</span>';
                                                                            }





                                                                    ?>
                                                                            <tr align="left">
                                                                                <td><?php echo $no; ?></td>
                                                                                <td><?php echo $kd_brg; ?></td>
                                                                                <td><?php echo $nama_barang; ?></td>
                                                                                <td style="text-align:right;"><?php echo number_format($buffer); ?></td>
                                                                                <td style="text-align:right;"><?php echo number_format($nilai_buffer); ?> %</td>
                                                                                <td style="text-align:right;"><?php echo number_format($stok_akhir); ?></td>
                                                                                <td style="text-align:right;"><?php echo number_format($perhitungan_stok_akhir); ?></td>
                                                                                <td style="background-color: rgba(207, 216, 220, 0.6); text-align:right;"><?php echo number_format($rata_minggu_I); ?></td>
                                                                                <td style="background-color: rgba(207, 216, 220, 0.6); text-align:right;"><?php echo number_format($rata_minggu_II); ?></td>
                                                                                <td style="background-color: rgba(207, 216, 220, 0.6); text-align:right;"><?php echo number_format($rata_minggu_III); ?></td>
                                                                                <td style="background-color: rgba(207, 216, 220, 0.6); text-align:right;"><?php echo number_format($rata_minggu_IV); ?></td>
                                                                                <td style="text-align:right;"><?php echo number_format($max_rata_per_minggu); ?></td>
                                                                                <td style="text-align:right;"><?php echo number_format($max_tertinggi_perminggu); ?></td>
                                                                                <td style="text-align:right;"><?php echo $waktu_kirim_barang . " Hari"; ?></td>
                                                                                <td style="text-align:right;">
                                                                                    <input type="radio" name="selection_<?php echo $kd_brg; ?>" value="qty_order_rata_<?php echo $kd_brg; ?>" class="largeRadio">
                                                                                    <?php echo number_format($qty_order); ?>
                                                                                    <input type="hidden" name="qty_order_<?php echo $kd_brg; ?>" value="<?php echo $qty_order; ?>">

                                                                                    <input type="hidden" name="kd_brg_<?php echo $kd_brg; ?>" value="<?php echo $kd_brg; ?>">
                                                                                    <input type="hidden" name="nama_barang_<?php echo $kd_brg; ?>" value="<?php echo $nama_barang; ?>">
                                                                                    <input type="hidden" name="buffer_<?php echo $kd_brg; ?>" value="<?php echo $buffer; ?>">
                                                                                    <input type="hidden" name="stok_akhir_<?php echo $kd_brg; ?>" value="<?php echo $stok_akhir; ?>">
                                                                                    <input type="hidden" name="perhitungan_stok_akhir_<?php echo $kd_brg; ?>" value="<?php echo $perhitungan_stok_akhir; ?>">
                                                                                    <input type="hidden" name="rata_minggu_I_<?php echo $kd_brg; ?>" value="<?php echo $rata_minggu_I; ?>">
                                                                                    <input type="hidden" name="rata_minggu_II_<?php echo $kd_brg; ?>" value="<?php echo $rata_minggu_II; ?>">
                                                                                    <input type="hidden" name="rata_minggu_III_<?php echo $kd_brg; ?>" value="<?php echo $rata_minggu_III; ?>">
                                                                                    <input type="hidden" name="rata_minggu_IV_<?php echo $kd_brg; ?>" value="<?php echo $rata_minggu_IV; ?>">
                                                                                    <input type="hidden" name="max_rata_per_minggu_<?php echo $kd_brg; ?>" value="<?php echo $max_rata_per_minggu; ?>">
                                                                                    <input type="hidden" name="max_tertinggi_perminggu_<?php echo $kd_brg; ?>" value="<?php echo $max_tertinggi_perminggu; ?>">
                                                                                    <input type="hidden" name="waktu_kirim_supplier_<?php echo $kd_brg; ?>" value="<?php echo $waktu_kirim_supplier; ?>">
                                                                                    <input type="hidden" name="waktu_kirim_barang_<?php echo $kd_brg; ?>" value="<?php echo $waktu_kirim_barang; ?>">
                                                                                    <input type="hidden" name="kd_supp_<?php echo $kd_brg; ?>" value="<?php echo $kd_supp; ?>">
                                                                                </td>
                                                                                <td style="text-align:right;">
                                                                                    <input type="radio" name="selection_<?php echo $kd_brg; ?>" value="qty_order_tertinggi_<?php echo $kd_brg; ?>" class="largeRadio">
                                                                                    <?php echo number_format($qty_order_max_jual); ?>
                                                                                    <input type="hidden" name="qty_order_max_<?php echo $kd_brg; ?>" value="<?php echo $qty_order_max_jual; ?>">
                                                                                </td>
                                                                                <td style="text-align:right;">
                                                                                    <input type="radio" name="selection_<?php echo $kd_brg; ?>" value="minimum_order_<?php echo $kd_brg; ?>" class="largeRadio">
                                                                                    <?php echo $minimum_order; ?>
                                                                                    <input type="hidden" name="minimum_order_<?php echo $kd_brg; ?>" value="<?php echo $minimum_order; ?>">
                                                                                </td>
                                                                                <?php if ($estimasi_tidak_aman < 0) { ?>
                                                                                    <td style="text-align:right;"><?php echo number_format($estimasi_tidak_aman); ?></td>
                                                                                <?php } else { ?>
                                                                                    <td></td>
                                                                                <?php } ?>
                                                                            </tr><?php
                                                                                    $no++;
                                                                                }
                                                                            } else {
                                                                                echo "<tr><td colspan='21' align='center'>Data tidak ditemukan</td></tr>";
                                                                            }
                                                                                    ?>
                                                                </tbody>
                                                            </table>


                                                        </form>
                                                    <?php } ?>
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
            </div>

            <!-- Include jQuery and Bootstrap JS for check all functionality -->
            <script>
                // Fungsi untuk mengatur checkbox "Select All"
                function toggle(source) {
                    var checkboxes = document.getElementsByClassName('largeCheckbox');
                    for (var i = 0; i < checkboxes.length; i++) {
                        checkboxes[i].checked = source.checked;
                    }
                }

                // Fungsi untuk menghapus centangan pada saat halaman dimuat
                window.onload = function() {
                    document.getElementById('select-all').checked = false;
                    var checkboxes = document.getElementsByClassName('largeCheckbox');
                    for (var i = 0; i < checkboxes.length; i++) {
                        checkboxes[i].checked = false;
                    }
                };
            </script>
            <!-- /.content-wrapper -->
            <style>
                /* Mengubah ukuran radio button */
                input[type="radio"].largeRadio {
                    width: 20px;
                    height: 20px;
                    accent-color: #4CAF50;
                    /* Warna untuk radio button */
                    cursor: pointer;
                    /* Mengubah kursor menjadi pointer saat hover */
                }

                /* Mengatur margin agar lebih rapi */
                input[type="radio"].largeRadio+span {
                    margin-left: 10px;
                    font-size: 16px;
                    vertical-align: middle;
                    /* Menyelaraskan teks dengan radio button */
                }

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
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const table = $('#example').DataTable({
                        paging: true,
                        lengthMenu: [
                            [10, 25, 50, -1],
                            [10, 25, 50, 'All']
                        ]
                    });

                    const selectedRadios = {};

                    // Track selected radios across pages
                    document.addEventListener('change', function(e) {
                        if (e.target.type === 'radio') {
                            selectedRadios[e.target.name] = e.target.value;
                        }
                    });

                    document.getElementById("invoiceForm").addEventListener("submit", function(e) {
                        e.preventDefault();
                        const form = this;

                        // Clear previously added hidden fields
                        form.querySelectorAll('.dynamic-radio').forEach(el => el.remove());

                        // Loop through all rows in DataTable (including paginated)
                        table.rows().every(function() {
                            const row = this.node();
                            const radios = row.querySelectorAll('input[type="radio"]:checked');

                            radios.forEach(radio => {
                                const name = radio.name;
                                const value = radio.value;

                                // ✅ Add selected radio value
                                const inputRadio = document.createElement("input");
                                inputRadio.type = "hidden";
                                inputRadio.name = name;
                                inputRadio.value = value;
                                inputRadio.classList.add("dynamic-radio");
                                form.appendChild(inputRadio);

                                // ✅ Add all hidden inputs in the same row
                                row.querySelectorAll('input[type="hidden"]').forEach(source => {
                                    const hiddenInput = document.createElement("input");
                                    hiddenInput.type = "hidden";
                                    hiddenInput.name = source.name;
                                    hiddenInput.value = source.value;
                                    hiddenInput.classList.add("dynamic-radio");
                                    form.appendChild(hiddenInput);
                                });

                                // ✅ (Optional) Add all visible <td> values
                                row.querySelectorAll('td').forEach((td, index) => {
                                    const text = td.textContent.trim();
                                    const tdInput = document.createElement("input");
                                    tdInput.type = "hidden";
                                    tdInput.name = `visible_td_${name}_col${index}`;
                                    tdInput.value = text;
                                    tdInput.classList.add("dynamic-radio");
                                    form.appendChild(tdInput);
                                });
                            });
                        });

                        // ✅ Submit form
                        form.submit();
                    });
                });
            </script>
<?php
            break;
    }
}
?>