<?php

include "../../../../config/koneksi.php";
include "../../../../config/fungsi_rupiah.php";
include "../../../../config/library.php";
include "../../../../config/fungsi_indotgl.php";


session_start();

$login_hash = $_SESSION['login_hash'];
$en = $_SESSION['employee_number'];

$judulform = "Stok Terkini";

$data = 'lap_stok';
$rute = 'lap_stok';
$aksi = 'aksi_list_stok';


$tabel = 'inventory';
$f1 = 'kd_cus';
$f2 = 'kd_brg';
$f3 = 'stok';
$f4 = 'satuan';


$j1 = 'Kode Lokasi';
$j2 = 'Kode Barang';
$j3 = 'Stok';
$j4 = 'Satuan';


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
  $query = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE kd_cus='$nilai' ");
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
$judul2 =   "  " . $judul_nilai;
// $judul3 = 'Periode : ' . $tgl_awal . " s/d " . $tgl_akhir;

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
      border-top: 8px solid #149;
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


    #example4 th {
      text-align: center;
      white-space: nowrap;
    }

    #example4 th:nth-child(1) {
      width: 5%;
    }

    #example4 th:nth-child(2) {
      width: 15%;
    }

    #example4 th:nth-child(3) {
      width: 20%;
    }

    #example4 th:nth-child(4) {
      width: 10%;
    }

    #example4 th:nth-child(5) {
      width: 25%;
    }

    #example4 th:nth-child(6) {
      width: 15%;
    }

    #example4 th:nth-child(7) {
      width: 10%;
    }
  </style>

  <div id="loading-bar">
    <div class="spinner-container">
      <div class="spinner"></div>
    </div>
    <div class="loading-text">
      Proses<span class="dot">.</span><span class="dot">.</span><span class="dot">.</span><span class="dot">.</span><span class="dot">.</span>
    </div>
  </div>
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

          <!-- <?php echo $judul3; ?> -->
        </h4>
      </center>
    </div><!-- /.container-fluid -->
  </section>
  <!-- <div class="table-responsive"> -->
  <?php if ($filter == 'semua') { ?>
    <table id="example4" class="table table-bordered table-striped">
      <thead style="background-color: #ddd;">
        <tr style="font-weight: 600">
          <th>No</th>
          <th>Kode Barang</th>
          <th>Nama Barang</th>
          <th>Stok Swalayan</th>
          <th>Stok Gudang</th>
          <th>Satuan</th>
        </tr>
      </thead>
      <tbody id="inventoryTableBodysearch">
        <?php
        // Query untuk mendapatkan data barang dan inventory
        $query = "
    SELECT 
    barang.kd_brg,
    barang.nama AS nama_barang,
    COALESCE(sw.stok, 0) AS stok_swalayan,
    COALESCE(gd.stok, 0) AS stok_gudang,
    barang.Satuan1 AS satuan
      FROM barang
      LEFT JOIN inventory sw ON barang.kd_brg = sw.kd_brg AND sw.kd_cus = '1316'
      LEFT JOIN inventory gd ON barang.kd_brg = gd.kd_brg AND gd.kd_cus = '8001'
      WHERE `kd_subgrup` IS NULL
     ORDER BY stok_swalayan ASC, stok_gudang ASC
          ";

        $result = mysqli_query($koneksi, $query);

        if (!$result) {
          die("Error: " . mysqli_error($koneksi));
        }

        $no = 1; // Inisialisasi nomor
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
          <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $row['kd_brg']; ?></td>
            <td><?php echo $row['nama_barang']; ?></td>
            <td style="text-align: right;"><?php echo number_format($row['stok_swalayan']); ?></td>
            <td style="text-align: right;"><?php echo number_format($row['stok_gudang']); ?></td>
            <td><?php echo $row['satuan']; ?></td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>



  <?php } elseif ($filter == 'supplier') { ?>
    <table id="example4" class="table table-bordered table-striped">
      <thead style="background-color: #ddd;">
        <tr style="font-weight: 600">
          <th>No</th>
          <th>Kode Barang</th>
          <th>Nama Barang</th>
          <th>Stok</th>
          <th>Satuan</th>
        </tr>
      </thead>
      <tbody id="inventoryTableBodysearch">
        <?php


        // Query untuk mendapatkan data barang dan inventory berdasarkan kd_cus
        $query = "
        SELECT 
          barang.kd_brg,
          barang.nama AS nama_barang,
          sw.stok,
          barang.Satuan1 AS satuan
        FROM barang
        LEFT JOIN inventory sw ON barang.kd_brg = sw.kd_brg
        WHERE sw.kd_cus = '$nilai' AND `kd_subgrup` IS NULL
        ORDER BY sw.stok 
      ";

        $result = mysqli_query($koneksi, $query);

        if (!$result) {
          die("Error: " . mysqli_error($koneksi));
        }

        $no = 1; // Inisialisasi nomor
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
          <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $row['kd_brg']; ?></td>
            <td><?php echo $row['nama_barang']; ?></td>
            <td style="text-align: right;"><?php echo number_format($row['stok']); ?></td>
            <td><?php echo $row['satuan']; ?></td>
          </tr>
        <?php
        }
        ?>
      </tbody>
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
    var tablebaranguntuksearch = $("#examplebarang").DataTable({
      "responsive": false,
      "autoWidth": false,
      'searching': false,
    });
    $(document).on("input", "#cariBarangInventory", function() {
      var searchValue = $(this).val();
      console.log("Input Value:", searchValue); // Debug nilai input

      $.ajax({
        type: "GET",
        url: "searchTableInventory.php?value=" + encodeURIComponent(searchValue),
        dataType: "json",
        success: function(response) {
          console.log("AJAX Response:", response); // Debug respons dari server

          // Kosongkan tabel sebelum menambahkan data baru
          $("#inventoryTableBodysearch").empty();

          if (Array.isArray(response) && response.length > 0) {
            let current_kd_brg = null;
            let no = 1;

            // Iterasi setiap item dalam respons
            $.each(response, function(index, item) {
              console.log("Item Data:", item); // Debug data item

              if (current_kd_brg !== item.kd_brg) {
                current_kd_brg = item.kd_brg;

                // Tambahkan baris grup untuk kd_brg baru
                const groupRow = `
              <tr style="background-color: #f0f0f0; font-weight: bold;">
                <td>${no++}</td>
                <td>${item.kd_brg || ''}</td>
                <td>${item.nama_barang || ''}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            `;
                $("#inventoryTableBodysearch").append(groupRow);
              }

              // Tambahkan baris data lokasi
              const dataRow = `
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td>${item.kd_cus || ''}</td>
              <td>${item.nama_lokasi || ''}</td>
              <td>${item.stok ? parseInt(item.stok).toLocaleString() : ''}</td>
              <td>${item.satuan_barang || ''}</td>
            </tr>
          `;
              $("#inventoryTableBodysearch").append(dataRow);
            });
          } else {
            console.warn("No data found or response is invalid."); // Debug jika data kosong atau tidak valid
            const noDataRow = `
          <tr align="middle">
            <td colspan="7">Tidak ada data ditemukan</td>
          </tr>
        `;
            $("#inventoryTableBodysearch").append(noDataRow);
          }
        },
        error: function(xhr, status, error) {
          console.error("AJAX Error:", status, error); // Debug error dari server
          console.error("Response Text:", xhr.responseText);
        },
      });
    });
  </script>



  <script>
    $(document).ready(function() {
      // Menghilangkan loading bar setelah halaman siap
      $("#loading-bar").hide();


    });
  </script>

<?php include '../footer_lap_stok_terkini.php';
} ?>