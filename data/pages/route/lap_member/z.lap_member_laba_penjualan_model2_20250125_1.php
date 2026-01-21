<?php

include "../../../../config/koneksi.php";
include "../../../../config/fungsi_rupiah.php";
include "../../../../config/library.php";
include "../../../../config/fungsi_indotgl.php";


session_start();

$login_hash = $_SESSION['login_hash'];
$en = $_SESSION['employee_number'];

$judulform = "Laporan Penjualan (MEMBER)";

$data = 'lap_member';
$rute = 'list_member';
$aksi = 'aksi_list_member';

$tabel = 'mutasi_stok';
$f1 = 'tgl';
$f2 = 'regional';
$f3 = 'kd_unit';
$f4 = 'nama_outlet';
$f5 = 'kd_sage';
$f6 = 'nama_barang';
$f7 = 'satuan';
$f8 = 'qty_awal';
$f9 = 'nilai_awal';
$f10 = 'qty_beli';
$f11 = 'nilai_beli';
$f12 = 'qt_produksi';
$f13 = 'nilai_produksi';
$f14 = 'qt_terima_int';
$f15 = 'nilai_terima_int';
$f16 = 'qt_tersedia';
$f17 = 'nilai_tersedia';
$f18 = 'harga_rata';
$f19 = 'qt_kirim_int';
$f20 = 'nilai_kirim_int';
$f21 = 'qt_pake';
$f22 = 'nilai_pake';
$f23 = 'qt_jual';
$f24 = 'nilai_jual';
$f25 = 'hpp_jual';
$f26 = 'qt_akhir';
$f27 = 'nilai_akhir';
$f28 = 'harga_patokan_hpp';
$f29 = 'nilai_qty_hpp';


$j1 = 'Tanggal';
$j2 = 'Regional';
$j3 = 'Kd Cus';
$j4 = 'Nama Outlet';
$j5 = 'Kd Sage';
$j6 = 'Nama Barang';
$j7 = 'Satuan';
$j8 = 'Qty Awal';
$j9 = 'Nilai Awal';
$j10 = 'Qty Beli';
$j11 = 'Nilai Beli';
$j12 = 'Qty Produksi';
$j13 = 'Nilai Produksi';
$j14 = 'Qty Terima Int';
$j15 = 'Nilai Terima Int';
$j16 = 'Qty Tersedia';
$j17 = 'Nilai Tersedia';
$j18 = 'Harga Rata';
$j19 = 'Qty Kirim Int';
$j20 = 'Nilai Kirim Int';
$j21 = 'Qty Pakai';
$j22 = 'Nilai Pakai';
$j23 = 'Qty Jual';
$j24 = 'Nilai Jual';
$j25 = 'Hpp Jual';
$j26 = 'Qty Akhir';
$j27 = 'Nilai Akhir';


$tgl_awal = $_GET['tgl_awal'];
$tgl_akhir = $_GET['tgl_akhir'];
$filter = $_GET['filter'];
$nilai = $_GET['nilai'];
$barangs_list = $_GET['barangs_list'];
$members_list = $_GET['members_list'];
if ($barangs_list != " " && !empty($barangs_list)) {
    $kondisi3 = "  AND $tabel.kd_brg IN ($barangs_list)";
} else {
    $kondisi3 = "";
}
if ($members_list != " " && !empty($members_list)) {
    $kondisi4 = "  AND penjualan.no_meja IN ($members_list)";
} else {
    $kondisi4 = "";
}

// $tgl_terakhir=$tgl_akhir+interval 1 day;

// echo '<br/><br/><br/>';

// echo "<br/>".$tgl_awal;
// echo "<br/>".$tgl_akhir;
// echo "<br/>".$filter;
// echo "<br/>".$nilai;

$kondisi = "";
$judul_nilai = '';
$kondisi_join = '';
$kondisi_group = '';


$judul = $judulform;
$judul2 = $filter . " : " . $judul_nilai;
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

<table id="example4" class="table table-bordered table-striped">
    <thead style="background-color: lightgray;" class="elevation-2">
        <tr>
            <th width="20">No.</th>
            <th width="55">Member</th>
            <th width="55">Kode Barang</th>
            <th width="55">Nama Barang</th>
            <th width="55" style="text-align:right">QTY Penjualan</th>
            <th width="55" style="text-align:right">Nilai Penjualan</th>
            <th width="55" style="text-align:right">HPP</th>
            <th width="55" style="text-align:right">Margin</th>
            <th width="55" style="text-align:right">Persen HPP</th>
            <th width="55" style="text-align:right">Persen Margin</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT $tabel.kd_brg, barang.nama As nama_barang,
            jualdetil.banyak * jualdetil.qty_satuan as sum_qt_jual,
            jualdetil.banyak * jualdetil.qty_satuan * (CASE WHEN $tabel.qt_jual = 0 THEN 0 ELSE $tabel.nilai_jual / $tabel.qt_jual END) AS sum_nilai_jual,
            jualdetil.banyak * jualdetil.qty_satuan * (CASE WHEN $tabel.qt_jual = 0 THEN 0 ELSE $tabel.hpp_jual / $tabel.qt_jual END) AS sum_hpp_jual,
            ifnull((SELECT nama from member where member.kd_member = penjualan.no_meja),' ') as member
            FROM $tabel
        	JOIN barang ON barang.kd_brg = $tabel.kd_brg
        	JOIN jualdetil ON jualdetil.kd_brg = $tabel.kd_brg
            JOIN penjualan ON penjualan.faktur = jualdetil.faktur
            WHERE $tabel.tgl>='$tgl_awal' AND $tabel.tgl <= '$tgl_akhir' 
            AND jualdetil.tanggal>='$tgl_awal' AND jualdetil.tanggal <= '$tgl_akhir' +interval 1 day $kondisi3 $kondisi4
            $kondisi
            GROUP BY $tabel.kd_brg,penjualan.no_meja
            ORDER BY $tabel.kd_brg ASC";
        // $query = "SELECT jualdetil.kd_brg, barang.nama As nama_barang,
        //     $tabel.qt_jual as sum_qt_jual,
        //     $tabel.nilai_jual as sum_nilai_jual,
        //     $tabel.hpp_jual as sum_hpp_jual,
        //     ifnull((SELECT nama from member where member.kd_member = penjualan.no_meja),' ') as member
        //     FROM jualdetil
        // 	JOIN barang ON barang.kd_brg = jualdetil.kd_brg
        // 	JOIN $tabel ON $tabel.kd_brg  = jualdetil.kd_brg
        //     JOIN penjualan ON penjualan.faktur = jualdetil.faktur
        //     WHERE jualdetil.tanggal>='$tgl_awal' AND jualdetil.tanggal <= '$tgl_akhir' +interval 1 day $kondisi3 $kondisi4
        //     $kondisi
        //     GROUP BY jualdetil.kd_brg
        //     ORDER BY jualdetil.kd_brg ASC";

        $sql1 = mysqli_query($koneksi, $query);
        $no = 1;
        $total_qty = 0;
        $total_nilai_penjualan = 0;
        $total_hpp = 0;
        $total_margin = 0;
        $total_persen_hpp = 0;
        $total_persen_margin = 0;


        if (!$sql1) {
            die("querry error" . mysqli_error($koneksi));
        }
        while ($s1 = mysqli_fetch_array($sql1)) {
            $nilai_margin = ($s1['sum_nilai_jual'] - $s1['sum_hpp_jual']);
            $margin = ($s1['sum_nilai_jual'] != 0) ? ($nilai_margin / $s1['sum_nilai_jual']) : 0;
            $persen_hpp = ($s1['sum_nilai_jual'] != 0) ? ($s1['sum_hpp_jual'] / $s1['sum_nilai_jual']) * 100 : 0;
            $persen_margin = ($s1['sum_nilai_jual'] != 0) ? ($nilai_margin / $s1['sum_nilai_jual']) * 100 : 0;

            $total_qty += $s1['sum_qt_jual'];
            $total_nilai_penjualan += $s1['sum_nilai_jual'];
            $total_hpp += $s1['sum_hpp_jual'];
            $total_margin += $nilai_margin;
        ?>
            <tr align="left">
                <td><?php echo $no; ?></td>
                <td><?php echo $s1['member']; ?></td>
                <td><?php echo $s1['kd_brg']; ?></td>
                <td><?php echo $s1['nama_barang']; ?></td>
                <td style="text-align: right;"><?php echo number_format($s1['sum_qt_jual'], 2); ?></td>
                <td style="text-align: right;"><?php echo number_format($s1['sum_nilai_jual'], 2); ?></td>
                <td style="text-align: right;"><?php echo number_format($s1['sum_hpp_jual'], 2); ?></td>
                <td style="text-align: right;"><?php echo number_format($nilai_margin, 2); ?></td>
                <td style="text-align: right;"><?php echo number_format((1 - $margin) * 100, 2); ?>%</td>

                <td style="text-align: right;"><?php echo number_format($margin * 100, 2); ?>%</td>
            </tr>
        <?php
            $no++;
            // Menghitung persentase total
            $total_persen_hpp = ($total_nilai_penjualan != 0) ? ($total_hpp / $total_nilai_penjualan) * 100 : 0;
            $total_persen_margin = ($total_nilai_penjualan != 0) ? ($total_margin / $total_nilai_penjualan) * 100 : 0;
            // $prosen = ($total_hpp != 0) ? ($total_margin / $total_nilai_penjualan) * 100 : 0;
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="2" style="text-align:right">Total:</td>
            <td style="text-align:right"><?php echo number_format($total_qty, 2); ?></td>
            <td style="text-align:right"><?php echo number_format($total_nilai_penjualan, 2); ?></td>
            <td style="text-align:right"><?php echo number_format($total_hpp, 2); ?></td>
            <td style="text-align:right"><?php echo number_format($total_margin, 2); ?></td>
            <td style="text-align:right"><?php echo number_format($total_persen_hpp, 2); ?>%</td>
            <td style="text-align:right"><?php echo number_format($total_persen_margin, 2); ?>%</td>
        </tr>
    </tfoot>
</table>


<!-- </div> -->

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
    $(document).ready(function() {
        // Menghilangkan loading bar setelah halaman siap
        $("#loading-bar").hide();


    });
</script>
<?php include '../footer_lap_mutasi.php'; ?>