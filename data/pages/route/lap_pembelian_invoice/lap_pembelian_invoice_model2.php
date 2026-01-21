<?php

include "../../../../config/koneksi.php";
include "../../../../config/fungsi_rupiah.php";
include "../../../../config/library.php";
include "../../../../config/fungsi_indotgl.php";


session_start();

$login_hash = $_SESSION['login_hash'];
$en = $_SESSION['employee_number'];
$judulform = 'Laporan Pembelian (Invoice)';

$data = 'lap_pembelian';
$rute = 'lap_pembelian_invoice';
$aksi = 'aksi_list_pembelian_invoice';

$view = 'purchase_order_detail_invoice';
$tabel = 'pembelian';

$f1 = 'kd_beli';
$f2 = 'tgl_beli';
$f3 = 'kd_supp';
$f4 = 'ket_payment';
$f5 = 'status_payment';
$f6 = 'jenis_po';
$f7 = 'ppn';
$f8 = 'status_pembelian';
$f9 = 'tgl_po';
$f10 = 'tgl_rilis';


$j1 = 'Kode PO';
$j2 = 'Tanggal';
$j3 = 'Kode Supplier';
$j4 = 'Ket Payment';
$j5 = 'Status';
$j6 = 'Jenis';
$j7 = 'Ppn';
$j8 = 'Status Pembelian';
$j9 = 'Tanggal PO';
$j10 = 'Tangagl Rilis';

$tabel2 = 'pembelian_detail';

$ff1 = 'kd_beli';
$ff2 = 'kd_brg';
$ff3 = 'jml';
$ff4 = 'price';
$ff5 = 'currency';
$ff6 = 'kurs';
$ff7 = 'disc';
$ff8 = 'urut';


$jj1 = 'Kode Beli';
$jj2 = 'Kode Barang';
$jj3 = 'Jumlah';
$jj4 = 'Price';
$jj5 = 'Currency';
$jj6 = 'Kurs';
$jj7 = 'Discount';
$jj8 = 'urut';

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
    <table id="example4" class="table table-bordered table-striped">
      <thead style="background-color: lightgray;" class="elevation-2">
        <tr>
          <th>No.</th>
          <th><?php echo $j1; ?></th>
          <th><?php echo $j9; ?></th>
          <th>Tanggal Catat Invoice</th>
          <th><?php echo $j3; ?></th>
          <th>Nama Supplier</th>
          <!-- <th>Aksi</th> -->
          <!-- <th>Total Tagihan Sesuai PO</th> -->
        </tr>
      </thead>
      <tbody>
        <?php
        $sql1 = mysqli_query($koneksi, "
            SELECT $tabel.kd_po, $tabel.kd_beli, $tabel.ppn, $tabel.tarif_ppn, $tabel.tgl_po, $tabel.kd_supp,
                   supp.nama AS nama_supplier,pi.tanggal_invoice
            FROM $tabel
            JOIN pembelian_invoice pi ON pi.kd_po = $tabel.kd_po
            LEFT JOIN supplier supp ON supp.kd_supp = $tabel.kd_supp
            WHERE $tabel.status_invoice >= 1 AND pi.tanggal_invoice BETWEEN '$tgl_awal' AND '$tgl_akhir'
            GROUP BY kd_po
        ");

        $no = 1;
        $nilai_pjk = 0;
        $subtotal = 0;

        if (!$sql1) {
          die('query error' . mysqli_error($koneksi));
        }

        while ($s1 = mysqli_fetch_array($sql1)) {
          // $sql2 = mysqli_query($koneksi, "
          //         SELECT 
          //             (SELECT SUM($tabel2.disc) FROM $tabel2 WHERE $tabel2.kd_beli = '{$s1['kd_beli']}') AS tot_disc,
          //             (SELECT SUM($tabel2.jml  *  $tabel2.price) FROM $tabel2 WHERE $tabel2.kd_beli = '{$s1['kd_beli']}')  AS tot_price,
          //             (SELECT SUM(penerimaan_barang.jumlah_datang * $tabel2.jumlah_pcs *  $tabel2.price) + pembelian_invoice.ongkir 
          //             FROM $tabel2
          //             JOIN penerimaan_barang ON penerimaan_barang.kd_po = pembelian_detail.kd_po 
          //             JOIN pembelian_invoice ON pembelian_invoice.kd_po = pembelian_detail.kd_po 
          //             WHERE $tabel2.kd_beli = '{$s1['kd_beli']}' ) AS tot_price_datang
          //     ");

          // $s2 = mysqli_fetch_array($sql2);

          // $grand_total = $s2['tot_price'] - $s2['tot_disc'];
          // $grand_total_datang = $s2['tot_price_datang'] - $s2['tot_disc'];

          // if ($s1[$f7] == 1) {
          //   $nilai_pjk = $grand_total * $s1['tarif_ppn'] / 100;
          //   $nilai_pjk_datang = $grand_total_datang * $s1['tarif_ppn'] / 100;
          // } else {
          //   $nilai_pjk = 0;
          //   $nilai_pjk_datang = 0;
          // }

          // $subtotal = $grand_total + $nilai_pjk;
          // $subtotal_datang = $grand_total_datang + $nilai_pjk_datang;
        ?>
          <tr align="left">
            <td><?php echo $no; ?></td>
            <!-- <td align="left">
            <a href="/emart_asta/data/pages/main.php?route=<?php echo $view; ?>&act&id=<?php echo $s1[$f1]; ?>&asal=<?php echo $rute; ?>" title="Detail" style="text-decoration: none;">
              <span style="color: #1E90FF; font-weight: bold; font-size: 16px;">
                <i class="fas fa-info-circle" style="margin-right: 5px;"></i>
                <?php echo $s1['kd_po']; ?>
              </span>
            </a>
          </td> -->
            <td><a href="../../main.php?route=purchase_order_detail&act&id=<?php echo $s1[$f1]; ?>&asal=<?php echo $rute; ?>" title="Detail"><?php echo $s1['kd_po']; ?></a></td>

            <td><?php echo $s1[$f9]; ?></td>
            <td><?php echo $s1['tanggal_invoice']; ?></td>
            <td><?php echo $s1[$f3]; ?></td>
            <td><?php echo $s1['nama_supplier']; ?></td>
            <!-- <td style="text-align: center;">
            <a href="<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=hapus-invoice&id=<?php echo $s1['kd_po']; ?>" title="Hapus" type="button" onclick="return confirm('Apakah anda yakin ingin menghapus ini ?')">
              <button class="btn btn-danger btn-sm elevation-2" type="button" style="opacity: .7;width:80px">
                <i class="fa fa-trash"></i> Batal
              </button>
            </a>
          </td> -->
            <!-- <td style="text-align:right;"><?php echo format_rupiah($subtotal); ?></td> -->
          </tr>
        <?php
          $no++;
        }
        ?>
      </tbody>
    </table>


  <?php } elseif ($filter == 'supplier') { ?>

    <table id="example4" class="table table-bordered table-striped">
      <thead style="background-color: lightgray;" class="elevation-2">
        <tr>
          <th>No.</th>
          <th><?php echo $j1; ?></th>
          <th><?php echo $j9; ?></th>
          <th>Tanggal Catat Invoice</th>
          <th><?php echo $j3; ?></th>
          <th>Nama Supplier</th>
          <!-- <th>Total Tagihan Sesuai PO</th> -->
        </tr>
      </thead>
      <tbody>
        <?php
        $sql1 = mysqli_query($koneksi, "
            SELECT $tabel.kd_po, $tabel.kd_beli, $tabel.ppn, $tabel.tarif_ppn, $tabel.tgl_po, $tabel.kd_supp, 
                   supp.nama AS nama_supplier,pi.tanggal_invoice
            FROM $tabel
            JOIN pembelian_invoice pi ON pi.kd_po = $tabel.kd_po
            LEFT JOIN supplier supp ON supp.kd_supp = $tabel.kd_supp
                       WHERE $tabel.status_invoice >= 1 AND supp.kd_supp = '$nilai'
                       AND pi.tanggal_invoice BETWEEN '$tgl_awal' AND '$tgl_akhir'
            GROUP BY kd_po
        ");

        $no = 1;
        $nilai_pjk = 0;
        $subtotal = 0;

        if (!$sql1) {
          die('query error' . mysqli_error($koneksi));
        }

        while ($s1 = mysqli_fetch_array($sql1)) {
          // $sql2 = mysqli_query($koneksi, "
          //         SELECT 
          //             (SELECT SUM($tabel2.disc) FROM $tabel2 WHERE $tabel2.kd_beli = '{$s1['kd_beli']}') AS tot_disc,
          //             (SELECT SUM($tabel2.jml  *  $tabel2.price) FROM $tabel2 WHERE $tabel2.kd_beli = '{$s1['kd_beli']}')  AS tot_price,
          //             (SELECT SUM(penerimaan_barang.jumlah_datang * $tabel2.jumlah_pcs *  $tabel2.price) + pembelian_invoice.ongkir 
          //             FROM $tabel2
          //             JOIN penerimaan_barang ON penerimaan_barang.kd_po = pembelian_detail.kd_po 
          //             JOIN pembelian_invoice ON pembelian_invoice.kd_po = pembelian_detail.kd_po 
          //             WHERE $tabel2.kd_beli = '{$s1['kd_beli']}' ) AS tot_price_datang
          //     ");

          // $s2 = mysqli_fetch_array($sql2);

          // $grand_total = $s2['tot_price'] - $s2['tot_disc'];
          // $grand_total_datang = $s2['tot_price_datang'] - $s2['tot_disc'];

          // if ($s1[$f7] == 1) {
          //   $nilai_pjk = $grand_total * $s1['tarif_ppn'] / 100;
          //   $nilai_pjk_datang = $grand_total_datang * $s1['tarif_ppn'] / 100;
          // } else {
          //   $nilai_pjk = 0;
          //   $nilai_pjk_datang = 0;
          // }

          // $subtotal = $grand_total + $nilai_pjk;
          // $subtotal_datang = $grand_total_datang + $nilai_pjk_datang;
        ?>
          <tr align="left">
            <td><?php echo $no; ?></td>
            <!-- <td align="left">
            <a href="data/pages/main.php?route=<?php echo $view; ?>&act&id=<?php echo $s1[$f1]; ?>&asal=<?php echo $rute; ?>" title="Detail" style="text-decoration: none;">
              <span style="color: #1E90FF; font-weight: bold; font-size: 16px;">
                <i class="fas fa-info-circle" style="margin-right: 5px;"></i>
                <?php echo $s1['kd_po']; ?>
              </span>
            </a>
          </td> -->
            <td><a href="../../main.php?route=purchase_order_detail&act&id=<?php echo $s1[$f1]; ?>&asal=<?php echo $rute; ?>" title="Detail"><?php echo $s1['kd_po']; ?></a></td>
            <td><?php echo $s1[$f9]; ?></td>
            <td><?php echo $s1['tanggal_invoice']; ?></td>
            <td><?php echo $s1[$f3]; ?></td>
            <td><?php echo $s1['nama_supplier']; ?></td>
            <!-- <td style="text-align:right;"><?php echo format_rupiah($subtotal); ?></td> -->
          </tr>
        <?php
          $no++;
        }
        ?>
      </tbody>
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
            <td align="left"><?php echo $s1['nama']; ?></td>
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
} ?>