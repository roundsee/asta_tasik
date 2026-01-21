<?php
$login_hash = $_SESSION['login_hash'];
$en = $_SESSION['employee_number'];
$to = $_SESSION['to'];
$area_e = $_SESSION['area_e'];
$area_nama = $_SESSION['area_nama'];

$judulform = 'Paylater';

$data = 'data_paylater';
$aksi = 'aksi_paylater';
$rute = 'paylater';

$rute_detail2 = "paylater_add";
$view = 'paylater_view';

$tabel = 'pembelian_invoice';
$f1 = 'no_invoice';
$f2 = 'tanggal_invoice';
$f3 = 'kd_po';
$f4 = 'kd_supp';
$f5 = 'status_payment';
$f6 = 'status_print';
$f7 = 'status_invoice';
$f8 = 'ppn';
$f9 = 'ongkir';

$j1 = 'no_invoice';
$j2 = 'Tanggal Invoice';
$j3 = 'Kode Po';
$j4 = 'Kode Supp';
$j5 = 'Status Payment';
$j6 = 'Status Print';
$j7 = 'Status Invoice';
$j8 = 'PPN';
$j9 = 'ongkir';

$tabel2 = 'pembelian_invoice_detail';
$ff1 = 'no_invoice';
$ff2 = 'kd_po';
$ff3 = 'kd_brg';
$ff4 = 'nilai';
$ff5 = 'disc';
$ff6 = 'jml_pcs';


$jj1 = 'no invoice';
$jj2 = 'Kode Po';
$jj3 = 'Kode Barang';
$jj4 = 'Nilai';
$jj5 = 'Disc';
$jj6 = 'Jumlah Pcs';

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
                                                    <!-- <button class="btn btn-primary btn-sm elevation-2" style="opacity: .7;" onclick="window.location='main.php?route=invoice_tambah'">
                                                        <i class="fa fa-plus"></i> Tambah
                                                    </button> -->
                                                    <div style="margin:10px"></div>

                                                    <table id="example1" class="table table-bordered table-striped">
                                                        <thead style="background-color: lightgray;" class="elevation-2">
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>Tanggal</th>
                                                                <th>Faktur</th>
                                                                <th>Nama Member</th>
                                                                <th>Alat Bayar</th>
                                                                <th>Total Tagihan</th>
                                                                <th>Sisa Tagihan</th>
                                                                <?php if ($login_hash == 6) { ?>
                                                                    <th style="text-align: center;">Aksi</th>
                                                                <?php } ?>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $sql1 = mysqli_query($koneksi, "
                                                              SELECT 
                                                                penjualan.faktur,
                                                                date(penjualan.tanggal) as tanggal,
                                                                (penjualan.jumlah + penjualan.ongkir - penjualan.voucher_nilai_diskon - penjualan.byr_pocer) as jumlah,
                                                                member.nama,
                                                                COALESCE(
                                                                    (SELECT SUM(paylater.jumlah_payment) 
                                                                    FROM paylater 
                                                                    WHERE paylater.faktur = penjualan.faktur), 
                                                                    0
                                                                ) AS sisa,
                                                                COALESCE(
                                                                    (SELECT SUM(paylater.status_payment) 
                                                                    FROM paylater 
                                                                    WHERE paylater.faktur = penjualan.faktur), 
                                                                    0
                                                                ) AS lunas
                                                            FROM penjualan
                                                            JOIN member 
                                                                ON penjualan.no_meja = member.kd_member
                                                            WHERE penjualan.kd_alatbayar = 214 
                                                            HAVING (jumlah - sisa) > 0;
                                                            ");


                                                            if (!$sql1) {
                                                                die("Query Error: " . mysqli_error($koneksi));
                                                            }

                                                            $no = 1;
                                                            while ($s1 = mysqli_fetch_array($sql1)) {
                                                                if ($s1['lunas'] == 0) {
                                                                    $link = "main.php?route=lap_pb1_detil_view&act&id={$s1['faktur']}&asal=pb1";

                                                            ?>
                                                                    <tr align="left">
                                                                        <td><?php echo $no; ?></td>
                                                                        <td><?php echo $s1['tanggal']; ?></td>
                                                                        <td><a href="<?php echo $link; ?>" title="Detail"><?php echo $s1['faktur']; ?></a></td>
                                                                        <td><?php echo $s1['nama']; ?></td>
                                                                        <td>Paylater</td>
                                                                        <td style="text-align:right;"><?php echo format_rupiah($s1['jumlah']); ?></td>
                                                                        <td style="text-align:right;"><?php echo format_rupiah($s1['jumlah'] - $s1['sisa']); ?></td>

                                                                        <?php if ($login_hash == 6) { ?>
                                                                            <td style="text-align: center;">
                                                                                <a href="main.php?route=<?php echo $rute_detail2; ?>&act&id=<?php echo $s1['faktur']; ?>&asal=<?php echo $rute; ?>" title="edit Detail">
                                                                                    <button class="btn btn-primary btn-sm elevation-2" type="button" style="opacity: .7;" data-toggle="modal" data-target="#modalDetail<?php echo $s1['faktur']; ?>">
                                                                                        <i class="fa fa-check"></i> bayar
                                                                                    </button>
                                                                                </a>
                                                                                <button class="btn btn-success btn-sm elevation-2"
                                                                                    type="button"
                                                                                    style="opacity:.7;"
                                                                                    title="Detail"
                                                                                    onclick="window.location.href='main.php?route=<?php echo $view; ?>&act&id=<?php echo $s1['faktur']; ?>&asal=<?php echo $rute; ?>'">
                                                                                    <i class="fa fa-check"></i> Daftar Bayar
                                                                                </button>
                                                                            </td>
                                                                        <?php } ?>
                                                                    </tr>
                                                            <?php
                                                                    $no++;
                                                                }
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
<?php
            break;
    }
}
?>