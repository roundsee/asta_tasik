<?php

include "../../../../config/koneksi.php";
include "../../../../config/fungsi_rupiah.php";
include "../../../../config/library.php";
include "../../../../config/fungsi_indotgl.php";


session_start();

$login_hash = $_SESSION['login_hash'];
$en = $_SESSION['employee_number'];

$judulform = 'Retur Penjualan Detail';
$data = 'data_penjualan_retur';
$aksi = 'aksi_penjualan_retur';
$rute = 'penjualan_retur';
$rute_detail = 'penjualan_retur_detail';
$view = 'penjualan_retur_view';


$tabel = 'retur_penjualan';
$f1 = 'tanggal_retur';
$f2 = 'kd_retur';
$f3 = 'faktur';
$f4 = 'kd_brg';
$f5 = 'harga';
$f6 = 'banyak';
$f7 = 'satuan';
$f8 = 'subtotal';
$f9 = 'total_retur';
$f10 = 'login_hash';


$j1 = 'Tanggal Retur';
$j2 = 'Kode Retur';
$j3 = 'Faktur';
$j4 = 'Kode Barang';
$j5 = 'Harga';
$j6 = 'Banyak';
$j7 = 'satuan';
$j8 = 'subtotal';
$j9 = 'Total Retur';
$j10 = 'Login Hash';


$tgl_awal = $_GET['tgl_awal'];
$tgl_akhir = $_GET['tgl_akhir'];
$filter = $_GET['filter'];
$nilai = $_GET['nilai'];
// $tgl_terakhir=$tgl_akhir+interval 1 day;

// echo '<br/><br/><br/>';

// echo "<br/>".$tgl_awal;
// echo "<br/>".$tgl_akhir;
// echo "<br/>".$filter;
// echo "<br/>".$nilai;

if ($filter == 'supplier') {
    $kondisi = "AND kd_supp='$nilai'";
    $query = mysqli_query($koneksi, "SELECT * FROM supplier WHERE kd_supp='$nilai' ");
    $q1 = mysqli_fetch_array($query);
    $judul_nilai = $q1['nama'];
    $kondisi_join = '';
    $kondisi_group = '';
} elseif ($filter == 'area') {
    $newnilai = sprintf("%02s", $nilai);
    $kondisi = "AND unit_kerja.kd_area='$nilai'";
    $query = mysqli_query($koneksi, "SELECT * FROM area WHERE kode='$nilai' ");
    $q1 = mysqli_fetch_array($query);
    $judul_nilai = $q1['nama'];
    $kondisi_join = '';
    $kondisi_group = ', unit_kerja.kd_area';
    // $kondisi_group= ',regional';
} elseif ($filter == 'unitkerja') {
    $kondisi = "AND kd_unit='$nilai'";
    $query = mysqli_query($koneksi, "SELECT * FROM unit_kerja WHERE kd_cus='$nilai' ");
    $q1 = mysqli_fetch_array($query);
    $judul_nilai = $q1['nama'];
    $kondisi_join = '';
    $kondisi_group = '';
} else {
    $kondisi = "";
    $judul_nilai = '';
    $kondisi_join = '';
    $kondisi_group = '';
}


$judul = $judulform;
$judul2 = $filter . "  " . $judul_nilai;
$judul3 = 'Periode : ' . $tgl_awal . " s/d " . $tgl_akhir;

// echo '<br> kondisi :'.$kondisi;
// echo '<br> judul Nilai :'.$judul_nilai;
// echo '<br> kondisi Join :'.$kondisi_join;


include '../header_lap_mutasi.php';

?>
<style type="text/css">
    div.dataTables_wrapper div.dataTables_length select {
        width: 50;
    }

    div.dt-buttons {
        padding-left: 20;
    }

    div.dt-container {
        width: 800px;
        margin: 0 auto;
    }

    .table thead th {
        vertical-align: middle;
    }

    th {
        text-align: center;

    }

    table.dataTable tfoot td {
        /*		padding: 10px 10px!important 6px 18px;*/
        padding-right: 1px !important;
        background-color: beige;
    }

    .bg1 {
        background-color: RGBA(100, 149, 237, .1);
    }

    .bg2 {
        background-color: RGBA(100, 149, 237, .2);
    }

    .bg3 {
        background-color: RGBA(100, 149, 237, .3);
    }

    .bg4 {
        background-color: RGBA(100, 149, 237, .4);
    }

    .bg5 {
        background-color: RGBA(100, 149, 237, .5);
    }

    /* CSS for loading spinner */
    #loading-bar {
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background: rgba(255, 255, 255, 0.8);
        z-index: 9999;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .spinner-container {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100px;
        height: 100px;
        /* border: 10px solid; */
    }

    .spinner {
        width: 100px;
        height: 100px;
        border: 16px solid #f3f3f3;
        border-top: 8px solid #f8f850;
        border-radius: 50%;
        animation: spin 1.5s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .loading-text {
        margin-top: 5px;
        font-size: 1.5rem;
        /* Increased font size */
        font-family: Arial, sans-serif;
        color: #333;
        font-weight: bold;
        /* Added font weight */
    }

    .dot {
        font-size: 2rem;
        /* Match dot size to text */
        animation: blink 1.4s infinite both;
    }

    .dot:nth-child(2) {
        animation-delay: 0.2s;
        animation: blink 1.4s infinite both;
    }

    .dot:nth-child(3) {
        animation-delay: 0.4s;
        animation: blink 1.4s infinite both;
    }

    .dot:nth-child(4) {
        animation-delay: 0.4s;
        animation: blink 1.4s infinite both;
    }

    .dot:nth-child(5) {
        animation-delay: 0.4s;
        animation: blink 1.4s infinite both;
    }

    @keyframes blink {

        0%,
        20%,
        50%,
        80%,
        100% {
            opacity: 1;
        }

        40% {
            opacity: 0;
        }

        60% {
            opacity: 0;
        }
    }
</style>
<!-- <div id="loading-bar">
    <div class="spinner-container">
        <div class="spinner"></div>
    </div>
    <div class="loading-text">
        Proses<span class="dot">.</span><span class="dot">.</span><span class="dot">.</span><span class="dot">.</span><span class="dot">.</span>
    </div>
</div> -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
<!-- <div class="container"> -->

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
                    <li class="breadcrumb-item"><a href="../../main.php?route=home">Beranda</a></li>
                    <li class="breadcrumb-item active">Laporan</li>
                    <li class="breadcrumb-item active"><?php echo $judulform; ?></li>
                </ol>
            </div>

        </div>

        <br>
        <center>
            <h4><?php echo $judul; ?>
                <h5><?php echo $judul2; ?></h5>

                <?php echo $judul3; ?>
            </h4>
        </center>
    </div><!-- /.container-fluid -->
</section>
<?php if ($filter == 'semua') { ?>
    <table id="example4" width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-bordered table-striped">
        <thead style="background-color: #ddd;">
            <tr style="font-weight: 600">
                <th align="center" width="40px">No</th>
                <th>Nomor Faktur</th>
                <th>Nomor Retur</th>
                <th>Tanggal Retur</th>
                <th>Pengembalian Oleh</th>
                <th>Gudang</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th align="left">Qty Retur</th>
                <th align="left">Satuan</th>
                <th align="left" width="140px">Harga</th>
                <th align="right" width="100px">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $current_supplier = 0;
            $total_keseluruhan = 0;

            $sql1 = mysqli_query($koneksi, "SELECT rp.tanggal_retur,rp.kd_retur,rp.faktur,rp.kd_brg,rp.login_hash,b.nama AS nama_barang,p.nama AS nama_gudang,rp.total_retur,rp.harga
            FROM retur_penjualan rp 
            LEFT JOIN barang b ON rp.kd_brg=b.kd_brg
            LEFT JOIN pelanggan p ON rp.kd_cus=p.kd_cus
            WHERE rp.tanggal_retur BETWEEN '$tgl_awal' AND '$tgl_akhir' AND rp.status_voucher >= 1 
            ORDER BY rp.tanggal_retur,rp.faktur ASC  
           
        ");

            if (!$sql1) {
                die("Query error: " . mysqli_error($koneksi));
            }

            while ($s1 = mysqli_fetch_array($sql1)) {
                $total_keseluruhan += $s1['total_retur'] * $s1['harga'];
                // Jika supplier berubah, cetak subtotal supplier sebelumnya (jika ada)

            ?>
                <tr>
                    <td align="right"><?php echo $no; ?></td>
                    <td align="left"><?php echo $s1['faktur']; ?></td>
                    <td align="left"><?php echo $s1['kd_retur']; ?></td>
                    <td align="left"><?php echo $s1['tanggal_retur']; ?></td>
                    <td align="left"><?php echo $s1['login_hash']; ?></td>
                    <td align="left"><?php echo $s1['nama_gudang']; ?></td>
                    <!-- <td align="left"><?php echo $s1['kd_po']; ?></td> -->
                    <td align="left"><?php echo $s1['kd_brg']; ?></td>
                    <td align="left"><?php echo $s1['nama_barang']; ?></td>
                    <td align="right"><?php echo $s1['total_retur']; ?></td>
                    <!-- <td align="right"><?php echo  number_format($s1['jumlah_barang_datang'] * $s1['jml_pcs'], 0, ',', '.'); ?></td> -->

                    <!-- <td align="right"><?php echo $s1['jumlah_barang_datang']; ?></td> -->
                    <td>Pcs</td>
                    <!-- <td align="right"><?php echo $s1['jml_pcs']; ?></td> -->
                    <td align="right"><?php echo number_format($s1['harga']); ?></td>
                    <td align="right"><?php echo  number_format($s1['total_retur'] * $s1['harga'], 0, ',', '.'); ?></td>
                    <!-- <td align="right"><?php echo number_format($s1['tot_disc']); ?></td> -->
                    <!-- <td align="right"><?php echo number_format($nilai_pjk); ?></td> -->
                    <!-- <td align="right"><?php echo number_format($subtotal); ?></td> -->
                </tr>
            <?php
                $no++;
            }

            // Tampilkan subtotal terakhir setelah loop
            if ($current_supplier != "") {
            ?>
                <!-- <tr>
            <td colspan="9" align="right">Subtotal</td>
            <td align="right"><?php echo number_format($subtotal_supplier); ?></td>
        </tr> -->
            <?php } ?>
        </tbody>
        <tfoot>
            <tr style="font-weight: 600">
                <td colspan="10" align="right">Total Keseluruhan</td>
                <td align="right"><?php echo number_format($total_keseluruhan); ?></td>
            </tr>
        </tfoot>
    </table>
<?php } ?>

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
            scrollX: true,
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
</script>
<script>

</script>

<script>
    $(document).ready(function() {
        // Menghilangkan loading bar setelah halaman siap
        $("#loading-bar").hide();


    });
</script>

<?php include '../footer_lap_mutasi.php'; ?>