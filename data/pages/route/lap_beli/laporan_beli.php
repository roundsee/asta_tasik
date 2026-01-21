<?php

include "../../../../config/koneksi.php";
include "../../../../config/fungsi_rupiah.php";
include "../../../../config/library.php";
include "../../../../config/fungsi_indotgl.php";

ignore_user_abort(true);
set_time_limit(0);

ini_set('output_buffering', 'Off');
ini_set('zlib.output_compression', 'Off');
while (ob_get_level()) {
  ob_end_clean();
}
session_start();

$login_hash = $_SESSION['login_hash'];
$en = $_SESSION['employee_number'];
$judulform = 'Laporan Pembelian';

$data = 'lap_beli';
$rute = 'lap_beli';
$aksi = 'aksi_list_pembelian';


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

if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
    <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../../../index.php><b>LOGIN</b></a></center>";
} else {
  session_write_close();
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
  <!-- <div class="table-responsive"> -->
  <?php if ($filter == 'semua') { ?>
    <table id="example4" width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-bordered table-striped">
      <thead style="background-color: #ddd;">
        <tr style="font-weight: 600">
          <th align="center" width="40px">No</th>
          <th>Nomor Invoice</th>
          <th>Kode PO</th>
          <th>Kode Supplier</th>
          <th>Nama Supplier</th>
          <th>Tanggal</th>
          <th>Kode Barang</th>
          <th>Nama Barang</th>
          <th align="left">Qty</th>
          <th align="left">Satuan</th>
          <th align="left" width="140px">Harga</th>
          <th align="left" width="140px">Sub Total</th>
          <th align="right" width="100px">Diskon</th>
          <th align="right" width="100px">PPN</th>
          <th align="right" width="100px">Total</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $subtotal_supplier = 0;
        $grand_total_all_suppliers = 0;
        $grand_total_price = 0;
        $grand_total_diskon = 0;
        $grand_total_pajak = 0;
        $current_supplier = "";
        //before
        // $sql1 = mysqli_query($koneksi, "
        //             SELECT 
        //                 pd.*, 
        //                 barang.nama, 
        //                 SUM(pd.disc) AS tot_disc, 
        //                 pd.jml,
        //                 pembelian.ppn, 
        //                 pd.jml AS jumlah_barang_datang, 
        //                 pembelian.tarif_ppn, 
        //                 supplier.nama AS nama_supp, 
        //                 supplier.kd_supp,
        //                 pembelian_invoice.tanggal_invoice
        //             FROM $tabel2 pd
        //             JOIN barang ON barang.kd_brg = pd.kd_brg
        //             JOIN pembelian ON pembelian.kd_po = pd.kd_po
        //             JOIN supplier ON supplier.kd_supp = pembelian.kd_supp
        //             JOIN pembelian_invoice ON pembelian_invoice.no_invoice = pd.no_invoice
        //             WHERE pembelian_invoice.tanggal_invoice BETWEEN '$tgl_awal' AND '$tgl_akhir'
        //             GROUP BY pd.kd_po, pd.kd_brg, pd.urut
        //             ORDER BY kd_supp, tanggal_invoice, kd_po ASC;
        //         ");
        //after
        // $sql1 = mysqli_query($koneksi, "
        //     SELECT 
        //         pd.nilai, pd.jml_pcs, pd.no_invoice, pd.kd_po, pd.kd_brg,
        //         barang.nama, 
        //         pd.disc AS tot_disc, 
        //         pd.jml,
        //         pembelian.ppn, 
        //         pd.jml AS jumlah_barang_datang, 
        //         pembelian.tarif_ppn, 
        //         IFNULL((SELECT nama FROM supplier WHERE supplier.kd_supp = pembelian.kd_supp LIMIT 1), 'Unknown Supplier') AS nama_supp,
        //         IFNULL(pembelian.kd_supp, 'N/A') AS kd_supp,
        //         pembelian_invoice.tanggal_invoice,
        //         barang.Satuan1
        //     FROM $tabel2 pd
        //     JOIN barang ON barang.kd_brg = pd.kd_brg
        //     JOIN pembelian ON pembelian.kd_po = pd.kd_po
        //     JOIN pembelian_invoice ON pembelian_invoice.no_invoice = pd.no_invoice
        //     WHERE pembelian_invoice.tanggal_invoice BETWEEN '$tgl_awal' AND '$tgl_akhir'
        //     ;
        // ");

        $sql1 = mysqli_query($koneksi, "
            SELECT 
                pd.nilai,
                pd.jml_pcs,
                pd.no_invoice,
                pd.kd_po,
                pd.kd_brg,
                barang.nama,
                pd.disc AS tot_disc,
                pd.jml,
                pembelian.ppn,
                pd.jml AS jumlah_barang_datang,
                pembelian.tarif_ppn,
                IFNULL(s.nama, 'Unknown Supplier') AS nama_supp,
                IFNULL(pembelian.kd_supp, 'N/A') AS kd_supp,
                pembelian_invoice.tanggal_invoice,
                barang.Satuan1
            FROM $tabel2 pd
            LEFT JOIN barang 
                ON barang.kd_brg = pd.kd_brg
            JOIN pembelian 
                ON pembelian.kd_po = pd.kd_po
            JOIN pembelian_invoice 
                ON pembelian_invoice.no_invoice = pd.no_invoice
            LEFT JOIN supplier s 
                ON s.kd_supp = pembelian.kd_supp
            WHERE pembelian_invoice.tanggal_invoice 
                  BETWEEN '$tgl_awal' AND '$tgl_akhir';");

        if (!$sql1) {
          die("Query error: " . mysqli_error($koneksi));
        }

        while ($s1 = mysqli_fetch_array($sql1)) {
          // Jika supplier berubah, cetak subtotal supplier sebelumnya (jika ada)
          if ($current_supplier != $s1['kd_supp']) {
            if ($current_supplier != "") {
              // Tampilkan subtotal untuk supplier sebelumnya
        ?>
              <!-- <tr>
                        <td colspan="9" align="right">Subtotal</td>
                        <td align="right"><?php echo number_format($subtotal_supplier); ?></td>
                    </tr> -->
          <?php
            }
            // Reset subtotal untuk supplier baru
            $subtotal_supplier = 0;
            $current_supplier = $s1['kd_supp'];
          }

          // Hitung total harga dan pajak
          $total_price = $s1['jumlah_barang_datang'] * $s1[$ff4];
          $grand_total = $total_price - $s1['tot_disc'];
          $nilai_pjk = ($s1['ppn'] == 1) ? $grand_total * $s1['tarif_ppn'] / 100 : 0;
          $subtotal = $grand_total + $nilai_pjk;
          $subtotal_supplier += $subtotal; // Tambahkan ke subtotal supplier
          $grand_total_all_suppliers += $subtotal; // Tambahkan ke total keseluruhan
          $grand_total_price += $total_price; // Tambahkan ke total keseluruhan
          $grand_total_diskon += $s1['tot_disc']; // Tambahkan ke total keseluruhan
          $grand_total_pajak += $nilai_pjk; // Tambahkan ke total keseluruhan



          // $harga_perbarang = (($s1[$ff4] * $s1['jumlah_barang_datang']) / ($s1['jumlah_barang_datang'] * $s1['jml_pcs']));
          if ($s1['jumlah_barang_datang'] > 0 && $s1['jml_pcs'] > 0) {
            // $harga_perbarang = (($s1[$ff4] * $s1['jumlah_barang_datang']) / ($s1['jumlah_barang_datang'] * $s1['jml_pcs']));
            $harga_perbarang = $s1[$ff4] / $s1['jml_pcs'];
          } else {
            $harga_perbarang = 0; // Or handle it differently based on your requirements
          }
          ?>
          <tr>
            <td align="right"><?php echo $no; ?></td>
            <td align="left"><?php echo $s1['no_invoice']; ?></td>
            <td align="left"><?php echo $s1['kd_po']; ?></td>
            <td align="left"><?php echo $s1['kd_supp']; ?></td>
            <td align="left"><?php echo $s1['nama_supp']; ?></td>
            <td align="left"><?php echo $s1['tanggal_invoice']; ?></td>
            <!-- <td align="left"><?php echo $s1['kd_po']; ?></td> -->
            <td align="left"><?php echo $s1['kd_brg']; ?></td>
            <td align="left"><?php echo $s1['nama'] ?? "-"; ?></td>
            <td align="right"><?php echo number_format($s1['jumlah_barang_datang'] * $s1['jml_pcs']); ?></td>
            <!-- <td align="right"><?php echo  number_format($s1['jumlah_barang_datang'] * $s1['jml_pcs'], 0, ',', '.'); ?></td> -->

            <!-- <td align="right"><?php echo $s1['jumlah_barang_datang']; ?></td> -->
            <!-- <td>Pcs</td> -->
            <td><?php echo $s1['Satuan1']; ?></td>

            <!-- <td align="right"><?php echo $s1['jml_pcs']; ?></td> -->
            <td align="right"><?php echo number_format($harga_perbarang); ?></td>
            <td align="right"><?php echo number_format($harga_perbarang * ($s1['jumlah_barang_datang'] * $s1['jml_pcs'])); ?></td>
            <td align="right"><?php echo number_format($s1['tot_disc']); ?></td>
            <td align="right"><?php echo number_format($nilai_pjk); ?></td>
            <td align="right"><?php echo number_format($subtotal); ?></td>
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
          <td align="right">Grand Total Keseluruhan</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>

          <td align="right"><?php echo number_format($grand_total_price); ?></td>
          <td align="right"><?php echo number_format($grand_total_diskon); ?></td>
          <td align="right"><?php echo number_format($grand_total_pajak); ?></td>
          <td align="right"><?php echo number_format($grand_total_all_suppliers); ?></td>
        </tr>
      </tfoot>
    </table>



  <?php } elseif ($filter == 'supplier') { ?>

    <table id="example4" width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-bordered table-striped">
      <thead style="background-color: #ddd;">
        <tr style="font-weight: 600">
          <th align="center" width="40px">No</th>
          <th>Nomor Invoice</th>
          <th>Kode PO</th>
          <th>Kode Supplier</th>
          <th>Nama Supplier</th>
          <th>Tanggal</th>
          <th>Kode Barang</th>
          <th>Nama Barang</th>
          <th align="left">Qty</th>
          <th align="left">Satuan</th>
          <th align="left" width="140px">Harga</th>
          <th align="left" width="140px">Sub Total</th>
          <th align="right" width="100px">Diskon</th>
          <th align="right" width="100px">PPN</th>
          <th align="right" width="100px">Total</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $subtotal_supplier = 0;
        $grand_total_all_suppliers = 0;
        $current_supplier = "";

        $sql1 = mysqli_query($koneksi, "
            SELECT 
                pd.nilai,pd.jml_pcs,pd.no_invoice,pd.kd_po,pd.kd_brg,
                barang.nama, 
                pd.disc AS tot_disc, 
                pd.jml,
                pembelian.ppn, 
                pd.jml AS jumlah_barang_datang, 
                pembelian.tarif_ppn, 
                supplier.nama AS nama_supp, 
                supplier.kd_supp,
                pembelian_invoice.tanggal_invoice
            FROM $tabel2 pd
            LEFT JOIN barang ON barang.kd_brg = pd.kd_brg
            JOIN pembelian ON pembelian.kd_po = pd.kd_po
            LEFT JOIN supplier ON supplier.kd_supp = pembelian.kd_supp
            JOIN pembelian_invoice ON pembelian_invoice.no_invoice = pd.no_invoice
            WHERE pembelian_invoice.tanggal_invoice BETWEEN '$tgl_awal' AND '$tgl_akhir' AND pembelian.kd_supp = '$nilai'
            ;
        ");

        if (!$sql1) {
          die("Query error: " . mysqli_error($koneksi));
        }

        while ($s1 = mysqli_fetch_array($sql1)) {
          // Jika supplier berubah, cetak subtotal supplier sebelumnya (jika ada)
          if ($current_supplier != $s1['kd_supp']) {
            if ($current_supplier != "") {
              // Tampilkan subtotal untuk supplier sebelumnya
        ?>
              <!-- <tr>
                        <td colspan="9" align="right">Subtotal</td>
                        <td align="right"><?php echo number_format($subtotal_supplier); ?></td>
                    </tr> -->
          <?php
            }
            // Reset subtotal untuk supplier baru
            $subtotal_supplier = 0;
            $current_supplier = $s1['kd_supp'];
          }

          // Hitung total harga dan pajak
          $total_price = $s1['jumlah_barang_datang'] * $s1[$ff4];
          $grand_total = $total_price - $s1['tot_disc'];
          $nilai_pjk = ($s1['ppn'] == 1) ? $grand_total * $s1['tarif_ppn'] / 100 : 0;
          $subtotal = $grand_total + $nilai_pjk;
          $subtotal_supplier += $subtotal; // Tambahkan ke subtotal supplier
          $grand_total_all_suppliers += $subtotal; // Tambahkan ke total keseluruhan
          // $harga_perbarang = (($s1[$ff4] * $s1['jumlah_barang_datang']) / ($s1['jumlah_barang_datang'] * $s1['jml_pcs']));
          $penyebut = $s1['jumlah_barang_datang'] * $s1['jml_pcs'];

          $harga_perbarang = ($penyebut > 0)
            ? (($s1[$ff4] * $s1['jumlah_barang_datang']) / $penyebut)
            : 0;

          ?>
          <tr>
            <td align="right"><?php echo $no; ?></td>
            <td align="left"><?php echo $s1['no_invoice']; ?></td>
            <td align="left"><?php echo $s1['kd_po']; ?></td>
            <td align="left"><?php echo $s1['kd_supp']; ?></td>
            <td align="left"><?php echo $s1['nama_supp']; ?></td>
            <td align="left"><?php echo $s1['tanggal_invoice']; ?></td>
            <!-- <td align="left"><?php echo $s1['kd_po']; ?></td> -->
            <td align="left"><?php echo $s1['kd_brg']; ?></td>
            <td align="left"><?php echo $s1['nama'] ?? "-"; ?></td>
            <td align="right"><?php echo number_format($s1['jumlah_barang_datang'] * $s1['jml_pcs']); ?></td>
            <!-- <td align="right"><?php echo  number_format($s1['jumlah_barang_datang'] * $s1['jml_pcs'], 0, ',', '.'); ?></td> -->

            <!-- <td align="right"><?php echo $s1['jumlah_barang_datang']; ?></td> -->
            <td>Pcs</td>
            <!-- <td align="right"><?php echo $s1['jml_pcs']; ?></td> -->
            <td align="right"><?php echo number_format($harga_perbarang); ?></td>
            <td align="right"><?php echo number_format($harga_perbarang * ($s1['jumlah_barang_datang'] * $s1['jml_pcs'])); ?></td>
            <td align="right"><?php echo number_format($s1['tot_disc']); ?></td>
            <td align="right"><?php echo number_format($nilai_pjk); ?></td>
            <td align="right"><?php echo number_format($subtotal); ?></td>
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
          <td colspan="9" align="right">Grand Total Keseluruhan</td>
          <td align="right"><?php echo number_format($grand_total_all_suppliers); ?></td>
        </tr>
      </tfoot>
    </table>







  <?php } elseif ($filter == 'supplier_ori') { ?>
    <table id="example4" width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-bordered table-striped">
      <thead style="background-color: #ddd;">
        <tr style="font-weight: 600">
          <td align="center" width="40px">No</td>
          <td>Kode Supplier</td>
          <td>Nama Supplier</td>
          <td align="left" width="120px"><?php echo $jj2; ?></td>
          <td>Kode Barang</td>
          <td>Nama Barang</td>
          <td align="left">Jumlah Barang Datang</td>
          <td align="left" width="140px"><?php echo $jj3; ?> Berdasarkan PO</td>
          <td align="left" width="140px"><?php echo $jj4; ?></td>
          <td align="right" width="100px">Diskon</td>
          <td align="right" width="100px">PPN</td>
          <td align="right" width="100px">Total</td>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $subtotal = 0;
        $stotal = 0;
        $sql1 = mysqli_query($koneksi, "SELECT pd.*, barang.nama, SUM(pembelian_detail.disc) as tot_disc, pembelian.ppn, pb.jumlah_datang as jumlah_barang_datang, pembelian.tarif_ppn, supplier.nama AS nama_supp, supplier.kd_supp
          FROM $tabel2 pd
          JOIN barang ON barang.kd_brg = pd.kd_brg
          JOIN pembelian ON pembelian.kd_po = pd.kd_po
          JOIN supplier on supplier.kd_supp = pembelian.kd_supp
          JOIN pembelian_detail ON pembelian_detail.kd_po = pd.kd_po AND pembelian_detail.kd_brg = pd.kd_brg
          LEFT JOIN penerimaan_barang pb ON pb.kd_po = pd.kd_po AND pb.kd_brg = pd.kd_brg
          GROUP BY pd.kd_po, pd.kd_brg
          ORDER BY kd_supp ASC;
          ");

        if (!$sql1) {
          die("Query error: " . mysqli_error($koneksi));
        }

        while ($s1 = mysqli_fetch_array($sql1)) {
          $total_price = $s1['jumlah_barang_datang'] * $s1[$ff4];
          $grand_total = $total_price - $s1['tot_disc'];
          $nilai_pjk = ($s1['ppn'] == 1) ? $grand_total * $s1['tarif_ppn'] / 100 : 0;
          $subtotal = $grand_total + $nilai_pjk;
          $stotal += $subtotal;
        ?>
          <tr>
            <td align="right"><?php echo $no; ?></td>
            <td align="left"><?php echo $s1['kd_supp']; ?></td>
            <td align="left"><?php echo $s1['nama_supp']; ?></td>
            <td align="right"><?php echo $s1[$ff2]; ?></td>
            <td align="right"><?php echo $s1[$ff3]; ?></td>
            <td align="left"><?php echo $s1['nama'] ?? "-"; ?></td>
            <td align="right"><?php echo $s1['jumlah_barang_datang']; ?></td>
            <td align="right"><?php echo $s1['jml_pcs']; ?></td>
            <td align="right"><?php echo number_format($s1[$ff4]); ?></td>
            <td align="right"><?php echo number_format($s1['tot_disc']); ?></td>
            <td align="right"><?php echo number_format($nilai_pjk); ?></td>
            <td align="right"><?php echo number_format($subtotal); ?></td>
          </tr>
        <?php
          $no++;
        }
        ?>
      </tbody>
      <tfoot>
        <tr style="font-weight: 600">
          <td colspan="9" align="right">Total</td>
          <td id="stotal" align="right"><?php echo number_format($stotal); ?></td>
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

  </script>

  <script>
    $(document).ready(function() {
      // Menghilangkan loading bar setelah halaman siap
      $("#loading-bar").hide();


    });
  </script>

<?php include '../footer_lap_mutasi.php';
}
if (function_exists('fastcgi_finish_request')) {
  fastcgi_finish_request();
}
exit; ?>