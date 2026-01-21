<?php
$login_hash = $_SESSION['login_hash'];
$en = $_SESSION['employee_number'];
$to = $_SESSION['to'];
$area_e = $_SESSION['area_e'];
$area_nama = $_SESSION['area_nama'];

$judulform = 'Outstanding Utang';

$data = 'lap_outstanding_utang';
$aksi = 'aksi_outstanding';
$rute = 'outstanding_utang';

$tabel = 'payment';
$f1 = 'no_invoice';
$f2 = 'jumlah_payment';
$f3 = 'no_payment';
$f4 = 'tanggal_payment';

$j1 = 'No Inovice';
$j2 = 'Jumlah Payment';
$j3 = 'No Payment';
$j4 = 'Tanggal Payment';


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



                                                        <?php if ($login_hash != '7') { ?>

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
                                                                            <input type="radio" name="cakup" onclick="displayResult(this.value)" value="Asuransi"> Supplier
                                                                        </div>
                                                                        <!-- <div>
                                                                            <input type="radio" name="cakup" onclick="displayResult(this.value)" value="Outlet"> Data Siap Print
                                                                        </div> -->
                                                                    <?php } ?>

                                                                    <!-- <div>
                                                                        <input type="radio" name="cakup" onclick="displayResult(this.value)" value="Outlet"> Outlet
                                                                    </div> -->


                                                                    <div class="form-group">
                                                                        <!-- <label>Cakupan terpilih : </label> -->
                                                                        <input type="hidden" id="result" readonly style="width:100;font-size:120%;font-weight:600">
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
                                                                <!-- Show Utk Kota -->
                                                                <div id="isian1" style="display: none;">
                                                                    <div class="row">
                                                                        <div class="col-lg-10">
                                                                            <div class="form-group">
                                                                                <form method="post" action="simpan_index.php">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-6">

                                                                                            <label>Kode Supplier</label>
                                                                                            <input type="text" class="form-control" required="required" id="tampil_asuransi_kode" placeholder="Isi Kode Supplier">
                                                                                        </div>
                                                                                        <div class="col-lg-6">
                                                                                            <button style="margin-top: 27px" type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#cariAsuransi">
                                                                                                <i class="fa fa-search"></i> Cari Supplier
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>

                                                                                    <label>Supplier<span id="status_asuransi"></span></label>
                                                                                    <input type="text" class="form-control" name="asuransi" value="" required="required" placeholder="Nama Supplier .." id="tampil_asuransi_nama" readonly>

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
                                                                                                            $data = mysqli_query($koneksi, "SELECT kd_supp,nama
                                                                                                                                            FROM supplier                                                                                                               
                                                                                                                                            ORDER BY kd_supp ASC;
                                                                                                                                            ");
                                                                                                            while ($d = mysqli_fetch_array($data)) {
                                                                                                            ?>
                                                                                                                <tr>
                                                                                                                    <td width="1%" class="text-center"><?php echo $no++; ?></td>
                                                                                                                    <td width="1%" class="text-center"><?php echo $d['kd_supp']; ?></td>
                                                                                                                    <td width="3%"><?php echo $d['nama']; ?></td>
                                                                                                                    <td width="1%">
                                                                                                                        <button type="button" class="btn btn-success btn-sm modal-pilih-asuransi" id="<?php echo $d['kd_supp']; ?>" kode="<?php echo $d['kd_supp']; ?>" nama="<?php echo $d['nama']; ?>" data-dismiss="modal">Pilih</button>
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
        <?php
            break;

        case "report";

            // $tgl_awal = $_GET['tgl_awal'];
            // $tgl_akhir = $_GET['tgl_akhir'];
            $filter = $_GET['filter'];
            $nilai = $_GET['nilai'];

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

            if ($login_hash == '7') {
                $filter = 'Outlet';
                $query = mysqli_query($koneksi, "SELECT cabang_e FROM employee WHERE employee_number='$en'");
                $q1 = mysqli_fetch_array($query);
                $nilai = $q1['cabang_e'];
                $kondisi = "AND penjualan.kd_cus='$nilai'";
                $query = mysqli_query($koneksi, "SELECT nama FROM pelanggan WHERE kd_cus='$nilai'");
                $q1 = mysqli_fetch_array($query);
                $judul_nilai = $q1['nama'];
            }

            $judul = 'Umur Piutang';
            $judul2 = $filter . " : " . $judul_nilai . $judul_area;
            // $judul3 = 'Periode : ' . $tgl_awal . " s/d " . $tgl_akhir;

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
                                <!-- <br /><?php echo $judul3; ?> -->
                            </h4>
                            <!-- <?php
                                    echo "<br/>" . $filter;
                                    echo "<br/>" . $nilai;
                                    ?> -->
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
                                                    <?php if ($filter == 'asuransi') { ?>
                                                        <table id="example1" class="table table-bordered table-striped">
                                                            <thead style="background-color: lightgray;" class="elevation-2">
                                                                <tr style="text-align: center;">
                                                                    <th>No.</th>
                                                                    <th>Tanggal Kirim</th>
                                                                    <th>Nomor Invoice</th>
                                                                    <th>Rupiah</th>
                                                                    <th>Tanggal Bayar</th>
                                                                    <th>Bayar</th>
                                                                    <th>Saldo</th>
                                                                    <th>Lama</th>
                                                                    <th>Not Due</th>
                                                                    <th>30-60 Hari</th>
                                                                    <th>> 60 Hari</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $sql1 = mysqli_query($koneksi, "
                                                                SELECT 
                                                                    i.no_invoice,
                                                                    i.tanggal_invoice,
                                                                    i.kode_pasien,
                                                                    p.nama_perusahaan,
                                                                    i.status_payment,
                                                                    i.status_print,
                                                                    (SELECT SUM(nilai) FROM invoice_perusahaan_detail WHERE no_invoice = i.no_invoice) as total_nilai,
                                                                    (SELECT tanggal_payment FROM payment WHERE no_invoice = i.no_invoice LIMIT 1) as tanggal_payment,
                                                                    (SELECT SUM(jumlah_payment) FROM payment WHERE no_invoice = i.no_invoice) as jumlah_payment,
                                                                    (SELECT SUM(bayar_kasir) FROM transaksi WHERE no_invoice = i.no_invoice) as total_payment_kasir,
                                                                    (SELECT SUM(diskon) FROM invoice_perusahaan_detail WHERE no_invoice = i.no_invoice) as total_diskon,
                                                                    DATEDIFF(NOW(), i.tanggal_invoice) as lama_hari
                                                                FROM invoice_perusahaan i 
                                                                JOIN perusahaan p ON p.kd_perusahaan = i.kode_perusahaan   
                                                                WHERE i.kode_perusahaan = '$nilai'
                                                                AND (i.status_payment != 2 OR i.status_payment IS NULL)
                                                                ORDER BY i.no_invoice ASC
                                                            ");

                                                                if (!$sql1) {
                                                                    die("Query gagal: " . mysqli_error($koneksi));
                                                                }

                                                                $no = 1;
                                                                $totalPengiriman = 0;
                                                                $totalPembayaran = 0;
                                                                $totalSaldo = 0;
                                                                $total1_30 = 0;
                                                                $total31_60 = 0;
                                                                $total61_90 = 0;

                                                                while ($s1 = mysqli_fetch_array($sql1)) {
                                                                    $saldo = $s1['total_nilai'] - $s1['total_payment_kasir'] - $s1['total_diskon'] - $s1['jumlah_payment'];
                                                                    $totalPengiriman += $s1['total_nilai'];
                                                                    $totalPembayaran += $s1['jumlah_payment'];
                                                                    $totalSaldo += $saldo;

                                                                    // Menghitung jumlah per kategori hari
                                                                    $jumlah1_30 = 0;
                                                                    $jumlah31_60 = 0;
                                                                    $jumlah61_90 = 0;
                                                                    if ($s1['lama_hari'] >= 1 && $s1['lama_hari'] <= 30) {
                                                                        $jumlah1_30 = $saldo;
                                                                        $total1_30 += $saldo;
                                                                    } elseif ($s1['lama_hari'] >= 31 && $s1['lama_hari'] <= 60) {
                                                                        $jumlah31_60 = $saldo;
                                                                        $total31_60 += $saldo;
                                                                    } elseif ($s1['lama_hari'] > 60) {
                                                                        $jumlah61_90 = $saldo;
                                                                        $total61_90 += $saldo;
                                                                    }
                                                                ?>
                                                                    <tr align="left" style="<?php echo ($s1['lama_hari'] > 60) ? 'background-color: ;' : (($s1['lama_hari'] >= 31 && $s1['lama_hari'] <= 60) ? 'background-color:;' : ''); ?>">
                                                                        <td><?php echo $no; ?></td>
                                                                        <td><?php echo $s1['tanggal_invoice']; ?></td>
                                                                        <td><?php echo $s1['no_invoice']; ?></td>
                                                                        <td style="text-align:right;"><?php echo number_format($s1['total_nilai']); ?></td>
                                                                        <td><?php echo $s1['tanggal_payment']; ?></td>
                                                                        <td style="text-align:right;"><?php echo number_format($s1['jumlah_payment']); ?></td>
                                                                        <td style="text-align:right;"><?php echo number_format($saldo); ?></td>
                                                                        <td><?php echo $s1['lama_hari']; ?></td>
                                                                        <td style="background-color: #B4E380; text-align:right;"><?php echo number_format($jumlah1_30); ?></td>
                                                                        <td style=" text-align:right; background-color:#F6FB7A;"><?php echo number_format($jumlah31_60); ?></td>
                                                                        <td style="text-align:right; background-color: #FF6969"><?php echo number_format($jumlah61_90); ?></td>
                                                                    </tr>
                                                                <?php
                                                                    $no++;
                                                                }
                                                                ?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr style="font-weight:800;background-color: #758694">
                                                                    <td colspan="3" style="text-align:right;"> Total :</td>
                                                                    <td style="text-align:right;"><?php echo number_format($totalPengiriman); ?></td>
                                                                    <td colspan="2" style="text-align:right;"><?php echo number_format($totalPembayaran); ?></td>
                                                                    <td style="text-align:right;"><?php echo number_format($totalSaldo); ?></td>
                                                                    <td></td>
                                                                    <td style="background-color: #B4E380; text-align:right;"><?php echo number_format($total1_30); ?></td>
                                                                    <td style="text-align:right; background-color: #F6FB7A;"><?php echo number_format($total31_60); ?></td>
                                                                    <td style="text-align:right; background-color: #FF6969"><?php echo number_format($total61_90); ?></td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>


                                                        <!-- Save button -->
                                                    <?php } elseif ($filter == 'semua') { ?>
                                                        <table id="example2" class="table table-bordered table-striped">
                                                            <thead style="background-color: lightgray;" class="elevation-2">
                                                                <tr style="text-align: center;">
                                                                    <th>No.</th>
                                                                    <th>Tanggal Kirim</th>
                                                                    <th>Nomor Invoice</th>
                                                                    <th>Nama Supplier</th>
                                                                    <th>Rupiah</th>
                                                                    <th>Tanggal Bayar</th>
                                                                    <th>Bayar</th>
                                                                    <th>Saldo</th>
                                                                    <th>Lama</th>
                                                                    <th>Not Due</th>
                                                                    <th>1-30 Hari</th>
                                                                    <th>31-60 Hari</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $sql1 = mysqli_query($koneksi, "
                                                                    SELECT 
                                                                        pembelian_invoice.no_invoice,
                                                                        pembelian_invoice.tanggal_invoice,
                                                                        pembelian_invoice.kd_supp,
                                                                        pembelian_invoice.status_payment,
                                                                        pembelian_invoice.ppn,
                                                                        supplier.nama as nama_supplier,
                                                                        pembelian_invoice.ongkir,
                                                                        (SELECT SUM(nilai * penerimaan_barang.jumlah_datang) 
                                                                        FROM pembelian_invoice_detail 
                                                                        JOIN penerimaan_barang ON penerimaan_barang.kd_po = pembelian_invoice.kd_po 
                                                                        WHERE no_invoice = pembelian_invoice.no_invoice) as total_nilai,
                                                                        (SELECT tanggal_payment FROM payment WHERE no_invoice = pembelian_invoice.no_invoice LIMIT 1) as tanggal_payment,
                                                                         (SELECT SUM(disc) FROM pembelian_invoice_detail WHERE no_invoice = pembelian_invoice.no_invoice) as total_diskon,
                                                                        (SELECT SUM(jumlah_payment) FROM payment WHERE no_invoice = pembelian_invoice.no_invoice) as jumlah_payment,
                                                                        (SELECT tarif_ppn FROM pembelian WHERE kd_po = pembelian_invoice.kd_po) as tarif_ppn,
                                                                        (SELECT SUM(jumlah_datang) FROM penerimaan_barang WHERE kd_po = pembelian_invoice.kd_po) as jumlah_datang,
                                                                        DATEDIFF(NOW(), pembelian_invoice.tanggal_invoice) as lama_hari
                                                                    FROM pembelian_invoice
                                                                   JOIN supplier on supplier.kd_supp = pembelian_invoice.kd_supp
                                                                   JOIN pembelian on pembelian.kd_po = pembelian_invoice.kd_po
                                                                    WHERE (pembelian_invoice.status_payment != 2 OR pembelian_invoice.status_payment IS NULL)
                                                                    ORDER BY pembelian_invoice.no_invoice ASC
                                                                ");

                                                                if (!$sql1) {
                                                                    die("Query gagal: " . mysqli_error($koneksi));
                                                                }

                                                                $no = 1;
                                                                $totalPengiriman = 0;
                                                                $totalPembayaran = 0;
                                                                $totalSaldo = 0;
                                                                $total1_30 = 0;
                                                                $total31_60 = 0;
                                                                $total61_90 = 0;

                                                                while ($s1 = mysqli_fetch_array($sql1)) {

                                                                    if ($s1['ppn'] = 1) {
                                                                        $nilai_pajak =  ($s1['total_nilai'] - $s1['total_diskon']) * $s1['tarif_ppn'] / 100;
                                                                    } else {
                                                                        $nilai_pajak = 0;
                                                                    }


                                                                    $saldo = $s1['total_nilai'] - $s1['total_diskon'] + $nilai_pajak + $s1['ongkir'];
                                                                    $totalPengiriman += $s1['total_nilai'];
                                                                    $totalPembayaran += $s1['jumlah_payment'];
                                                                    $totalSaldo += $saldo;

                                                                    // Menghitung jumlah per kategori hari
                                                                    $jumlah1_30 = 0;
                                                                    $jumlah31_60 = 0;
                                                                    $jumlah61_90 = 0;
                                                                    $notDue = '';

                                                                    if ($s1['lama_hari'] >= 1 && $s1['lama_hari'] <= 30) {
                                                                        $jumlah1_30 = $saldo;
                                                                        $total1_30 += $saldo;
                                                                    } elseif ($s1['lama_hari'] >= 31 && $s1['lama_hari'] <= 60) {
                                                                        $jumlah31_60 = $saldo;
                                                                        $total31_60 += $saldo;
                                                                    } elseif ($s1['lama_hari'] >= 61 && $s1['lama_hari'] <= 90) {
                                                                        $jumlah61_90 = $saldo;
                                                                        $total61_90 += $saldo;
                                                                    } else {
                                                                        $notDue = $s1['lama_hari'];
                                                                    }
                                                                ?>
                                                                    <tr align="left" style="<?php echo ($s1['lama_hari'] >= 61 && $s1['lama_hari'] <= 90) ? 'background-color: ;' : (($s1['lama_hari'] >= 1 && $s1['lama_hari'] <= 60) ? 'background-color:;' : ''); ?>">
                                                                        <td><?php echo $no; ?></td>
                                                                        <td><?php echo $s1['tanggal_invoice']; ?></td>
                                                                        <td><?php echo $s1['no_invoice']; ?></td>
                                                                        <td><?php echo $s1['nama_supplier']; ?></td>
                                                                        <td style="text-align:right;"><?php echo number_format($s1['total_nilai']); ?></td>
                                                                        <td><?php echo $s1['tanggal_payment']; ?></td>
                                                                        <td style="text-align:right;"><?php echo number_format($s1['jumlah_payment']); ?></td>
                                                                        <td style="text-align:right;"><?php echo number_format($saldo); ?></td>
                                                                        <td><?php echo $s1['lama_hari']; ?></td>
                                                                        <td style="text-align:right; background-color: #B4E380;"><?php echo number_format($jumlah1_30); ?></td>
                                                                        <td style="text-align:right; background-color:#F6FB7A;"><?php echo number_format($jumlah1_30); ?></td>
                                                                        <td style="text-align:right; background-color: #FF6969"><?php echo number_format($jumlah31_60); ?></td>
                                                                    </tr>
                                                                <?php
                                                                    $no++;
                                                                }
                                                                ?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr style="font-weight:800;background-color: #758694">
                                                                    <td colspan="4" style="text-align:right;"> Total :</td> <!-- Menggunakan colspan 4 agar sesuai -->
                                                                    <td style="text-align:right;"><?php echo number_format($totalPengiriman); ?></td>
                                                                    <td></td> <!-- Kolom Tanggal Bayar -->
                                                                    <td style="text-align:right;"><?php echo number_format($totalPembayaran); ?></td>
                                                                    <td style="text-align:right;"><?php echo number_format($totalSaldo); ?></td>
                                                                    <td></td> <!-- Kolom Lama -->
                                                                    <td style="text-align:right; background-color: #B4E380;"><?php echo number_format($total1_30); ?></td>
                                                                    <td style="text-align:right; background-color: #F6FB7A;"><?php echo number_format($total31_60); ?></td>
                                                                    <td style="text-align:right; background-color: #FF6969;"><?php echo number_format($total61_90); ?></td>
                                                                </tr>
                                                            </tfoot>
                                                            <!-- 
                                                            <tfoot>
                                                                <tr style="font-weight:800;background-color: #758694">
                                                                    <td colspan="3" style="text-align:right;"> Total :</td>
                                                                    <td colspan="2" style="text-align:right;"><?php echo number_format($totalPengiriman); ?></td>
                                                                    <td colspan="2" style="text-align:right;"><?php echo number_format($totalPembayaran); ?></td>
                                                                    <td></td>
                                                                    <td style="text-align:left;"><?php echo number_format($totalSaldo); ?></td>
                                                                    <td style="text-align:right; background-color: #B4E380 ;"><?php echo number_format($total1_30); ?></td>
                                                                    <td style="text-align:right; background-color: #F6FB7A;"><?php echo number_format($total1_30); ?></td>
                                                                    <td style="text-align:right; background-color: #FF6969"><?php echo number_format($total31_60); ?></td>
                                                                </tr>
                                                            </tfoot> -->
                                                        </table>

                                                        <!-- Save button -->
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
                // JavaScript untuk Select All
                document.addEventListener('DOMContentLoaded', function() {
                    var selectAllCheckbox = document.getElementById('select-all');
                    var checkboxes = document.querySelectorAll('.checkbox');

                    selectAllCheckbox.addEventListener('change', function() {
                        checkboxes.forEach(function(checkbox) {
                            checkbox.checked = selectAllCheckbox.checked;
                        });
                    });
                });
            </script>

            <!-- /.content-wrapper -->

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
<?php
            break;
    }
}
?>