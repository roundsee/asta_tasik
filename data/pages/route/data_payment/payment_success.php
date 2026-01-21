<?php
$login_hash = $_SESSION['login_hash'];
$en = $_SESSION['employee_number'];
$to = $_SESSION['to'];
$area_e = $_SESSION['area_e'];
$area_nama = $_SESSION['area_nama'];

$judulform = 'Payment Lunas';

$data = 'data_payment';
$aksi = 'aksi_payment';
$rute = 'invoice_pembelian';

$rute_detail2 = "payment_add";
$view = 'payment_view';

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
                                                        <thead style="background-color: lightgray;" class="elevation-2">
                                                            <tr>
                                                                <th>No.</th>
                                                                <th><?= $j1; ?></th>
                                                                <th><?php echo $j2; ?></th>
                                                                <th><?php echo $j3; ?></th>
                                                                <th>Nama Supplier</th>
                                                                <th>Total Tagihan</th>
                                                                <th>Status</th>
                                                               
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $sql1 = mysqli_query($koneksi, "
                                                                SELECT barang.nama, SUM(((pd.nilai* pd.jml) - pd.disc)+(pembelian.ppn * (((pd.nilai* pd.jml) - pd.disc)* pembelian.tarif_ppn / 100 )))+pembelian_invoice.ongkir as hargatotal,
                                                               pembelian.kd_po,
                                                               pembelian_invoice.tanggal_invoice,
                                                               pembelian_invoice.no_invoice,
                                                               supplier.nama as nama_supplier,
                                                               supplier.term_of_payment
                                                               FROM pembelian_invoice_detail pd
                                                                JOIN barang ON barang.kd_brg = pd.kd_brg
                                                                JOIN pembelian ON pembelian.kd_po = pd.kd_po
                                                                join pembelian_invoice ON pembelian_invoice.no_invoice = pd.no_invoice
                                                                join supplier ON supplier.kd_supp = pembelian_invoice.kd_supp
                                                                    WHERE pembelian_invoice.status_payment > 1 
                                                                GROUP BY pd.kd_po ;
                                                            ");


                                                            if (!$sql1) {
                                                                die("Query Error: " . mysqli_error($koneksi));
                                                            }

                                                            $no = 1;
                                                            while ($s1 = mysqli_fetch_array($sql1)) {
                                                                $sql2 = mysqli_query($koneksi, "SELECT sum(jumlah_payment) as jumlah_payment from payment where no_invoice = '$s1[no_invoice]' group by no_invoice");
                                                                $s2 = mysqli_fetch_assoc($sql2);
                                                                $jumlah_payment = isset($s2['jumlah_payment']) ? $s2['jumlah_payment'] : 0;

                                                                $sisaTagihan = $s1['hargatotal'] - $jumlah_payment;

                                                            ?>
                                                                <tr align="left">

                                                                    <td><?php echo $no; ?></td>
                                                                    <td><a href="main.php?route=<?php echo $view; ?>&act&id=<?php echo $s1[$f1]; ?>&asal=<?php echo $rute; ?>" title="Detail"><?php echo $s1[$f1]; ?></a></td>
                                                                    <td><?php echo $s1[$f2]; ?></td>
                                                                    <td><?php echo $s1[$f3]; ?></td>
                                                                    <td><?php echo $s1['nama_supplier']; ?></td>
                                                                    <td style="text-align:right;"><?php echo format_rupiah($s1['hargatotal']); ?></td>
                                                                    <!-- <td style="text-align:right;"><?php echo format_rupiah($sisaTagihan); ?></td> -->
                                                                     <td><button class="btn btn-success" >Lunas</button></td>

                                                                   
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