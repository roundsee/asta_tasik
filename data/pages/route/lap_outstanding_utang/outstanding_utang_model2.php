<?php

include "../../../../config/koneksi.php";
include "../../../../config/fungsi_rupiah.php";
include "../../../../config/library.php";
include "../../../../config/fungsi_indotgl.php";


session_start();

$login_hash = $_SESSION['login_hash'];
$en = $_SESSION['employee_number'];
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
$judul3 = ' : ' . $tgl_awal . " " . $tgl_akhir;

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
    background-color: RGBA(100, 149,237, .1);
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
      <tr style="text-align: center;">
        <th>No.</th>
        <th>Nama Supplier</th>
        <!-- <th>No Invoice</th> -->
        <!-- <th>Total</th>
         <th>Jumlah Payment</th> -->
        <th>Total</th>
        <th style="background-color: #e0f7fa;">Current / 1-7 Hari</th>
        <th style="background-color: #ffe0b2;">8-14 Hari</th>
        <th style="background-color: #c8e6c9;">15-21 Hari</th>
        <th style="background-color: #ffcdd2;">22+</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql1 = mysqli_query($koneksi, "
                                                                SELECT supplier.nama AS nama_supplier,
                                                                    pembelian_invoice.no_invoice,
                                                                    SUM(((pd.nilai * pd.jml) - pd.disc) + 
                                                                        (pembelian.ppn * (((pd.nilai * pd.jml) - pd.disc) * pembelian.tarif_ppn / 100 ))) + 
                                                                        pembelian_invoice.ongkir AS hargatotal,
                                                                    (SELECT IFNULL(SUM(jumlah_payment), 0) 
                                                                    FROM payment 
                                                                    WHERE payment.no_invoice = pembelian_invoice.no_invoice) AS jumlah_payment,
                                                                    DATEDIFF(CURDATE(), pembelian_invoice.tanggal_invoice) AS selisih_hari
                                                                FROM pembelian_invoice_detail pd
                                                                JOIN barang ON barang.kd_brg = pd.kd_brg
                                                                JOIN pembelian ON pembelian.kd_po = pd.kd_po
                                                                JOIN pembelian_invoice ON pembelian_invoice.no_invoice = pd.no_invoice
                                                                JOIN supplier ON supplier.kd_supp = pembelian_invoice.kd_supp
                                                                WHERE pembelian_invoice.status_payment <= 1
                                                                GROUP BY supplier.nama, pembelian_invoice.no_invoice;
                                                            ");

      if (!$sql1) {
        die("Query gagal: " . mysqli_error($koneksi));
      }

      $supplierData = [];
      $grandTotal = [
        'total' => 0,
        'jumlah_payment' => 0,
        'sisa' => 0,
        'range_1_7' => 0,
        'range_8_14' => 0,
        'range_15_21' => 0,
        'range_22_plus' => 0
      ];

      while ($s1 = mysqli_fetch_array($sql1)) {
        $nama_supplier = $s1['nama_supplier'];
        $hargatotal = $s1['hargatotal'];
        $jumlah_payment = $s1['jumlah_payment'];
        $sisa_tagihan = $hargatotal - $jumlah_payment;
        $selisih_hari = $s1['selisih_hari'];

        // Jika supplier belum ada di array, buat entry baru
        if (!isset($supplierData[$nama_supplier])) {
          $supplierData[$nama_supplier] = [
            'total' => 0,
            'jumlah_payment' => 0,
            'sisa' => 0,
            'range_1_7' => 0,
            'range_8_14' => 0,
            'range_15_21' => 0,
            'range_22_plus' => 0,
            'invoices' => []
          ];
        }

        // Menambah nilai total, jumlah payment, dan sisa tagihan
        $supplierData[$nama_supplier]['total'] += $hargatotal;
        $supplierData[$nama_supplier]['jumlah_payment'] += $jumlah_payment;
        $supplierData[$nama_supplier]['sisa'] += $sisa_tagihan;
        $grandTotal['total'] += $hargatotal;
        $grandTotal['jumlah_payment'] += $jumlah_payment;
        $grandTotal['sisa'] += $sisa_tagihan;

        // Menghitung berdasarkan rentang hari menggunakan sisa tagihan
        if ($selisih_hari >= 0 && $selisih_hari <= 7) {
          $supplierData[$nama_supplier]['range_1_7'] += $sisa_tagihan;
          $grandTotal['range_1_7'] += $sisa_tagihan;
        } elseif ($selisih_hari >= 8 && $selisih_hari <= 14) {
          $supplierData[$nama_supplier]['range_8_14'] += $sisa_tagihan;
          $grandTotal['range_8_14'] += $sisa_tagihan;
        } elseif ($selisih_hari >= 15 && $selisih_hari <= 21) {
          $supplierData[$nama_supplier]['range_15_21'] += $sisa_tagihan;
          $grandTotal['range_15_21'] += $sisa_tagihan;
        } elseif ($selisih_hari > 21) {
          $supplierData[$nama_supplier]['range_22_plus'] += $sisa_tagihan;
          $grandTotal['range_22_plus'] += $sisa_tagihan;
        }

        // Menyimpan nomor invoice
        $supplierData[$nama_supplier]['invoices'][] = $s1['no_invoice'];
      }

      $no = 1;

      // Menampilkan data per supplier
      foreach ($supplierData as $supplier => $data) {
      ?>
        <tr align="left">
          <td><?php echo $no; ?></td>
          <td><?php echo $supplier; ?></td>
          <!-- <td><?php echo implode(', ', $data['invoices']); ?></td> -->
          <!-- <td><?php echo number_format($data['total'], 2); ?></td>
          <td><?php echo number_format($data['jumlah_payment'], 2); ?></td> -->
          <td align="right"><?php echo number_format($data['sisa']); ?></td>
          <td align="right" style="background-color: #e0f7fa;"><?php echo number_format($data['range_1_7']); ?></td>
          <td align="right" style="background-color: #ffe0b2;"><?php echo number_format($data['range_8_14']); ?></td>
          <td align="right" style="background-color: #c8e6c9;"><?php echo number_format($data['range_15_21']); ?></td>
          <td align="right" style="background-color: #ffcdd2;"><?php echo number_format($data['range_22_plus']); ?></td>
        </tr>
      <?php
        $no++;
      }
      ?>
    </tbody>

    <!-- Bagian tfoot untuk total keseluruhan -->
    <tfoot>
      <tr style="font-weight: bold; background-color: #D6D6D6;">
        <td colspan="2" align="right">Total Keseluruhan:</td>
        <!-- <td><?php echo number_format($grandTotal['total']); ?></td>
        <td><?php echo number_format($grandTotal['jumlah_payment']); ?></td> -->
        <td align="right"><?php echo number_format($grandTotal['sisa']); ?></td>
        <td style="background-color: #e0f7fa; text-align:right;" ><?php echo number_format($grandTotal['range_1_7']); ?></td>
        <td style="background-color: #ffe0b2; text-align:right;" ><?php echo number_format($grandTotal['range_8_14']); ?></td>
        <td style="background-color: #c8e6c9; text-align:right;" ><?php echo number_format($grandTotal['range_15_21']); ?></td>
        <td style="background-color: #ffcdd2; text-align:right;" ><?php echo number_format($grandTotal['range_22_plus']); ?></td>
      </tr>
    </tfoot>
  </table>
<?php }elseif ($filter == 'supplier'){ ?>

  <table id="example4" class="table table-bordered table-striped">
    <thead style="background-color: lightgray;" class="elevation-2">
      <tr style="text-align: center;">
        <th>No.</th>
        <th>Nama Supplier</th>
        <!-- <th>No Invoice</th> -->
        <!-- <th>Total</th>
         <th>Jumlah Payment</th> -->
        <th>Total</th>
        <th style="background-color: #e0f7fa;">Current / 1-7 Hari</th>
        <th style="background-color: #ffe0b2;">8-14 Hari</th>
        <th style="background-color: #c8e6c9;">15-21 Hari</th>
        <th style="background-color: #ffcdd2;">22+</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql1 = mysqli_query($koneksi, "

       SELECT supplier.nama AS nama_supplier,
                                                                    pembelian_invoice.no_invoice,
                                                                    SUM(((pd.nilai * pd.jml) - pd.disc) + 
                                                                        (pembelian.ppn * (((pd.nilai * pd.jml) - pd.disc) * pembelian.tarif_ppn / 100 ))) + 
                                                                        pembelian_invoice.ongkir AS hargatotal,
                                                                    (SELECT IFNULL(SUM(jumlah_payment), 0) 
                                                                    FROM payment 
                                                                    WHERE payment.no_invoice = pembelian_invoice.no_invoice) AS jumlah_payment,
                                                                    DATEDIFF(CURDATE(), pembelian_invoice.tanggal_invoice) AS selisih_hari
                                                                FROM pembelian_invoice_detail pd
                                                                JOIN barang ON barang.kd_brg = pd.kd_brg
                                                                JOIN pembelian ON pembelian.kd_po = pd.kd_po
                                                                JOIN pembelian_invoice ON pembelian_invoice.no_invoice = pd.no_invoice
                                                                JOIN supplier ON supplier.kd_supp = pembelian_invoice.kd_supp
                                                                WHERE pembelian_invoice.status_payment <= 1 AND pembelian_invoice.kd_supp = '$nilai'
                                                                GROUP BY supplier.nama, pembelian_invoice.no_invoice;
                                                            ");

      if (!$sql1) {
        die("Query gagal: " . mysqli_error($koneksi));
      }

      $supplierData = [];
      $grandTotal = [
        'total' => 0,
        'jumlah_payment' => 0,
        'sisa' => 0,
        'range_1_7' => 0,
        'range_8_14' => 0,
        'range_15_21' => 0,
        'range_22_plus' => 0
      ];

      while ($s1 = mysqli_fetch_array($sql1)) {
        $nama_supplier = $s1['nama_supplier'];
        $hargatotal = $s1['hargatotal'];
        $jumlah_payment = $s1['jumlah_payment'];
        $sisa_tagihan = $hargatotal - $jumlah_payment;
        $selisih_hari = $s1['selisih_hari'];

        // Jika supplier belum ada di array, buat entry baru
        if (!isset($supplierData[$nama_supplier])) {
          $supplierData[$nama_supplier] = [
            'total' => 0,
            'jumlah_payment' => 0,
            'sisa' => 0,
            'range_1_7' => 0,
            'range_8_14' => 0,
            'range_15_21' => 0,
            'range_22_plus' => 0,
            'invoices' => []
          ];
        }

        // Menambah nilai total, jumlah payment, dan sisa tagihan
        $supplierData[$nama_supplier]['total'] += $hargatotal;
        $supplierData[$nama_supplier]['jumlah_payment'] += $jumlah_payment;
        $supplierData[$nama_supplier]['sisa'] += $sisa_tagihan;
        $grandTotal['total'] += $hargatotal;
        $grandTotal['jumlah_payment'] += $jumlah_payment;
        $grandTotal['sisa'] += $sisa_tagihan;

        // Menghitung berdasarkan rentang hari menggunakan sisa tagihan
        if ($selisih_hari >= 0 && $selisih_hari <= 7) {
          $supplierData[$nama_supplier]['range_1_7'] += $sisa_tagihan;
          $grandTotal['range_1_7'] += $sisa_tagihan;
        } elseif ($selisih_hari >= 8 && $selisih_hari <= 14) {
          $supplierData[$nama_supplier]['range_8_14'] += $sisa_tagihan;
          $grandTotal['range_8_14'] += $sisa_tagihan;
        } elseif ($selisih_hari >= 15 && $selisih_hari <= 21) {
          $supplierData[$nama_supplier]['range_15_21'] += $sisa_tagihan;
          $grandTotal['range_15_21'] += $sisa_tagihan;
        } elseif ($selisih_hari > 21) {
          $supplierData[$nama_supplier]['range_22_plus'] += $sisa_tagihan;
          $grandTotal['range_22_plus'] += $sisa_tagihan;
        }

        // Menyimpan nomor invoice
        $supplierData[$nama_supplier]['invoices'][] = $s1['no_invoice'];
      }

      $no = 1;

      // Menampilkan data per supplier
      foreach ($supplierData as $supplier => $data) {
      ?>
        <tr align="left">
          <td><?php echo $no; ?></td>
          <td><?php echo $supplier; ?></td>
          <!-- <td><?php echo implode(', ', $data['invoices']); ?></td> -->
          <!-- <td><?php echo number_format($data['total']); ?></td>
          <td><?php echo number_format($data['jumlah_payment']); ?></td> -->
          <td align="right"><?php echo number_format($data['sisa']); ?></td>
          <td align="right" style="background-color: #e0f7fa;"><?php echo number_format($data['range_1_7']); ?></td>
          <td align="right" style="background-color: #ffe0b2;"><?php echo number_format($data['range_8_14']); ?></td>
          <td align="right" style="background-color: #c8e6c9;"><?php echo number_format($data['range_15_21']); ?></td>
          <td align="right" style="background-color: #ffcdd2;"><?php echo number_format($data['range_22_plus']); ?></td>
        </tr>
      <?php
        $no++;
      }
      ?>
    </tbody>

    <!-- Bagian tfoot untuk total keseluruhan -->
    <tfoot>
      <tr style="font-weight: bold; background-color: #D6D6D6;">
        <td colspan="2" align="right">Total Keseluruhan:</td>
        <!-- <td><?php echo number_format($grandTotal['total']); ?></td>
        <td><?php echo number_format($grandTotal['jumlah_payment']); ?></td> -->
        <td align="right"><?php echo number_format($grandTotal['sisa']); ?></td>
        <td style="background-color: #e0f7fa; text-align:right;" ><?php echo number_format($grandTotal['range_1_7']); ?></td>
        <td style="background-color: #ffe0b2; text-align:right;" ><?php echo number_format($grandTotal['range_8_14']); ?></td>
        <td style="background-color: #c8e6c9; text-align:right;" ><?php echo number_format($grandTotal['range_15_21']); ?></td>
        <td style="background-color: #ffcdd2; text-align:right;" ><?php echo number_format($grandTotal['range_22_plus']); ?></td>
      </tr>
    </tfoot>
  </table>

  <?php }?>


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