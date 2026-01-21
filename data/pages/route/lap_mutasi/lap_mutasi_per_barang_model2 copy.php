<?php

include "../../../../config/koneksi.php";
include "../../../../config/fungsi_rupiah.php";
include "../../../../config/library.php";
include "../../../../config/fungsi_indotgl.php";


session_start();

$login_hash = $_SESSION['login_hash'];
$en = $_SESSION['employee_number'];

$judulform = "Mutasi";

$data = 'lap_mutasi';
$rute = 'list_mutasi';
$aksi = 'aksi_list_mutasi';

$tabel = 'mutasi_stok';
$f1 = 'tgl';
$f2 = 'kd_cus';
$f3 = 'kd_brg';
$f4 = 'satuan';
$f5 = 'qty_awal';
$f6 = 'nilai_awal';
$f7 = 'qty_beli';
$f8 = 'nilai_beli';
$f9 = 'qty_beli_retur';
$f10 = 'nilai_beli_retur';
$f11 = 'qt_tersedia';
$f12 = 'nilai_tersedia';
$f13 = 'harga_rata';
$f14 = 'qt_jual';
$f15 = 'nilai_jual';
$f16 = 'hpp_jual';
$f17 = 'qt_akhir';
$f18 = 'nilai_akhir';
$f19 = 'stok_opname';
$f20 = 'nilai_opname';

$j1 = 'Tanggal';
$j2 = 'Kode Customer';
$j3 = 'Kode Barang';
$j4 = 'Satuan';
$j5 = 'Qty Awal';
$j6 = 'Nilai Awal';
$j7 = 'Qty Beli';
$j8 = 'Nilai Beli';
$j9 = 'Qty Beli Retur';
$j10 = 'Nilai Beli Retur';
$j11 = 'Qty Tersedia';
$j12 = 'Nilai Tersedia';
$j13 = 'Harga Rata-Rata';
$j14 = 'Qty Jual';
$j15 = 'Nilai Jual';
$j16 = 'HPP Jual';
$j17 = 'Qty Akhir';
$j18 = 'Nilai Akhir';
$j19 = 'Stok Opname';
$j20 = 'Nilai Opname';


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

if ($filter == 'outlet') {
  $kondisi = "AND kd_unit='$nilai'";
  $query = mysqli_query($koneksi, "SELECT * FROM unit_kerja WHERE kd_cus='$nilai' ");
  $q1 = mysqli_fetch_array($query);
  $judul_nilai = $q1['nama'];
  $kondisi_join = '';
  $kondisi_group = '';
} elseif ($filter == 'area') {
  $newnilai = sprintf("%02s", $nilai);
  $kondisi = "AND kd_cus='$nilai'";
  $query = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE kd_cus='$nilai' ");
  $q1 = mysqli_fetch_array($query);
  $judul_nilai = $q1['nama'];
  $kondisi_join = '';
  $kondisi_group = '';
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
        <!-- <h5><?php echo $judul2; ?></h5> -->
        <?php echo $judul3; ?>
      </h4>
    </center>
    <h5>
      tes
    </h5>
  </div><!-- /.container-fluid -->
</section>
<!-- <div class="table-responsive"> -->
<?php if ($filter == 'semua') { ?>

  <!-- <center>
    <h3 class="mt-4 mb-3">Outlet dan Dapur</h3>
  </center> -->
  <table id="example4" class="table table-bordered table-striped" style="width:1900px;">
    <thead style="background-color: lightgray;" class="elevation-2">
      <tr>
        <th width="5" rowspan="2">No</th>
        <th width="115" rowspan="2">Kode Barang</th>
        <th width="225" rowspan="2">Nama Barang</th>
        <th colspan="3" class="bg1">Awal</th>
        <th colspan="3" class="bg2">Penerimaan</th>
        <th width="55" rowspan="2" class="bg3">Hpp</th>
        <!-- <th rowspan="2">biaya</th> -->
        <th colspan="3" class="bg4">Pengeluaran</th>
        <th colspan="3" class="bg5">Akhir</th>
        <!-- <th rowspan="2">Min Stok</th>
        <th rowspan="2">Max Stok</th> -->
        <!-- <th rowspan="2">Satuan</th> -->
        <!-- <th rowspan="2">Order Status</th> -->
      </tr>
      <tr>
        <th width="55" style="text-align:right;" class="bg1">Qty</th>
        <th width="55" style="text-align:right;" class="bg1">Harga</th>
        <th width="55" style="text-align:right;" class="bg1">Nilai</th>
        <th width="55" style="text-align:right;" class="bg2">Qty</th>
        <th width="55" style="text-align:right;" class="bg2">Harga</th>
        <th width="55" style="text-align:right;" class="bg2">Nilai</th>
        <th width="55" style="text-align:right;" class="bg4">Qty</th>
        <th width="55" style="text-align:right;" class="bg4">Harga</th>
        <th width="55" style="text-align:right;" class="bg4">Nilai</th>
        <th width="55" style="text-align:right;" class="bg5">Qty</th>
        <th width="55" style="text-align:right;" class="bg5">Harga</th>
        <th width="55" style="text-align:right;" class="bg5">Nilai</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $query = "SELECT $tabel.kd_brg, barang.nama AS nama_barang,
          SUM(qty_beli_retur) AS sum_qty_beli_retur, SUM(nilai_beli_retur) AS sum_nilai_beli_retur,
          SUM(qty_awal) AS sum_qty_awal, SUM(nilai_awal) AS sum_nilai_awal,
          SUM(qty_beli) AS sum_qty_beli, SUM(nilai_beli) AS sum_nilai_beli,
          SUM(qt_jual) AS sum_qt_jual, SUM(nilai_jual) AS sum_nilai_jual,
          SUM(qt_terima_int) AS sum_qt_terima_internal, SUM(nilai_terima_int) AS sum_nilai_terima_internal,
          SUM(qt_kirim_int) AS sum_qt_kirim_internal, SUM(nilai_kirim_int) AS sum_nilai_kirim_internal,
          SUM(qt_pake) AS sum_qt_pake, SUM(nilai_pake) AS sum_nilai_pake
          FROM $tabel
          JOIN barang ON barang.kd_brg = $tabel.kd_brg 
          WHERE tgl >= '$tgl_awal' AND tgl <= '$tgl_akhir' 
          $kondisi
          GROUP BY $tabel.kd_brg $kondisi_group
          ORDER BY $tabel.kd_brg ASC";

      $sql1 = mysqli_query($koneksi, $query);
      $no = 1;
      $grand_awal = 0;
      $grand_penerimaan = 0;
      $grand_pengeluaran = 0;
      $grand_akhir = 0;
      $grand_biaya = 0;

      if (!$sql1) {
        die("querry error" . mysqli_error($koneksi));
      }

      while ($s1 = mysqli_fetch_array($sql1)) {
        $query2 = "SELECT SUM(qty_awal) AS q2_sum_qty_awal, SUM(nilai_awal) AS q2_sum_nilai_awal
            FROM $tabel
            WHERE tgl = '$tgl_awal' AND kd_brg = '{$s1[$f3]}'
            $kondisi
            GROUP BY kd_brg";

        $sql2 = mysqli_query($koneksi, $query2);
        $q2 = mysqli_fetch_array($sql2);

        $q2_qty_awal = !isset($q2['q2_sum_qty_awal']) ? 0 : $q2['q2_sum_qty_awal'];
        $q2_nil_nilai_awal = !isset($q2['q2_sum_nilai_awal']) ? 0 : $q2['q2_sum_nilai_awal'];

        if ($q2_qty_awal == 0) {
          $total_harga_awal = 0;
        } else {
          $total_harga_awal = $q2_nil_nilai_awal / $q2_qty_awal;
        }

        $total_qty_penerimaan = $s1['sum_qty_beli']  + $s1['sum_qt_terima_internal'];
        $total_penerimaan = $s1['sum_nilai_beli'] + $s1['sum_nilai_terima_internal'];

        if ($total_qty_penerimaan == 0) {
          $total_harga_penerimaan = 0;
        } else {
          $total_harga_penerimaan = $total_penerimaan / $total_qty_penerimaan;
        }

        $total_qty_pengeluaran = $s1['sum_qt_kirim_internal'] + $s1['sum_qt_pake'];
        $total_pengeluaran = $s1['sum_nilai_kirim_internal'] + $s1['sum_nilai_pake'];

        if ($total_qty_pengeluaran == 0) {
          $total_harga_pengeluaran = 0;
        } else {
          $total_harga_pengeluaran = $total_pengeluaran / $total_qty_pengeluaran;
        }

        $qty_akhir = $q2_qty_awal + $total_qty_penerimaan - $total_qty_pengeluaran;
        $nilai_akhir = $q2_nil_nilai_awal + $total_penerimaan - $total_pengeluaran;

        if ($qty_akhir == 0) {
          $harga_akhir = 0;
        } else {
          $harga_akhir = $nilai_akhir / $qty_akhir;
        }

        $query3 = "SELECT *
            FROM master_outlet_barang
            WHERE  kd_sage = '{$s1[$f3]}'";

        $sql3 = mysqli_query($koneksi, $query3);
        $q3 = mysqli_fetch_array($sql3);

        if (isset($q3['min_stok'])) {
          $data_min = $q3['min_stok'];
        } else {
          $data_min = 0;
        }
        if (isset($q3['max_stok'])) {
          $data_max = $q3['max_stok'];
        } else {
          $data_max = 0;
        }

        if (isset($q3['satuan'])) {
          $satuan = $q3['satuan'];
        } else {
          $satuan = "";
        }
        if (isset($q3['satuan'])) {
          $satuan = $q3['satuan'];
        } else {
          $satuan = "";
        }

        $satuan = 'Pcs';

        // if ($qty_akhir >= $q3['min_stok'] && $qty_akhir <= $q3['max_stok']) {
        if ($qty_akhir >= $data_min && $qty_akhir <= $data_max) {
          $status_stok = '<b>Aman</b>';
        } elseif ($qty_akhir < $data_min) {
          $status_stok = '<b>ORDER</b>';
        } elseif ($qty_akhir > $data_max) {
          $status_stok = '<b>OVER</b>';
        }

        $grand_awal += $q2_nil_nilai_awal;
        $grand_pengeluaran += $total_pengeluaran;
        $grand_akhir += $nilai_akhir;
      ?>
        <tr align="left">
          <td><?php echo $no; ?></td>
          <td><?php echo $s1[$f3]; ?></td>
          <td><?php echo $s1['nama_barang']; ?></td>
          <td style="text-align: right;" class="bg1"><?php echo number_format($q2_qty_awal, 2); ?></td>
          <td style="text-align: right;" class="bg1"><?php echo number_format($total_harga_awal, 2); ?></td>
          <td style="text-align: right;" class="bg1"><?php echo number_format($q2_nil_nilai_awal, 2); ?></td>

          <td style="text-align: right;" class="bg2"><?php echo number_format($total_qty_penerimaan, 2); ?></td>
          <td style="text-align: right;" class="bg2"><?php echo number_format($total_harga_penerimaan, 2); ?></td>
          <td style="text-align: right;" class="bg2"><?php echo number_format($total_penerimaan, 2); ?></td>
          <td style="text-align: left;" class="bg3"><?php echo $satuan; ?></td>

          <!-- <td style="text-align: right;"><?php echo number_format(0, 2); ?></td> -->

          <?php
          $grand_penerimaan += $total_penerimaan;
          ?>


          <td style="text-align: right;" class="bg4"><?php echo number_format($total_qty_pengeluaran, 2); ?></td>
          <td style="text-align: right;" class="bg4"><?php echo number_format($total_harga_pengeluaran, 2); ?></td>
          <td style="text-align: right;" class="bg4"><?php echo number_format($total_pengeluaran, 2); ?></td>
          <td style="text-align: right;" class="bg5"><?php echo number_format($qty_akhir, 2); ?></td>
          <td style="text-align: right;" class="bg5"><?php echo number_format($harga_akhir, 2); ?></td>
          <td style="text-align: right;" class="bg5"><?php echo number_format($nilai_akhir, 2); ?></td>
          <!-- <td style="text-align: right;"><?php echo number_format($data_min, 2); ?></td> -->
          <!-- <td style="text-align: right;"><?php echo number_format($data_max, 2); ?></td> -->
          <!-- <td style="text-align: left;"><?php echo $satuan; ?></td> -->
          <!-- <td style="text-align: center;"><?php echo $status_stok; ?></td> -->
        </tr>
      <?php
        $no++;
      }
      ?>
    </tbody>
    <tfoot>
      <tr style="font-weight:600;font-size: 110%;padding-right: 10;">
        <td colspan="3" style="text-align:right;">Total</td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right;"><?php echo number_format($grand_awal, 2); ?></td>
        <td></td>
        <td></td>
        <td style="text-align: right;"><?php echo number_format($grand_penerimaan, 2); ?></td>
        <!-- <td style="text-align: right;"><?php echo number_format($grand_biaya, 2); ?></td> -->
        <td></td>
        <td></td>
        <td style="text-align: right;"><?php echo number_format($grand_pengeluaran, 2); ?></td>
        <td></td>
        <td></td>
        <td style="text-align: right;"><?php echo number_format($grand_akhir, 2); ?></td>
        <!-- <td></td> -->
        <!-- <td></td> -->
        <!-- <td></td> -->
      </tr>
    </tfoot>
  </table>
<?php } elseif ($filter == 'outlet' or $filter == 'area' or $filter == 'unitkerja') { ?>
  <table id="example4" class="table table-bordered table-striped" style="width:1900px;">
    <thead style="background-color: lightgray;" class="elevation-2">
      <tr>
        <th rowspan="2">No</th>
        <th rowspan="2">Kode Barang</th>
        <th rowspan="2">Nama Barang</th>
        <th rowspan="2">Satuan</th>
        <th colspan="3" class="bg1">Awal</th>
        <th colspan="3" class="bg2">Penerimaan</th>
        <!-- <th rowspan="2">biaya</th> -->
        <th colspan="3" class="bg3">Pengeluaran</th>
        <th colspan="3" class="bg4">Akhir</th>
        <!-- <th rowspan="2">Min Stok</th>
        <th rowspan="2">Max Stok</th> -->
        <!-- <th rowspan="2">Satuan</th> -->
        <!-- <th rowspan="2">Order Status</th> -->
      </tr>
      <tr>
        <th width="55" style="text-align:right;" class="bg1">Qty</th>
        <th width="55" style="text-align:right;" class="bg1">Harga</th>
        <th width="55" style="text-align:right;" class="bg1">Nilai</th>
        <th width="55" style="text-align:right;" class="bg2">Qty</th>
        <th width="55" style="text-align:right;" class="bg2">Harga</th>
        <th width="55" style="text-align:right;" class="bg2">Nilai</th>
        <th width="55" style="text-align:right;" class="bg3">Qty</th>
        <th width="55" style="text-align:right;" class="bg3">Harga</th>
        <th width="55" style="text-align:right;" class="bg3">Nilai</th>
        <th width="55" style="text-align:right;" class="bg4">Qty</th>
        <th width="55" style="text-align:right;" class="bg4">Harga</th>
        <th width="55" style="text-align:right;" class="bg4">Nilai</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $query = "SELECT $tabel.kd_brg, barang.nama AS nama_barang,
          SUM(qty_awal) AS sum_qty_awal, SUM(nilai_awal) AS sum_nilai_awal,
          SUM(qty_beli) AS sum_qty_beli, SUM(nilai_beli) AS sum_nilai_beli,
          SUM(qty_beli_retur) AS sum_qty_beli_retur, SUM(nilai_beli_retur) AS sum_nilai_beli_retur,
          SUM(qt_jual) AS sum_qt_jual, SUM(nilai_jual) AS sum_nilai_jual,
          SUM(qt_terima_int) AS sum_qt_terima_internal, SUM(nilai_terima_int) AS sum_nilai_terima_internal,
          SUM(qt_kirim_int) AS sum_qt_kirim_internal, SUM(nilai_kirim_int) AS sum_nilai_kirim_internal,
          SUM(qt_pake) AS sum_qt_pake, SUM(nilai_pake) AS sum_nilai_pake
          FROM $tabel
          JOIN barang ON barang.kd_brg = $tabel.kd_brg 
          WHERE tgl >= '$tgl_awal' AND tgl <= '$tgl_akhir' 
          $kondisi
          GROUP BY $tabel.kd_brg $kondisi_group
          ORDER BY $tabel.kd_brg ASC";

      $sql1 = mysqli_query($koneksi, $query);
      $no = 1;
      $grand_awal = 0;
      $grand_penerimaan = 0;
      $grand_pengeluaran = 0;
      $grand_akhir = 0;
      $grand_biaya = 0;

      if (!$sql1) {
        die("querry error" . mysqli_error($koneksi));
      }

      while ($s1 = mysqli_fetch_array($sql1)) {
        $query2 = "SELECT SUM(qty_awal) AS q2_sum_qty_awal, SUM(nilai_awal) AS q2_sum_nilai_awal
            FROM $tabel
            WHERE tgl = '$tgl_awal' AND kd_brg = '{$s1[$f3]}'
            $kondisi
            GROUP BY kd_brg";

        $sql2 = mysqli_query($koneksi, $query2);
        $q2 = mysqli_fetch_array($sql2);

        $q2_qty_awal = !isset($q2['q2_sum_qty_awal']) ? 0 : $q2['q2_sum_qty_awal'];
        $q2_nil_nilai_awal = !isset($q2['q2_sum_nilai_awal']) ? 0 : $q2['q2_sum_nilai_awal'];

        if ($q2_qty_awal == 0) {
          $total_harga_awal = 0;
        } else {
          $total_harga_awal = $q2_nil_nilai_awal / $q2_qty_awal;
        }

        $total_qty_penerimaan = $s1['sum_qty_beli'] + $s1['sum_qt_terima_internal'];
        $total_penerimaan = $s1['sum_nilai_beli'] + $s1['sum_nilai_terima_internal'];

        if ($total_qty_penerimaan == 0) {
          $total_harga_penerimaan = 0;
        } else {
          $total_harga_penerimaan = $total_penerimaan / $total_qty_penerimaan;
        }

        $total_qty_pengeluaran = $s1['sum_qt_kirim_internal'] + $s1['sum_qt_pake'];
        $total_pengeluaran = $s1['sum_nilai_kirim_internal'] + $s1['sum_nilai_pake'];

        if ($total_qty_pengeluaran == 0) {
          $total_harga_pengeluaran = 0;
        } else {
          $total_harga_pengeluaran = $total_pengeluaran / $total_qty_pengeluaran;
        }

        $qty_akhir = $q2_qty_awal + $total_qty_penerimaan - $total_qty_pengeluaran;
        $nilai_akhir = $q2_nil_nilai_awal + $total_penerimaan - $total_pengeluaran;

        if ($qty_akhir == 0) {
          $harga_akhir = 0;
        } else {
          $harga_akhir = $nilai_akhir / $qty_akhir;
        }

        $query3 = "SELECT *
            FROM master_outlet_barang
            WHERE  kd_sage = '{$s1[$f3]}'";

        $sql3 = mysqli_query($koneksi, $query3);
        $q3 = mysqli_fetch_array($sql3);

        if (isset($q3['min_stok'])) {
          $data_min = $q3['min_stok'];
        } else {
          $data_min = 0;
        }
        if (isset($q3['max_stok'])) {
          $data_max = $q3['max_stok'];
        } else {
          $data_max = 0;
        }

        if (isset($q3['satuan'])) {
          $satuan = $q3['satuan'];
        } else {
          $satuan = "";
        }
        if (isset($q3['satuan'])) {
          $satuan = $q3['satuan'];
        } else {
          $satuan = "";
        }

        $satuan = 'Pcs';

        // if ($qty_akhir >= $q3['min_stok'] && $qty_akhir <= $q3['max_stok']) {
        if ($qty_akhir >= $data_min && $qty_akhir <= $data_max) {
          $status_stok = '<b>Aman</b>';
        } elseif ($qty_akhir < $data_min) {
          $status_stok = '<b>ORDER</b>';
        } elseif ($qty_akhir > $data_max) {
          $status_stok = '<b>OVER</b>';
        }

        $grand_awal += $q2_nil_nilai_awal;
        $grand_pengeluaran += $total_pengeluaran;
        $grand_akhir += $nilai_akhir;
      ?>
        <tr align="left">
          <td><?php echo $no; ?></td>
          <td><?php echo $s1[$f3]; ?></td>
          <td><?php echo $s1['nama_barang']; ?></td>
          <td style="text-align: left;"><?php echo $satuan; ?></td>
          <td style="text-align: right;" class="bg1"><?php echo number_format($q2_qty_awal, 2); ?></td>
          <td style="text-align: right;" class="bg1"><?php echo number_format($total_harga_awal, 2); ?></td>
          <td style="text-align: right;" class="bg1"><?php echo number_format($q2_nil_nilai_awal, 2); ?></td>

          <td style="text-align: right;" class="bg2"><?php echo number_format($total_qty_penerimaan, 2); ?></td>
          <td style="text-align: right;" class="bg2"><?php echo number_format($total_harga_penerimaan, 2); ?></td>
          <td style="text-align: right;" class="bg2"><?php echo number_format($total_penerimaan, 2); ?></td>

          <!-- <td style="text-align: right;"><?php echo number_format(0, 2); ?></td> -->

          <?php
          $grand_penerimaan += $total_penerimaan;
          ?>


          <td style="text-align: right;" class="bg3"><?php echo number_format($total_qty_pengeluaran, 2); ?></td>
          <td style="text-align: right;" class="bg3"><?php echo number_format($total_harga_pengeluaran, 2); ?></td>
          <td style="text-align: right;" class="bg3"><?php echo number_format($total_pengeluaran, 2); ?></td>
          <td style="text-align: right;" class="bg4"><?php echo number_format($qty_akhir, 2); ?></td>
          <td style="text-align: right;" class="bg4"><?php echo number_format($harga_akhir, 2); ?></td>
          <td style="text-align: right;" class="bg4"><?php echo number_format($nilai_akhir, 2); ?></td>
          <!-- <td style="text-align: right;"><?php echo number_format($data_min, 2); ?></td> -->
          <!-- <td style="text-align: right;"><?php echo number_format($data_max, 2); ?></td> -->
          <!-- <td style="text-align: left;"><?php echo $satuan; ?></td> -->
          <!-- <td style="text-align: center;"><?php echo $status_stok; ?></td> -->
        </tr>
      <?php
        $no++;
      }
      ?>
    </tbody>
    <tfoot>
      <tr style="font-weight:600;font-size: 110%;padding-right: 10;">
        <td colspan="3" style="text-align:right;">Total</td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right;"><?php echo number_format($grand_awal, 2); ?></td>
        <td></td>
        <td></td>
        <td style="text-align: right;"><?php echo number_format($grand_penerimaan, 2); ?></td>
        <!-- <td style="text-align: right;"><?php echo number_format($grand_biaya, 2); ?></td> -->
        <td></td>
        <td></td>
        <td style="text-align: right;"><?php echo number_format($grand_pengeluaran, 2); ?></td>
        <td></td>
        <td></td>
        <td style="text-align: right;"><?php echo number_format($grand_akhir, 2); ?></td>
        <!-- <td></td> -->
        <!-- <td></td> -->
        <!-- <td></td> -->
      </tr>
    </tfoot>
  </table>

<?php } elseif ($filter == 'semuad') { ?>
  <center>
    <h3 class="mt-4 mb-3">Outlet dan Dapur</h3>
  </center>
  <table id="example4" class="table table-bordered table-striped" style="width:1900px;">
    <thead style="background-color: lightgray;" class="elevation-2">
      <tr>
        <th rowspan="2">No</th>
        <th rowspan="2">Kode Barang</th>
        <th rowspan="2">Nama Barang</th>
        <th rowspan="2">Satuan</th>
        <th colspan="3" class="bg1">Awal</th>
        <th colspan="3" class="bg2">Penerimaan</th>
        <th rowspan="2">Biaya</th>
        <th colspan="3" class="bg3">Pengeluaran</th>
        <th colspan="3" class="bg4">Akhir</th>
        <th rowspan="2">Min Stok</th>
        <th rowspan="2">Max Stok</th>
        <!-- <th rowspan="2">Satuan</th> -->
        <th rowspan="2">Order Status</th>
      </tr>
      <tr>
        <th width="55" style="text-align:right;" class="bg1">Qty</th>
        <th width="55" style="text-align:right;" class="bg1">Harga</th>
        <th width="55" style="text-align:right;" class="bg1">Nilai</th>
        <th width="55" style="text-align:right;" class="bg2">Qty</th>
        <th width="55" style="text-align:right;" class="bg2">Harga</th>
        <th width="55" style="text-align:right;" class="bg2">Nilai</th>
        <th width="55" style="text-align:right;" class="bg3">Qty</th>
        <th width="55" style="text-align:right;" class="bg3">Harga</th>
        <th width="55" style="text-align:right;" class="bg3">Nilai</th>
        <th width="55" style="text-align:right;" class="bg4">Qty</th>
        <th width="55" style="text-align:right;" class="bg4">Harga</th>
        <th width="55" style="text-align:right;" class="bg4">Nilai</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $query = "SELECT kd_sage, barang_ori.nama_barang,
          SUM(qty_awal) AS sum_qty_awal, SUM(nilai_awal) AS sum_nilai_awal,
          SUM(qty_beli) AS sum_qty_beli, SUM(nilai_beli) AS sum_nilai_beli,
          SUM(qt_terima_int) AS sum_qt_terima_internal, SUM(nilai_terima_int) AS sum_nilai_terima_internal,
          SUM(qt_kirim_int) AS sum_qt_kirim_internal, SUM(nilai_kirim_int) AS sum_nilai_kirim_internal,
          SUM(qt_pake) AS sum_qt_pake, SUM(nilai_pake) AS sum_nilai_pake
          FROM $tabel
          JOIN barang_ori ON barang_ori.kode_barang = $tabel.kd_sage 
          WHERE tgl >= '$tgl_awal' AND tgl <= '$tgl_akhir' AND NOT
          SUBSTR(kd_sage, 1, 2) = '15' AND (SUBSTR(kd_unit,1,1)='1' or SUBSTR(kd_unit,1,1) = '8')
          $kondisi
          GROUP BY kd_sage $kondisi_group
          ORDER BY kd_sage ASC";

      $sql1 = mysqli_query($koneksi, $query);
      $no = 1;
      $grand_awal = 0;
      $grand_penerimaan = 0;
      $grand_pengeluaran = 0;
      $grand_akhir = 0;
      $grand_biaya = 0;

      if (!$sql1) {
        die("querry error" . mysqli_error($koneksi));
      }

      while ($s1 = mysqli_fetch_array($sql1)) {
        $query2 = "SELECT SUM(qty_awal) AS q2_sum_qty_awal, SUM(nilai_awal) AS q2_sum_nilai_awal
            FROM $tabel
            WHERE tgl = '$tgl_awal' AND kd_sage = '{$s1[$f5]}'
            $kondisi
            GROUP BY kd_sage";

        $sql2 = mysqli_query($koneksi, $query2);
        $q2 = mysqli_fetch_array($sql2);

        $q2_qty_awal = !isset($q2['q2_sum_qty_awal']) ? 0 : $q2['q2_sum_qty_awal'];
        $q2_nil_nilai_awal = !isset($q2['q2_sum_nilai_awal']) ? 0 : $q2['q2_sum_nilai_awal'];

        if ($q2_qty_awal == 0) {
          $total_harga_awal = 0;
        } else {
          $total_harga_awal = $q2_nil_nilai_awal / $q2_qty_awal;
        }

        $total_qty_penerimaan = $s1['sum_qty_beli'] + $s1['sum_qt_terima_internal'];
        $total_penerimaan = $s1['sum_nilai_beli'] + $s1['sum_nilai_terima_internal'];

        if ($total_qty_penerimaan == 0) {
          $total_harga_penerimaan = 0;
        } else {
          $total_harga_penerimaan = $total_penerimaan / $total_qty_penerimaan;
        }

        $total_qty_pengeluaran = $s1['sum_qt_kirim_internal'] + $s1['sum_qt_pake'];
        $total_pengeluaran = $s1['sum_nilai_kirim_internal'] + $s1['sum_nilai_pake'];

        if ($total_qty_pengeluaran == 0) {
          $total_harga_pengeluaran = 0;
        } else {
          $total_harga_pengeluaran = $total_pengeluaran / $total_qty_pengeluaran;
        }

        $qty_akhir = $q2_qty_awal + $total_qty_penerimaan - $total_qty_pengeluaran;
        $nilai_akhir = $q2_nil_nilai_awal + $total_penerimaan - $total_pengeluaran;

        if ($qty_akhir == 0) {
          $harga_akhir = 0;
        } else {
          $harga_akhir = $nilai_akhir / $qty_akhir;
        }

        $query3 = "SELECT *
            FROM master_outlet_barang
            WHERE  kd_sage = '{$s1[$f5]}'";

        $sql3 = mysqli_query($koneksi, $query3);
        $q3 = mysqli_fetch_array($sql3);

        if (isset($q3['min_stok'])) {
          $data_min = $q3['min_stok'];
        } else {
          $data_min = 0;
        }
        if (isset($q3['max_stok'])) {
          $data_max = $q3['max_stok'];
        } else {
          $data_max = 0;
        }

        if (isset($q3['satuan'])) {
          $satuan = $q3['satuan'];
        } else {
          $satuan = "";
        }
        if (isset($q3['satuan'])) {
          $satuan = $q3['satuan'];
        } else {
          $satuan = "";
        }


        // if ($qty_akhir >= $q3['min_stok'] && $qty_akhir <= $q3['max_stok']) {
        if ($qty_akhir >= $data_min && $qty_akhir <= $data_max) {
          $status_stok = '<b>Aman</b>';
        } elseif ($qty_akhir < $data_min) {
          $status_stok = '<b>ORDER</b>';
        } elseif ($qty_akhir > $data_max) {
          $status_stok = '<b>OVER</b>';
        }

        $grand_awal += $q2_nil_nilai_awal;
        $grand_pengeluaran += $total_pengeluaran;
        $grand_akhir += $nilai_akhir;
      ?>
        <tr align="left">
          <td><?php echo $no; ?></td>
          <td><?php echo $s1[$f5]; ?></td>
          <td><?php echo $s1[$f6]; ?></td>
          <td style="text-align: left;"><?php echo $satuan; ?></td>
          <td style="text-align: right;" class="bg1"><?php echo number_format($q2_qty_awal, 2); ?></td>
          <td style="text-align: right;" class="bg1"><?php echo number_format($total_harga_awal, 2); ?></td>
          <td style="text-align: right;" class="bg1"><?php echo number_format($q2_nil_nilai_awal, 2); ?></td>

          <?php if (substr($s1[$f5], 0, 2) == '13' || substr($s1[$f5], 0, 2) == '14' || substr($s1[$f5], 0, 2) == '17' || substr($s1[$f5], 0, 2) == '18' || substr($s1[$f5], 0, 2) == '19' || substr($s1[$f5], 0, 2) == '99') { ?>

            <td style="text-align: right;" class="bg2"><?php echo number_format(0, 2); ?></td>
            <td style="text-align: right;" class="bg2"><?php echo number_format(0, 2); ?></td>
            <td style="text-align: right;" class="bg2"><?php echo number_format(0, 2); ?></td>

            <td style="text-align: right;"><?php echo number_format($total_penerimaan, 2); ?></td>
          <?php
            $grand_biaya += $total_penerimaan;
          } else { ?>
            <td style="text-align: right;" class="bg2"><?php echo number_format($total_qty_penerimaan, 2); ?></td>
            <td style="text-align: right;" class="bg2"><?php echo number_format($total_harga_penerimaan, 2); ?></td>
            <td style="text-align: right;" class="bg2"><?php echo number_format($total_penerimaan, 2); ?></td>

            <td style="text-align: right;"><?php echo number_format(0, 2); ?></td>

          <?php
            $grand_penerimaan += $total_penerimaan;
          } ?>

          <td style="text-align: right;" class="bg3"><?php echo number_format($total_qty_pengeluaran, 2); ?></td>
          <td style="text-align: right;" class="bg3"><?php echo number_format($total_harga_pengeluaran, 2); ?></td>
          <td style="text-align: right;" class="bg3"><?php echo number_format($total_pengeluaran, 2); ?></td>
          <td style="text-align: right;" class="bg4"><?php echo number_format($qty_akhir, 2); ?></td>
          <td style="text-align: right;" class="bg4"><?php echo number_format($harga_akhir, 2); ?></td>
          <td style="text-align: right;" class="bg4"><?php echo number_format($nilai_akhir, 2); ?></td>
          <td style="text-align: right;"><?php echo number_format($data_min, 2); ?></td>
          <td style="text-align: right;"><?php echo number_format($data_max, 2); ?></td>
          <!-- <td style="text-align: left;"><?php echo $satuan; ?></td> -->
          <td style="text-align: center;"><?php echo $status_stok; ?></td>
        </tr>
      <?php
        $no++;
      }
      ?>
    </tbody>
    <tfoot>
      <tr style="font-weight:600;font-size: 110%;padding-right: 10;">
        <td colspan="3" style="text-align:right;">Total</td>
        <td></td>
        <td></td>
        <td style="text-align: right;"><?php echo number_format($grand_awal, 2); ?></td>
        <td></td>
        <td></td>
        <td style="text-align: right;"><?php echo number_format($grand_penerimaan, 2); ?></td>
        <td style="text-align: right;"><?php echo number_format($grand_biaya, 2); ?></td>
        <td></td>
        <td></td>
        <td style="text-align: right;"><?php echo number_format($grand_pengeluaran, 2); ?></td>
        <td></td>
        <td></td>
        <td style="text-align: right;"><?php echo number_format($grand_akhir, 2); ?></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </tfoot>
  </table>
  <center>
    <h4 style="margin-top: 100px;" class="mb-4">GA dan Warehouse</h4>
  </center>
  <table id="example3" class="table table-bordered table-striped" style="width:1900px;">
    <thead style="background-color: lightgray;" class="elevation-2">
      <tr>
        <th rowspan="2">No</th>
        <th rowspan="2">Kode Barang</th>
        <th rowspan="2">Nama Barang</th>
        <th rowspan="2">Satuan</th>
        <th colspan="3" class="bg1">Awal</th>
        <th colspan="3" class="bg2">Penerimaan</th>
        <th rowspan="2">Biaya</th>
        <th colspan="3" class="bg3">Pengeluaran</th>
        <th colspan="3" class="bg4">Akhir</th>
        <th rowspan="2">Min Stok</th>
        <th rowspan="2">Max Stok</th>
        <!-- <th rowspan="2">Satuan</th> -->
        <th rowspan="2">Order Status</th>
      </tr>
      <tr>
        <th width="55" style="text-align:right;" class="bg1">Qty</th>
        <th width="55" style="text-align:right;" class="bg1">Harga</th>
        <th width="55" style="text-align:right;" class="bg1">Nilai</th>
        <th width="55" style="text-align:right;" class="bg2">Qty</th>
        <th width="55" style="text-align:right;" class="bg2">Harga</th>
        <th width="55" style="text-align:right;" class="bg2">Nilai</th>
        <th width="55" style="text-align:right;" class="bg3">Qty</th>
        <th width="55" style="text-align:right;" class="bg3">Harga</th>
        <th width="55" style="text-align:right;" class="bg3">Nilai</th>
        <th width="55" style="text-align:right;" class="bg4">Qty</th>
        <th width="55" style="text-align:right;" class="bg4">Harga</th>
        <th width="55" style="text-align:right;" class="bg4">Nilai</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $query = "SELECT kd_sage, barang_ori.nama_barang,
          SUM(qty_awal) AS sum_qty_awal, SUM(nilai_awal) AS sum_nilai_awal,
          SUM(qty_beli) AS sum_qty_beli, SUM(nilai_beli) AS sum_nilai_beli,
          SUM(qt_terima_int) AS sum_qt_terima_internal, SUM(nilai_terima_int) AS sum_nilai_terima_internal,
          SUM(qt_kirim_int) AS sum_qt_kirim_internal, SUM(nilai_kirim_int) AS sum_nilai_kirim_internal,
          SUM(qt_pake) AS sum_qt_pake, SUM(nilai_pake) AS sum_nilai_pake
          FROM $tabel
          JOIN barang_ori ON barang_ori.kode_barang = $tabel.kd_sage
          WHERE tgl >= '$tgl_awal' AND tgl <= '$tgl_akhir' AND NOT
          SUBSTR(kd_sage, 1, 2) = '15' AND (SUBSTR(kd_unit,1,1)='7' or SUBSTR(kd_unit,1,1) = '9')
          $kondisi
          GROUP BY kd_sage $kondisi_group
          ORDER BY kd_sage ASC";

      $sql1 = mysqli_query($koneksi, $query);
      $no = 1;
      $grand_awal = 0;
      $grand_penerimaan = 0;
      $grand_pengeluaran = 0;
      $grand_akhir = 0;
      $grand_biaya = 0;

      if (!$sql1) {
        die("Query error" . mysqli_error($koneksi));
      }

      while ($s1 = mysqli_fetch_array($sql1)) {
        $query2 = "SELECT SUM(qty_awal) AS q2_sum_qty_awal, SUM(nilai_awal) AS q2_sum_nilai_awal
            FROM $tabel
            WHERE tgl = '$tgl_awal' AND kd_sage = '{$s1[$f5]}'
            $kondisi
            GROUP BY kd_sage";

        $sql2 = mysqli_query($koneksi, $query2);
        $q2 = mysqli_fetch_array($sql2);

        $q2_qty_awal = !isset($q2['q2_sum_qty_awal']) ? 0 : $q2['q2_sum_qty_awal'];
        $q2_nil_nilai_awal = !isset($q2['q2_sum_nilai_awal']) ? 0 : $q2['q2_sum_nilai_awal'];

        if ($q2_qty_awal == 0) {
          $total_harga_awal = 0;
        } else {
          $total_harga_awal = $q2_nil_nilai_awal / $q2_qty_awal;
        }

        $total_qty_penerimaan = $s1['sum_qty_beli'] + $s1['sum_qt_terima_internal'];
        $total_penerimaan = $s1['sum_nilai_beli'] + $s1['sum_nilai_terima_internal'];

        if ($total_qty_penerimaan == 0) {
          $total_harga_penerimaan = 0;
        } else {
          $total_harga_penerimaan = $total_penerimaan / $total_qty_penerimaan;
        }

        $total_qty_pengeluaran = $s1['sum_qt_kirim_internal'] + $s1['sum_qt_pake'];
        $total_pengeluaran = $s1['sum_nilai_kirim_internal'] + $s1['sum_nilai_pake'];

        if ($total_qty_pengeluaran == 0) {
          $total_harga_pengeluaran = 0;
        } else {
          $total_harga_pengeluaran = $total_pengeluaran / $total_qty_pengeluaran;
        }

        $qty_akhir = $q2_qty_awal + $total_qty_penerimaan - $total_qty_pengeluaran;
        $nilai_akhir = $q2_nil_nilai_awal + $total_penerimaan - $total_pengeluaran;

        if ($qty_akhir == 0) {
          $harga_akhir = 0;
        } else {
          $harga_akhir = $nilai_akhir / $qty_akhir;
        }

        $query3 = "SELECT *
            FROM master_outlet_barang
            WHERE  kd_sage = '{$s1[$f5]}'";

        $sql3 = mysqli_query($koneksi, $query3);
        $q3 = mysqli_fetch_array($sql3);

        // if ($qty_akhir >= $q3['min_stok'] && $qty_akhir <= $q3['max_stok']) {
        //     $status_stok = '<b>Aman</b>';
        // } elseif ($qty_akhir < $q3['min_stok']) {
        //     $status_stok = '<b>ORDER</b>';
        // } elseif ($qty_akhir > $q3['max_stok']) {
        //     $status_stok = '<b>OVER</b>';
        // }
        if (isset($q3['min_stok'])) {
          $data_min = $q3['min_stok'];
        } else {
          $data_min = 0;
        }
        if (isset($q3['max_stok'])) {
          $data_max = $q3['max_stok'];
        } else {
          $data_max = 0;
        }

        if (isset($q3['satuan'])) {
          $satuan = $q3['satuan'];
        } else {
          $satuan = 0;
        }
        if ($qty_akhir >= $data_min && $qty_akhir <= $data_max) {
          $status_stok = '<b>Aman</b>';
        } elseif ($qty_akhir < $data_min) {
          $status_stok = '<b>ORDER</b>';
        } elseif ($qty_akhir > $data_max) {
          $status_stok = '<b>OVER</b>';
        }

        $grand_awal += $q2_nil_nilai_awal;
        $grand_pengeluaran += $total_pengeluaran;
        $grand_akhir += $nilai_akhir;
      ?>
        <tr align="left">
          <td><?php echo $no; ?></td>
          <td><?php echo $s1[$f5]; ?></td>
          <td><?php echo $s1[$f6]; ?></td>
          <td style="text-align: left;"><?php echo $satuan; ?></td>
          <td style="text-align: right;" class="bg1"><?php echo number_format($q2_qty_awal, 2); ?></td>
          <td style="text-align: right;" class="bg1"><?php echo number_format($total_harga_awal, 2); ?></td>
          <td style="text-align: right;" class="bg1"><?php echo number_format($q2_nil_nilai_awal, 2); ?></td>

          <?php if (substr($s1[$f5], 0, 2) == '13' || substr($s1[$f5], 0, 2) == '14' || substr($s1[$f5], 0, 2) == '17' || substr($s1[$f5], 0, 2) == '18' || substr($s1[$f5], 0, 2) == '19' || substr($s1[$f5], 0, 2) == '99') { ?>

            <td style="text-align: right;" class="bg2"><?php echo number_format($total_qty_penerimaan, 2); ?></td>
            <td style="text-align: right;" class="bg2"><?php echo number_format($total_harga_penerimaan, 2); ?></td>
            <td style="text-align: right;" class="bg2"><?php echo number_format($total_penerimaan, 2); ?></td>


            <td style="text-align: right;"><?php echo number_format(0, 2); ?></td>

          <?php
            $grand_biaya += $total_penerimaan;
          } else { ?>

            <td style="text-align: right;" class="bg2"><?php echo number_format(0, 2); ?></td>
            <td style="text-align: right;" class="bg2"><?php echo number_format(0, 2); ?></td>
            <td style="text-align: right;" class="bg2"><?php echo number_format(0, 2); ?></td>
            <td style="text-align: right;"><?php echo number_format($total_penerimaan, 2); ?></td>

          <?php
            $grand_penerimaan += $total_penerimaan;
          } ?>

          <td style="text-align: right;" class="bg3"><?php echo number_format($total_qty_pengeluaran, 2); ?></td>
          <td style="text-align: right;" class="bg3"><?php echo number_format($total_harga_pengeluaran, 2); ?></td>
          <td style="text-align: right;" class="bg3"><?php echo number_format($total_pengeluaran, 2); ?></td>
          <td style="text-align: right;" class="bg4"><?php echo number_format($qty_akhir, 2); ?></td>
          <td style="text-align: right;" class="bg4"><?php echo number_format($harga_akhir, 2); ?></td>
          <td style="text-align: right;" class="bg4"><?php echo number_format($nilai_akhir, 2); ?></td>
          <td style="text-align: right;"><?php echo number_format($data_min, 2); ?></td>
          <td style="text-align: right;"><?php echo number_format($data_max, 2); ?></td>
          <!-- <td style="text-align: left;"><?php echo $satuan; ?></td> -->
          <td style="text-align: center;"><?php echo $status_stok; ?></td>
        </tr>
      <?php
        $no++;
      }
      ?>
    </tbody>
    <tfoot>
      <tr style="font-weight:600;font-size: 110%;padding-right: 10;">
        <td colspan="3" style="text-align:right;">Total</td>
        <td></td>
        <td></td>
        <td style="text-align: right;"><?php echo number_format($grand_awal, 2); ?></td>
        <td></td>
        <td></td>
        <td style="text-align: right;"><?php echo number_format($grand_biaya, 2); ?></td>
        <td style="text-align: right;"><?php echo number_format($grand_penerimaan, 2); ?></td>
        <td></td>
        <td></td>
        <td style="text-align: right;"><?php echo number_format($grand_pengeluaran, 2); ?></td>
        <td></td>
        <td></td>
        <td style="text-align: right;"><?php echo number_format($grand_akhir, 2); ?></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </tfoot>
  </table>
<?php } ?>


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