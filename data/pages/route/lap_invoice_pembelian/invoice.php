<?php
$login_hash = $_SESSION['login_hash'];
$en = $_SESSION['employee_number'];
$to = $_SESSION['to'];
$area_e = $_SESSION['area_e'];
$area_nama = $_SESSION['area_nama'];

$judulform = 'Invoice Pembelian';

$data = 'lap_invoice_pembelian';
$aksi = 'aksi_invoice_pembelian';
$rute = 'invoice_pembelian';

$rute_detail2 = "invoice_bayar";
$view = 'invoice_pembelian_view';

$tabel = 'pembelian_invoice';
$f1 = 'no_invoice';
$f2 = 'tanggal_invoice';
$f3 = 'kd_po';
$f4 = 'kd_supp';
$f5 = 'status_payment';
$f6 = 'status_print';
$f7 = 'status_invoice';

$j1 = 'no_invoice';
$j2 = 'Tanggal Invoice';
$j3 = 'Kode Po';
$j4 = 'Kode Supp';
$j5 = 'Status Payment';
$j6 = 'Status Print';
$j7 = 'Status Invoice';

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
                                                        <thead style="background-color:  lightgray;" class="elevation-2">
                                                            <tr>
                                                                <th>No.</th>
                                                                <th><?= $j1; ?></th>
                                                                <th><?php echo $j2; ?></th>
                                                                <th><?php echo $j3; ?></th>
                                                                <th>Nama Supplier</th>
                                                                <th>Total Tagihan yang harus dibayar</th>
                                                                <!-- <th style="text-align: center;">Aksi</th> -->
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $subtotal = 0;
                                                            $stotal = 0;
                                                            $sql1 = mysqli_query(
                                                                $koneksi,
                                                                "SELECT *,supplier.nama,
                                                                  (SELECT pb.jumlah_datang
                                                                    FROM penerimaan_barang pb
                                                                    WHERE pb.kd_po = $tabel.kd_po  AND pb.kd_brg = pd.kd_brg
                                                                    LIMIT 1) as jumlah_datang, pembelian.tarif_ppn as tarif, pembelian_invoice.ongkir as biayaongkir
                                                                    FROM $tabel
                                                                    JOIN supplier ON supplier.kd_supp= $tabel.kd_supp
                                                                    JOIN pembelian_detail  pd ON pd.kd_po = $tabel.kd_po
                                                                    JOIN pembelian ON pembelian.kd_po = $tabel.kd_po
                                                                    LEFT JOIN penerimaan_barang pb ON pb.kd_po = pd.kd_po AND pb.kd_brg = pd.kd_brg
                                                                    GROUP BY $tabel.no_invoice
                                                                    ORDER BY $tabel.$f1 ASC
                                                            "

                                                            );

                                                            // $query="SELECT a.$f1,a.$f2,a.$f3,a.$f4,a.$f5,j.nama as nama_aplikasi
                                                            // from $tabel a
                                                            // join $tabel2 j on a.$f5=j.$ff1
                                                            // order by a.$f1 asc";
                                                            if (!$sql1) {
                                                                die("Query Error" . mysqli_error($koneksi));
                                                            }
                                                            // $sql1=mysqli_query($koneksi,$query);
                                                            $no = 1;
                                                            while ($s1 = mysqli_fetch_array($sql1)) {
                                                                $sql2 = mysqli_query($koneksi, "SELECT kd_po, kd_brg, SUM(disc) as tot_disc, SUM(price) as price FROM pembelian_detail WHERE kd_po='$s1[kd_po]' ");
                                                                if (!$sql2) {
                                                                    die('Query error: ' . mysqli_error($koneksi));
                                                                }

                                                                $jumlah_datang = $s1['jumlah_datang'];
                                                                print_r($jumlah_datang) . "<br>";
                                                                $s2 = mysqli_fetch_array($sql2);
                                                                $grand_total = ($s1['jumlah_datang'] * $s2['price']) - $s2['tot_disc']; // Inisialisasi grand_total untuk akumulasi



                                                                // Jika grand_total diubah, pastikan diskon juga dihitung
                                                                // echo $s1['ppn'] ."<br>";

                                                                if ($s1['ppn'] == 1) {
                                                                    $nilai_pjk = $grand_total * $s1['tarif'] / 100;
                                                                } else {
                                                                    $nilai_pjk = 0;
                                                                }
                                                                $subtotal = $grand_total + $nilai_pjk + $s1['biayaongkir'];
                                                                $stotal += $subtotal;
                                                                // Tampilkan subtotal
                                                                // echo $subtotal;



                                                            ?>
                                                                <tr align="left">
                                                                    <td><?php echo $no; ?></td>
                                                                    <td><a href="main.php?route=<?php echo $view; ?>&act&id=<?php echo $s1[$f1]; ?>&asal=<?php echo $rute; ?>" title="Detail"><?php echo $s1[$f1]; ?></a></td>
                                                                    <td><?php echo $s1[$f2]; ?></td>
                                                                    <td><?php echo $s1[$f3]; ?></td>
                                                                    <td><?php echo $s1['nama']; ?></td>
                                                                    <td style="text-align:right;"><?php echo format_rupiah($subtotal); ?></td>

                                                                    <!-- <td style="text-align: center;">
                                                                        <a href="route/<?php echo $data; ?>/cetak.php?no_invoice=<?php echo $s1['no_invoice']; ?>" target="_blank">
                                                                            <button class="btn btn-warning btn-sm elevation-2" type="button" style="opacity: .7;">
                                                                                <i class="fa fa-check"></i> Bayar
                                                                            </button>
                                                                        </a>
                                                                    </td> -->
                                                                    <!-- <td style="text-align: center;">
                                                                        <a href="main.php?route=<?php echo $rute_detail2; ?>&act&id=<?php echo $s1[$f1]; ?>&asal=<?php echo $rute; ?>" title="edit Detail">

                                                                            <button class="btn btn-primary btn-sm elevation-2" type="button" style="opacity: .7;" data-toggle="modal" data-target="#modalDetail<?php echo $s1[$f1]; ?>">
                                                                                <i class="fa fa-check"></i> Catat Invoice
                                                                            </button>
                                                                        </a>
                                                                    </td> -->

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
<?php
            break;
    }
}
?>