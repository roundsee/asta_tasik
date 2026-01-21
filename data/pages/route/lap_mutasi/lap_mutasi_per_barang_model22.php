<?php

include "../../../../config/koneksi.php";
include "../../../../config/fungsi_rupiah.php";
include "../../../../config/library.php";
include "../../../../config/fungsi_indotgl.php";


session_start();

$login_hash = $_SESSION['login_hash'];
$en = $_SESSION['employee_number'];
if (empty($_SESSION['namauser']) and empty($_SESSION['passuser'])) {
  echo "<link href='../../../../dist/style.css' rel='stylesheet' type='text/css'>
  <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<div class='wrapper'><a href=../../../../index.php><b>LOGIN</b></a></div></center>";
} else {

  $judulform = "Mutasi Per Barang";

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
  $lokasi = $_GET['lokasi'];
  $barang = $_GET['barang'];
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
  $judul2 = "";
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

    #example4_wrapper {
      width: 100%;
      overflow-x: auto;
    }

    #example4 {
      min-width: 1800px;
      width: 100%;
      table-layout: fixed;
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
      <hr>
      <div style="display: grid; grid-template-columns: 100px 1fr; row-gap: 5px; font-size: 14px;">
        <div><strong>Awal</strong></div>
        <div>: Saldo awal diambil dari saldo akhir hari sebelumnya.</div>

        <div><strong>Penerimaan</strong></div>
        <div>: Gabungan dari pembelian, penerimaan transfer barang, hasil barang jadi (BoM), retur penjualan, stock opname, dan void.</div>

        <div><strong>HPP</strong></div>
        <div>: Jumlah dari (nilai awal + nilai penerimaan) / (quantity awal + quantity penerimaan).</div>

        <div><strong>Pengeluaran</strong></div>
        <div>: Gabungan dari penjualan, pengiriman transfer barang, barang bahan baku (BoM), dan retur pembelian.</div>

        <div><strong>Akhir</strong></div>
        <div>: Saldo Akhir dari jumlah ((awal + penerimaan ) - pengeluaran ).</div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- <div class="table-responsive"> -->
  <?php if ($filter == 'semua') { ?>

    <!-- <center>
    <h3 class="mt-4 mb-3">Outlet dan Dapur</h3>
  </center> -->
    <div class="table-responsive">

      <table id="example4" class="table table-bordered table-striped">
        <thead style="background-color: lightgray;" class="elevation-2">
          <tr>
            <th width="50" rowspan="2">Tanggal</th>
            <th width="70" rowspan="2">Lokasi</th>

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
            <!-- <?php if ($tgl_awal == $tgl_akhir and $tgl_akhir == date("Y-m-d")) { ?>
              <th width="100" rowspan="2">Stock Opname</th>
            <?php } ?> -->
          </tr>
          <tr>
            <th width="55" style="text-align:right;" class="bg1">Qty Awal</th>
            <th width="55" style="text-align:right;" class="bg1">Harga Awal</th>
            <th width="55" style="text-align:right;" class="bg1">Nilai Awal</th>
            <th width="55" style="text-align:right;" class="bg2">Qty Terima</th>
            <th width="55" style="text-align:right;" class="bg2">Harga Terima</th>
            <th width="55" style="text-align:right;" class="bg2">Nilai Terima</th>
            <th width="55" style="text-align:right;" class="bg4">Qty Keluar</th>
            <th width="55" style="text-align:right;" class="bg4">Harga Keluar</th>
            <th width="55" style="text-align:right;" class="bg4">Nilai Keluar</th>
            <th width="55" style="text-align:right;" class="bg5">Qty Akhir</th>
            <th width="55" style="text-align:right;" class="bg5">Harga Akhir</th>
            <th width="55" style="text-align:right;" class="bg5">Nilai Akhir</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $query = "SELECT *
      ,IFNULL((SELECT nama FROM barang WHERE barang.kd_brg = mutasi_stok.kd_brg LIMIT 1), '-') AS nama_barang
      ,IFNULL((SELECT nama FROM pelanggan WHERE pelanggan.kd_cus = mutasi_stok.kd_cus LIMIT 1), '-') AS nama_lokasi

        FROM mutasi_stok WHERE tgl >= '$tgl_awal' AND tgl <= '$tgl_akhir' AND kd_cus = '$lokasi' AND kd_brg = '$barang'  
        ORDER BY mutasi_stok.tgl,mutasi_stok.kd_brg DESC";

          $sql1 = mysqli_query($koneksi, $query);

          if (!$sql1) {
            die("querry error" . mysqli_error($koneksi));
          }

          while ($s1 = mysqli_fetch_array($sql1)) {
          ?>
            <tr align="left">
              <td><?php echo $s1['tgl']; ?></td>
              <td style="text-align: left; font-weight: bold;" data-value="<?php echo $s1['kd_cus']; ?>"><?php echo substr($s1['nama_lokasi'], 0, -9); ?></td>
              <td><?php echo $s1[$f3]; ?></td>
              <td><?php echo $s1['nama_barang']; ?></td>
              <td style="text-align: right;" class="bg1"><?php echo $s1['qty_awal']; ?></td>
              <td style="text-align: right;" class="bg1"><?php echo ($s1['qty_awal'] != 0) ? round($s1['nilai_awal'] / $s1['qty_awal'], 2) : 0; ?></td>
              <td style="text-align: right;" class="bg1"><?php echo $s1['nilai_awal']; ?></td>

              <td style="text-align: right;" class="bg2"><?php echo $s1['qty_beli'] + $s1['qt_produksi'] + $s1['qt_terima_int'] + $s1['qt_opname_hari'] + $s1['qt_retur_jual'] + $s1['qt_void']; ?></td>
              <td style="text-align: right;" class="bg2"><?php echo (($s1['qty_beli'] + $s1['qt_produksi'] + $s1['qt_terima_int'] + $s1['qt_opname_hari']  + $s1['qt_retur_jual']  + $s1['qt_void']) != 0) ? round((($s1['nilai_beli'] + $s1['nilai_produksi'] + $s1['nilai_terima_int'] + $s1['nilai_opname_hari'] + $s1['nilai_retur_jual'] + $s1['nilai_void']) / ($s1['qty_beli'] + $s1['qt_produksi'] + $s1['qt_terima_int'] + $s1['qt_opname_hari'] + $s1['qt_retur_jual'] + $s1['qt_void'])), 2) : 0; ?></td>
              <td style="text-align: right;" class="bg2"><?php echo $s1['nilai_beli'] + $s1['nilai_produksi'] + $s1['nilai_terima_int'] + $s1['nilai_opname_hari'] + $s1['nilai_retur_jual'] + $s1['nilai_void']; ?></td>

              <td style="text-align: left;" class="bg3"><?php echo  $s1['harga_rata']; ?></td>

              <td style="text-align: right;" class="bg4"><?php echo $s1['qt_kirim_int'] + $s1['qt_pake'] + $s1['qt_jual'] + $s1['qty_beli_retur']; ?></td>
              <td style="text-align: right;" class="bg4"><?php echo (($s1['qt_kirim_int'] + $s1['qt_pake'] + $s1['qt_jual'] + $s1['qty_beli_retur']) != 0) ? round((($s1['nilai_kirim_int'] + $s1['nilai_pake'] + $s1['nilai_jual'] + $s1['nilai_beli_retur']) / ($s1['qt_kirim_int'] + $s1['qt_pake'] + $s1['qt_jual'] + $s1['qty_beli_retur'])), 2) : 0; ?></td>
              <td style="text-align: right;" class="bg4"><?php echo $s1['nilai_kirim_int'] + $s1['nilai_pake'] + $s1['nilai_jual'] + $s1['nilai_beli_retur']; ?></td>

              <td style="text-align: right;" class="bg5"><?php echo $s1['qt_akhir']; ?></td>
              <td style="text-align: right;" class="bg5"><?php echo ($s1['qt_akhir'] != 0) ? round(($s1['nilai_akhir'] / $s1['qt_akhir']), 2)  : 0;  ?></td>
              <td style="text-align: right;" class="bg5"><?php echo $s1['nilai_akhir']; ?></td>
              <!-- <?php if ($tgl_awal == $tgl_akhir and $tgl_akhir == date("Y-m-d")) { ?>
                <td style="text-align: right;">
                  <button type="button" onclick="navigateOpname(this)" class="btn btn-secondary"><i class="fa fa-close"></i><strong style="color: whitesmoke;"> Stock Opname</strong></button>
                </td>
              <?php } ?> -->
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
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
    function navigateOpname(button) {
      var row = button.closest('tr');
      const te1s = '<?php echo $en; ?>';
      var tdValue = row.querySelector('td:nth-child(1)').textContent;
      var tdValue2 = row.querySelector('td:nth-child(2)').getAttribute('data-value');
      var tdValue3 = row.querySelector('td:nth-child(3)').textContent;

      const jumlahopname = prompt("Masukan Stock Terbaru");
      if (jumlahopname && jumlahopname.trim() !== '') {
        let jumlah = jumlahopname.replace(/\D/g, '');
        console.log(`tanggal :${tdValue}, Lokasi :${tdValue2}, Barang :${tdValue3}, jumlah :${jumlah}`);
        $.ajax({
          type: 'GET',
          url: 'ajax_opname_stock.php?tanggal=' + tdValue + '&lokasi=' + tdValue2 + '&barang=' + tdValue3 + '&jumlah=' + jumlah + '&user=' + te1s,
          dataType: 'json',
          success: function(response) {
            console.log('Success response received');
            console.log('Response:', response);
            if (response.error) {
              console.log('Error:', response.error);
            } else {
              console.log('Success:', response.success);
              console.log('Reloading the page');
              location.reload(); // Page reload
            }
            // Log all parameters
            // console.log('barang:', response.barang);
            // console.log('lokasi:', response.lokasi);
            // console.log('tanggal:', response.tanggal);
            // console.log('jumlah:', response.jumlah);
          },
          error: function(xhr, status, error) {
            console.log(xhr.responseText);
          }
        });
      }
    }
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

<?php include '../footer_lap_mutasi.php';
} ?>