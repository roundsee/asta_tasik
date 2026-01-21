<?php

include "../../../../config/koneksi.php";
include "../../../../config/fungsi_rupiah.php";
include "../../../../config/library.php";
include "../../../../config/fungsi_indotgl.php";


session_start();

$login_hash = $_SESSION['login_hash'];
$en = $_SESSION['employee_number'];
$judulform = 'Laporan Pembelian';

$judulform = "Laporan Payment Lunas";

$data = 'lap_transfer_barang';
$rute = 'lap_pembelap_transfer_baranglian';
$aksi = 'aksi_list_transfer_barang';

$tabel = 'payment';

$f1 = 'no_invoice';
$f2 = 'jumlah_payment';
$f3 = 'no_payment';
$f4 = 'tanggal_payment';
$f5 = 'insert_oleh';
$f6 = 'metode_payment';
$f7 = 'reff';
$f8 = 'akun';
$f9 = 'status';
$f10 = 'ppn';

// Variabel untuk label kolom
$j1 = 'Nomor Invoice';
$j2 = 'Jumlah Payment';
$j3 = 'Nomor Payment';
$j4 = 'Tanggal Payment';
$j5 = 'Di input Oleh';
$j6 = 'Metode Payment';
$j7 = 'REFF';
$j8 = 'Akun';
$j9 = 'Status Payment';
$j10 = 'PPN';


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
    <table id="example4" width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-bordered table-striped">
      <thead style="background-color: #ddd;">
        <tr style="font-weight: 600">
          <th align="center" width="40px">No</th>
          <th>No Invoice</th>
          <th>Tanggal Invoice</th>
          <th>Kode Supplier</th>
          <th>Nama Supplier</th>
          <th>Total Tagihan</th>
          <th>No Payment</th>
          <th>Tanggal Payment</th>
          <th>Insert Oleh</th>
          <th>Reff</th>
          <th>Metode Payment</th>
          <th>Akun</th>
          <th>Jumlah Payment</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $global_no = 1; // Penomoran untuk invoice
        $grand_total_payment = 0;
        $last_no_invoice = ''; // Variabel untuk melacak invoice terakhir

        // Query data utama
        $sql1 = mysqli_query($koneksi, "
     SELECT 
    py.jumlah_payment,
    py.no_payment,
    py.tanggal_payment,
    py.insert_oleh,
    py.metode_payment,
    py.reff,
    py.akun,
    pbd.no_invoice,
    pbd.tanggal_invoice,
    pbd.kd_supp,
    supp.nama AS nama_supplier,
    p.kd_po, 
    p.ppn, 
    p.tarif_ppn,
    emp.name_e as nama_user,
    ac.deskripsi as nama_akun,
    jt.nama as jenis_transaksi,
    (
      (
        SELECT 
          SUM(
            (nilai * jml - disc) + 
            CASE 
              WHEN p.ppn = 1 THEN ((nilai * jml - disc) * p.tarif_ppn / 100)
              ELSE 0 
            END
          )
        FROM pembelian_invoice_detail 
        WHERE pembelian_invoice_detail.no_invoice = pbd.no_invoice
      )
      + pbd.ongkir
    ) AS total_tagihan
FROM 
    payment py
JOIN 
    pembelian_invoice pbd ON py.no_invoice = pbd.no_invoice
JOIN 
    pembelian p ON p.kd_po = pbd.kd_po
JOIN 
    supplier supp ON pbd.kd_supp = supp.kd_supp
JOIN 
    employee emp ON py.insert_oleh = emp.employee_number
JOIN 
    account ac ON py.akun = ac.no_account
JOIN 
    jenis_transaksi jt ON py.metode_payment = jt.kd_jenis
WHERE 
    pbd.status_payment = '2' 
    AND pbd.tanggal_invoice BETWEEN '$tgl_awal' AND '$tgl_akhir'
ORDER BY 
    pbd.no_invoice, py.no_payment;

  ");


        if (!$sql1) {
          die("Query error: " . mysqli_error($koneksi));
        }

        while ($row = mysqli_fetch_assoc($sql1)):
          $grand_total_payment += $row['jumlah_payment'];

          // Jika invoice baru, tampilkan informasi invoice
          if ($last_no_invoice !== $row['no_invoice']):
        ?>
            <tr>
              <td align="center"><?php echo $global_no++; ?></td>
              <td align="left"><?php echo $row['no_invoice']; ?></td>
              <td align="left"><?php echo $row['tanggal_invoice']; ?></td>
              <td align="left"><?php echo $row['kd_supp']; ?></td>
              <td align="left"><?php echo $row['nama_supplier']; ?></td>
              <td align="right"><?php echo number_format($row['total_tagihan']); ?></td>
              <td colspan="7"></td> <!-- Kosongkan kolom pembayaran -->
              <td style="display: none;"></td>
              <td style="display: none;"></td>
              <td style="display: none;"></td>
              <td style="display: none;"></td>
              <td style="display: none;"></td>
              <td style="display: none;"></td>

            </tr>
          <?php
            $last_no_invoice = $row['no_invoice']; // Perbarui invoice terakhir
          endif;
          ?>
          <tr>
            <td colspan="6"></td> <!-- Kosongkan kolom pembayaran -->
            <td style="display: none;"></td>
            <td style="display: none;"></td>
            <td style="display: none;"></td>
            <td style="display: none;"></td>
            <td style="display: none;"></td>
            <td align="left"><?php echo $row['no_payment']; ?></td>
            <td align="left"><?php echo $row['tanggal_payment']; ?></td>
            <td align="left"><?php echo $row['nama_user']; ?></td>
            <td align="left"><?php echo $row['reff']; ?></td>
            <td align="left"><?php echo $row['metode_payment'] . " - " . $row['jenis_transaksi']; ?></td>
            <td align="left"><?php echo $row['akun'] . " - " . $row['nama_akun']; ?></td>
            <td align="right"><?php echo number_format($row['jumlah_payment']); ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
      <tfoot>
        <tr style="font-weight: 600">
          <td colspan="12" align="right">Grand Total Payment</td>
          <td align="right"><?php echo number_format($grand_total_payment); ?></td>
        </tr>
      </tfoot>
    </table>





  <?php } elseif ($filter == 'supplier') { ?>
    <table id="example4" width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-bordered table-striped">
      <thead style="background-color: #ddd;">
        <tr style="font-weight: 600">
          <th align="center" width="40px">No</th>
          <th>No Invoice</th>
          <th>Tanggal Invoice</th>
          <th>Kode Supplier</th>
          <th>Nama Supplier</th>
          <th>Total Tagihan</th>
          <th>No Payment</th>
          <th>Tanggal Payment</th>
          <th>Insert Oleh</th>
          <th>Reff</th>
          <th>Metode Payment</th>
          <th>Akun</th>
          <th>Jumlah Payment</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $global_no = 1; // Penomoran untuk invoice
        $grand_total_payment = 0;
        $last_no_invoice = ''; // Variabel untuk melacak invoice terakhir

        // Query data utama
        $sql1 = mysqli_query($koneksi, "
     SELECT 
    py.jumlah_payment,
    py.no_payment,
    py.tanggal_payment,
    py.insert_oleh,
    py.metode_payment,
    py.reff,
    py.akun,
    pbd.no_invoice,
    pbd.tanggal_invoice,
    pbd.kd_supp,
    supp.nama AS nama_supplier,
    p.kd_po, 
    p.ppn, 
    p.tarif_ppn,
    emp.name_e as nama_user,
    ac.deskripsi as nama_akun,
    jt.nama as jenis_transaksi,
    (
      (
        SELECT 
          SUM(
            (nilai * jml - disc) + 
            CASE 
              WHEN p.ppn = 1 THEN ((nilai * jml - disc) * p.tarif_ppn / 100)
              ELSE 0 
            END
          )
        FROM pembelian_invoice_detail 
        WHERE pembelian_invoice_detail.no_invoice = pbd.no_invoice
      )
      + pbd.ongkir
    ) AS total_tagihan
FROM 
    payment py
JOIN 
    pembelian_invoice pbd ON py.no_invoice = pbd.no_invoice
JOIN 
    pembelian p ON p.kd_po = pbd.kd_po
JOIN 
    supplier supp ON pbd.kd_supp = supp.kd_supp
JOIN 
    employee emp ON py.insert_oleh = emp.employee_number
JOIN 
    account ac ON py.akun = ac.no_account
JOIN 
    jenis_transaksi jt ON py.metode_payment = jt.kd_jenis
WHERE 
    pbd.status_payment = '2' 
    AND pbd.tanggal_invoice BETWEEN '$tgl_awal' AND '$tgl_akhir'
    AND pbd.kd_supp = '$nilai'
ORDER BY 
    pbd.no_invoice, py.no_payment;

  ");


        if (!$sql1) {
          die("Query error: " . mysqli_error($koneksi));
        }

        while ($row = mysqli_fetch_assoc($sql1)):
          $grand_total_payment += $row['jumlah_payment'];

          // Jika invoice baru, tampilkan informasi invoice
          if ($last_no_invoice !== $row['no_invoice']):
        ?>
            <tr>
              <td align="center"><?php echo $global_no++; ?></td>
              <td align="left"><?php echo $row['no_invoice']; ?></td>
              <td align="left"><?php echo $row['tanggal_invoice']; ?></td>
              <td align="left"><?php echo $row['kd_supp']; ?></td>
              <td align="left"><?php echo $row['nama_supplier']; ?></td>
              <td align="right"><?php echo number_format($row['total_tagihan']); ?></td>
              <td colspan="7"></td> <!-- Kosongkan kolom pembayaran -->
              <td style="display: none;"></td>
              <td style="display: none;"></td>
              <td style="display: none;"></td>
              <td style="display: none;"></td>
              <td style="display: none;"></td>
              <td style="display: none;"></td>
            </tr>
          <?php
            $last_no_invoice = $row['no_invoice']; // Perbarui invoice terakhir
          endif;
          ?>
          <tr>
            <td colspan="6"></td> <!-- Kosongkan kolom pembayaran -->
            <td style="display: none;"></td>
            <td style="display: none;"></td>
            <td style="display: none;"></td>
            <td style="display: none;"></td>
            <td style="display: none;"></td>
            <td align="left"><?php echo $row['no_payment']; ?></td>
            <td align="left"><?php echo $row['tanggal_payment']; ?></td>
            <td align="left"><?php echo $row['nama_user']; ?></td>
            <td align="left"><?php echo $row['reff']; ?></td>
            <td align="left"><?php echo $row['metode_payment'] . " - " . $row['jenis_transaksi']; ?></td>
            <td align="left"><?php echo $row['akun'] . " - " . $row['nama_akun']; ?></td>
            <td align="right"><?php echo number_format($row['jumlah_payment']); ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
      <tfoot>
        <tr style="font-weight: 600">
          <td colspan="12" align="right">Grand Total Payment</td>
          <td align="right"><?php echo number_format($grand_total_payment); ?></td>
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