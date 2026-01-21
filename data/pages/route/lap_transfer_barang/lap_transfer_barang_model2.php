<?php

include "../../../../config/koneksi.php";
include "../../../../config/fungsi_rupiah.php";
include "../../../../config/library.php";
include "../../../../config/fungsi_indotgl.php";


session_start();

$login_hash = $_SESSION['login_hash'];
$en = $_SESSION['employee_number'];
$judulform = 'Laporan Pembelian';

$judulform = "Transfer Barang";

$data = 'lap_transfer_barang';
$rute = 'lap_pembelap_transfer_baranglian';
$aksi = 'aksi_list_transfer_barang';

$tabel = 'permintaan_barang';

// Variabel untuk nama kolom tabel permintaan_barang
$f1 = 'kode_permintaan';
$f2 = 'kd_cus_peminta';
$f3 = 'kd_cus_pengirim';
$f4 = 'tanggal_permintaan';
$f5 = 'status_permintaan';
$f6 = 'keterangan';

// Variabel untuk label kolom
$j1 = 'Kode Permintaan';
$j2 = 'Penerima';
$j3 = 'Pengirim';
$j4 = 'Tanggal Permintaan';
$j5 = 'Status Permintaan';
$j6 = 'Keterangan';

$tabel2 = "permintaan_barang_detail";

// Variabel untuk nama kolom tabel permintaan_barang_detail
$ff1 = 'id_detail';
$ff2 = 'kode_permintaan';
$ff3 = 'kd_cus_peminta';
$ff4 = 'kd_barang';
$ff5 = 'nama_barang';
$ff6 = 'qty_diajukan';
$ff7 = 'qty_terkirim';
$ff8 = 'qty_diterima';
$ff9 = 'qty_satuan';
$ff10 = 'satuan';
$ff11 = 'harga';
$ff12 = 'urut';
$ff13 = 'status_item';

// Variabel untuk label kolom
$jj1 = 'ID Detail';
$jj2 = 'Kode Permintaan';
$jj3 = 'Kode Customer Peminta';
$jj4 = 'Kode Barang';
$jj5 = 'Nama Barang';
$jj6 = 'Quantity Permintaan';
$jj7 = 'Quantity Terkirim';
$jj8 = 'Quantity Diterima';
$jj9 = 'Quantity Satuan';
$jj10 = 'Satuan';
$jj11 = 'Harga';
$jj12 = 'Urut';
$jj13 = 'Status Item';



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
          <th>Tanggal Permintaan</th>
          <th>Tanggal Penerimaan</th>
          <th>Kode Permintaan</th>
          <th>Pengirim</th>
          <th>Penerima</th>
          <th>Kode Barang</th>
          <th>Nama Barang</th>
          <th align="left">Qty Diajukann</th>
          <th align="left">Qty Kirim</th>
          <th align="left">Qty Terima</th>
          <th align="left">Satuan</th>
          <th align="left">Qty Satuan</th>
          <th align="left" width="140px">Harga</th>
          <th align="left" width="140px">Total Harga</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql_faktur = "SELECT pbi.kode_permintaan as kode_permintaan
      FROM penerimaan_barang_detail_internal pbd
      JOIN penerimaan_barang_internal pbi ON pbi.kode_penerimaan = pbd.kode_penerimaan 
      JOIN permintaan_barang pb ON pb.kode_permintaan = pbi.kode_permintaan 
      WHERE pb.status_permintaan = '2' AND pbd.tanggal_penerimaan BETWEEN '$tgl_awal' AND '$tgl_akhir'";

        $result_faktur = mysqli_query($koneksi, $sql_faktur);

        if (!$result_faktur) {
          die("Query error: " . mysqli_error($koneksi));
        }

        $faktur_list = [];
        while ($row = mysqli_fetch_assoc($result_faktur)) {
          $faktur_list[] = "'" . $row['kode_permintaan'] . "'";
        }

        $faktur = "";
        if (count($faktur_list) > 0) {
          $faktur = "(" . implode(",", $faktur_list) . ")";
        }

        $no = 1;
        $last_kode_permintaan = ''; // Melacak kode permintaan terakhir
        $last_tanggal_permintaan = ''; // Melacak tanggal permintaan terakhir
        $total_qty_diajukan = 0;
        $total_qty_dikirim = 0;
        $total_qty_diterima = 0;
        $grand_total_harga = 0;

        // Query untuk mendapatkan data
        $sql1 = mysqli_query($koneksi, "
    SELECT 
        pb.tanggal_permintaan,
        pb.kode_permintaan,
        pb.kd_cus_pengirim AS Pengirim,
        pb.kd_cus_peminta AS Penerima,
        pbd.kd_barang,
        pbd.nama_barang,
        pbd.qty_terkirim AS Qty_Kirim,
        pbd.qty_diterima AS Qty_Terima,
        pbd.qty_diajukan AS Qty_Diajukan,
        pbd.satuan,
        pbd.qty_satuan,
        pbid.tanggal_penerimaan,
        barang.harga
    FROM 
        permintaan_barang pb
    JOIN 
        permintaan_barang_detail pbd
    ON 
        pb.kode_permintaan = pbd.kode_permintaan
    LEFT JOIN 
        penerimaan_barang_internal pbi
    ON 
        pb.kode_permintaan = pbi.kode_permintaan
    LEFT JOIN 
        penerimaan_barang_detail_internal pbid
    ON pbi.kode_penerimaan = pbid.kode_penerimaan
    AND pbd.kd_barang = pbid.kd_barang
    JOIN
        barang
    ON pbd.kd_barang = barang.kd_brg
    WHERE 
        " . ($faktur !== "" ? "pb.kode_permintaan IN $faktur OR " : "") . "
        (pb.status_permintaan = '2' AND
        pb.tanggal_permintaan BETWEEN '$tgl_awal' AND '$tgl_akhir')
    ORDER BY 
        pb.tanggal_permintaan, pb.kode_permintaan;
  ");

        if (!$sql1) {
          die("Query error: " . mysqli_error($koneksi));
        }

        while ($row = mysqli_fetch_assoc($sql1)) {
          // Hitung Total Harga
          $total_harga = $row['harga'] * $row['Qty_Terima'];
          $grand_total_harga += $total_harga;

          $total_qty_diajukan += $row['Qty_Diajukan'];
          $total_qty_dikirim += $row['Qty_Kirim'];
          $total_qty_diterima += $row['Qty_Terima'];


          // Tampilkan Tanggal dan Kode Permintaan hanya jika berbeda
          // $tanggal_permintaan = ($last_tanggal_permintaan === $row['tanggal_permintaan'] && $last_kode_permintaan === $row['kode_permintaan']) ? '' : $row['tanggal_permintaan'];
          // $kode_permintaan = ($last_kode_permintaan === $row['kode_permintaan']) ? '' : $row['kode_permintaan'];

          $tanggal_permintaan =  $row['tanggal_permintaan'];
          $kode_permintaan =  $row['kode_permintaan'];
        ?>
          <tr>
            <td align="right"><?php echo $no; ?></td>
            <td align="left"><?php echo $tanggal_permintaan; ?></td>
            <td align="left"><?php echo $row['tanggal_penerimaan']; ?></td>
            <td align="left"><?php echo $kode_permintaan; ?></td>
            <td align="left"><?php echo $row['Pengirim']; ?></td>
            <td align="left"><?php echo $row['Penerima']; ?></td>
            <td align="left"><?php echo $row['kd_barang']; ?></td>
            <td align="left"><?php echo $row['nama_barang']; ?></td>
            <td align="right"><?php echo number_format($row['Qty_Diajukan']); ?></td>
            <td align="right"><?php echo number_format($row['Qty_Kirim']); ?></td>
            <td align="right"><?php echo number_format($row['Qty_Terima']); ?></td>
            <td align="center"><?php echo $row['satuan']; ?></td>
            <td align="right"><?php echo number_format($row['qty_satuan']); ?></td>
            <td align="right"><?php echo number_format($row['harga']); ?></td>
            <td align="right"><?php echo number_format($total_harga); ?></td>
          </tr>
        <?php
          // Perbarui variabel untuk kode dan tanggal permintaan terakhir
          // if ($kode_permintaan !== '') {
          //   $last_kode_permintaan = $row['kode_permintaan'];
          // }
          // if ($tanggal_permintaan !== '') {
          //   $last_tanggal_permintaan = $row['tanggal_permintaan'];
          // }

          $no++;
        }
        ?>
      </tbody>
      <tfoot>
        <tr style="font-weight: 600">
          <td colspan="7" align="right">Grand Total Keseluruhan</td>
          <td align="right"><?php echo number_format($total_qty_diajukan); ?></td>
          <td align="right"><?php echo number_format($total_qty_dikirim); ?></td>
          <td align="right"><?php echo number_format($total_qty_diterima); ?></td>
          <td></td>
          <td></td>
          <td align="right"><?php echo number_format($grand_total_harga); ?></td>
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